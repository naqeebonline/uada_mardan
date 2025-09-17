<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRent extends Model
{
    protected $guarded = ["id"];
    public $timestamps = false;

    public function banks()
    {
        return $this->belongsTo(BankAccount::class,"bank_id");
    }

    public function getBillGenerateDateAttribute($value)
    {

        return date("Y-m-d",strtotime($value));
    }

}
