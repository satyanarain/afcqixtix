<?php

namespace App\Http\Middleware\User;

use Closure;
use Auth;

class CanChangeProfileImage
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
            Session()->flash('flash_message_warning', 'Not allowed to change profile image');
            return redirect()->route('users.show', $request->id);
        }
        return $next($request);
    }
}
