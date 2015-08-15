<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Session;
use Request;
use Flash;
use Auth;

class BeforeFilter
{


    /**
     * Create a new filter instance.
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = null;
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
        // Perform action
        $uri = $request->path();
        if (!Request::is('users/login-modal','logout','users/login'))
        {
         Session::flash('redirect_flash',$uri);
        }
        return $next($request);
    }
}
