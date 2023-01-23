<?php
namespace App\Interfaces;

use App\Models\Crypto;
use Illuminate\Support\Collection;

interface CryptoInterface
{
    public function getList(): Collection;
    public function getBySymbol(string $symbol): ?Crypto;
}
