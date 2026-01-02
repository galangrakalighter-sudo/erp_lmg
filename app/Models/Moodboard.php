<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moodboard extends Model
{
    protected $table = "moodboard";

    protected $fillable = [
        'produk_client_id',
        'moodboard',
    ];
}
