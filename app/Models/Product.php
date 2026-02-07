<?php

namespace App\Models;

use App\Http\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'products';

    protected $fillable = [
        'serial_no',
        'requiredment_type',
        'project_code',
        'pcb_code',
        'quantity',
        'unit',
        'layer',
        'pcb_thickness',
        'sku',
        'mpn',
        'suggested_vendor',
        'order_vendor',
        'vendor',
        'gerber_link',
        'order_qty',
        'receive_qty',
        'price_per_piece',
        'order_date',
        'expected_date',
        'target_receive_date',
        'receive_date',
        'request_person',
        'order_person',
        'receiver_name',
        'status',
        'image',
        'created_id',
        'updated_id',
        'deleted_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'receive_date' => 'date',
        'created_id' => 'integer',
        'updated_id' => 'integer',
        'deleted_id' => 'integer',
    ];

    protected $auditEvents = [
        'created',
        'updated',
        'deleted',
    ];

    /* =========================
       Query Helpers (Like Example)
    ========================== */

    public static function getQueryForList($data)
    {
        $query = self::query();

        if (!empty($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('serial_no', 'like', '%' . $data['search'] . '%')
                  ->orWhere('sku', 'like', '%' . $data['search'] . '%')
                  ->orWhere('mpn', 'like', '%' . $data['search'] . '%');
            });
        }

        if (!empty($data['status'])) {
            $query->where('status', $data['status']);
        }

        return $query;
    }
}
