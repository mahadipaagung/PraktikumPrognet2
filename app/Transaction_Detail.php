<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_Detail extends Model
{
    protected $table='transaction_details';

    public function transcation(){
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}