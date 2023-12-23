<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    function question() {
        return $this->belongsTo(LatihanQuestion::class);
    }
}
