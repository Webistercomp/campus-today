<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\PacketHistory;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Routing\RequestContext;

class PacketController extends Controller {
    function index() {
        $packets = Packet::all();
        $mandiri = $packets->where('type', 'mandiri');
        $bimbel = $packets->where('type', 'bimbel');
        $packetBimbel = [];
        foreach ($bimbel as $b) {
            array_push($packetBimbel, $b);
        }
        return Inertia::render('BeliPaket/Index', [
            'title' => 'Beli Paket',
            'packetMandiri' => $mandiri,
            'packetBimbel' => $packetBimbel
        ]);
    }

    function store(Request $request) {
        $request->validate([
            'packet_id' => 'required',
            'user_id' => 'required',
            'file' => '',
            'payment_method' => 'required',
        ]);
        $newPacketHistory = new PacketHistory();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/bukti_pembayaran', $fileName);
            $newPacketHistory->bukti_pembayaran = $fileName;
        }
        $newPacketHistory->packet_id = $request->packet_id;
        $newPacketHistory->user_id = $request->user_id;
        $newPacketHistory->payment_method = $request->payment_method;
        $newPacketHistory->save();

        return redirect()->route('paket.verification', $request->packet_id);
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

    function payment($packet_id, Request $request) {
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Payment', [
            'title' => 'Pembayaran Paket ' . $packet->name,
            'packet' => $packet,
            'user_data' => $request,
        ]);
    }

    function verification($packet_id) {
        return Inertia::render('BeliPaket/Verification', ['title' => 'Pembayaran', 'nama_paket' => 'Friendly']);
    }
}
