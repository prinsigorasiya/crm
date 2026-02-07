<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Provider\ProductServiceProvider;
use App\Http\Requests\Product\ProductGetRequest;
use App\Http\Requests\Product\ProductInPurchaseRequest;
use App\Http\Requests\Product\ProductOrderRequest;
use App\Http\Requests\Product\ProductReceiveRequest;
use App\Http\Requests\Project\ProjectStoreRequest;

class ProductController extends Controller
{
     /**
      *  @OA\Post(
      *    path="/api/v1/owner/product/list",
      *     summary="List Product",
      *     tags={"Product"},
      *     description="List Product",
      *     operationId="ProductList",
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
          return ProductServiceProvider::index($request);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/product/inPurchase",
      *     summary="In Purchase a Product",
      *     tags={"Product"},
      *     description="Product",
      *     operationId="ProductInPurchase",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="serial_no",
      *          required=true,
      *          in="query",
      *          example="Product Serial No",
      *          description="Enter Product Serial No",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="requiredment_type",
      *          required=true,
      *          in="query",
      *          example="Product Requiredment Type",
      *          description="Enter Product Requiredment Type",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="project_code",
      *          required=true,
      *          in="query",
      *          example="Product Project Code",
      *          description="Enter Project Code",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="pcb_code",
      *          required=true,
      *          in="query",
      *          example="100",
      *          description="Enter PCB Code",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="quantity",
      *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter Quantity",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="unit",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter Unit",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="layer",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter Layer",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="pcb_thickness",
      *          required=true,
      *          in="query",
      *          example="0.5",
      *          description="Enter PCB Thickness",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="sku",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter sku",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="mpn",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter mpn",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="suggested_vendor",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter suggested_vendor",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="gerber_link",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter Gerber Link",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="target_receive_date",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter target_receive_date",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *
      *     @OA\Parameter(
      *          name="request_person",
      *          required=true,
      *          in="query",
      *          example="kg",
      *          description="Enter request_person",
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
     public function InPurchase(ProductInPurchaseRequest $request)
     {
          $validatedData = $request->validated();

          return ProductServiceProvider::InPurchase($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/product/order",
      *     summary="Order a Product",
      *     tags={"Product"},
      *     description="Product",
      *     operationId="ProductOrder",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="serial_no",
      *          required=true,
      *          in="query",
      *          example="Product Serial No",
      *          description="Enter Product Serial No",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="order_qty",
      *          required=true,
      *          in="query",
      *          example="Product Order Quantity",
      *          description="Enter Product Order Quantity",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="price_per_piece",
      *          required=true,
      *          in="query",
      *          example="Product Price Per Piece",
      *          description="Enter Price Per Piece",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="order_vendor",
      *          required=true,
      *          in="query",
      *          example="order_vendor",
      *          description="Enter Order Vendor",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="sku",
      *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter SKU",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="mpn",
      *          required=true,
      *          in="query",
      *          example="mpn",
      *          description="Enter MPN",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="order_person",
      *          required=true,
      *          in="query",
      *          example="order_person",
      *          description="Enter Order Person",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="order_date",
      *          required=true,
      *          in="query",
      *          example="01-01-2026",
      *          description="Enter Order Date",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="expected_date",
      *          required=true,
      *          in="query",
      *          example="01-01-2026",
      *          description="Enter Expected Date",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="target_receive_date",
      *          required=true,
      *          in="query",
      *          example="01-01-2026",
      *          description="Enter Target Receive Date",
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
     public function Order(ProductOrderRequest $request)
     {
          $validatedData = $request->validated();

          return ProductServiceProvider::Order($validatedData);
     }

     /**
      *  @OA\Post(
      *     path="/api/v1/owner/product/receive",
      *     summary="Receive a Product",
      *     tags={"Product"},
      *     description="Product",
      *     operationId="ProductReceive",
      *     security={{"bearerAuth":{}}},
      *
      *     @OA\Parameter(
      *          name="serial_no",
      *          required=true,
      *          in="query",
      *          example="Product Serial No",
      *          description="Enter Product Serial No",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="receive_qty",
      *          required=true,
      *          in="query",
      *          example="Product Receive Quantity",
      *          description="Enter Product Receive Quantity",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="receive_date",
      *          required=true,
      *          in="query",
      *          example="Product Receive Date",
      *          description="Enter Product Receive Date",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="receiver_name",
      *          required=true,
      *          in="query",
      *          example="receiver_name",
      *          description="Enter Receiver Name",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      *
      *     @OA\Parameter(
      *          name="price_per_piece",
      *          required=true,
      *          in="query",
      *          example="8",
      *          description="Enter Price Per Piece",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *       ),
      * 
      *     @OA\Parameter(
      *          name="vendor",
      *          required=true,
      *          in="query",
      *          example="vendor",
      *          description="Enter Vendor",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      *
      *     @OA\Parameter(
      *          name="sku",
      *          required=true,
      *          in="query",
      *          example="sku",
      *          description="Enter SKU",
      *
      *          @OA\Schema(
      *          type="string",
      *         ),
      *     ),
      * 
      *     @OA\Parameter(
      *          name="mpn",
      *          required=true,
      *          in="query",
      *          example="mpn",
      *          description="Enter MPN",
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
     public function Receive(ProductReceiveRequest $request)
     {
          $validatedData = $request->validated();

          return ProductServiceProvider::Receive($validatedData);
     }
}
