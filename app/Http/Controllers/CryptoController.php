<?php

namespace App\Http\Controllers;

use App\Repositories\CoinMarketCryptoRepository;
use App\Repositories\CoinsRepository;
use App\Services\CoinMarketCapCryptoAPI;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    private CoinMarketCryptoRepository $coinsRepository;

    public function __construct(CoinMarketCryptoRepository $coinsRepository)
    {
        $this->coinsRepository = $coinsRepository;
    }
    public function index(): View
    {
        $coins = $this->coinsRepository->getList();
        return view('crypto.main', [
            'coins' => $coins
        ]);
    }

    public function show(string $symbol): View
    {

        //get coin from api using symbol
        $coin = $this->coinsRepository->getBySymbol($symbol);
        return view('crypto.single', [
            'coin' => $coin
        ]);
    }
    //
}
