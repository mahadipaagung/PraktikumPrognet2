<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';

    public function product_category_details()
    {
        return $this->hasMany('App\Product_Category_Details');
    }

    public function product_review()
    {
        return $this->hasMany('App\Product_Review');
    }

    public function discount()
    {
        return $this->hasMany('App\Discount','id_product', 'id');
    }

    public function relasi_product_image(){
        return $this->hasMany('App\Product_Image','product_id','id');
    }
}
