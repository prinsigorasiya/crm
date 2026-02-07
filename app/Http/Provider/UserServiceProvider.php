<?php

namespace App\Http\Provider;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\Log;

class UserServiceProvider extends Controller
{
     public static function index($request)
     {
          try {
               $start = @$request->start ? $request->start : 0;
               $limit = @$request->limit ? $request->limit : 10;
               $search = @$request->search ? $request->search : '';
               $name = @$request->name ? $request->name : '';
               $email = @$request->email ? $request->email : '';
               $sort_by = @$request->sort_by ? $request->sort_by : 'id';
               $sort_order = @$request->sort_order ? $request->sort_order : 'asc';

               $data = [
                    'search' => $search,
                    'name' => $name,
                    'email' => $email,
               ];

               $query = Users::getQueryForList($data)->where('status', 'Active');
               $total_count = Users::select('id')->where('status', 'Active')->count();
               $filter_count = $query->clone()->count();
               $usersList = $query->clone()
                    ->orderBy($sort_by, $sort_order)
                    ->skip($start)
                    ->limit($limit)
                    ->get();


               $data = [
                    'status_code' => 200,
                    'message' => 'Record get successfully.',
                    'data' => [
                         'total_count' => $total_count,
                         'filter_count' => $filter_count,
                         'users_list' => $usersList,
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

     public static function store($validatedData)
     {
          try {

               $user = Users::create($validatedData);

               $data = [
                    'status_code' => 201,
                    'message' => 'User created successfully.',
                    'data' => $user,
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

     public static function update($validatedData)
     {
          try {

               $user = Users::find($validatedData['id']);

               $user->update($validatedData);

               $data = [
                    'status_code' => 200,
                    'message' => 'User updated successfully.',
                    'data' => $user,
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

     public static function view($validatedData)
     {
          try {

               $user = Users::find($validatedData['id']);

               $data = [
                    'status_code' => 200,
                    'message' => 'User get successfully.',
                    'data' => $user,
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

     public static function changeStatus($validatedData)
     {
          try {

               $user = Users::find($validatedData['id']);
               $user->status = $validatedData['status'];
               $user->save();

               $data = [
                    'status_code' => 200,
                    'message' => 'User status updated successfully.',
                    'data' => $user,
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

     public static function destroy($validatedData)
     {
          try {

               $user = Users::find($validatedData['id']);
               $user->delete();

               $data = [
                    'status_code' => 200,
                    'message' => 'User deleted successfully.',
                    'data' => $user,
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

     public static function dropDown($request)
     {
          try {

               $user = Users::where('status', 'Active')
                    ->select('id', 'first_name', 'user_name')
                    ->get();

               $data = [
                    'status_code' => 200,
                    'message' => 'User get successfully.',
                    'data' => $user,
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
