<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user belum login
        if (!Auth::check()) {
            abort(404);
        }

        $user = Auth::user();

        // Ambil daftar nama role user
        $userRoles = $user->roles->pluck('name')->toArray();

        if (!empty($roles)) {
            // Cek apakah user punya salah satu role yang diizinkan
            if (!array_intersect($roles, $userRoles)) {
                abort(404);
            }
        } else {
            // Default: hanya izinkan 'admin'
            if (!in_array('admin', $userRoles)) {
                abort(404);
            }
        }

        // Lanjut ke request berikutnya
        return $next($request);
    }
}
