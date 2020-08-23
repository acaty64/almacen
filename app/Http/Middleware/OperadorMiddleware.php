<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class OperadorMiddleware
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            Auth::logout();
            return redirect()->to('login');
        }; 

        if(!($this->auth->user()->isOperador ||
                $this->auth->user()->isAdmin || 
                $this->auth->user()->isMaster)){
            return redirect()->to('home');
        }
        return $next($request);

    }
}
