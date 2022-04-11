<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $categories=['Lait','Riz'];
        foreach($categories as $category){
            Category::create([
                'name'      =>   $category,
                
            ]);
        }
       
    }
}
