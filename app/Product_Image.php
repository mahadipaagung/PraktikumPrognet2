<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
    	'product_id', 'image_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
