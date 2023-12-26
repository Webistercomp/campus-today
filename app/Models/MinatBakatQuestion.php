<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatBakatQuestion extends Model {
    use HasFactory;

    function minatBakat() {
        return $this->belongsTo(MinatBakat::class);
    }

    function minatBakatAnswer() {
        return $this->hasMany(MinatBakatAnswer::class);
    }
}
