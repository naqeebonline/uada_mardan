<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\CourtCase;
use App\Models\CourtCaseDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PropertyCaseController extends Controller
{

    public function view()
    {

        $query = CourtCase::leftJoin("plaza_shops","plaza_shops.id","=","court_case.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("court","court_case.court_id","=","court.id")
            ->where(["court_case.org_id" => auth()->user()->org_id])
            ->select(["court_case.*","plaza_shops.shop_name","plaza.name as plaza_name","plaza.id as plaza_id","court.name as court_name"])
             ;
        return DataTables::of($query)
            ->addColumn('action', function ($value) {
                return '<a href="#edit-'.$value->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);

    }

    public function index()
    {

        //..... popup dropdown values   .....//
        $not_admin = Auth::user()->user_type == "super_admin" ? "" : "apply";
        $data['court'] = DB::table("court")->get();
        $data['shops'] = DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza.name as plaza_name")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->when($not_admin, function ($query, $not_admin) {
                return $query->where('plaza.org_id', Auth::user()->org_id);
            })
            ->get();
        //......... end of popup values   .....//


        $data["title"] = "Court Cases";
        $not_admin = Auth::user()->user_type == "super_admin" ? "" : "apply";
        $data['data'] = CourtCase::leftJoin("plaza_shops","plaza_shops.id","=","court_case.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("court","court_case.court_id","=","court.id")
            ->when($not_admin, function ($query, $not_admin) {
                return $query->where('court_case.org_id', Auth::user()->org_id);
            })
            ->where(["court_case.org_id" => auth()->user()->org_id])
            ->select(["court_case.*","plaza_shops.shop_name","plaza.name as plaza_name","plaza.id as plaza_id","court.name as court_name"])
            ->paginate(20);





        return view("admin.court.index",$data);
    }

    public function create()
    {
        $not_admin = Auth::user()->user_type == "super_admin" ? "" : "apply";
        $data['title'] = "Create Case";
        $data['court'] = DB::table("court")->get();
        $data['shops'] = DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name")
            ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
            ->leftJoin("plaza","plaza.id","=","plaza_floors.plaza_id")
            ->when($not_admin, function ($query, $not_admin) {
                return $query->where('plaza.org_id', Auth::user()->org_id);
            })
            ->get();

        return view("admin.court.create",$data);
    }

    public function edit($id)
    {
        $not_admin = Auth::user()->user_type == "super_admin" ? "" : "apply";
        $data['data'] = CourtCase::leftJoin("plaza_shops","plaza_shops.id","=","court_case.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("court","court_case.court_id","=","court.id")
            ->when($not_admin, function ($query, $not_admin) {
                return $query->where('plaza.org_id', Auth::user()->org_id);
            })
            ->where(["court_case.id" => $id])
            ->where(["court_case.org_id" => auth()->user()->org_id])
            ->select(["court_case.*","plaza_shops.shop_name","plaza.name as plaza_name","plaza.id as plaza_id","court.name as court_name"])
            ->first();
        $data['title'] = "Create Case";
        $data['court'] = DB::table("court")->get();
        $data['shops'] = DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza.name as plaza_name")

            ->leftJoin("plaza","plaza.id","=","plaza_floors.plaza_id")
            ->when($not_admin, function ($query, $not_admin) {
                return $query->where('plaza.org_id', Auth::user()->org_id);
            })
            ->paginate(20);

        return view("admin.court.create",$data);
    }

    public function store(FilesController $filesController)
    {
        /*$data = [
            "court_id"          => request()->court_name,
            "case_number"          => request()->case_number,
            "case_title"       => request()->case_title,
            "case_status"       => request()->case_status,
            "org_id"            => auth()->user()->org_id,
            "plaza_shop_id"     =>  request()->plaza_shop_id,
            "lawyer_name"     =>  request()->lawyer_name,
            "hearing_date"     =>  request()->hearing_date,
            "next_hearing_date"     =>  request()->next_hearing_date,
            "final_decision"     =>  request()->next_hearing_date,
        ];*/
        $data = request()->except(["_token","final_decision"]);
        if (request()->has("final_decision") && !empty(request()->final_decision))
            $data['final_decision'] = $filesController->uploadFile("final_decision","uploads/organization_logo/");

        $data["org_id"] = auth()->user()->org_id;
        if(request()->id == 0)
            DB::table("court_case")->insert($data);
        else
            CourtCase::updateOrCreate(
                ["id"=>request()->id],
                $data
            );
        return ["status" => true,"message" => "Record Saved successfully"];
        return redirect()->to('settings/list-cases')->with('success_message', 'Case Saved Successfully.');
    }

    public function delete()
    {
        DB::table("court_case")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Plaza Deleted successfully"];
    }



    public function details($id)
    {
        $data["title"] = "Case Details";
        $data["id"] = $id;
        //$data['case'] = DB::table("court_case")->whereId(request()->id)->first();
        $data['case'] = CourtCase::leftJoin("plaza_shops","plaza_shops.id","=","court_case.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("court","court_case.court_id","=","court.id")
            //->where(["court_case.org_id" => auth()->user()->org_id])
            ->where(["court_case.id" => $id])
            ->select(["court_case.*","plaza_shops.shop_name","plaza.name as plaza_name","plaza.id as plaza_id","court.name as court_name"])
            ->first();
        $data['data'] = DB::table("court_case_details")->where(["court_case_id" => $id])->orderBy("heiring_date","DESC")->get();

        return view("admin.court.case_details",$data);
    }

    public function saveCaseDetails(FilesController $filesController)
    {

        $data = request()->except(["id","file"]);
        if (request()->has("file") && !empty(request()->file))
            $data['attachments'] = $filesController->uploadFile("file","uploads/organization_logo/");
        CourtCaseDetails::updateOrCreate(
            ["id" => request()->id],
            $data
        );
        return ["status" => true,"message" => "Record Saved successfully"];

    }

    public function deleteCaseDetails()
    {
        DB::table("court_case_details")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Details Deleted successfully"];
    }

    public function printCases()
    {
        $data['data'] = CourtCase::leftJoin("plaza_shops","plaza_shops.id","=","court_case.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("court","court_case.court_id","=","court.id")
            ->where(["court_case.org_id" => auth()->user()->org_id])
            ->select(["court_case.*","plaza_shops.shop_name","plaza.name as plaza_name","plaza.id as plaza_id","court.name as court_name"])
            ->get();



        return view("Reports.print_court_cases",$data);
    }
}
