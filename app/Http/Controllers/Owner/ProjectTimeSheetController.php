<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Provider\ProjectTimeSheetServiceProvider;
use App\Http\Requests\ProjectTimeSheet\ProjectTimeSheetChangeStatusRequest;
use App\Http\Requests\ProjectTimeSheet\ProjectTimeSheetGetRequest;
use App\Http\Requests\ProjectTimeSheet\ProjectTimeSheetUpdateRequest;
use App\Http\Requests\ProjectTimeSheet\ProjectTimeSheetStoreRequest;

class ProjectTimeSheetController extends Controller
{
     /**
      *  @OA\Post(
      *    path="/api/v1/owner/project-timesheet/list",
      *     summary="List Project Timesheet",
      *     tags={"Project Timesheet"},
      *     description="List Project Timesheet",
      *     operationId="ProjectTimesheetList",
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
      *          name="project_id",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="Project ID",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *      @OA\Parameter(
      *          name="user_id",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="User ID",
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
          return ProjectTimeSheetServiceProvider::index($request);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project-timesheet/store",
      *     summary="Store a Project Timesheet",
      *     tags={"Project Timesheet"},
      *     description="Project Timesheet",
      *     operationId="ProjectTimesheetStore",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="project_id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter Project ID",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="start_time",
      *          required=true,
      *          in="query",
      *          example="100",
      *          description="Enter Start Time",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="end_time",
       *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter End Time",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="notes",
      *          required=true,
      *          in="query",
      *          example="Add notes here",
      *          description="Enter Notes",
      *
      *          @OA\Schema(
      *          type="string",
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
     public function store(ProjectTimeSheetStoreRequest $request)
     {
          $validatedData = $request->validated();

          return ProjectTimeSheetServiceProvider::store($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project-timesheet/update",
      *     summary="Update a Project Timesheet",
      *     tags={"Project Timesheet"},
      *     description="Project Timesheet",
      *     operationId="ProjectTimesheetUpdate",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter Project ID",
      *
      *          @OA\Schema(
      *          type="number",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="project_id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter Project ID",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="start_time",
      *          required=true,
      *          in="query",
      *          example="100",
      *          description="Enter Start Time",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="end_time",
       *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter End Time",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="notes",
      *          required=true,
      *          in="query",
      *          example="Add notes here",
      *          description="Enter Notes",
      *
      *          @OA\Schema(
      *          type="string",
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
     public function update(ProjectTimeSheetUpdateRequest $request)
     {
          $validatedData = $request->validated();

          return ProjectTimeSheetServiceProvider::update($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project-timesheet/view",
      *     summary="View a Project Timesheet",
      *     tags={"Project Timesheet"},
      *     description="Project Timesheet",
      *     operationId="ProjectTimesheetView",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter Project Timesheet ID",
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
     public function view(ProjectTimeSheetGetRequest $request)
     {
          $validatedData = $request->validated();
          return ProjectTimeSheetServiceProvider::view($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project-timesheet/change-status",
      *     summary="Change Project Timesheet Status",
      *     tags={"Project Timesheet"},
      *     description="Project Timesheet",
      *     operationId="ProjectTimesheetChangeStatus",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter Project Timesheet ID",
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
      *          description="Enter Status(InPlanning, Running, Stopped, Completed)",
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
     public function changeStatus(ProjectTimeSheetChangeStatusRequest $request)
     {
          $validatedData = $request->validated();
          return ProjectTimeSheetServiceProvider::changeStatus($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project-timesheet/destroy",
      *     summary="Destroy a Project Timesheet",
      *     tags={"Project Timesheet"},
      *     description="Project Timesheet",
      *     operationId="ProjectTimesheetDestroy",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="id",
      *          required=true,
      *          in="query",
      *          example="1",
      *          description="Enter Project Timesheet ID",
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
     public function destroy(ProjectTimeSheetGetRequest $request)
     {
          $validatedData = $request->validated();
          return ProjectTimeSheetServiceProvider::destroy($validatedData);
     }
}
