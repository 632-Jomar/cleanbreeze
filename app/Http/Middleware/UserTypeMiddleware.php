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
            if (auth()->user()->is_verified) {
                foreach ($userTypeId as $key => $typeId) {
                    if (auth()->user()->user_type_id == $typeId)
                        return $next($request);
                }

                abort(403, "You don't have permission to access this page.");

            } else {
                auth()->logout();
                return redirect()->route('login')->withErrors(['email' => 'Unverified Account!']);
            }
        }

        abort(401, 'Unauthenticated');
    }
}
