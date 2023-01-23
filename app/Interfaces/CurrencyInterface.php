<?php
namespace App\Interfaces;
use Illuminate\Support\Collection;

interface CurrencyInterface
{
    public function getCurrencyRate(string $code): float;
    public function getCurrencies(): Collection;
    public function getAllCurrencyCodes(): Collection;
}
