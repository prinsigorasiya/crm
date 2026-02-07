<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MongoExample;


class TestController extends Controller
{
     public function mongoTest()
     {
          // Get MongoDB connection
          $db = DB::connection('mongodb')->getMongoDB();

          // List all collections
          $collections = $db->listCollections();

          $collectionExists = false;
          foreach ($collections as $collection) {
               if ($collection->getName() === 'mongo_examples') {
                    $collectionExists = true;
                    break;
               }
          }

          if ($collectionExists) {
               return response()->json(['status' => 'success', 'message' => 'Collection exists']);
          } else {
               return response()->json(['status' => 'error', 'message' => 'Collection does not exist']);
          }
     }
}
