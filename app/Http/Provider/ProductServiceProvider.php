<?php

namespace App\Http\Provider;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\Log;

class ProductServiceProvider extends Controller
{
     public static function index($request)
     {
          try {
               $start = @$request->start ? $request->start : 0;
               $limit = @$request->limit ? $request->limit : 10;
               $search = @$request->search ? $request->search : '';
               $sort_by = @$request->sort_by ? $request->sort_by : 'id';
               $sort_order = @$request->sort_order ? $request->sort_order : 'asc';

               $data = [
                    'search' => $search,
               ];

               $query = Product::getQueryForList($data)->where('status', 'Active');
               $total_count = Product::select('id')->where('status', 'Active')->count();
               $filter_count = $query->clone()->count();
               $productsList = $query->clone()
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
                         'products_list' => $productsList,
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

     public static function InPurchase($validatedData)
     {
          try {

               $product = Product::create($validatedData);

               $data = [
                    'status_code' => 201,
                    'message' => 'Product created successfully.',
                    'data' => $product,
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

     public static function Order($validatedData)
     {
          try {

               $product = Product::where('serial_no', $validatedData['serial_no'])->first();

               if (!$product) {
                    return sendJsonResponse(['status_code' => 404, 'message' => 'Product not found.']);
               }

               $product->update($validatedData);

               $data = [
                    'status_code' => 200,
                    'message' => 'Product updated successfully.',
                    'data' => $product,
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

     public static function Receive($validatedData)
     {
          try {

               $product = Product::where('serial_no', $validatedData['serial_no'])->first();

               if (!$product) {
                    return sendJsonResponse(['status_code' => 404, 'message' => 'Product not found.']);
               }

               $product->update($validatedData);

               $data = [
                    'status_code' => 200,
                    'message' => 'Product updated successfully.',
                    'data' => $product,
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
