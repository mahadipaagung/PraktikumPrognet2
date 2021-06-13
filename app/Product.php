<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table='products';
    protected $dates = ['deleted_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'product_name'
            ]
        ];
    }

    public function product_category_details()
    {
        return $this->hasMany('App\Product_Category_Details');
    }

    protected $fillable = [
        'product_name',
        'price',
        'description',
        'stock',
        'weight',
       ];
   
    protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    ];

    // protected $dates = ['deleted_at'];
   
    public function product_category_detail(){
        return $this->hasMany('App\Product_Category_Details','product_id','id');
    }

    public function product_image(){
        return $this->hasMany('App\Product_image','product_id','id');
    }

    public function category(){
        return $this->belongsToMany('App\Category','product_category_details', 'product_id', 'category_id')->withPivot('id');
    }

    public function discount(){
        return $this->hasMany('App\Discount', 'id_product', 'id');
    }

    public function product_review(){
        return $this->hasMany('App\Product_Review', 'product_id', 'id');
    }

    public function user(){
        return $this->belongsToMany('App\User', 'product_reviews', 'product_id', 'user_id')->withPivot('id');
    }

    public function cart(){
        return $this->hasMany('App\Cart', 'product_id', 'id');
    }

    public function user_cart(){
        return $this->belongsToMany('App\User', 'carts', 'product_id', 'user_id')->withPivot('id');
    }

    public function transaction(){
        return $this->belongsToMany('App\Transaction', 'transaction_details', 'product_id', 'transaction_id')->withPivot('id');
    }

    public function relasi_product_image(){
        return $this->hasMany('App\Product_Image','product_id','id');
    }

    // public function product_review()
    // {
    //     return $this->hasMany('App\Product_Review');
    // }

    // public function discount()
    // {
    //     return $this->hasMany('App\Discount','id_product', 'id');
    // }
}
