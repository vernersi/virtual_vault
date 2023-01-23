<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('security_code_1')->nullable();
            $table->integer('security_code_2')->nullable();
            $table->integer('security_code_3')->nullable();
            $table->integer('security_code_4')->nullable();
            $table->integer('security_code_5')->nullable();
            $table->integer('security_code_6')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
};
