<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "strategy";
    protected $fillable = [
        "status"
    ];
}

