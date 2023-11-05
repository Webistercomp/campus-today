<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function index() {
        return Inertia::render('Profile/Index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request) {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->name = $request->name ?? $user->name;
        $user->tanggallahir = $request->tanggallahir ?? $user->tanggallahir;
        $user->nohp = $request->nohp ?? $user->nohp;
        $user->pekerjaan = $request->pekerjaan ?? $user->pekerjaan;
        $user->jenis_kelamin = $request->gender ?? $user->jenis_kelamin;
        $user->kota_kabupaten = $request->kota ?? $user->kota_kabupaten;
        $user->provinsi = $request->provinsi ?? $user->provinsi;
        $user->pendidikan = $request->pendidikan ?? $user->pendidikan;
        $user->institusi = $request->institusi ?? $user->institusi;
        $user->save();

        return redirect()->back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
