<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;


class Designer
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
        if(Auth::check()){

            // $user=User::where('id',Auth::user()->id)->first();
            $user=User::find(Auth::user()->id);

            if($user->user_role_id == 2){

                return redirect('admin/orders/pending-design');
                
            }


        }

        return $next($request);
    }
}
