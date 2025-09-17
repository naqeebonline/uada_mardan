<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlazaShop extends Model
{
    protected $table = "plaza_shops";
    protected $guarded = ["id"];
    public $timestamps = false;

    public function plaza()
    {
        return $this->belongsTo(Plaza::class,"plaza_id");
    }

    public function rentout()
    {
        return $this->hasMany(CustomerProperty::class,"plaza_shop_id");
    }
}
