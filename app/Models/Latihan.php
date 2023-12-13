<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;

    protected $guarded = [];

    function questions() {
        return $this->hasMany(Question::class, 'tryout_id', 'id');
    }

    function materialType() {
        return $this->belongsTo(MaterialType::class, 'material_type_id', 'id');
    }

    function group() {
        return $this->belongsTo(GroupType::class, 'group_id', 'id');
    }
}
