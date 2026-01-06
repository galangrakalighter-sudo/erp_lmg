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
        Schema::create('positioning', function(Blueprint $table) {
            $table->id();
            $table->foreignId('produk_client_id')->constrained("produk_client")->cascadeOnDelete();
            $table->string('indikator')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('platform')->nullable();
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
