<?php

namespace App\Http\Middleware;

use Closure;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$userTypeId)
    {
        if (auth()->check()) {
            foreach ($userTypeId as $key => $typeId) {
                if (auth()->user()->user_type_id == $typeId)
                    return $next($request);
            }

        }

        abort(403, 'Access Forbidden');
    }
}
