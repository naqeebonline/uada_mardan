<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    protected $table = "plaza";
    protected $guarded = ["id"];
    public $timestamps = false;
}
