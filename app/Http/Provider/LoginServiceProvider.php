<?php

namespace App\Http\Provider;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Otp;
use App\Models\Role;
use App\Models\Users;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginServiceProvider extends Controller
{

     public static function login($validatedData)
     {
          try {
               if (! Users::existsOwner($validatedData['email'])) {
                    $data = [
                         'status_code' => 400,
                         'message' => 'Email Not Exists.',
                         'data' => [
                              'email' => $validatedData['email'],
                         ],
                    ];

                    return sendJsonResponse($data);
               }
               
               // check password is valid or not for this email
               $user = Users::checkUserWithPassword($validatedData['email'], $validatedData['password']);
               if (!$user) {
                    $data = [
                         'status_code' => 400,
                         'message' => 'Invalid Password.',
                         'data' => [
                              'email' => $validatedData['email'],
                         ],
                    ];

                    return sendJsonResponse($data);
               }

               $authData = [];
               try {


                    $user = Users::getUserDataUsingEmail($validatedData['email']);

                    if (!empty($user)) {
                         if ($user->status == 'Inactive') {
                              $data = [
                                   'status_code' => 400,
                                   'message' => 'Your account is inactive.',
                                   'data' => [
                                        'email' => $validatedData['email'],
                                   ],
                              ];

                              return sendJsonResponse($data);
                         }
                    } else {
                         $data = [
                              'status_code' => 401,
                              'message' => 'Unauthorized',
                              'data' => $user,
                         ];

                         return sendJsonResponse($data);
                    }


                    if (! $token = JWTAuth::fromUser($user)) {
                         $data = [
                              'status_code' => 401,
                              'message' => 'Unauthorized',
                              'data' => $user,
                         ];

                         return sendJsonResponse($data);
                    }

                    $rolePermissions = [];


                    // Save Details
                    $authData['id'] = $user->id;
                    $authData['userDetails'] = $user;
                    $authData['token'] = $token;
                    $authData['token_type'] = 'bearer';
                    $authData['expires_in'] = JWTAuth::factory()->getTTL();
                    $authData['role_permission'] = $rolePermissions;

                    $data = [
                         'status_code' => 200,
                         'message' => 'Login Successfully!',
                         'data' => $authData,
                    ];

                    return sendJsonResponse($data);
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
                              'message' => 'Token Not found',
                         ];
                    }

                    return sendJsonResponse($data);
               }
               $data = [
                    'status_code' => 200,
                    'message' => 'Login successful.',
                    'data' => [
                         'user_id' => $user->id,
                    ],
               ];

               return sendJsonResponse($data);
          } catch (\Exception $e) {
               Log::error([
                    'method' => __METHOD__,
                    'error' => ['file' => $e->getFile(), 'line' => $e->getLine(), 'message' => $e->getMessage()],
                    'created_at' => date('Y-m-d H:i:s'),
               ]);

               return sendJsonResponse(['status_code' => 500, 'message' => 'Something went wrong.']);
          }
     }
}
