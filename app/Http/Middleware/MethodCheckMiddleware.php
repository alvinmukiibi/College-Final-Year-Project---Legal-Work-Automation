<?php

namespace App\Http\Middleware;

use Closure;

class MethodCheckMiddleware
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
        if($request->is("verifyEmail/*") && $request->method() !== "GET"){
            return response()->json(["error" => true, "message" => "method not supported on resource"]);
        }

        //here you can do sth to the request before passing it down to other middleware

        $response = $next($request); //this means we are handing the request off to the rest of the middle ware stack and the response from all of them is stored in the $response variable

        //here you can do sth to the response before passing it up 


        return $response;
    }
}
