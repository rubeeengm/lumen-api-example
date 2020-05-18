<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware {
    /**
     * Handle an incoming request
     * @param $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, string $role) {
        $isValid = Auth::user()->roles()->where('name', $role)->exists();

        if (!$isValid) {
            return response('Forbidden',403);
        }

        return $next($request);
    }
}
