<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Utility\Common;
use Closure;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestHeader = substr($request->header('content-type'), 0, strpos($request->header('content-type'), ';'));

        if ($request->header('authorization') !== null) {
            try {

                if (! $user = JWTAuth::parseToken()->authenticate()) {

                    $data = [
                        'status_code' => 400,
                        'message' => 'Invalid User',
                        'data' => [],
                    ];

                    return Common::sendJsonResponse($data);
                }
                $prefix = request()->route()->getPrefix();


                if ($user->status !== 'Active') {
                    $data = [
                        'status_code' => 400,
                        'message' => 'Invalid User',
                        'data' => [],
                    ];

                    return Common::sendJsonResponse($data);
                }

            } catch (JWTException $e) {
                if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException) {
                    $data = [
                        'status_code' => 401,
                        'message' => 'Token Expired',
                    ];
                } elseif ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {
                    $data = [
                        'status_code' => 401,
                        'message' => 'Invalid Token',
                    ];
                } else {
                    $data = [
                        'status_code' => 401,
                        'message' => 'Token Not exist',
                    ];
                }

                return Common::sendJsonResponse($data);
            }

            $request->merge(['user' => $user]);
            $response = $next($request);
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Content-Range, Content-Disposition, Content-Description, X-Auth-Token');
            $response->header('Access-Control-Allow-Methods', 'GET,POST,OPTIONS,DELETE,PUT');

            return $response;
        } else {
            $data = [
                'status' => false,
                'status_code' => 401,
                'message' => 'Token Not found',
            ];

            return Common::sendJsonResponse($data);
        }
    }
}
