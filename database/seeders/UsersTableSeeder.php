<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now();
        $superAdminUser = User::create([
            'name' => 'SuperAdmin',
            'email' => 'SuperAdmin@gmail.com',
            'email_verified_at' => $currentDate,
            'departament_id' => 1,
            'password' => Hash::make('123'),
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
        ]);
    }
}
