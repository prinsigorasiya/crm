<?php

namespace App\Models;

use App\Http\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model implements Auditable
{
     use CreatedUpdatedBy, HasFactory, SoftDeletes;
     use \OwenIt\Auditing\Auditable;

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
          'name',
          'code',
          'status',
          'inquiry_date',
          'target_date',
          'start_date',
          'end_date',
          'total_hours',
          'par_day_hours',
          'assigned_user',
          'created_id',
          'updated_id',
          'deleted_id',
     ];

     /**
      * The attributes that should be cast to native types.
      *
      * @var array
      */
     protected $casts = [
          'id' => 'integer',
          'created_id' => 'integer',
          'updated_id' => 'integer',
          'deleted_id' => 'integer',
     ];

     protected $auditEvents = [
          'created',
          'updated',
          'deleted',
     ];

     public static function getQueryForList($data)
     {
          $responseData = self::where(function ($query) use ($data) {
               if (@$data['search']) {
                    $query->where('name', 'LIKE', '%' . $data['search'] . '%')
                         ->orWhere('code', 'LIKE', '%' . $data['search'] . '%')
                         ->orWhere('status', 'LIKE', '%' . $data['search'] . '%');
               }
          });
          if (@$data['name']) {
               $responseData->where('name', 'LIKE', '%' . $data['name'] . '%');
          }

          if (@$data['code']) {
               $responseData->where('code', 'LIKE', '%' . $data['code'] . '%');
          }

          if (@$data['status']) {
               $responseData->where('status', 'LIKE', '%' . $data['status'] . '%');
          }

          return $responseData;
     }
}
