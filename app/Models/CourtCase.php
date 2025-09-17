<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtCase extends Model
{
    protected $table = "court_case";
    protected $guarded = ["id"];
    public $timestamps = false;
}
