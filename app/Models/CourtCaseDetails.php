<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtCaseDetails extends Model
{
    protected $table = "court_case_details";
    protected $guarded = ["id"];
    public $timestamps = false;
}
