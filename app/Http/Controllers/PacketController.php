<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\PacketHistory;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Routing\RequestContext;

class PacketController extends Controller
{
    function index()
    {
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

    function store(Request $request)
    {
        $request->validate([
            'packet_id' => 'required',
            'user_id' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'payment_method' => 'required',
        ]);
        $newPacketHistory = new PacketHistory();
        if ($request->hasFile('bukti_pembayaran')) {
            $path = storage_path('/app/public/bukti_pembayaran');
            !is_dir($path) && mkdir($path, 0777, true);

            $file = $request->file('bukti_pembayaran');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->move($path, $filename);

            $newPacketHistory->bukti_pembayaran = $filename;
        }
        $newPacketHistory->packet_id = $request->packet_id;
        $newPacketHistory->user_id = $request->user_id;
        $newPacketHistory->payment_method = $request->payment_method;
        $newPacketHistory->save();

        return response()->json(['message' => 'Paket berhasil dibeli', 'data' => $newPacketHistory], 200);
    }

    function show($packet_id)
    {
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Deskripsi', [
            'title' => 'Paket ' . $packet->nama,
            'packet' => $packet,
        ]);
    }

    function checkout(Request $request, $packet_id)
    {
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Checkout', [
            'title' => 'Checkout Paket ' . $packet->name,
            'packet' => $packet,
        ]);
    }

    function payment($packet_id, Request $request)
    {
        $payment_method = $request->payment_method;
        $packet = Packet::find($packet_id);
        return Inertia::render('BeliPaket/Payment', [
            'title' => 'Pembayaran Paket ' . $packet->name,
            'packet' => $packet,
            'user_data' => $request,
            'payment_method' => $payment_method,
        ]);
    }

    function verification(Request $request, $packet_id)
    {
        return Inertia::render('BeliPaket/Verification', ['title' => 'Pembayaran', 'nama_paket' => 'Friendly']);
    }
}
