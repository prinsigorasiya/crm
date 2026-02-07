<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Provider\ProjectServiceProvider;
use App\Http\Requests\Project\ProjectChangeStatusRequest;
use App\Http\Requests\Project\ProjectGetRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Http\Requests\Project\ProjectStoreRequest;

class ProjectController extends Controller
{
     /**
      *  @OA\Post(
      *    path="/api/v1/owner/project/list",
      *     summary="List Project",
      *     tags={"Project"},
      *     description="List Project",
      *     operationId="ProjectList",
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
      *          name="code",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="Code",
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
          return ProjectServiceProvider::index($request);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project/store",
      *     summary="Store a Project",
      *     tags={"Project"},
      *     description="Project",
      *     operationId="ProjectStore",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="name",
      *          required=true,
      *          in="query",
      *          example="Project Name",
      *          description="Enter Project Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="code",
      *          required=true,
      *          in="query",
      *          example="Project Code",
      *          description="Enter Project Code",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="status",
      *          required=true,
      *          in="query",
      *          example="Active",
      *          description="Enter Status(InPlanning, Running, Stopped, Completed)",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="total_hours",
      *          required=true,
      *          in="query",
      *          example="100",
      *          description="Enter Total Hours",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="per_day_hours",
      *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter Per Day Hours",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="assigned_user",
      *          required=true,
      *          in="query",
      *          example="1,2,3",
      *          description="Enter Assigned User",
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
     public function store(ProjectStoreRequest $request)
     {
          $validatedData = $request->validated();

          return ProjectServiceProvider::store($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project/update",
      *     summary="Update a Project",
      *     tags={"Project"},
      *     description="Project",
      *     operationId="ProjectUpdate",
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
      *          name="name",
      *          required=true,
      *          in="query",
      *          example="Project Name",
      *          description="Enter Project Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="code",
      *          required=true,
      *          in="query",
      *          example="Project Code",
      *          description="Enter Project Code",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="status",
      *          required=true,
      *          in="query",
      *          example="Active",
      *          description="Enter Status(InPlanning, Running, Stopped, Completed)",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="total_hours",
      *          required=true,
      *          in="query",
      *          example="100",
      *          description="Enter Total Hours",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="per_day_hours",
      *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter Per Day Hours",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="assigned_user",
      *          required=true,
      *          in="query",
      *          example="1,2,3",
      *          description="Enter Assigned User",
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
     public function update(ProjectUpdateRequest $request)
     {
          $validatedData = $request->validated();

          return ProjectServiceProvider::update($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project/view",
      *     summary="View a Project",
      *     tags={"Project"},
      *     description="Project",
      *     operationId="ProjectView",
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
     public function view(ProjectGetRequest $request)
     {
          $validatedData = $request->validated();
          return ProjectServiceProvider::view($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project/change-status",
      *     summary="Change Project Status",
      *     tags={"Project"},
      *     description="Project",
      *     operationId="ProjectChangeStatus",
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
      *         name="status",
      *         in="query",
      *         required=true,
      *          description="Enter Status(InPlanning, Running, Stopped, Completed)",
      *         example="Active",
      *
      *         @OA\Schema(
      *             type="string",
      *             enum={"InPlanning", "Running", "Stopped", "Completed"}
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
     public function changeStatus(ProjectChangeStatusRequest $request)
     {
          $validatedData = $request->validated();
          return ProjectServiceProvider::changeStatus($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project/destroy",
      *     summary="Destroy a Project",
      *     tags={"Project"},
      *     description="Project",
      *     operationId="ProjectDestroy",
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
     public function destroy(ProjectGetRequest $request)
     {
          $validatedData = $request->validated();
          return ProjectServiceProvider::destroy($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/project/drop-down",
      *     summary="Get Project Drop Down",
      *     tags={"Project"},
      *     description="Project",
      *     operationId="ProjectDropDown",
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
          return ProjectServiceProvider::dropDown($request);
     }
}
