<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class CekSuperRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$id)
    {
        if (in_array($request->user()->id, $id)) {
            return $next($request);
        }
        return redirect('/admin')->with('denied', 'anda tak berhak masuk kehalaman tersebut!');
    }

}
