<?php

use App\Models\User;
use Carbon\Carbon;

$users = User::all();
// based on jakarta, indonesia timezone
$now = Carbon::now('Asia/Jakarta');
foreach($users as $user) {
    if($user->role_id != 1 && $user->expired_at != null) {
        $expired_at = Carbon::parse($user->expired_at);
        if($now > $expired_at) {
            $user->role_id = 1;
            $user->expired_at = null;
        }
    }
}