<?php

namespace App\Models;

use App\Http\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Users extends Authenticatable implements JWTSubject
{
    use CreatedUpdatedBy, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'user_name',
        'email',
        'username',
        'department',
        'role',
        'password',
        'status',
        'created_id',
        'updated_id',
        'deleted_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'created_id' => 'integer',
            'updated_id' => 'integer',
            'deleted_id' => 'integer',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public static function getUserDataUsingEmail($email, ){
        $user = Users::where('email', $email)
            ->first();

        return $user;
    }

    public static function existsOwner($email)
    {
       
        return Users::where('email', $email)
            ->exists();
    }

    public static function checkUserWithPassword($email, $password)
    {
        return Users::where('email', $email)
            ->where('password', $password)
            ->first();
    }

    public static function getQueryForList($data)
    {
        $responseData = self::where(function ($query) use ($data) {
            if (@$data['search']) {
                $query->where('first_name', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('user_name', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('department', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('role', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('status', 'LIKE', '%' . $data['search'] . '%');
            }
        });
        if (@$data['user_name']) {
            $responseData->where('user_name', 'LIKE', '%' . $data['user_name'] . '%');
        }

        if (@$data['email']) {
            $responseData->where('email', $data['email']);
        }


        return $responseData;
    }
}
