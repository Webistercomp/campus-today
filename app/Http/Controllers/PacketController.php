<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PacketController extends Controller
{
    function index () {
        $packets = Packet::all();
        $mandiri = $packets->where('type', 'mandiri');
        $bimbel = $packets->where('type', 'bimbel');
        $packetBimbel = [];
        foreach($bimbel as $b) {
            array_push($packetBimbel, $b);
        }
        return Inertia::render('BeliPaket/Index', [
            'title' => 'Beli Paket', 
            'packetMandiri' => $mandiri,
            'packetBimbel' => $packetBimbel
        ]);
    }

    function show($packet_id) {
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Deskripsi', [
            'title' => 'Paket ' . $packet->nama, 
            'packet' => $packet,
        ]);
    }

    function checkout($packet_id) {
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Checkout', [
            'title' => 'Checkout Paket ' . $packet->name, 
            'packet' => $packet,
        ]);
    }

    function payment($packet_id) {
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Payment', [
            'title' => 'Pembayaran Paket ' . $packet->name,
            'packet' => $packet,
        ]);
    }

    function verification($packet_id) {
        return Inertia::render('BeliPaket/Verification', ['title' => 'Pembayaran', 'nama_paket' => 'Friendly']);
    }
}
