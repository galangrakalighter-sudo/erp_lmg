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
        Schema::create('segmentasi', function(Blueprint $table) {
            $table->id();
            $table->foreignId('produk_client_id')->constrained("produk_client")->cascadeOnDelete();
            $table->string('usia')->nullable();
            $table->string('gender')->nullable();
            $table->string('negara')->nullable();
            $table->string('wilayah')->nullable();
            $table->string('gaya_hidup')->nullable();
            $table->string('status_sosial')->nullable();
            $table->string('minat')->nullable();
            $table->string('penggunaan')->nullable();
            $table->string('loyalitas')->nullable();
            $table->string('manfaat')->nullable();
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
