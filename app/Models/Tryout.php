<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    function packet() {
        return $this->belongsTo(Packet::class);
    }

    function questions() {
        return $this->hasMany(Question::class);
    }
}
