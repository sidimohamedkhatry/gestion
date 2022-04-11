<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;



class OrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function headings():array
    {
        return [
            "id",
            "num_fa",
            "status	",
            "total_price",
            "created_at	",
            "updated_at"

        ];
    }

    public function collection()
    {
        return Order::select('id','num_fa','status','total_price','created_at','updated_at')->get();
    }
}






