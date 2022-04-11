<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
        
     protected $guarded = [];
    protected $appends = ['image_path']; 
        
    

    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get name attribute

    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders


    public function invoices()
    {
        return $this->hasMany(invoices::class);

    }//end of orders


    public function getImagePathAttribute(){
        return asset('uploads/client_images/' . $this->image);
    }//end of get images
    // protected $casts = [
    //     'phone' => 'array'
    // ];
}
