<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
use URL;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
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
 
        if ($this->auth->guest()) {
            Session::flash('redirect', URL::full()); 
            // if ($request->ajax()) {
            //     return response('Unauthorized.', 401);
            // } else {
            //     return redirect()->guest('auth/login');
            // }
        }

        return $next($request);
    }
}
