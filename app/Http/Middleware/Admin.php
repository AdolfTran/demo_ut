<?php

namespace App\Http\Middleware;

use App\Models\ManageRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // user is already check null by auth middleware
        if(!Auth::user()->isRole(ManageRole::ROLE_ADMIN)){
            abort(403);
        }

        return $next($request);
    }
}
