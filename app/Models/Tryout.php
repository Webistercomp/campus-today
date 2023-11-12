<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;
    protected $guarded = [];

    function materialType() {
        return $this->belongsTo(MaterialType::class);
    }

    function questions() {
        return $this->hasMany(Question::class);
    }
}
