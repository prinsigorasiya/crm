<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Provider\UserServiceProvider;
use App\Http\Requests\User\UserChangeStatusRequest;
use App\Http\Requests\User\UserGetRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserStoreRequest;

class UserController extends Controller
{
     /**
      *  @OA\Post(
      *    path="/api/v1/owner/user/list",
      *     summary="List User",
      *     tags={"User"},
      *     description="List User",
      *     operationId="UserList",
      *     security={{"bearerAuth":{}}},
      *
      *      @OA\Parameter(
      *          name="start",
      *          required=false,
      *          in="query",
      *          example="0",
      *          description="no of record you already get",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *      @OA\Parameter(
      *          name="limit",
      *          required=false,
      *          in="query",
      *          example="10",
      *          description="no of record you want to get",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="search",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="search by name, mobile, email",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *      @OA\Parameter(
      *          name="name",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *      @OA\Parameter(
      *          name="sort_by",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="Sort by column(eg. id, name, mobile, email)",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *      @OA\Parameter(
      *          name="sort_order",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="Sort order (asc or desc)",
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
     public function index(Request $request)
     {
          return UserServiceProvider::index($request);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/user/store",
      *     summary="Store a User",
      *     tags={"User"},
      *     description="User",
      *     operationId="UserStore",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="first_name",
      *          required=true,
      *          in="query",
      *          example="User First Name",
      *          description="Enter First Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="middle_name",
      *          required=true,
      *          in="query",
      *          example="User Middle Name",
      *          description="Enter Middle Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="last_name",
      *          required=true,
      *          in="query",
      *          example="User Last Name",
      *          description="Enter Last Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="user_name",
      *          required=true,
      *          in="query",
      *          example="User User Name",
      *          description="Enter User Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="email",
      *          required=true,
      *          in="query",
      *          example="test@yopmail.com",
      *          description="Enter Email Address",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="role",
      *          required=true,
      *          in="query",
      *          example="Admin",
      *          description="Enter Role",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="password",
      *          required=true,
      *          in="query",
      *          example="password123",
      *          description="Enter Password",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="department",
      *          required=true,
      *          in="query",
      *          example="IT",
      *          description="Enter Department",
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
     public function store(UserStoreRequest $request)
     {
          $validatedData = $request->validated();

          return UserServiceProvider::store($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/user/update",
      *     summary="Update a User",
      *     tags={"User"},
      *     description="User",
      *     operationId="UserUpdate",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter User ID",
      *
      *          @OA\Schema(
      *          type="number",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="first_name",
      *          required=true,
      *          in="query",
      *          example="User First Name",
      *          description="Enter First Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="middle_name",
      *          required=true,
      *          in="query",
      *          example="User Middle Name",
      *          description="Enter Middle Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="last_name",
      *          required=true,
      *          in="query",
      *          example="User Last Name",
      *          description="Enter Last Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="user_name",
      *          required=true,
      *          in="query",
      *          example="User User Name",
      *          description="Enter User Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="email",
      *          required=true,
      *          in="query",
      *          example="test@yopmail.com",
      *          description="Enter Email Address",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="role",
      *          required=true,
      *          in="query",
      *          example="Admin",
      *          description="Enter Role",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="password",
      *          required=true,
      *          in="query",
      *          example="password123",
      *          description="Enter Password",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="department",
      *          required=true,
      *          in="query",
      *          example="IT",
      *          description="Enter Department",
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
     public function update(UserUpdateRequest $request)
     {
          $validatedData = $request->validated();

          return UserServiceProvider::update($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/user/view",
      *     summary="View a User",
      *     tags={"User"},
      *     description="User",
      *     operationId="UserView",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter User ID",
      *
      *          @OA\Schema(
      *          type="number",
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
     public function view(UserGetRequest $request)
     {
          $validatedData = $request->validated();
          return UserServiceProvider::view($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/user/change-status",
      *     summary="Change User Status",
      *     tags={"User"},
      *     description="User",
      *     operationId="UserChangeStatus",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter User ID",
      *
      *          @OA\Schema(
      *          type="number",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *         name="status",
      *         in="query",
      *         required=true,
      *         description="Enter Status (Active or Inactive)",
      *         example="Active",
      *
      *         @OA\Schema(
      *             type="string",
      *             enum={"Active", "Inactive"}
      *         ),
      *     ),
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
     public function changeStatus(UserChangeStatusRequest $request)
     {
          $validatedData = $request->validated();
          return UserServiceProvider::changeStatus($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/user/destroy",
      *     summary="Destroy a User",
      *     tags={"User"},
      *     description="User",
      *     operationId="UserDestroy",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter User ID",
      *
      *          @OA\Schema(
      *          type="number",
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
     public function destroy(UserGetRequest $request)
     {
          $validatedData = $request->validated();
          return UserServiceProvider::destroy($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/user/drop-down",
      *     summary="Get User Drop Down",
      *     tags={"User"},
      *     description="User",
      *     operationId="UserDropDown",
      *     security={{"bearerAuth":{}}},
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
     public function dropDown(Request $request)
     {
          return UserServiceProvider::dropDown($request);
     }
}
