<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class employe extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $appends = ['image_path']; 



    public function getImagePathAttribute(){
        return asset('uploads/employe_images/' . $this->image);
    }//end of get images

    
    // public function employe()
    // {
    //     return $this->belongsTo(employe::class);

    // }

}
