<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\CustomerProperty;
use App\Models\Plaza;
use App\Models\PlazaShop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class PlazaFloorController extends Controller
{


    public function plazaFloorView($plaza_id = 0)
    {

        $data["title"] = "Add Plaza Floor";
        $query = DB::table("plaza_floors")
            ->select("plaza_floors.*","plaza.name as plaza_name","plaza.property_type")
            ->leftJoin("plaza","plaza.id","=","plaza_floors.plaza_id");
        if($plaza_id !=0){
            $query = $query->where("plaza_id",$plaza_id);
        }

        $query = $query->paginate(20);
        foreach ($query as $key => $value){
            $value->menu = $this->getLevels($value->property_type,2);
        }
        $data['data'] = $query;
        $data['plaza_id'] = $plaza_id;
        return view("admin.plaza-floor.manage-plaza-floor",$data);
    }


    public function addPlazaFloor($plaza_id = 0)
    {
        $data["title"] = "Add Plaza";
        if($plaza_id == 0){
            $data["plaza"] = DB::table("plaza")->get();
        }else{
            $data['plaza'] = [];
        }

        $data['plaza_id'] = $plaza_id;
        return view("admin.plaza-floor.add-plaza-floor",$data);
    }

    public function savePlazaFloor()
    {
        $insertData = request()->except(["id","_token"]);
        $plaza_id = request()->plaza_id;

        if(request()->id == 0){
            DB::table("plaza_floors")->insert($insertData);
            return redirect()->to("settings/manage-plaza-floor/$plaza_id")->with('success_message', 'Floor Created Successfully.');
        }else{
            DB::table("plaza_floors")->where(["id"=>request()->id])->update($insertData);
            return redirect()->to("settings/manage-plaza-floor/$plaza_id")->with('success_message', 'Plaza updated Successfully.');
        }


    }

    public function editPlazaFloor($id)
    {

        $data["title"] = "Edit Plaza Floor";
        $data["plaza"] = DB::table("plaza")->get();

        $data["data"] = DB::table("plaza_floors")->where(["id"=>$id])->first();
        $data['plaza_id'] = $data["data"]->plaza_id;

        return view("admin.plaza-floor.add-plaza-floor",$data);
    }
    public function deletePlazaFloor()
    {
        DB::table("plaza_floors")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Plaza Deleted successfully"];
    }

    public function manageAttachements()
    {
        if($_GET['type'] == "Plaza"){
            $data['data'] = DB::table("attachments")->whereTableName("Plaza")
                ->where("resource_id",$_GET['id'])
                ->paginate(20);
        }else{
            $data['data'] = DB::table("attachments")->whereTableName("Shop")
                ->where("resource_id",$_GET['id'])
                ->paginate(20);

        }
        $data['title'] = "Manage Attachments";

        return view('common.attachments',$data);
    }

    public function saveAttachment()
    {
        $type = request()->type;
        $insertData = [
            "type"  =>request()->doc_type,
            "table_name"  =>request()->type,
            "title"  =>request()->title,
            "resource_id"  =>request()->id,

        ];
        if(request()->type == "Plaza"){

            if (request()->has("attachment") && !empty(request()->attachment)){
                $file = request()->file("attachment");
                $extension=$file->getClientOriginalExtension();
                $file_name = 'uploads/plaza/plaza'."_" . uniqid() . '.' . $extension;
                $file->move(public_path("uploads/plaza/"),$file_name);
                $insertData["attachment"] = $file_name;
                $insertData["extention"] = $extension;
                DB::table("attachments")->insert($insertData);
                return redirect()->back()->with('success_message', "$type Added Successfully.");

            }
        }else{
            if (request()->has("attachment") && !empty(request()->attachment)){
                $file = request()->file("attachment");
                $extension=$file->getClientOriginalExtension();
                $file_name = 'uploads/plaza/plaza'."_" . uniqid() . '.' . $extension;
                $file->move(public_path("uploads/plaza/"),$file_name);
                $insertData["attachment"] = $file_name;
                $insertData["extention"] = $extension;
                DB::table("attachments")->insert($insertData);

                return redirect()->back()->with('success_message', "$type Added Successfully.");

            }
        }

    }

    public function deleteAttachment()
    {
        DB::table("attachments")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Record Deleted successfully"];

    }

    public function shopDetails($id)
    {
        $plaza_shop = PlazaShop::with("plaza")->whereId($id)->first();
        $data['owner'] = CustomerProperty::wherePlazaShopId($plaza_shop->id)->with(["customer","shop"])->where(["is_active" => 1])->first();
        $data['data'] = $plaza_shop;
        $data['tenant'] = CustomerProperty::wherePlazaShopId($plaza_shop->id)->with(["customer","shop"])->orderBy("created_at","DESC")->get();
        //dd($data);
        return view("admin.plaza_shops.details",$data);
    }

    public function commercialProperties()
    {
        $plaza_id = $_GET["plaza_id"] ?? "";
        $shop_id = $_GET["shop_id"] ?? "";
        $search = $_GET["search"] ?? "";
        $data['shops'] = [];
        if($plaza_id != ""){
            $data['shops'] = PlazaShop::
            leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
                ->where(['plaza.org_id'=>Auth::user()->org_id])
                ->where(['plaza.office_id'=>Auth::user()->office_id])
                ->where(['plaza_shops.property_type'=>"Commercial"])
                ->where(['plaza_shops.plaza_id'=>$plaza_id])
                ->select("plaza_shops.*","plaza.name as plaza_name")

                ->get();
        }

        $data["title"] = "Commercial Properties";
        $data['plaza'] = Plaza::where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])->get();
        $data['data']  = PlazaShop::
            leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("users","users.id","=","plaza_shops.customer_id")
            ->where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.property_type'=>"Commercial"])
            ->when($plaza_id,function ($query,$plaza_id){
                return $query->where(["plaza_shops.plaza_id" => $plaza_id ]);
            })
            ->when($shop_id,function ($query,$shop_id){
                return $query->where(["plaza_shops.id" => $shop_id ]);
            })
            ->when($search,function ($query,$search){
                return $query->where(function ($query) use ($search) {
                    $query->where("users.name","like","%$search%");
                    $query->orWhere("users.cnic","like","%$search%");
                    $query->orWhere("plaza_shops.start_rent","=",$search);
                });
            })
            ->with('rentout')
            ->select("plaza_shops.*","plaza.name as plaza_name","plaza.org_id","plaza.address as location")
            ->orderBy("shop_status","DESC")
            ->paginate(20);
            foreach ($data['data'] as $key => $value){
                $value->lease_date = "";
                $value->expiry_date = "";
                $value->customer = null;
                if(count($value->rentout) > 0){
                    $customer = $value->rentout->where("is_active",1)->first();
                    $value->lease_date = date("d-m-Y",strtotime($customer->lease_date));
                    $value->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
                    $value->customer = User::where("id",$customer->customer_id)->select(["name","email","cnic","phoneNumber","address","image","fathername"])->first();
                }
            }

        return view("admin.plaza_shops.commercial_properties",$data);
    }

    public function printCommercial($id="")
    {


        $data['data']  = PlazaShop::
        leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.property_type'=>"Commercial"])
            ->with('rentout')
            ->select("plaza_shops.*","plaza.name as plaza_name","plaza.address as location")
            ->orderBy("shop_status","DESC");
           if($id){
               $res = $data['data']->where(["plaza_shops.id" => $id])->first();
               $res->lease_date = "";
               $res->expiry_date = "";
               $res->customer = null;
               if(count($res->rentout) > 0){
                   $customer = $res->rentout->where("is_active",1)->first();
                   $res->lease_date = date("d-m-Y",strtotime($customer->lease_date));
                   $res->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
                   $res->customer = User::where("id",$customer->customer_id)->select(["name","email","cnic","phoneNumber","address","image","fathername"])->first();

               }

               $data['data'] = $res;

               return view("Reports.print_single_commercial_properties",$data);
           }else{
               $data['data'] = $data['data']->get(20);
               foreach ($data['data'] as $key => $value){
                   $value->lease_date = "";
                   $value->expiry_date = "";
                   $value->customer = null;
                   if(count($value->rentout) > 0){
                       $customer = $value->rentout->where("is_active",1)->first();
                       $value->lease_date = date("d-m-Y",strtotime($customer->lease_date));
                       $value->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
                       $value->customer = User::where("id",$customer->customer_id)->select(["name","email","cnic","phoneNumber","address","image","fathername"])->first();
                   }
               }
               return view("Reports.print_commercial_properties",$data);
           }



    }


    public function residentialProperties()
    {
        $plaza_id = $_GET["plaza_id"] ?? "";
        $shop_id = $_GET["shop_id"] ?? "";
        $data['shops'] = [];
        if($plaza_id != ""){
            $data['shops'] = PlazaShop::
            leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
                ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
                ->where(['plaza.org_id'=>Auth::user()->org_id])
                ->where(['plaza.office_id'=>Auth::user()->office_id])
                ->where(['plaza_shops.property_type'=>"Residential"])
                ->where(['plaza_shops.plaza_id'=>$plaza_id])
                ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name")
                ->get();
        }

        $data["title"] = "Commercial Properties";
        $data['plaza'] = Plaza::where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])->get();
        $data['data']  = PlazaShop::
            leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
            ->where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.property_type'=>"Residential"])
            ->when($plaza_id,function ($query,$plaza_id){
                return $query->where(["plaza_shops.plaza_id" => $plaza_id ]);
            })
            ->when($shop_id,function ($query,$shop_id){
                return $query->where(["plaza_shops.id" => $shop_id ]);
            })
            ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name")
            ->paginate(20);
        foreach ($data['data'] as $key => $value){
            $value->lease_date = "";
            $value->expiry_date = "";
            $value->customer = null;
            if(count($value->rentout) > 0){
                $customer = $value->rentout->where("is_active",1)->first();
                $value->lease_date = date("d-m-Y",strtotime($customer->lease_date));
                $value->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
                $value->customer = User::where("id",$customer->customer_id)->select(["name","email","cnic","phoneNumber","address","image","fathername","designation","place_of_duty"])->first();
            }
        }
        return view("admin.plaza_shops.residential_properties",$data);
    }

    public function printResidential($id="")
    {


        $data["title"] = "Commercial Properties";
        $data['data']  = PlazaShop::
        leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
            ->where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.property_type'=>"Residential"])
            ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name","plaza.address");
        if($id){
            $res = $data['data']->where(["plaza_shops.id" => $id])->first();
            $res->lease_date = "";
            $res->expiry_date = "";
            $res->customer = null;
            if(count($res->rentout) > 0){
                $customer = $res->rentout->where("is_active",1)->first();
                $res->lease_date = date("d-m-Y",strtotime($customer->lease_date));
                $res->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
                $res->customer = User::where("id",$customer->customer_id)->select(["name","email","cnic","phoneNumber","address","image","fathername","designation","place_of_duty"])->first();
                $res->ledger =  (new RentCollectionController())->getPropertyDetails($res->id);

            }
            //dd($res);
            $data['data'] = $res;

            return view("Reports.print_single_residential_properties",$data);
        }else{
            $data['data'] = $data['data']->get(20);
            foreach ($data['data'] as $key => $value){
                $value->lease_date = "";
                $value->expiry_date = "";
                $value->customer = null;
                if(count($value->rentout) > 0){
                    $customer = $value->rentout->where("is_active",1)->first();
                    $value->lease_date = date("d-m-Y",strtotime($customer->lease_date));
                    $value->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
                    $value->customer = User::with('organization')->where("id",$customer->customer_id)->select(["name","email","cnic","phoneNumber","address","image","fathername","designation","place_of_duty"])->first();
                }
            }

            return view("Reports.print_residential_properties",$data);
        }
    }

    public function get_shops()
    {
        $data = PlazaShop::
        leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
            ->where(['plaza.org_id'=>Auth::user()->org_id])
            ->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.property_type'=>"commercial"])
            ->where(['plaza_shops.plaza_id'=>request()->plaza_id])
            ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name")
            ->get();
        return ["status" => true,"data" => $data];
    }



    



}
