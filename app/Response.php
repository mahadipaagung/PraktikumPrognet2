<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table='response';

    public function product_review()
    {
        return $this->belongsTo('App\Product_Review', 'review_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
}
