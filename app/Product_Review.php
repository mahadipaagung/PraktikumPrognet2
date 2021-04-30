<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Review extends Model
{
    protected $table='product_reviews';

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function response()
    {
        return $this->hasMany('App\Response');
    }
}
