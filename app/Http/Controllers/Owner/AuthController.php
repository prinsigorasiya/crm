<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Provider\LoginServiceProvider;
use App\Http\Requests\Otp\LoginRequest;
use App\Http\Requests\Otp\SendOtpRequest;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="CRM API Documentation",
 *    description="CRM API Documentation",
 *    version="1.0.0",
 * ),
 *
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat= "JWT"
 *  )
 * @OA\Tag(
 *     name="User",
 *     description="",
 * )
 */
class AuthController extends Controller
{

    /**
     *  @OA\Post(
     *     path="/api/v1/owner/login/login",
     *     summary="owner login",
     *     tags={"Login"},
     *     description="owner login",
     *     operationId="OwnerLogin",
     *
     *      @OA\Parameter(
     *          name="email",
     *          required=true,
     *          in="query",
     *          example="prinsi@yopmail.com",
     *          description="email",
     *
     *          @OA\Schema(
     *          type="string",
     *         ),
     *       ),
     * 
     *      @OA\Parameter(
     *          name="password",
     *          required=true,
     *          in="query",
     *          example="123456",
     *          description="password",
     *
     *          @OA\Schema(
     *          type="string",
     *         ),
     *       ),
     *
     *      @OA\Response(
     *         response=200,
     *         description="json schema",
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Invalid Request"
     *     ),
     * )
     */
    public function OwnerLogin(LoginRequest $request)
    {
        $validatedData = $request->validated();
        return LoginServiceProvider::login($validatedData);
    }
}
