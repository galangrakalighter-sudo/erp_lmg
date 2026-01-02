<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Identify extends Model
{
    protected $table = "brand_identify";

    protected $fillable = [
        'produk_client_id',
        'identify',
    ];
}
