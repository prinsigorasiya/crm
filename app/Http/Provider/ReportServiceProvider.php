<?php

namespace App\Http\Provider;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Users;
use App\Models\ProjectTimeSheet;
use Illuminate\Support\Facades\Log;

class ReportServiceProvider extends Controller
{
     public static function index($request)
     {
          try {
               $start = @$request->start ? $request->start : 0;
               $limit = @$request->limit ? $request->limit : 10;
               $search = @$request->search ? $request->search : '';
               $project_id = @$request->project_id ? $request->project_id : '';
               $user_id = @$request->user_id ? $request->user_id : '';
               $start_date = @$request->start_date ? $request->start_date : '';
               $end_date = @$request->end_date ? $request->end_date : '';
               $sort_by = @$request->sort_by ? $request->sort_by : 'id';
               $sort_order = @$request->sort_order ? $request->sort_order : 'asc';

               // validation for project_id
               if (!empty($project_id)) {
                    $project = Project::where('id', $project_id)
                         ->whereNull('deleted_at')
                         ->first();
                    if (!$project) {
                         return sendJsonResponse(['status_code' => 400, 'message' => 'Invalid project_id.']);
                    }
               }

               // validation for user_id
               if (!empty($user_id)) {
                    $user = Users::where('id', $user_id)
                         ->whereNull('deleted_at')
                         ->first();
                    if (!$user) {
                         return sendJsonResponse(['status_code' => 400, 'message' => 'Invalid user_id.']);
                    }
               }

               // validation for start_date and end_date format (dd-mm-yyyy)
               if (!empty($start_date) && !self::validateDate($start_date, 'd-m-Y')) {
                    return sendJsonResponse(['status_code' => 400, 'message' => 'Invalid start_date format. Use dd-mm-yyyy.']);
               }

               if (!empty($end_date) && !self::validateDate($end_date, 'd-m-Y')) {
                    return sendJsonResponse(['status_code' => 400, 'message' => 'Invalid end_date format. Use dd-mm-yyyy.']);
               }

               $data = [
                    'search' => $search,
                    'project_id' => $project_id,
                    'user_id' => $user_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
               ];

               $query = ProjectTimeSheet::getQueryForReport($data)->with([
                    'user',
                    'project',
               ]);
               $total_count = ProjectTimeSheet::select('id')->count();
               $filter_count = $query->clone()->count();
               $total_duration = $query->clone()->sum('duration');
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
                         'total_duration' => $total_duration,
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

     private static function validateDate($date, $format = 'Y-m-d')
     {
          $d = \DateTime::createFromFormat($format, $date);
          return $d && $d->format($format) === $date;
     }
}
