<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuberAdmin
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
        $suberadmin = Role::where('name','suberadmin')->first();
        if(Auth::user()->role_id !== $suberadmin->id) {
            return redirect(url('/'));
        }
        return $next($request);
    }
}
