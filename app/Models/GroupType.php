<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    use HasFactory;

    function material() {
        return $this->hasMany(Material::class);
    }
    function materialType() {
        return $this->belongsTo(MaterialType::class);
    }
}
