<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class CustomerReportController extends Controller
{

    public function customerPropertyReport()
    {
        $data["title"] = "Customer Report";
        $data["data"] = "";
        return view("Reports.customer_report.customer_property_report_view");
    }

    public function printCustomerPropertyReport()
    {
        $data["title"] = "Customer Property Details";
        $data['data'] = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("organization","organization.id","=","plaza.org_id")
            ->leftJoin("auctions","auctions.id","=","plaza_shops.auction_id")
            ->where(["plaza_shops.customer_id"=>Auth::user()->id])
            ->get();



        $pdf = PDF::loadView('Reports.customer_report.customer_property_report', $data)->setPaper('a4', 'landscape');

        return $pdf->download("customer_report.pdf");
    }
}
