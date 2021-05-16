<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transaction_detail(){
        return $this->hasMany('App\Transaction_Detail', 'transaction_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product(){
        return $this->belongsToMany('App\Product', 'transaction_details', 'transaction_id', 'product_id')->withPivot('id');
    }

    public function courier(){
        return $this->belongsTo('App\Courier', 'courier_id', 'id');
    }
}
