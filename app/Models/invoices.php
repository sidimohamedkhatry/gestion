<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class invoices extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);

    }//end of user


    public function products(){
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity');
    }


    



   //end of orders

    // public function produit()
    // {
    //     return $this->belongsTo(Product::class);

    // }//end of user

    
}


