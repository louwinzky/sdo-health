<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUnapproved
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->is_approved && ! $user->hasRole('sdo_admin')) {
            if (! $request->routeIs('pending-approval')) {
                return redirect()->route('pending-approval');
            }
        }

        return $next($request);
    }
}
