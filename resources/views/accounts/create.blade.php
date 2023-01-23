<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Account') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                To add new Account fill the information below:
            </div>
        </div>
    </div>
    <form action="/account/create" method="POST">
        @csrf
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    Select the currency of account you want to create:
                <div>
                    <select class="form-control form-select-lg mb-3" aria-label=".form-select-lg example"
                            name="currency" id="currency">
                        @foreach ($currencies as $currency)
                            <option value="{{$currency}}">{{ $currency }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div>
                    <label for="label">Add the label to your new account if you wish</label>
                    <input type="text" name="label" id="label" class="form-control" placeholder="Label">
                </div>
            </div>
            <div class="py-10">
                <div class="max-w-max mx-auto sm:px-6 lg:px-0">
                    <div class="bg-green-700 overflow-hidden  sm:rounded-r-lg sm:rounded-l-lg">
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
