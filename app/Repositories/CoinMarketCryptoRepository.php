<?php
namespace App\Repositories;

use App\Interfaces\CryptoInterface;
use App\Models\Crypto;
use App\Services\CoinMarketCapCryptoAPI;
use Illuminate\Support\Collection;


class CoinMarketCryptoRepository implements CryptoInterface
{
    public function getList(): Collection
    {
        // TODO: Implement getList() method.
        $coinMarketCapCryptoAPI = new CoinMarketCapCryptoAPI();
        $coins = $coinMarketCapCryptoAPI->getList();
        $collection = collect();
        foreach ($coins as $coin) {
            $collection->push(new Crypto(
                $coin['id'],
                $coin['name'],
                $coin['symbol'],
                $coin['date_added'],
                $coin['max_supply'],
                $coin['circulating_supply'],
                $coin['total_supply'],
                $coin['last_updated'],
                $coin['quote']['USD']['price'],
                $coin['quote']['USD']['volume_24h'],
                $coin['quote']['USD']['volume_change_24h'],
                $coin['quote']['USD']['percent_change_24h'],
                $coin['quote']['USD']['market_cap']
            ));
        }
        return $collection;
    }

    public function getBySymbol(string $symbol): ?Crypto
    {
        $coinMarketCapCryptoAPI = new CoinMarketCapCryptoAPI();
        $coin = $coinMarketCapCryptoAPI->getBySymbol($symbol)[$symbol];
        $coin = new Crypto(
            $coin['id'],
            $coin['name'],
            $coin['symbol'],
            $coin['date_added'],
            $coin['max_supply'],
            $coin['circulating_supply'],
            $coin['total_supply'],
            $coin['last_updated'],
            $coin['quote']['USD']['price'],
            $coin['quote']['USD']['volume_24h'],
            $coin['quote']['USD']['volume_change_24h'],
            $coin['quote']['USD']['percent_change_24h'],
            $coin['quote']['USD']['market_cap']
        );
        return $coin;
    }
}
