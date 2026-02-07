<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Users::updateOrInsert(
            ['email' => 'prinsi@yopmail.com'],
            [
                'first_name' => 'Prinsi',
                'middle_name' => 'Babubhai',
                'last_name' => 'Gorasiya',
                'user_name' => 'prinsi1909',
                'password' => 'Prinsi@1909',
                'role' => 'Admin',
                'department' => 'IT',
                'status' => 'Active',
                'created_id' => 1,
            ]
        );

    }
}
