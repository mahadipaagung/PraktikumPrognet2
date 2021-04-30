<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    protected $table = 'product_categories';
    public function product_category_details()
    {
        return $this->hasMany('App/Product_Category_Details');
    }
}
