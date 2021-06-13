<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use SoftDeletes;
 
    protected $table = "transactions";
    protected $dates = ['deleted_at'];

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

    public function product_review(){
        return $this->hasMany('App\Product_Review', 'transaction_id', 'id');
    }
}
