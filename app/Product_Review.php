<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_Review extends Model
{
    use SoftDeletes;
    protected $table='product_reviews';
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    // public function response()
    // {
    //     return $this->hasMany('App\Response');
    // }

    public function response(){
        return $this->hasMany('App\Response', 'review_id', 'id');
    }
}
