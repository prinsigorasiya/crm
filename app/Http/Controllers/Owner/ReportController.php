<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Provider\ReportServiceProvider;

class ReportController extends Controller
{
     /**
      *  @OA\Post(
      *    path="/api/v1/owner/report/list",
      *     summary="List Report",
      *     tags={"Report"},
      *     description="List Report",
      *     operationId="ReportList",
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
      *     @OA\Parameter(
      *          name="project_id",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="search by project id",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="user_id",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="search by user id",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="start_date",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="search by start date",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="end_date",
      *          required=false,
      *          in="query",
      *          example="",
      *          description="search by end date",
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
          return ReportServiceProvider::index($request);
     }
}
