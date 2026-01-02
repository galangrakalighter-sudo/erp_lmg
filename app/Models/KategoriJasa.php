<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriJasa extends Model
{
    protected $table = "kategori_jasa";
    protected $fillable = [
        'kategori'
    ];

    public function clients(){
        return $this->hasMany(ProdukClient::class, 'kategori_jasa_id')->where('status', 1);
    }
}
