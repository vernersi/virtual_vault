<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'from_user_id',
        'to_user_id',
        'amount',
        'currency',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'fromAccountId', 'id');

    }

}
