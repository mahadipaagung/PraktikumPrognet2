<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    protected $table = 'product_images';

    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
