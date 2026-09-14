<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Jika role user tidak ada di dalam parameter middleware yang diizinkan
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized action. Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}