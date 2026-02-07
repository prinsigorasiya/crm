<?php

namespace App\Http\Provider;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Users;
use Illuminate\Support\Facades\Log;

class ProjectServiceProvider extends Controller
{
     public static function index($request)
     {
          try {
               $start = @$request->start ? $request->start : 0;
               $limit = @$request->limit ? $request->limit : 10;
               $search = @$request->search ? $request->search : '';
               $name = @$request->name ? $request->name : '';
               $code = @$request->code ? $request->code : '';
               $status = @$request->status ? $request->status : '';
               $sort_by = @$request->sort_by ? $request->sort_by : 'id';
               $sort_order = @$request->sort_order ? $request->sort_order : 'asc';

               $data = [
                    'search' => $search,
                    'name' => $name,
                    'code' => $code,
                    'status' => $status,
               ];

               $query = Project::getQueryForList($data);
               $total_count = Project::select('id')->count();
               $filter_count = $query->clone()->count();
               $project_list = $query->clone()
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
                         'projects_list' => $project_list,
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

               // let today date is inquiry_date
               $validatedData['inquiry_date'] = date('Y-m-d-H:i:s');
               // count total hours and per day hours and calculate target date sundays are not count
               $total_hours = $validatedData['total_hours'];
               $per_day_hours = $validatedData['per_day_hours'];
               $days = ceil($total_hours / $per_day_hours);
               $target_date = date('Y-m-d-H:i:s', strtotime("+$days days"));
               $validatedData['target_date'] = $target_date;

               // if status is Running then start_date is today date
               if ($validatedData['status'] == 'Running') {
                    $validatedData['start_date'] = date('Y-m-d-H:i:s');
               }

               // assigned_user is comma seprated string of user ids check user is valid or not if user is not valid then not store this user id in assigned_user
               $assigned_user = explode(',', $validatedData['assigned_user']);
               $valid_user_ids = [];
               foreach ($assigned_user as $user_id) {
                    $user = Users::find($user_id);
                    if (!$user) {
                         continue;
                    }
                    $valid_user_ids[] = $user_id;
               }
               $validatedData['assigned_user'] = implode(',', $valid_user_ids);

               $project = Project::create($validatedData);

               $data = [
                    'status_code' => 201,
                    'message' => 'Project created successfully.',
                    'data' => $project,
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

               // let today date is inquiry_date
               $validatedData['inquiry_date'] = date('Y-m-d-H:i:s');
               // count total hours and per day hours and calculate target date sundays are not count
               $total_hours = $validatedData['total_hours'];
               $per_day_hours = $validatedData['per_day_hours'];
               $days = ceil($total_hours / $per_day_hours);
               $target_date = date('Y-m-d-H:i:s', strtotime("+$days days"));
               $validatedData['target_date'] = $target_date;

               // if status is Running then start_date is today date
               if ($validatedData['status'] == 'Running') {
                    $validatedData['start_date'] = date('Y-m-d-H:i:s');
               }

               // assigned_user is comma seprated string of user ids check user is valid or not if user is not valid then not store this user id in assigned_user
               $assigned_user = explode(',', $validatedData['assigned_user']);
               $valid_user_ids = [];
               foreach ($assigned_user as $user_id) {
                    $user = Users::find($user_id);
                    if (!$user) {
                         continue;
                    }
                    $valid_user_ids[] = $user_id;
               }
               $validatedData['assigned_user'] = implode(',', $valid_user_ids);

               $project = Project::find($validatedData['id']);

               $project->update($validatedData);

               $data = [
                    'status_code' => 200,
                    'message' => 'Project updated successfully.',
                    'data' => $project,
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

               $project = Project::find($validatedData['id']);

               $data = [
                    'status_code' => 200,
                    'message' => 'Project get successfully.',
                    'data' => $project,
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

               $project = Project::find($validatedData['id']);

               // if status is InPlanning then start_date is null and end_date is null 
               if ($validatedData['status'] == 'InPlanning') {
                    $project->start_date = null;
                    $project->end_date = null;
               }

               // if status is Running then start_date is today date and end_date is null
               if ($validatedData['status'] == 'Running') {
                    $project->start_date = date('Y-m-d-H:i:s');
                    $project->end_date = null;
               }

               // if status is Stopped then end_date is today date
               if ($validatedData['status'] == 'Stopped') {
                    $project->end_date = date('Y-m-d-H:i:s');
               }

               // if status is Completed then end_date is today date
               if ($validatedData['status'] == 'Completed') {
                    $project->end_date = date('Y-m-d-H:i:s');
               }

               $project->status = $validatedData['status'];
               $project->save();

               $data = [
                    'status_code' => 200,
                    'message' => 'Project status updated successfully.',
                    'data' => $project,
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

               $project = Project::find($validatedData['id']);
               $project->delete();

               $data = [
                    'status_code' => 200,
                    'message' => 'Project deleted successfully.',
                    'data' => $project,
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

               $user = Project::where('status', 'Running')
                    ->select('id', 'name', 'code')
                    ->get();

               $data = [
                    'status_code' => 200,
                    'message' => 'Project get successfully.',
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
