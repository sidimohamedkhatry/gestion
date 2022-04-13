<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;


    public function headings():array
    {
        return [
            
            "num_produitt",
            "name	",
            "image",
            "purches_price	",
            "stock",
            "created_at",
            "updated_at"

        ];
    }
    public function collection()
    {
        return Product::select('num_produitt', 'name','image', 'purches_price','stock', 'created_at', 'updated_at')->get();
    }
}



