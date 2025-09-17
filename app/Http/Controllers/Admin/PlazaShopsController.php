<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\CourtCase;
use App\Models\CustomerProperty;
use App\Models\Plaza;
use App\Models\PlazaShop;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class PlazaShopsController extends Controller
{


    public function floorShopView($plaza_id = 0, $floor_id =0)
    {
        $data["title"] = "Add Plaza Floor";

        $data['data'] = PlazaShop::with("rentout")
            ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name")
            ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
            ->leftJoin("plaza","plaza.id","=","plaza_floors.plaza_id")
            ->where("plaza_shops.floor_id",$floor_id)
            ->paginate(20);
        $data['plaza_id'] = $plaza_id;
        $data['floor_id'] = $floor_id;
        return view("admin.plaza_shops.manage-plaza-shops",$data);
    }


    public function addFloorShop($plaza_id="",$floor_id="")
    {
        $data["title"] = "Add Shop";
        $data['plaza_id'] = $plaza_id;
        $data['floor_id'] = $floor_id;
        $data['plaza'] = Plaza::where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])->get();
        $data['category'] = DB::table("property_types")->get();
        $data['court'] = DB::table("court")->get();
        return view("admin.plaza_shops.add-plaza-shops",$data);
    }

    public function addResidential()
    {
        $data["title"] = "Add Shop";

        $data['floor_id'] = 0;
        $data['plaza'] = Plaza::where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])->get();
        $data['category'] = DB::table("property_types")->get();
        $data['court'] = DB::table("court")->get();
        $data['org'] = DB::table("organization")->get();
        return view("admin.plaza_shops.add-residential",$data);
    }

    public function editResidential($id)
    {

        $res = DB::table("plaza_shops")->where(["id"=>$id])->first();
        if($res){
            if($res->shop_status == "rent_out"){
                $data['customerProperty'] = DB::table("customer_property")
                    ->select(["users.id as user_id","users.name","users.cnic","users.email","customer_property.*"])
                    ->leftJoin("users","users.id","=","customer_property.customer_id")
                    ->where(["customer_property.plaza_shop_id" => $res->id,"customer_property.is_active" => 1])
                    ->first();
            }

            if($res->is_court_case == "Yes"){
                $data['court_case'] = DB::table("court_case")
                    ->where(["court_case.plaza_shop_id" => $res->id])
                    ->first();
            }
        }
        $data['data'] = $res;

        $data["title"] = "Edit Shop";



        $data['category'] = DB::table("property_types")->get();
        $data['court'] = DB::table("court")->get();
        $data['plaza'] = Plaza::where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])->get();
        $data['org'] = DB::table("organization")->get();
        return view("admin.plaza_shops.add-residential",$data);


    }

    public function saveFloorShop()
    {

        $insertData = request()->except(["id","_token","attachment","customer_id","lease_date","duration","court_name","case_title","case_number","case_status"]);
        $plaza_id = request()->plaza_id;
        $floor_id = request()->floor_id;


        if (request()->has("attachment") && !empty(request()->attachment)){
            $file = request()->file("attachment");
            $extension=$file->getClientOriginalExtension();
            $file_name = 'uploads/plaza/plaza'."_" . uniqid() . '.' . $extension;
            $file->move(public_path("uploads/plaza/"),$file_name);
            $insertData["attachment"] = $file_name;
        }
        if (request()->has("document") && !empty(request()->document)){
            $file = request()->file("document");
            $extension=$file->getClientOriginalExtension();
            $file_name = 'uploads/plaza/plaza'."_" . uniqid() . '.' . $extension;
            $file->move(public_path("uploads/plaza/"),$file_name);
            $insertData["document"] = $file_name;
        }
        if(request()->id == 0){
            $plaza_shop_id = DB::table("plaza_shops")->insertGetId($insertData);

            if(request()->is_court_case == "Yes"){
                $this->insertCourtCase($plaza_shop_id,0);
            }
            if(request()->shop_status == "rent_out"){
                $this->insertCustomerProperty($plaza_shop_id,0);
            }

            if(request()->property_type == "Commercial")
                return redirect()->to("commercial-properties")->with('success_message', 'Floor Created Successfully.');
            else
                return redirect()->to("residential-properties")->with('success_message', 'Floor Created Successfully.');
        }else{
            DB::table("plaza_shops")->where(["id"=>request()->id])->update($insertData);
            if(request()->is_court_case == "Yes"){
                $this->insertCourtCase(request()->id,1);
            }
            if(request()->shop_status == "rent_out"){
                $this->insertCustomerProperty(request()->id,1);
            }
            if(request()->property_type == "Commercial")
                return redirect()->to("commercial-properties")->with('success_message', 'Floor updated Successfully.');
            else
                return redirect()->to("residential-properties")->with('success_message', 'Floor updated Successfully.');

        }


    }

    public function insertCourtCase($plaza_shop_id,$is_insert)
    {
        $data = [
            "court_id"          => request()->court_name,
            "case_number"          => request()->case_number,
            "case_title"       => request()->case_title,
            "case_status"       => request()->case_status,
            "plaza_shop_id"     => $plaza_shop_id,
        ];
        if($is_insert == 0)
            DB::table("court_case")->insert($data);
        else
            CourtCase::updateOrCreate(
                ["plaza_shop_id"=>$plaza_shop_id],
                $data
            );


        return ["status" => true];
    }

    public function insertCustomerProperty($plaza_shop_id,$is_insert)
    {
        $data = [
            "lease_date"        => request()->lease_date,
            "duration"          => request()->duration,
            "customer_id"       => request()->customer_id,
            "alloted_by"        => "manual",
            "plaza_shop_id"     => $plaza_shop_id,
        ];
        if($is_insert == 0){
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            DB::table("customer_property")->insert($data);
            DB::table("plaza_shops")->whereId($plaza_shop_id)->update(["customer_id"=>request()->customer_id]);
        } else{
            $data['updated_at'] = Carbon::now();
            CustomerProperty::updateOrCreate(
                ["is_active" => 1,"plaza_shop_id"=>$plaza_shop_id],
                $data
            );
            DB::table("plaza_shops")->whereId($plaza_shop_id)->update(["customer_id"=>request()->customer_id]);
            DB::table("plaza_shops")->whereId($plaza_shop_id)->update(["customer_id"=>request()->customer_id]);
        }
        return ["status" => true];
    }

    public function editFloorShop($id)
    {

        $res = DB::table("plaza_shops")->where(["id"=>$id])->first();
        if($res){
            if($res->shop_status == "rent_out"){
                $data['customerProperty'] = DB::table("customer_property")
                    ->select(["users.id as user_id","users.name","users.cnic","users.email","customer_property.*"])
                    ->leftJoin("users","users.id","=","customer_property.customer_id")
                    ->where(["customer_property.plaza_shop_id" => $res->id,"customer_property.is_active" => 1])
                    ->first();
            }

            if($res->is_court_case == "Yes"){
                $data['court_case'] = DB::table("court_case")
                    ->where(["court_case.plaza_shop_id" => $res->id])
                    ->first();
            }
        }
        $data['data'] = $res;

        $data["title"] = "Edit Shop";
        /*$res = DB::table("plaza_floors")->whereId($data["data"]->floor_id)->first();
        $data['plaza_id'] = $res->plaza_id;
        $data['floor_id'] = $data["data"]->floor_id;*/
        $data['category'] = DB::table("property_types")->get();
        $data['court'] = DB::table("court")->get();
        $data['plaza'] = Plaza::where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])->get();
        return view("admin.plaza_shops.add-plaza-shops",$data);


    }
    public function deleteFloorShop()
    {
        DB::table("plaza_floors")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Plaza Deleted successfully"];
    }


    public function updateCustomerCron()
    {
        $res = DB::table("customer_property")->get(["customer_id","plaza_shop_id"]);
        foreach ($res as $key => $value){
            DB::table("plaza_shops")->whereId($value->plaza_shop_id)->update(["customer_id"=> $value->customer_id]);
        }
       dd("done");

    }





    



}
