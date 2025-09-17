<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProperty extends Model
{
    protected $table = "customer_property";
    protected $guarded = ["id"];
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(User::class,"customer_id");
    }

    public function shop()
    {
        return $this->belongsTo(PlazaShop::class,"plaza_shop_id");
    }


    /*public function getLeaseDateAttribute($value){
        return date("d-m-Y",strtotime($value->lease_date));
    }*/
}
