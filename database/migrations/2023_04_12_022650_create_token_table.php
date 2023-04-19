<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('token', function (Blueprint $table) {
            $table->id();
            $table->string('token_web');
            $table->string('token_verificacion_web'); 
            $table->unsignedBigInteger('Envio_user_id');
            $table->foreign('Envio_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('Token_user_id');
            $table->foreign('Token_user_id')->references('id')->on('users');
            $table->boolean('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token');
    }
};
