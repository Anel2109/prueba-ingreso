<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nelson Arevalo',
            'email' => 'arneldesing@gmail.com',
            'city_id' => 1,
            'status_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Angela Lozano',
            'email' => 'angie40@gmail.com',
            'city_id' => 1,
            'status_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Ronaldo Arciniegas',
            'email' => 'arcironaldo@gmail.com',
            'city_id' => 3,
            'status_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Esteban Cañon',
            'email' => 'cañon23@gmail.com',
            'city_id' => 2,
            'status_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);
    }
}
