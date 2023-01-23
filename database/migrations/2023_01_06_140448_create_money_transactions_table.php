<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   const TABLE_NAME = 'transactions';
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users');
            $table->foreignId('from_account_id')->constrained('accounts');
            $table->foreignId('to_user_id')->constrained('users');
            $table->foreignId('to_account_id')->constrained('accounts');
            $table->integer('amount')->unsigned();
            $table->string('currency', 3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('money_transactions');
    }
};
