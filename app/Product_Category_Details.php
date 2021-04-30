<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Category_Details extends Model
{
    protected $table = 'product_category_details';
    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
    public function product_categories()
    {
        return $this->belongsTo('App\Product_Categories', 'category_id', 'id');
    }
}
