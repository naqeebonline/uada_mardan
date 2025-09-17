<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function listOpenAuction()
    {

        $data["title"] = "Add Auction";
        $data['data'] = Auction::select("auctions.*","news_paper.newspaper_name","plaza.name as plaza_name")
            ->leftJoin("news_paper","news_paper.newspaper_id","=","auctions.newspaper_id")
            ->leftJoin("plaza","plaza.id","=","auctions.plaza_id")
            ->where("auctions.status","published")
            ->where("auctions.end_date_time",">=",Carbon::now())
            ->paginate(20);
        foreach ($data['data'] as $key => $value){
            $value->openForAuctions = $this->getOpenForAcutionShops($value->plaza_id);
        }


        return view("admin.customer.open_auction",$data);
    }

    public function getOpenForAcutionShops($plaza_id)
    {
        $data =  DB::table("plaza_shops")->where(["shop_status" => "open_for_aution","plaza_id"=>$plaza_id])->count();
        return $data;
    }

    public function propertyDetails($auction_id,$plaza_id)
    {
        
        $data['title'] = "Property Details";
        $data['data'] = DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza_floors.floor_name","plaza.name as plaza_name")
            ->leftJoin("plaza_floors","plaza_floors.id","=","plaza_shops.floor_id")
            ->leftJoin("plaza","plaza.id","=","plaza_floors.plaza_id")
            ->where("plaza_shops.plaza_id",$plaza_id)
            ->where("plaza_shops.shop_status","auctioned")
            ->paginate(20);
        foreach ($data['data'] as $key => $value){
            $value->shop_status = ($value->shop_status == "auctioned") ? "Under Actioned" : $value->shop_status;
        }
        $data['auction_id'] = $auction_id;
        $data['plaza_id'] = $plaza_id;
        return view("admin.customer.property_details",$data);
    }

    public function addCustomerCdr($auction_id,$plaza_shop_id)
    {
        $data['title'] = "Add Customer CDR";
        $data['auction_id'] = $auction_id;
        $data['plaza_shop_id'] = $plaza_shop_id;
        $data["banks"] = DB::table("banks")->get();
        $data['customer_id'] = Auth::user()->id;
        $data['details'] = DB::table("plaza_shops")
            ->select("plaza_shops.shop_name","plaza_shops.cdr_amount","plaza.name as plaza_name","plaza.property_type")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(["plaza_shops.id"=>$plaza_shop_id])->first();

        $data['submited_amount'] = DB::table("customer_cdr")
            ->where(["customer_id"=>Auth::user()->id,"auction_id"=>$auction_id,"plaza_shop_id"=>$plaza_shop_id])
            ->sum('amount');

        $data['is_delete'] = DB::table("aution_bids")
            ->where(["customer_id"=>Auth::user()->id,"auction_id"=>$auction_id,"shop_id"=>$plaza_shop_id])
            ->count();


        $data['cdr'] = DB::table("customer_cdr")
            ->select("customer_cdr.*","banks.bank_name","users.name","auctions.auction_name")
            ->leftJoin("banks","banks.bank_id","=","customer_cdr.bank_id")
            ->leftJoin("users","users.id","=","customer_cdr.customer_id")
            ->leftJoin("auctions","auctions.id","=","customer_cdr.auction_id")
            ->where(["customer_id"=>Auth::user()->id,"auction_id"=>$auction_id,"plaza_shop_id"=>$plaza_shop_id])
            ->paginate();
        return view("admin.customer.add-customer-cdr",$data);

    }

    public function saveCustomerCdr()
    {
        $insertData = request()->except(["id","_token","attachment"]);
        if (request()->has("attachment") && !empty(request()->attachment)){
            $file = request()->file("attachment");
            $extension=$file->getClientOriginalExtension();
            $file_name = 'uploads/customer_cdr/customer_cdr'."_" . uniqid() . '.' . $extension;
            $file->move(public_path("uploads/customer_cdr/"),$file_name);
            $insertData["attachment"] = $file_name;
        }

        if(request()->id == 0){
            DB::table("customer_cdr")->insert($insertData);
            return redirect()->back()->with("success_message","Customer CDR Added successfully");
        }else{
            DB::table("customer_cdr")->where(["id"=>request()->id])->update($insertData);
            return redirect()->back()->with("success_message","Customer CDR updated successfully");
        }
    }

    public function editSuperAdmin($id)
    {
        $data['title'] = "Edit Customer CDR";
        $cdr = DB::table("customer_cdr")->whereId(request()->id)->first();
        $data['data'] = $cdr;
        $data['auction_id'] = $cdr->auction_id;
        $data['plaza_shop_id'] = $cdr->plaza_shop_id;
        $data["banks"] = DB::table("banks")->get();
        $data['customer_id'] = Auth::user()->id;
        $data['details'] = DB::table("plaza_shops")
            ->select("plaza_shops.shop_name","plaza_shops.cdr_amount","plaza.name as plaza_name","plaza.property_type")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(["plaza_shops.id"=>$cdr->plaza_shop_id])->first();
        $data['cdr'] = DB::table("customer_cdr")
            ->select("customer_cdr.*","banks.bank_name","users.name","auctions.auction_name")
            ->leftJoin("banks","banks.bank_id","=","customer_cdr.bank_id")
            ->leftJoin("users","users.id","=","customer_cdr.customer_id")
            ->leftJoin("auctions","auctions.id","=","customer_cdr.auction_id")
            ->where(["customer_id"=>Auth::user()->id,"auction_id"=>$cdr->auction_id,"plaza_shop_id"=>$cdr->plaza_shop_id])
            ->paginate();
        return view("admin.customer.add-customer-cdr",$data);
    }

    public function deleteCustomerCDR()
    {
        DB::table("customer_cdr")->whereId(request()->id)->delete();
        return ["status" => true,"message"=>"Organization Deleted successfully"];
    }


}
