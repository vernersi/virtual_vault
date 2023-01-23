<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'label',
        'balance',
        'currency',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'from_account_id', 'id');
    }

    public function getCurrencySymbolAttribute(): string
    {
        if ($this->currency === 'EUR') {
            return '€';
        } elseif ($this->currency === 'USD') {
            return '$';
        } elseif ($this->currency === 'GBP') {
            return '£';
        }
        return $this->currency;
    }
}
