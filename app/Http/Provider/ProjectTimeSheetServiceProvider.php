<?php

namespace App\Http\Provider;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTimeSheet;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectTimeSheetServiceProvider extends Controller
{
     public static function index($request)
     {
          try {
               $start = @$request->start ? $request->start : 0;
               $limit = @$request->limit ? $request->limit : 10;
               $search = @$request->search ? $request->search : '';
               $project_id = @$request->project_id ? $request->project_id : '';
               $user_id = @$request->user_id ? $request->user_id : '';
               $sort_by = @$request->sort_by ? $request->sort_by : 'id';
               $sort_order = @$request->sort_order ? $request->sort_order : 'asc';

               $data = [
                    'search' => $search,
                    'project_id' => $project_id,
                    'user_id' => $user_id,
               ];

               $query = ProjectTimeSheet::getQueryForList($data)->with([
                    'user',
                    'project',
               ]);
               $total_count = ProjectTimeSheet::select('id')->count();
               $filter_count = $query->clone()->count();
               $project_time_sheet_list = $query->clone()
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
                         'project_time_sheet_list' => $project_time_sheet_list,
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

               // let user_id is authenticated user id
               $user = Auth::user();
               $validatedData['user_id'] = $user->id;

               // let date today date
               $validatedData['date'] = date('Y-m-d');

               // count duration in hours from start_time and end_time
               $start_time = strtotime($validatedData['start_time']);
               $end_time = strtotime($validatedData['end_time']);
               $duration = ($end_time - $start_time) / 3600;
               $validatedData['duration'] = $duration;

               $projectTimeSheet = ProjectTimeSheet::create($validatedData);

               $data = [
                    'status_code' => 201,
                    'message' => 'Project Time Sheet created successfully.',
                    'data' => $projectTimeSheet,
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

               // count duration in hours from start_time and end_time
               $start_time = strtotime($validatedData['start_time']);
               $end_time = strtotime($validatedData['end_time']);
               $duration = ($end_time - $start_time) / 3600;
               $validatedData['duration'] = $duration;
               $projectTimeSheet = ProjectTimeSheet::find($validatedData['id']);

               $projectTimeSheet->update($validatedData);

               $data = [
                    'status_code' => 200,
                    'message' => 'Project Time Sheet updated successfully.',
                    'data' => $projectTimeSheet,
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

               $projectTimeSheet = ProjectTimeSheet::where('id', $validatedData['id'])->with([
                    'user',
                    'project',
               ])->first();

               $data = [
                    'status_code' => 200,
                    'message' => 'Project Time Sheet get successfully.',
                    'data' => $projectTimeSheet,
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

               $projectTimeSheet = ProjectTimeSheet::find($validatedData['id']);
               $projectTimeSheet->status = $validatedData['status'];
               $projectTimeSheet->save();

               $data = [
                    'status_code' => 200,
                    'message' => 'Project Time Sheet status updated successfully.',
                    'data' => $projectTimeSheet,
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

               $projectTimeSheet = ProjectTimeSheet::find($validatedData['id']);
               $projectTimeSheet->delete();

               $data = [
                    'status_code' => 200,
                    'message' => 'Project Time Sheet deleted successfully.',
                    'data' => $projectTimeSheet,
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
