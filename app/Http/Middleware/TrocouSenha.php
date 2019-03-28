<?php

namespace CodeFlix\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TrocouSenha
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
        if(! Auth::user()->troca_senha){
            return redirect('/admin/troca-senha');
        }
        
        
        return $next($request);
    }
}
