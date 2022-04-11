<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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


    public function invoices()
    {
        return $this->hasMany(invoices::class,'product_order')->withPivot('quantity');

    }



    public function status(){
        return $this->hasMany(status::class);
    }
}
