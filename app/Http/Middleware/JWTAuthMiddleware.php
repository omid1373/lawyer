<?php

namespace App\Http\Middleware;
use App\Classes\Authentication;

use Closure;

class JWTAuthMiddleware
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
        try{
            $token= $request->header('authorization');
            //$token = $request->cookie('jwt_header') . '.' . $request->cookie('jwt_payload') . '.' . $request->cookie('jwt_signature');
            $payload = Authentication::decode($token);
            $token = Authentication::encode($payload);
            $request->route()->setParameter('user_id', $payload['userId']);
            $response = $next($request);
            return $response
                ->cookie('jwt_header', $token[0],2, '/', null, false, true)
                ->cookie('jwt_payload', $token[1],2, '/', null, false, true)
                ->cookie('jwt_signature', $token[2],2, '/', null, false, false);

        } catch (\Exception $e){
            return response(['message' => $e->getMessage()], 401);
        }
    }
}
