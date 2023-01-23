<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts & Cards') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <button type="button" class="btn bg-blue-400 btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-pencil"></i> Add Label to this account
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
                    <div class="modal-dialog" role="form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="label">Rename the Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/account/{{$account->id}}/edit" method="POST"> @csrf
                                    <div class="form-group">
                                       @method('PUT')
                                        <label for="label" class="col-form-label">Label:</label>
                                        <input type="text" class="form-control" id="label" name="label" value="{{$account->label}}">
                                        @error('label')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary bg-blue-400" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary bg-blue-400">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <li>@if(isset($account->label))({{$account->label}}) @endif{{ $account->number }}</li>
                <li>Holder Name: {{ Auth::user()->name }}</li>
                Balance: {{ number_format($account->balance / 100, 2) }} {{$account->currencySymbol}}
            </div>
        </div>
    </div>
</x-app-layout>
