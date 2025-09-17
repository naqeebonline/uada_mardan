<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Route;

class PlazaController extends Controller
{


    public function plazaView()
    {
        $not_admin = Auth::user()->user_type == "super_admin" ? "apply" : "apply";
        $route = Route::current();


        $data["title"] = "Manage Plaza";
        $data['data'] = DB::table("plaza")
            ->where('org_id', Auth::user()->org_id)
            ->paginate(20);

        foreach ($data['data'] as $key => $value){
            $value->shops_for_auction = $this->getOpenForAcutionShops($value->id);
            $value->menu = $this->getLevels($value->property_type,1);
        }
        return view("admin.plaza.manage-plaza",$data);
    }

    public function getOpenForAcutionShops($plaza_id)
    {
        return DB::table("plaza_shops")->where(["shop_status" => "open_for_aution","plaza_id"=>$plaza_id])->count();
    }


    public function addPlaza()
    {
        $data["title"] = "Add Plaza";
        return view("admin.plaza.add-plaza",$data);
    }

    public function savePlaza()
    {
        $insertData = request()->except(["id","_token","attachment"]);
        if (request()->has("attachment") && !empty(request()->attachment)){
            $file = request()->file("attachment");
            $extension=$file->getClientOriginalExtension();
            $file_name = 'uploads/plaza/plaza'."_" . uniqid() . '.' . $extension;
            $file->move(public_path("uploads/plaza/"),$file_name);
            $insertData["attachment"] = $file_name;

        }
        if(request()->id == 0){
            $insertData['office_id'] = Auth::user()->office_id;
            $insertData['org_id'] = Auth::user()->org_id;
            DB::table("plaza")->insert($insertData);
            return redirect()->to('settings/manage-plaza')->with('success_message', 'Plaza Created Successfully.');
        }else{
            $insertData['office_id'] = Auth::user()->office_id;
            $insertData['org_id'] = Auth::user()->org_id;
            DB::table("plaza")->where(["id"=>request()->id])->update($insertData);
            return redirect()->to('settings/manage-plaza')->with('success_message', 'Plaza updated Successfully.');
        }
    }

    public function editPlaza($id)
    {
        $data["title"] = "Edit Plaz";
        $data["data"] = DB::table("plaza")->where(["id"=>$id])->first();
         
        return view("admin.plaza.add-plaza",$data);
    }
    public function deletePlaza()
    {
        DB::table("plaza")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Plaza Deleted successfully"];
    }



    



}
