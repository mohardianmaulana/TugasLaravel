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
        Schema::create('flowers', function(Blueprint $table){
            $table-> id();
            $table-> String('nama');
            $table-> integer('jumlah');
            $table-> integer('harga');
            $table-> binary('image')->nullable();
            $table-> timeStamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExist('flowers');
    }
};