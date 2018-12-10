<?php

namespace App\Http\Middleware\User;

use Closure;
use Auth;

class CanAddTravelProfile
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
        if (Auth::id() != $request->id) {
            Session()->flash('flash_message_warning', 'Not allowed to add travel profile');
            return redirect()->route('users.show', $request->id);
        }
        return $next($request);
    }
}
