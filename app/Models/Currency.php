<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    //make constructor to create new currency model
    public function __construct($code, $rate)
    {
        $this->code = $code;
        $this->rate = $rate;
    }

    use HasFactory;
    //currency have the following attributes: code, rate
    protected $fillable = [
        'code',
        'rate'
    ];
    public function getCode(){
        return $this->code;
    }
    public function getRate(){
        return $this->rate;
    }

}
