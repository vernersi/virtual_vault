<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crypto Currencies') }}
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
            <div class="max-fit rounded overflow-hidden shadow-lg mx-auto sm:px-0 lg:px-0 bg-white">
                <div class="min-h-0 bg-gray-100 flex flex-col justify-center">
                    <div class="relative p-12 w-full sm:max-w-2xl sm:mx-auto">
                        <div class="overflow-hidden z-0 rounded-full relative p-2">
                            <form role="form" class="relative flex z-50 bg-white rounded-full">
                                <input type="text" placeholder="Enter the coin name" class="rounded-full flex-1 px-6 py-4 text-gray-700 focus:outline-none">
                                <button class="bg-blue-500 text-white rounded-full font-semibold px-8 py-4 hover:bg-blue-400 focus:bg-blue-600 focus:outline-none">Search</button>
                            </form>
                            <div class="glow glow-1 z-10 bg-pink-400 absolute"></div>
                            <div class="glow glow-2 z-20 bg-purple-400 absolute"></div>
                            <div class="glow glow-3 z-30 bg-yellow-400 absolute"></div>
                            <div class="glow glow-4 z-40 bg-blue-400 absolute"></div>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="grid grid-cols-4 gap-6 transition-colors py-6">
                            @foreach($coins as $coin)
                                <div class="col-span-1 hover:shadow-lg">
                                    <div class="card p-6 bg-gray-100 border-b border-black-200 hover:bg-gray-300" onclick="window.location.href='/crypto/{{$coin->getId()}}'">
                                        <div class="card-body">
                                            <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$coin->getId()}}.png" alt="logo" width="75" style="margin-left: auto; margin-right: auto; padding-bottom: 20px">
                                            <h3 class="card-title text-lg font-semibold text-gray-800">{{ $coin->getName() }}</h3>
                                            <p class="card-subtitle text-gray-600">{{ $coin->getSymbol() }}</p>
                                            <h3 class="card-title text-lg font-semibold text-gray-800">{{ number_format($coin->getPrice(),9)  }} $</h3>
                                            @if($coin->getPercentChange24h() < 0)
                                                <p class="card-subtitle text-red-600"><i class="fa fa-caret-down"></i> {{ number_format($coin->getPercentChange24h(),3) }} %</p>
                                            @else
                                                <p class="card-subtitle text-green-600"><i class="fa fa-caret-up"></i> {{ number_format($coin->getPercentChange24h(),3) }} %</p>
                                            @endif
                                            <button class="btn-primary bg-blue-500 text-white rounded-full font-semibold px-8 py-0 hover:bg-blue-400 focus:bg-blue-600 focus:outline-none" style="margin-top: 20px" onclick="window.location.href='/crypto/{{$coin->getId()}}'">View Coin</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
