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
}
