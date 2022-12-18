<?php

namespace App\Http\Middleware;

use App\Models\Events;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckUserEvents
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return response()->json($request->user);
        return $next($request);
    }
}
