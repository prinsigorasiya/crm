<?php

namespace App\Models;

use App\Http\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ProjectTimeSheet extends Model implements Auditable
{
     use CreatedUpdatedBy, HasFactory, SoftDeletes;
     use \OwenIt\Auditing\Auditable;

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
          'project_id',
          'user_id',
          'date',
          'start_time',
          'end_time',
          'duration',
          'notes',
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
          'project_id' => 'integer',
          'user_id' => 'integer',
          'created_id' => 'integer',
          'updated_id' => 'integer',
          'deleted_id' => 'integer',
     ];

     protected $auditEvents = [
          'created',
          'updated',
          'deleted',
     ];

     // belogs user
     public function user()
     {
          return $this->belongsTo(Users::class, 'user_id', 'id');
     }

     // belongs project
     public function project()
     {
          return $this->belongsTo(Project::class, 'project_id', 'id');
     }

     public static function getQueryForList($data)
     {
          $responseData = self::where(function ($query) use ($data) {
               if (@$data['search']) {
               }
          });
          if (@$data['project_id']) {
               $responseData->where('project_id', $data['project_id']);
          }

          if (@$data['user_id']) {
               $responseData->where('user_id', $data['user_id']);
          }

          return $responseData;
     }

     public static function getQueryForReport($data)
     {
          $responseData = self::where(function ($query) use ($data) {
               if (@$data['search']) {
               }
          });
          if (@$data['project_id']) {
               $responseData->where('project_id', $data['project_id']);
          }

          if (@$data['user_id']) {
               $responseData->where('user_id', $data['user_id']);
          }

          if (@$data['start_date']) {
               $responseData->whereDate('date', '>=', date('Y-m-d', strtotime($data['start_date'])));
          }

          if (@$data['end_date']) {
               $responseData->whereDate('date', '<=', date('Y-m-d', strtotime($data['end_date'])));
          }

          return $responseData;
     }
}
