<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\CustomerProperty;
use App\Models\PropertyRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function getDashboardData()
    {

        $data["title"] = "User Registrationsssss";
        $data["total_tma_properties"] = $this->getTotalTmaProperties();
        $data["total_plaza"] = $this->totalNumberOfPlaza();
        $data["total_plots"] = $this->totalNumberOfPlots();
        $data["total_shops"] = $this->totalNumberOfShops();
        $data["total_lease_out"] = $this->propertyStatus("rent_out");
        $data["proprty_to_be_auctioned"] = $this->propertyStatus("open_for_aution");
        $data["lease_out_plaza"] = $this->propertyStatusByType("rent_out","plaza");
        $data["lease_out_plots"] = $this->propertyStatusByType("rent_out","plots");
        $data["property_rent_per_month"] = $this->propertyRentPerMonth("rent_out");
        $data["estimated_premium"] = $this->estimatedPermium();
        $data["offeredPermium"] = $this->offeredPermium();
        $data["getTotalOpenAuctions"] = $this->getTotalPublishedAuctions();
        $data["upcommingAuctions"] = $this->upcommingAuctions();
        $data["getTotalOpenAuctions"] = $this->getTotalOpenAuctions();
        $data["completedAuctions"] = $this->completedAuctions();
        $data["active_tenants"] = $this->getActiveTenants(1);
        $data["deactive_tenants"] = $this->getActiveTenants(0);
        $data["recipts"] = $this->getTotalReceipts();
        $data["commercial"] = $this->getProperty("Commercial");
        $data["residential"] = $this->getProperty("Residential");
        $data["open_plots"] = $this->totalOpenPlots();
        $data["case_in_progress"] = $this->courtCases("in_progress");
        $data["case_in_favour"] = $this->courtCases("in_favour");
        $data["case_decided_against"] = $this->courtCases("decided_against");
        return $data;
    }
    public function getProperty($type)
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(['plaza_shops.property_type'=>$type])
            ->count();
        return $data;

    }
    public function totalOpenPlots()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(['plaza.property_type'=>"open_plots"])
            ->count();
        return $data;

    }

    public function courtCases($status)
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("court_case")
            ->when($org_id,function ($query,$org_id){
                $query->where(['org_id'=>Auth::user()->org_id]);
            })
            ->where(['case_status'=>$status])
            ->count();
        return $data;

    }


    public function getActiveTenants($id)
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = CustomerProperty::
        leftJoin("plaza_shops","plaza_shops.id","=","customer_property.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(["customer_property.is_active" => $id])
            ->count();

        return $data;

    }

    public function getTotalReceipts()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = PropertyRent::
        leftJoin("customer_property","customer_property.id","=","property_rents.customer_property_id")
            ->leftJoin("plaza_shops","plaza_shops.id","=","customer_property.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->whereNotNull("dr")
            ->count();

        return $data;

    }

    public function getTotalTmaProperties()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            //->where(['plaza.org_id'=>Auth::user()->org_id])
            //->where(['plaza.office_id'=>Auth::user()->office_id])
            ->count();
        return $data;

    }

    public function totalNumberOfPlaza()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza")
            //->where(['plaza.org_id'=>Auth::user()->org_id])
            //->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza.property_type'=>"plaza"])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->count();
        return $data;

    }

    public function totalNumberOfPlots()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])
            //->where(['plaza.office_id'=>Auth::user()->office_id])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(['plaza.property_type'=>"plots"])
            ->count();
        return $data;

    }
    public function totalNumberOfShops()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])
            //->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza.property_type'=>"plaza"])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->count();
        return $data;

    }


    public function propertyStatus($status)
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.shop_status'=>$status])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->count();
        return $data;

    }

    public function propertyStatusByType($status,$type)
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.shop_status'=>$status])
            ->where(['plaza.property_type'=>$type])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->count();
        return $data;

    }

    public function propertyRentPerMonth($status)
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
           // ->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.shop_status'=>$status])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->sum('current_rent');
        return $data;
    }

    public function estimatedPermium()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.shop_status'=>"rent_out"])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->sum('starting_bid_amount');
        return $data;
    }

    public function offeredPermium()
    {
        $org_id = auth()->user()->org_id ?? "";
        $data = DB::table("plaza_shops")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
           // ->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where(['plaza_shops.shop_status'=>"rent_out"])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->sum('offered_customer_premium');
        return $data;
    }

    public function getTotalPublishedAuctions()
    {
        $org_id = auth()->user()->org_id ?? "";
        return DB::table("auctions")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(["status"=>"published"])->count();
    }

    public function getTotalOpenAuctions()
    {
        $org_id = auth()->user()->org_id ?? "";
        return DB::table("auctions")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->whereDate("auctions.start_date_time","<=",date("Y-m-d H:i:s"))
            ->whereDate("auctions.end_date_time",">=",date("Y-m-d H:i:s"))
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(["status"=>"published"])->count();
    }

    public function upcommingAuctions()
    {
        $org_id = auth()->user()->org_id ?? "";
        return Auction::leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
           // ->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where("auctions.status", "published")
            ->where("auctions.start_date_time",">", date("Y-m-d H:i:s"))
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->count();
    }

    public function completedAuctions()
    {
        $org_id = auth()->user()->org_id ?? "";
        return DB::table("auctions")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            //->where(['plaza.org_id'=>Auth::user()->org_id])->where(['plaza.office_id'=>Auth::user()->office_id])
            ->where("auctions.end_date_time","<", date("Y-m-d H:i:s"))
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->where(["status"=>"expired"])->count();
    }
}
