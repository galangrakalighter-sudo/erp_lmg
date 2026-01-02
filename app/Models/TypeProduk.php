<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProduk extends Model
{
    protected $table = "type_produk";
    protected $fillable = [
        "type",
        "status"
    ];
}
