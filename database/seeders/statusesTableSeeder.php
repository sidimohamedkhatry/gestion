<?php

namespace Database\Seeders;

use App\Models\status;
use Illuminate\Database\Seeder;

class statusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $status = ['Payé','No Payé'];

        foreach($status as $product){
            statuses::create([
                'name'          =>  $product,
                
            ]);
        }
       
    }
}