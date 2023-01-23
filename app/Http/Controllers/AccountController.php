<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Repositories\CurrencyRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('home', [
            'accounts' => $accounts
        ]);
    }

    public function edit(Account $account)
    {
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }
        return view('accounts.edit', [
            'account' => $account
        ]);
    }


    public function update(Account $account)
    {
        request()->validate([
            'label' => 'required|string|min:1|max:12'
        ]);

        if ($account->user_id !== Auth::id()) {
            abort(403);
        }
        $account->update([
            'label' => request('label')
        ]);
        return view('accounts.edit', [
            'account' => $account
        ]);

    }

    public function create()
    {
        if (!Cache::has('currencies')) {
            $currencies = new CurrencyRepository();
            Cache::put('currencies', $currencies, now()->addHour());
        }
        $currencies = Cache::get('currencies')->getAllCurrencyCodes();
        // return accounts.create view with currencies
        return view('accounts.create', [
            'currencies' => $currencies
        ]);
    }

    public function store()
    {
        request()->validate([
            'label' => 'required|string|min:1|max:12'
        ]);
        $account = (new Account())->fill([
            'number' => rand(10, 99) . 'VVLV' . rand(100000, 999999),
            'balance' => 0,
            'currency' => request('currency'),
            'label' => request('label')
        ]);
        $account->user()->associate(Auth::user());
        $account->save();
        return redirect()->route('home')->with('success', 'Account was created Successfully');
    }


}
