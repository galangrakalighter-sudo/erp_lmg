<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    protected $table = "strategy";
    protected $fillable = [
        "strategy",
        "status"
    ];
}
