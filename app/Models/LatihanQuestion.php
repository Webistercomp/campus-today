<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    function answers() {
        return $this->hasMany(LatihanAnswer::class);
    }

    function groupType() {
        return $this->belongsTo(GroupType::class);
    }
}
