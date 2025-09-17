<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserVerificationController extends Controller
{
    public function index()
    {
        $data["title"] = "Customer Verification";

        $data['data'] = User::where(["users.is_verified"=>1,"users.is_active" => 0])
            ->select("users.*","office.name as office_name","organization.org_name")
            ->leftJoin("office","office.id","=","users.office_id")
            ->leftJoin("organization","organization.id","=","users.org_id")
            ->paginate(20);
        return view("admin.user_verification.index",$data);
    }


    public function details($id)
    {
        $data["title"] = "Customer Details";
        $data["user"] = User::where(["id"=>$id])->first();

        $data["offices"] = DB::table("office")->get();
        return view("admin.user_verification.details",$data);
    }
}
