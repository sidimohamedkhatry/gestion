<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_path', 'profit_percent']; 
    
    // protected $fillable = [
        
    //     'name',
    //     'cat_id',
    //     'image',
    //     'purches_price',
    //     'sale_price',
    //     'stock'
    // ];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function orders(){
        return $this->BelongsToMany(Order::class,'product_order');
    }

    public function invoices(){
        return $this->BelongsToMany(invoices::class,'product_order');
    }

    public function getImagePathAttribute(){
        return asset('uploads/product_images/' . $this->image);
    }//end of get images

    public function getProfitPercentAttribute(){
        $profit = $this->sale_price - $this->purches_price; //المكسب

        $profit_percent = $profit * 100 / $this->purches_price;  //نسبه المكسب
        return round($profit_percent,2);  
    }


}
