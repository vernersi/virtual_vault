<?php
namespace App\Services;

use GuzzleHttp\Client;

class CoinMarketCapCryptoAPI
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/',
            'headers' => [
                'Accepts' => 'application/json',
                'X-CMC_PRO_API_KEY' => env('COINBASE_API_KEY')
            ]
        ]);

    }

    public function getList(): array
    {
        $response = $this->client->get('listings/latest');
        $data = json_decode($response->getBody()->getContents(), true);
        return $data['data'];
    }

    //get coin by ID defined as symbol
    public function getBySymbol(string $symbol): array
    {
        $response = $this->client->get('quotes/latest', [
            'query' => [
                'id' => $symbol
            ]
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        return $data['data'];
    }
}
