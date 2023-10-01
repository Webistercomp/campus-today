<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    function packet() {
        return $this->belongsTo(Packet::class);
    }

    function materials() {
        return $this->hasMany(Material::class);
    }
}
