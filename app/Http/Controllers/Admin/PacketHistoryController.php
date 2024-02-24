<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\Models\PacketHistory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PacketHistoryController extends Controller
{
    function index(Request $request)
    {
        $packetHistories = PacketHistory::all();
        $user = Auth::user();
        $menu = 'packethistory';
        $packets = Packet::all();
        if ($request->status && $request->status != 'all') {
            $packetHistories = PacketHistory::where('status', $request->status)->get();
        }
        if ($request->tanggal_pembayaran) {
            if ($request->tanggal_pembayaran == 'today') {
                $packetHistories = PacketHistory::whereDate('created_at', date('Y-m-d'))->get();
            } else if ($request->tanggal_pembayaran == 'week') {
                $packetHistories = PacketHistory::whereBetween('created_at', [date('Y-m-d', strtotime('last monday')), date('Y-m-d', strtotime('next sunday'))])->get();
            } else if ($request->tanggal_pembayaran == 'month') {
                $packetHistories = PacketHistory::whereMonth('created_at', date('m'))->get();
            } else if ($request->tanggal_pembayaran == 'year') {
                $packetHistories = PacketHistory::whereYear('created_at', date('Y'))->get();
            }
        }
        if ($request->packet && $request->packet != 'all') {
            $packetHistories = PacketHistory::where('packet_id', $request->packet)->get();
        }

        foreach ($packetHistories as $packetHistory) {
            $packetHistory->bukti_pembayaran = Storage::url('bukti_pembayaran/' . $packetHistory->bukti_pembayaran);
        }

        return view('admin.packethistory.index', compact('packetHistories', 'user', 'menu', 'packets'));
    }

    function create()
    {
        $packets = Packet::all();
        $users = User::where('is_admin', 0)->where('email_verified_at', '!=', null)->get();
        $menu = 'packethistory';

        return view('admin.packethistory.create', compact('packets', 'users', 'menu'));
    }

    function store(Request $request)
    {
        $request->validate([
            'packet_id' => 'required',
            'user_id' => 'required',
            'bukti_pembayaran' => 'mimes:jpg,jpeg,bmp,png|max:2000',
            'status' => 'required',
        ], [
            'packet_id.required' => 'Pilih paket terlebih dahulu',
            'user_id.required' => 'Pilih user terlebih dahulu',
            'bukti_pembayaran.mimes' => 'Format file harus jpg, jpeg, bmp, atau png',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB',
            'status.required' => 'Pilih status pembayaran',
        ]);
        $newPacketHistory = new PacketHistory();
        $newPacketHistory->packet_id = $request->packet_id;
        $newPacketHistory->user_id = $request->user_id;
        $newPacketHistory->payment_method = $request->payment_method;
        $newPacketHistory->status = $request->status;

        if ($request->hasFile('bukti_pembayaran')) {
            $time = time();
            $ext = $request->bukti_pembayaran->extension();
            $request->file('bukti_pembayaran')->storeAs('public/packethistory/bukti_pembayaran/', $time . '.' . $ext);
            $newPacketHistory->bukti_pembayaran = $time . '.' . $ext;
        }
        $newPacketHistory->save();

        return redirect()->route('admin.packethistory.index');
    }

    function show($id)
    {
        $packetHistory = PacketHistory::find($id);
        $packetHistory->bukti_pembayaran = Storage::url('bukti_pembayaran/' . $packetHistory->bukti_pembayaran);
        $user = Auth::user();
        $menu = 'packethistory';

        return view('admin.packethistory.show', compact('packetHistory', 'menu', 'user'));
    }

    function destroy($id)
    {
        $packetHistory = PacketHistory::find($id);
        $packetHistory->delete();

        return redirect()->route('admin.packethistory.index');
    }

    function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $packetHistory = PacketHistory::find($id);
        $packetHistory->status = $request->status;
        if($request->status == 'success') {
            $user = User::find($packetHistory->user_id);
            $packetHistory->load('packet');
            $user->role_id = $packetHistory->packet->role_id;
            $user->save();         
        }
        $packetHistory->save();

        return redirect()->route('admin.packethistory.show', $id);
    }
}
