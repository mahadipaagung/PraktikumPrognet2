<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use SoftDeletes;

    protected $table='response';
    protected $dates = ['deleted_at'];
    public function product_review()
    {
        return $this->belongsTo('App\Product_Review', 'review_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
}
