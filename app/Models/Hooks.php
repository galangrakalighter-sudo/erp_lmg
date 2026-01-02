<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hooks extends Model
{
    protected $table = "hooks";
    protected $fillable = [
        "hooks",
        "status"
    ];
}
