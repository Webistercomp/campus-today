<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    function role() {
        return $this->belongsTo(Role::class);
    }

    function tryouts() {
        return $this->hasMany(Tryout::class);
    }

    function materialTypes() {
        return $this->hasMany(MaterialType::class);
    }

    function videoTypes() {
        return $this->hasMany(VideoType::class);
    }
    
    function scheduleBimbels() {
        return $this->hasMany(ScheduleBimbel::class);
    }
}
