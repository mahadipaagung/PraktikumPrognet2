<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table='discounts';
    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product', 'id');
    }
}
