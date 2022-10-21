<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('cep')->nullable();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('number')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->dateTime('birth')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('imageUrl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
