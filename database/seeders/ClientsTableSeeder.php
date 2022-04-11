<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients =  ['Center Emir', 'Bana Bleu'];
        foreach($clients as $client){
            Client::create([
                'name'      =>$client,
                'phone'     =>  '44252225',
                'address'   =>  'Mauritanie',
            ]);
        }
    }
}
