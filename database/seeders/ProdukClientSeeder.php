<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("produk_client")->insert([
            [
                "kategori_jasa_id" => 1,
                "nama" => "Gafi",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 1,
                "nama" => "Reunion",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Eikyoo",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Raddine",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "LGTR",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Lighter Media Group",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Lighter Multimedia",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Lighter Tech",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Lighter Ecommarce",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Luminance Creative",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 2,
                "nama" => "Lighter Academy",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 3,
                "nama" => "Nabur",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 3,
                "nama" => "Bangkit",
                "status" => 1
            ],            
            [
                "kategori_jasa_id" => 3,
                "nama" => "Texal",
                "status" => 1
            ],            
        ]);
    }
}
