<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsAuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!User::isAuthor() && !User::isAdmin()) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید!');
        }
        return $next($request);
    }
}
