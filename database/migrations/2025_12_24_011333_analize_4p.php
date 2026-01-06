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
        Schema::create('analize_4p', function(Blueprint $table) {
            $table->id();
            $table->foreignId('produk_client_id')->constrained("produk_client")->cascadeOnDelete();
            $table->string('nama_analisis');
            $table->string('type');
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
