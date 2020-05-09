<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Arroz Florhuila',
            'reference' => '500 gramos',
            'image' => 'https://mercaenlinea.nyc3.digitaloceanspaces.com/2019/02/arroz_florhuila_500.jpg',
            'sale_price' => '1500',
            'category_id' => 1,
            'stock' => 127,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);

        DB::table('products')->insert([
            'name' => 'Aceite De Oliva ArteOliva',
            'reference' => '1 Litro',
            'image' => 'https://mercaenlinea.nyc3.digitaloceanspaces.com/2019/07/aceite_de_oliva_arteoliva_500ml2-416x416.jpg',
            'sale_price' => '15000',
            'category_id' => 2,
            'stock' => 100,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);

        DB::table('products')->insert([
            'name' => 'Leche Descremada Alpina',
            'reference' => '1100 mililitros',
            'image' => 'https://mercaenlinea.nyc3.digitaloceanspaces.com/2018/11/leche_deslactosada_alpina_maxilitro-600x600.jpg',
            'sale_price' => '1500',
            'category_id' => 3,
            'stock' => 150,
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:m:s')
        ]);
    }
}
