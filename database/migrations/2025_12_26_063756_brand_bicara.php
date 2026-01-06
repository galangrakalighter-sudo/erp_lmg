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
        Schema::create('gaya_komunikasi', function(Blueprint $table) {
            $table->id();
            $table->foreignId('produk_client_id')->constrained("produk_client")->cascadeOnDelete();
            $table->string('gaya_bicara');
            $table->string('gaya_bahasa');
            $table->string('platform');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
