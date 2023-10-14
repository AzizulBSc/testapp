<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class Authenticate extends Middleware
{
    use ResponseTrait;

    private function responseJson($status, $message, $data)
    {
        return response()->json([$status, $message, $data]);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): JsonResponse
    {
        if (! $request->expectsJson()) {
            return $this->responseError(null, 'Unauthenticated access');
            // return $this->responseJson('failed1',"Unauthenticated access",null);
        }
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards): JsonResponse
    {
        throw new HttpResponseException(
            $this->responseError(null, 'Unauthenticated access')
        );
    }
}
