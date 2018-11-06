<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use App\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
      if (auth()->check()) {

          $currentUserRole = User::find(auth()->user()->id)->role->slug;

          foreach ($roles as $role) {
              if ($role == $currentUserRole){
                  return $next($request);
              }
          }

          abort(403, 'Unauthorized action.');
      }

      abort(403, 'Unauthorized action.');
    }
}
