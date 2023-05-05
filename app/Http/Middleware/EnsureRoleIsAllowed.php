<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRoleIsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles)
    {
        $user = $request->user();

        if (in_array($user->role, $allowedRoles)) {
            return $next($request);
        }

        return response()->json(['message' => 'You do not have permission to access this resource.'], 403);
    }
}
