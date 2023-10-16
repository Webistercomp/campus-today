<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleBimbel extends Model
{
    use HasFactory;

    function packet() {
        return $this->belongsTo(Packet::class);
    }
}
