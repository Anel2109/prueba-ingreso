<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'Bogota',
            'code' => 'BOG',
            'shipping_value' => 3500,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        DB::table('cities')->insert([
            'name' => 'Medellin',
            'code' => 'MED',
            'shipping_value' => 4500,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        DB::table('cities')->insert([
            'name' => 'Barranquilla',
            'code' => 'BAR',
            'shipping_value' => 10500,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);
    }
}
