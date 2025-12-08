<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('success', 'Silakan login dulu');
        }

        $u = Auth::user();
        // status aktif DAN role 0/1 (Admin/SuperAdmin)
        if (!$u->status || !in_array((int)$u->role, [0, 1])) {
            return redirect()->route('products.index')->with('success', 'Akses admin saja');
        }

        return $next($request);
    }
}
