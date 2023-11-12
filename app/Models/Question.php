<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    function tryout() {
        return $this->belongsTo(Tryout::class);
    }

    function answers() {
        return $this->hasMany(Answer::class);
    }

    function groupType() {
        return $this->belongsTo(GroupType::class);
    }
}
