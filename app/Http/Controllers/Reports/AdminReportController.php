<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\CourtCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class AdminReportController extends Controller
{
    public function tmaPropertyReport()
    {
        $data["title"] = "Customer Report";

        $data["org"] = DB::table("organization")->get();
        return view("Reports.admin_report.tma_property_report_view",$data);
    }

    public function printTmaPropertyReport()
    {

        $data["title"] = "TMA Property Details";
        $office_id = $_GET["office_id"] ?? Auth::user()->office_id;
        $org_id = $_GET['org_id'] ?? Auth::user()->org_id;

        $type = $_GET["type"] ?? "";

        //$shop_status = (isset($_GET["shop_status"]) && $_GET['shop_status'] == 'open_for_aution') ? $_GET["shop_status"] : "";
        $shop_status = $_GET["shop_status"] ?? "";

        $data['organization'] = DB::table("organization");
        if($org_id != 0){
            $data['organization']= $data['organization']->where(["id"=>$org_id])->get();
        }else{
            $data['organization']= $data['organization']->get();
        }

        foreach ($data['organization'] as $key => $value){
            $details = "";
            $details = DB::table("plaza_shops")
                ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
                ->leftJoin("organization","organization.id","=","plaza.org_id")
                ->when($org_id,function ($query,$org_id)use($office_id){
                        $query->where("plaza.office_id",$office_id);
                        $query->where("plaza.org_id",$org_id);
                })
                ->when($type,function ($query,$type){
                    $query->where("plaza.property_type",$type);
                })
                ->when($shop_status,function ($query,$shop_status){
                    $query->where("plaza_shops.shop_status",$shop_status);
                });
             if($org_id == 0){
                 $details = $details->where("plaza.org_id",$value->id);
                 $details = $details->where("plaza.office_id",$office_id);
             }
                //$query->where("plaza.office_id",$office_id);
            $details = $details->get();
            $value->data = $details;
        }

        $pdf = PDF::loadView('Reports.admin_report.tma_property_report', $data)->setPaper('a4', 'landscape');
        return $pdf->download("tma_report.pdf");
    }

    public function printTmaRentOutPropertyReport()
    {

        $data["title"] = "Rented Out Property Details";
        $office_id = $_GET["office_id"] ?? 1;
        $org_id = $_GET['org_id'] ?? Auth::user()->org_id;
        $type = $_GET["type"] ?? "";
        $shop_status = (isset($_GET["shop_status"]) && $_GET['shop_status'] == 'rent_out') ? "rent_out" : "";
        $data['organization'] = DB::table("organization");
        if($org_id != 0){
            $data['organization']= $data['organization']->where(["id"=>$org_id])->get();
        }else{
            $data['organization']= $data['organization']->get();
        }

        foreach ($data['organization'] as $key => $value){
            $details = DB::table("plaza_shops")
                ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
                ->leftJoin("organization","organization.id","=","plaza.org_id")
                ->leftJoin("auctions","auctions.id","=","plaza_shops.auction_id")
                ->leftJoin("customer_property","customer_property.plaza_shop_id","=","plaza_shops.id")
                ->leftJoin("users","users.id","=","customer_property.customer_id")
                ->when($org_id,function ($query,$org_id)use($office_id){
                        $query->where("plaza.office_id",$office_id);
                        $query->where("plaza.org_id",$org_id);


                })
                ->when($type,function ($query,$type){
                    $query->where("plaza.property_type",$type);
                })
                ->when($shop_status,function ($query,$shop_status){
                    $query->where("plaza_shops.shop_status",$shop_status);
                });
                if($org_id == 0){

                    $details = $details->where("plaza.org_id",$value->id);
                    $details = $details->where("plaza.office_id",$office_id);
                }
                $details = $details->get(['plaza_shops.*','plaza.*','organization.*','auctions.*',
                    'users.name as customer_name',
                    'users.address as customer_address',
                    'users.cnic',
                    'users.phoneNumber',
                ]);
                $value->data= $details;


        }
        $pdf = PDF::loadView('Reports.admin_report.tma_rent_out_property_report', $data)->setPaper('a4', 'landscape');
        return $pdf->download("tma_report.pdf");
    }

    public function printCase($id)
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

        $pdf = PDF::loadView('Reports.admin_report.case_report', $data)->setPaper('a4', 'landscape');
        return $pdf->download("case_report.pdf");
    }
}
