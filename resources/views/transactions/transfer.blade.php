<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new Transaction') }}
        </h2>
    </x-slot>
    <div class="py-10">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="form-group" action="/transfer" method="post">
                    @csrf
                Choose your account:
                <select class="form-control form-select-lg mb-3" aria-label=".form-select-lg example" name="from_account_id" id="from_account_id">
                    @foreach ($accounts as $account)
                        <option value="{{$account->id}}">@if(isset($account->label))({{$account->label}}) @endif{{ $account->number }} ({{ number_format($account->balance / 100, 2) }}{{$account->currencySymbol}})</option>
                            <a href="/account/{{$account->id}}/edit"><ul>{{ $account->number }} / {{ number_format($account->balance / 100, 2) }}{{$account->currencySymbol}}</ul></a>
                    @endforeach
                </select>
                    <div class="form-group">
                        <label for="toUserName">Receivers Name:</label>
                        <input type="text" class="form-control" name="to_user_name" id="to_user_name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="toUserAccountNumber">Receivers bank account number:</label>
                        <input type="text" class="form-control" name="to_account_number" id="to_account_number" placeholder="Account Number">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount of money for transfer:</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="security_code">Enter your password: </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label for="security_code">Security Code Nr: {{$securityNumber}}</label>
                        <input type="password" class="form-control" name="security_code" id="security_code" placeholder="Enter Security Code">
                    </div>
                    <!-- submit button for form -->
                    <button type="submit" class="btn btn-primary" style="background-color: #1c7430">Submit Transaction</button>
                    <div class="py-10">
                        <a>* Note, that in case of currency selected does not match receivers, it will be converted according to Virtual Vault rate</a>
            </div>
                </form>
        </div>
        </div>
    </div>
</x-app-layout>
