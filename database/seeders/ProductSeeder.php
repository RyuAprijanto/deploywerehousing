<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['user_id' => 1,
            'name' => 'Aqua',
             'type_id' => 1,
             'stock' => 50,
             'description' => 'Aqua.',
             'image' => 'aqua.jpg',
            'buy_price'=>3000,
            'sell_price'=>3500,
            'expired_date'=>Carbon::create(2024, 12, 31)],
             
             ['user_id' => 1,
             'name' => 'Chiki',
             'type_id' => 2,
             'stock' => 30,
             'description' => 'Chiki',
             'image' => 'chiki.jpeg',
            'buy_price'=>5000,
            'sell_price'=>5500,
            'expired_date'=>Carbon::create(2024, 11, 25)],

             ['user_id' => 1,
             'name' => 'Teh Botol',
             'type_id' => 1,
             'stock' => 50,
             'description' => 'Tehbotol',
             'image' => 'tehbotol.png',
             'buy_price'=>4000,
            'sell_price'=>4500,
            'expired_date'=>Carbon::create(2024, 10, 23)]
            ]);
    }
}
