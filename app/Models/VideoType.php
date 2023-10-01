<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    use HasFactory;

    function packet() {
        return $this->belongsTo(Packet::class);
    }
    
    function videos() {
        return $this->hasMany(Video::class);
    }
}
