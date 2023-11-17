<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacketHistory extends Model
{
    use HasFactory;
    protected $guarded = [];

    function packet() {
        return $this->belongsTo(Packet::class);
    }
}
