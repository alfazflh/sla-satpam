<?php

namespace App\Http\Middleware;

use App\Models\User; 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */  
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('user.dashboard')
            ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
    }
}
