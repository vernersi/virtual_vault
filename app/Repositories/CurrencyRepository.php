<?php
namespace App\Repositories;

use App\Interfaces\CurrencyInterface;
use App\Models\Currency;
use Illuminate\Support\Collection;

class CurrencyRepository implements CurrencyInterface
{

    public Collection $currencies;
    public function __construct()
    {
        {
            $response = file_get_contents('https://www.bank.lv/vk/ecb.xml');
            $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $currencies = json_decode($json, TRUE);
            $currencyCollection = collect();
            foreach ($currencies['Currencies']['Currency'] as $currency) {
                $currencyModel = new Currency($currency['ID'], $currency['Rate']);
                $currencyCollection->put($currencyModel->getCode(), $currencyModel->getRate());
            }
            // add EUR to the list
            $currencyCollection->put('EUR', 1);
            $this->currencies = $currencyCollection;
        }
    }

    public function getCurrencyRate(string $code): float
    {
        return $this->currencies->get($code);
    }

    //return all currency codes
    public function getCurrencies(): Collection
    {
        return $this->currencies;
    }

    public function getAllCurrencyCodes(): Collection
    {
        return $this->currencies->keys();
    }


}
