<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts & Cards') }}
        </h2>
    </x-slot>
    <div class="py-10">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <!-- create button to make a new account  -->
                    <div class="text-2s mx-auto sm:px-0 lg:px-0">
                        <a href="{{ route('accounts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fa fa-plus" aria-hidden="true"></i>
                            Create Account</a>
                    </div>

                </div>
            </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($accounts as $account)
                    <div class="p-6 text-gray-900">
                        <a href="/account/{{$account->id}}/edit">
                            <ul>
                                <span style="color: #721c24">@if(isset($account->label))({{$account->label}}) @endif</span>
                                {{ $account->number }} /
                                {{ number_format($account->balance / 100, 2) }}
                                {{$account->currencySymbol}}</ul></a>
                    </div>
                @endforeach
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- add table of users security_codes without href -->

            </div>
        </div>
    </div>
</x-app-layout>
