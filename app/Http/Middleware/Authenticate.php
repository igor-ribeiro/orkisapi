<?php

namespace OrkisApp\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! $request->has('_token')) {
            return response([ 'errors' => 'Unauthorized' ], 401);
        }

        $user = app('OrkisApp\Repositories\UserRepository')->findByToken($request->get('_token'));

        if (! $user) {
            return response([ 'errors' => 'Invalid token' ], 401);
        }

        return $next($request);
    }
}
