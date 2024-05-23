<?php

namespace Database\Seeders;

use App\Models\Departament;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DepartamentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now();
        $departementAdminUser = Departament::create([
            'name' => 'Administracion',
            'description' => 'Departamento con que inicia el proyecto, es el encargado de la administracion',
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
        ]);
    }
}
