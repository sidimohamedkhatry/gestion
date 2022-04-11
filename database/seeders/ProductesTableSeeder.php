<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productes = ['Lekhrive','Kaswa'];

        foreach($productes as $product){
            Product::create([
                'name'          =>  $product,
                'category_id'   =>  1,
                'purches_price' =>  30,
                'sale_price'    =>  30,
                'stock'         =>  10
            ]);
        }
    }
}
