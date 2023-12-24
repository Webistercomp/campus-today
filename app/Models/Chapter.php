<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    function material() {
        return $this->belongsTo(Material::class);
    }

    function latihans() {
        return $this->hasMany(Latihan::class);
    }
}
