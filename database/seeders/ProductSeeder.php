<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $products = [
            [
                'user_id' => 1,
                'name' => 'Bap Cai',
                'price' => 100,
                'quantity' => 1000,
                'description' => 'Bap Cai Xanh',
            ],
            [
                'user_id' => 1,
                'name' => 'Xu Hao',
                'price' => 56000,
                'quantity' => 1000,
                'description' => 'Su Hao Da Lat',
            ],
            [
                'user_id' => 1,
                'name' => 'Ca rot',
                'price' => 10010,
                'quantity' => 100,
                'description' => 'Ca Rot Huu Co',
            ],
            [
                'user_id' => 1,
                'name' => 'Ca Chua',
                'price' => 19000,
                'quantity' => 100,
                'description' => 'Ca Chua Huu Co',
            ],
            [
                'user_id' => 1,
                'name' => 'Khoai Tay',
                'price' => 910000,
                'quantity' => 1000,
                'description' => 'Khoai Tay',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
