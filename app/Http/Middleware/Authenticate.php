<?php

namespace App\Http\Middleware;

// use App\Traits\ResponseTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authenticate extends Middleware
{
    // use ResponseTrait;
    private function responseJson($status,$message,$data){
        return response()->json([$status,$message,$data]);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // return $this->responseError(null, 'Unauthenticated access');
            return $this->responseJson('failed1',"Unauthenticated access",null);
        }
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new HttpResponseException(
            $this->responseJson('failed2',"Unauthenticated access",null)
        );
    }
}