<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    function materialType() {
        return $this->belongsTo(MaterialType::class);
    }

    function chapters() {
        return $this->hasMany(Chapter::class);
    }

    function groupType() {
        return $this->belongsTo(GroupType::class, 'group_id');
    }
}
