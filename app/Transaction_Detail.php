<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Transaction_Detail extends Model
{

    use SoftDeletes;
 
    protected $table='transaction_details';
    protected $dates = ['deleted_at'];

    public function transcation(){
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
    
}