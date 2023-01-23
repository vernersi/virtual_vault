<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = 'accounts';
    public function up():void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('number', 12)->unique();
            $table->string('currency', 3)->default('EUR');
            $table->string('label', 10)->nullable();
            $table->integer('balance')->default(0);
            $table->timestamps();
        });
    }


    public function down():void
    {
        Schema::dropIfExists('accounts');
    }
};
