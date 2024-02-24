<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $user = User::find(auth()->user()->id);
        $now = Carbon::now();
        $expired_at = Carbon::parse($user->expired_at);
        if($now > $expired_at) {
            $user->role_id = 1;
            $user->save();
        }
        return $request->expectsJson() ? null : route('login');
    }
}
