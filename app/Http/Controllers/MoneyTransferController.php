<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MoneyTransferController extends Controller
{
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        //random security code for the transfer
        $securityCodeNumber = rand(1, 6);
        //TODO noy quite sure if putting it in cache is the best way to do it but it works
        Cache::put('securityCodeNumber', $securityCodeNumber);
        return view('transactions.transfer',[
            'accounts' => $accounts,
            'securityNumber'=>$securityCodeNumber
        ]);
    }

    //TODO optimize validation
    public function store()
    {
       $data = request()->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_user_name' => 'required|exists:users,name',
            'to_account_number' => 'required|exists:accounts,number',
            'amount' => 'required|numeric|min:0.01',
            'password' => 'required',
            'security_code' => 'required|numeric|min:1'
        ]);
        $fromAccount = Account::find($data['from_account_id']);
        $toAccount = Account::where('number', $data['to_account_number'])->first();
        //check if password and security code are correct
        if (!Auth::attempt(['name' => Auth::user()->name, 'password' => $data['password']])) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }
        /*var_dump($data['security_code']);
        var_dump(Auth::user()->{"security_code_" . Cache::get('securityCodeNumber')});die;*/
        // chick if security code is the same as in db users column security_code_.Cache correct and delete it from cache
        if ($data['security_code'] != Auth::user()->{"security_code_" . Cache::get('securityCodeNumber')}) {
            return back()->withErrors(['security_code' => 'Incorrect security code']);
        }
        // check if the to_user_name does not mach the user_name of the to_account
        if ($toAccount->user->name !== $data['to_user_name']) {
            return redirect()->back()->withErrors(['to_user_name' => 'The receivers name or Account number is invalid.']);
        }
        if ($fromAccount->user_id !== Auth::id() || $toAccount->user_id === Auth::id()) {
            abort(403);
        }
        if ($fromAccount->balance < $data['amount']*100) {
            return redirect()->back()->withErrors(['amount' => 'You do not have enough money to make this transaction']);
        }
        //check if to_account currency has the same as the from_account currency
        if ($fromAccount->currency !== $toAccount->currency) {
            //check if currency rates are stored in cache if not store them
            if (!Cache::has('currencies')) {
                $currencies = new CurrencyRepository();
                Cache::put('currencies', $currencies, now()->addHour());
            }

            $toAccountRate = Cache::get('currencies')->getCurrencyRate($toAccount->currency);
            $fromAccountRate = Cache::get('currencies')->getCurrencyRate($fromAccount->currency);
            $data['amountExchanged'] = $data['amount'] * $toAccountRate / $fromAccountRate;
        }

        //add transaction to transactions table
        $fromAccount->transactions()->create([
            'from_user_id' => Auth::id(),
            'from_account_id' => $fromAccount->id,
            'to_user_id' => $toAccount->user_id,
            'to_account_id' => $toAccount->id,
            'amount' => $data['amount']*100,
            'currency' => $toAccount->currency,
        ]);

        $fromAccount->balance -= $data['amount']*100;
        $toAccount->balance += $data['amountExchanged']*100;
        //verify that the transaction was successful
        if ($fromAccount->save() && $toAccount->save()) {
            return redirect()->route('home')->with('success', 'Transaction was successful');
        }
        return redirect()->back()->withErrors(['amount' => 'Transaction failed']);
    }
}
