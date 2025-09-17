<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = "auctions";
    protected $primaryKey = "id";
    protected $guarded = ["id"];
    public $timestamps = true;
}
