<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Transaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_retailer) {
            abort(403, 'Retailer accounts are not allowed to make transactions.');
        }
        return $next($request);
    }
}
