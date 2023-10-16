<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    function eventTryOut() {
        return $this->belongsTo(EventTryOut::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
