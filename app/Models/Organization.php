<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{

    protected $table = "organization";
    protected $guarded = ["id"];
    public $timestamps = false;


}
