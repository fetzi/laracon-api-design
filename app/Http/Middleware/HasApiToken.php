<?php

namespace App\Http\Middleware;

use App\Exceptions\MissingOrInvalidApiToken;
use Closure;

class HasApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('api-token') && $request->header('api-token') === 'secret') {
            return $next($request);
        }

        throw new MissingOrInvalidApiToken();
    }
}
