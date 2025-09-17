<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\CustomerProperty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    public $filter = null;
    public function __construct()
    {

        $this->filter = new AutoBideController();
    }

    public function index()
    {


        $data["title"] = "Welcome e-property";
        $data["office"] = DB::table("office")->get();
        $data["organization"] = [];
        $type = $_GET['type'] ?? "";
        $office_id = $_GET['office_id'] ?? "";
        $org_id = $_GET['organization'] ?? "";
        if ($office_id != "") {
            $data['organization'] = DB::table("organization")->where("office_id", $office_id)->get();
        }
        DB::enableQueryLog();

        $data['auctions'] = Auction::select("auctions.id as auction_id", "auctions.*", "news_paper.newspaper_name", "plaza.attachment as plaza_img", "plaza.*", "organization.org_name")
            ->leftJoin("news_paper", "news_paper.newspaper_id", "=", "auctions.newspaper_id")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            ->leftJoin("organization", "organization.id", "auctions.org_id")
            ->where("status", "published")
            ->where("auctions.start_date_time", "<=", Carbon::now())
            ->where("auctions.end_date_time", ">=", Carbon::now())
            ->when($type, function ($query, $type) {
                return $query->where('plaza.property_type', strtolower($type));
            })
            ->when($office_id, function ($query, $office_id) {
                return $query->where('auctions.office_id', $office_id);
            })
            ->when($org_id, function ($query, $org_id) {
                return $query->where('auctions.org_id', $org_id);
            })
            ->get();

        //dd( DB::getQueryLog());



        foreach ($data['auctions'] as $key => $value) {
            $count = json_decode($value->auction_shops);
            $value->timeAgo = $this->timeAgo($value->created_at);
            $value->getOpenShops = count($count); //$this->getOpenForAcutionShops($value->id,$value->plaza_id);
            $value->totalImages = (1) + $this->plazaImagesCount($value->plaza_id);
        }




        return view("home", $data);
    }

    public function getOrganizationOffice($office_id)
    {

        $data = DB::table("organization")->where(["office_id" => $office_id])->get();
        return ["status" => true, "data" => $data];
    }


    public function propertyDetails($auction_id, $plaza_id)
    {

        $type = isset($_GET['type']) ? "rent_out" : "";
        //$type = isset($_GET['type']) ? $_GET['type'] : "";
        
        $auction = DB::table("auctions")->where(["id" => $auction_id])->first();
       
        $data['plaza_details'] = DB::table("plaza")->where(["id" => $plaza_id])->first();

         

        $auction_shops = json_decode($auction->auction_shops);
        DB::enableQueryLog();
        $data['title'] = "Property Details";
        $res = DB::table("plaza_shops")
            ->select("plaza_shops.*", "plaza_floors.floor_name", "plaza.name as plaza_name", 'plaza.property_type', 'organization.org_name')
            ->leftJoin("plaza_floors", "plaza_floors.id", "=", "plaza_shops.floor_id")
            ->leftJoin("plaza", "plaza.id", "=", "plaza_shops.plaza_id")
            ->leftJoin("organization", "organization.id", '=', "plaza.org_id")
            //->leftJoin("auctions","auctions.plaza_id","=","plaza_shops.plaza_id")
            ->where("plaza_shops.plaza_id", $plaza_id)
            ->whereIn("plaza_shops.id", $auction_shops);
        // $auction = DB::table("auctions")->where("plaza_id",$plaza_id)->latest()->first();
        $data['auction_id'] = $auction_id;

        if ($type == "rent_out" && $auction->status == 'expired') {
            $res = $res->where("plaza_shops.shop_status", "rent_out");
            //$res =$res->where("plaza_shops.shop_status","auctioned");

        } else {
            $res = $res->where("plaza_shops.shop_status", "!=", "rent_out");
        }
        $res = $res->get();





        foreach ($res as $key => $value) {
            $value->premium = $this->getAuctionBids($auction_id, $value->id);
            $value->totalBidders = $this->totalBidders($auction_id, $value->id);
            $value->totalBidds = $this->totalBidds($auction_id, $value->id);
        }

        $data['auctionStartTime'] = date("Y/m/d H:i:s"); //!empty($res) ? date("Y/m/d H:i:s",strtotime($res[0]->auctionStartTime)) : "";
        $data['auctionEndTime'] = !empty($auction) ? date("Y/m/d H:i:s", strtotime($auction->end_date_time ?? date('Y-m-d h:i:s'))) : "";
        if ($type == "rent_out") {
            $data['auctionEndTime'] = date("Y-m-d H:i:s");
        }
        if (date("Y-m-d H:i:s") > $auction->start_date_time  && date("Y-m-d H:i:s") < $auction->end_date_time) {
            $data['show_clock'] = true;
        } else {
            $data['show_clock'] = false;
        }
        $data['data'] = $res;

        return view("frontend.pages.property_details", $data);
    }

    public function singlePropertyDetails($auction_id, $plaza_id, $shop_id)
    {

        $type = isset($_GET['type']) ? "rent_out" : "";
        $auction = DB::table("auctions")->where(["id" => $auction_id])->first();
        $auction_shops = json_decode($auction->auction_shops);


        $data['auction_id'] = $auction_id;
        $data['plaza_id'] = $plaza_id;
        $data['shop_id'] = $shop_id;
        $data['auction_status'] = $auction->status;
        $data['title'] = "Property Details";
        $res = DB::table("plaza_shops")
            ->select("plaza_shops.*", "plaza_floors.floor_name", "plaza.name as plaza_name", 'plaza.property_type')
            ->leftJoin("plaza_floors", "plaza_floors.id", "=", "plaza_shops.floor_id")
            ->leftJoin("plaza", "plaza.id", "=", "plaza_floors.plaza_id")
            ->whereIn("plaza_shops.id", $auction_shops);

        if ($type == "rent_out" && $auction->status == 'expired') {
            $res = $res->where("plaza_shops.shop_status", "rent_out");
        } else {
            $res = $res->where("plaza_shops.shop_status", "open_for_aution");
            $res = $res->orWhere("plaza_shops.shop_status", "auctioned");
        }
        $res = $res->where("plaza_shops.plaza_id", $plaza_id)
            ->where("plaza_shops.id", $shop_id)
            ->first();

        $res->premium = $this->getAuctionBids($auction_id, $res->id);
        $res->totalBidders = $this->totalBidders($auction_id, $res->id);
        $res->totalBidds = $this->totalBidds($auction_id, $res->id);
        $res->getShopsImages = $this->getShopsImages($res->id);

        //$data['bidders'] = $this->getBidders($auction_id,$res->id);
        $data['bidders'] = $this->getBidders($auction_id, $shop_id);

        $data['auction_details'] = DB::table("auctions")
            ->select("auctions.*", "news_paper.*")
            ->leftJoin("news_paper", "news_paper.newspaper_id", "auctions.newspaper_id")
            ->where(["id" => $auction_id])->first();
        $data['shop_documents'] = DB::table("attachments")->where(["type" => "document", "resource_id" => $shop_id])->whereTableName("Shop")->get();

        $data['auctionStartTime'] = date("Y/m/d H:i:s"); //!empty($res) ? date("Y/m/d H:i:s",strtotime($res[0]->auctionStartTime)) : "";
        $data['auctionEndTime'] = !empty($auction) ? date("Y-m-d H:i:s", strtotime($auction->end_date_time)) : "";

        if ($type == "rent_out") {
            $data['auctionEndTime'] = date("Y-m-d H:i:s");
        }


        if (date("Y-m-d H:i:s") > $auction->start_date_time  && date("Y-m-d H:i:s") < $auction->end_date_time) {

            $data['show_clock'] = true;
        } else {

            $data['show_clock'] = false;
        }
        $data['value'] = $res;
        $data['expiration_alert'] = "dont_show_alert";
        //dd($auction->status);
        if (date("Y-m-d H:i:s") > $auction->end_date_time && $auction->status == 'published') {
            $data['expiration_alert'] = "show_alert";
        }
        // dd($data['show_clock']);

        return view("frontend.pages.single_property_details", $data);
    }


    public function placeBid()
    {
         
        try {
            if (Auth::user() && Auth::user()->user_type == "customer") {
              
                $current_time = date("Y-m-d H:i:s"); // "2020-07-05 12:00:59";
                $auction = DB::table("auctions")->whereId(request()->auction_id)->first();
                $auction_end_time = $auction->end_date_time;
                $cdr = $this->getCustomerCdrAmount();
                $shop = DB::table("plaza_shops")->where(["id" => request()->shop_id])->first();

                $required_cdr_amount = $shop->cdr_amount;
                if ($cdr < $required_cdr_amount)
                    return ["status" => "submit_full_cdr", "message" => "Please submit your cdr for this auction"];
                //........ premium will be check here    ......//
                $premium = $shop->starting_bid_amount;
                $maxBid = $this->getHighstBid();
                $premium = ($maxBid > $premium) ? $maxBid : $premium;

                //============ find 30% amount of startBid  -------//
                $userbidAmount = request()->bid_amount;

                if ($userbidAmount > (($premium * 30 / 100) + $premium)) {
                    // return ["status" => "min_bid","message"=>"Abnormal bid. Please enter correct amount"];
                    return ["status" => "min_bid", "message" => "Abnormal bid. Please enter correct amount. غلط بولی لگائی گئی ہے۔ براہ کرم صحیح رقم درج کریں۔"];
                }

                if (request()->bid_amount <= $premium) {
                    return ["status" => "min_bid", "message" => "Please enter highest bid from current bid"];
                }
                //....... end of premium check   ..........///

                //........ check if auction is not expired    ..........//
                if ($current_time <= $auction_end_time) {
                     
                    $insertData = request()->all();
                    $insertData['customer_id'] = Auth::user()->id;
                    $insertData['status'] = "active";
                    
                    $insertData['created_at'] = date("Y-m-d H:i:s");
                    $insertData['updated_at'] = date("Y-m-d H:i:s");
                    
                    DB::table("aution_bids")->insert($insertData);
                    
                    (new AuctionController())->sendSmsToAllBidders(request()->auction_id, request()->shop_id, request()->bid_amount);
                    return ["status" => "true", "message" => "Your Bid is placed successfully.", "data" => $this->getHighstBid()];
                } else {
                    
                    $this->makeAuctionExpired(request()->auction_id);
                    return ["status" => "expire", "message" => "Auction is expired. You can't place bid any more."];
                }
                //.......  end of auction expiration  ................//

            } else {
                return ["status" => "Unauthenticated.", "message" => "Please login as customer."];
            }
        } catch (\Exception $e) {
            return ["status" => "Unauthenticated.", "message" => "Please login as customer."];
        }
    }

    public function makeAuctionExpired($auction_id)
    {
        $auction = DB::table("auctions")->where(["id" => $auction_id, "status" => "published"])->first();
        if (!$auction) {
            return ["status" => false, "message" => "No Auction Found"];
        }

        if (date("Y-m-d H:i:s") <= $auction->end_date_time) {
            return ["status" => false, "message" => "No Auction Found"];
        }



        $auction_shops = json_decode($auction->auction_shops);

        if ($auction) {
            //...... filter shops and auctions   ......//
            $auto_bid = DB::table("auto_bid")->whereAuctionId($auction_id)->get();
            foreach ($auto_bid as $key => $value)
                $this->filter->placeLastBid($value->auction_id, $value->shop_id, $value->customer_id, $value->value, $value->end_date_time);

            //...... end of filter shops and auctions ......//
            //................ yahan aution expire ho jayain gay .....//
            DB::table("auctions")->where(["id" => $auction_id])->update(["status" => "expired"]);
            DB::table("aution_bids")->where(["id" => $auction_id])->update(["status" => "expired"]);

            $plaza_shops = DB::table("plaza_shops")
                ->where(["plaza_id"  => $auction->plaza_id, "shop_status"  => "auctioned"])
                ->whereIn("id", $auction_shops)
                ->get();

            $plaza_shops_id = $plaza_shops->pluck("id");
            DB::table("plaza_shops")->whereIn("id", $plaza_shops_id)->update(["shop_status" => "rent_out"]);

            //$plaza = DB::table("plaza")->where(["id"=>$auction->plaza_id]);

            $message = "$auction->auction_name Auction Expired \n ";
            $user_id = 0;

            foreach ($plaza_shops as $key => $value) {
                $user_id = $this->getWinner($auction_id, $value->id);
                if ($user_id) {
                    $this->insertCustomerProperty($value->id, $auction->duration, $user_id);
                    DB::table("plaza_shops")->whereIn("id", $plaza_shops_id)->update(["customer_id" => $user_id, "auction_id" => $auction_id]);
                    $winner = User::where("users.id", $user_id)->first();

                    $highest_bid = $this->getMaxBid($auction_id, $value->id);
                    $message = $message . "$value->shop_name MaxBid:$highest_bid Winner: $winner->name ($winner->cnic) \n";
                } else {
                    continue;
                }
            }

            $bidders =  DB::table("customer_cdr")
                ->select("customer_id")
                ->where(["auction_id" => $auction_id])
                ->groupBy('customer_id')->pluck("customer_id");
            $users = User::whereIn("id", $bidders)->get();

            $mobiles = "";
            foreach ($users as $key => $value) {
                if ($value->phoneNumber != "")
                    $mobiles = $mobiles . $value->phoneNumber . ",";
            }
            $mobiles = rtrim($mobiles, ",");
            (new AuctionController())->sendSms($mobiles, $message);

            return ['status' => true, "message" => "expired"];
        } else {
            return ['status' => false, "message" => "No Record Found"];
        }
    }

    public function insertCustomerProperty($plaza_shop_id, $duration, $customer_id)
    {
        $data = [
            "lease_date"        => Carbon::now(),
            "duration"          => $duration,
            "customer_id"       => $customer_id,
            "alloted_by"        => "eproperty",
            "plaza_shop_id"     => $plaza_shop_id,
            "created_at"        => Carbon::now(),
            "updated_at"        => Carbon::now(),
        ];
        DB::table("customer_property")->insert($data);
        DB::table("plaza_shops")->whereId($plaza_shop_id)->update(["customer_id" => $customer_id]);
        return ["status" => true];
    }

    public function getOpenForAcutionShops($plaza_id)
    {
        return DB::table("plaza_shops")->where(["shop_status" => "auctioned", "plaza_id" => $plaza_id])->count();
    }

    public function plazaImagesCount($id)
    {
        return DB::table('attachments')->where([
            "resource_id"      => $id,
            "type"      => "image",
            "table_name"      => "Plaza",
        ])->count();
    }

    public function shopsImagesCount($id)
    {
        return DB::table('attachments')->where([
            "resource_id"      => $id,
            "type"      => "image",
            "table_name"      => "Plaza",
        ])->count();
    }

    public function getShopsImages($id)
    {
        return DB::table('attachments')->where([
            "resource_id"      => $id,
            "type"      => "image",
            "table_name"      => "Shop",
        ])->get();
    }

    public function getCustomerCdrAmount()
    {
        return DB::table("customer_cdr")
            ->where(["auction_id" => request()->auction_id, "plaza_shop_id" => request()->shop_id, "customer_id" => Auth::user()->id])
            ->sum('amount');
    }

    public function getHighstBid()
    {

        $data =  DB::table("aution_bids")
            ->where(["auction_id" => request()->auction_id, "shop_id" => request()->shop_id])
            ->max('bid_amount');
        return !empty($data) ? $data : 0;
    }



    public function getMaxBid($auction_id, $shop_id)
    {
        $data =  DB::table("aution_bids")
            ->where(["auction_id" => $auction_id, "shop_id" => $shop_id])
            ->max('bid_amount');
        return !empty($data) ? $data : 0;
    }

    public function getWinner($auction_id, $shop_id)
    {
        $data =  DB::table("aution_bids")
            ->select('customer_id')
            ->where(["auction_id" => $auction_id, "shop_id" => $shop_id])
            ->orderBy("bid_amount", "DESC")
            ->first();
        return !empty($data) ? $data->customer_id : [];
    }

    protected function getAuctionBids($auction_id, $shop_id)
    {
        $shop = DB::table("plaza_shops")->where(["id" => $shop_id])->first();
        $premium = $shop->starting_bid_amount;
        $maxBid = DB::table("aution_bids")
            ->where(["auction_id" => $auction_id, "shop_id" => $shop_id])
            ->max('bid_amount');
        $maxBid =  !empty($maxBid) ? $maxBid : 0;
        $premium = ($maxBid > $premium) ? $maxBid : $premium;
        return $premium;
    }

    protected function totalBidders($auction_id, $shop_id)
    {
        $data =  DB::table("aution_bids")
            ->select("customer_id")
            ->where(["auction_id" => $auction_id, "shop_id" => $shop_id])
            ->groupBy('customer_id')->get();
        return $data->count();
    }

    protected function totalBidds($auction_id, $shop_id)
    {
        $data =  DB::table("aution_bids")
            ->select("customer_id")
            ->where(["auction_id" => $auction_id, "shop_id" => $shop_id])
            ->get();
        return $data->count();
    }

    public function getBidders($auction_id, $shop_id)
    {


        $data =  DB::table("aution_bids")
            ->select("users.name as bidder_name", "aution_bids.*", "auctions.status as auctionStatus")
            ->leftJoin("users", "users.id", "=", "aution_bids.customer_id")
            ->leftJoin("auctions", "auctions.id", "=", "aution_bids.auction_id")
            ->where(["auction_id" => $auction_id, "shop_id" => $shop_id])
            ->orderBy("bid_amount", "DESC")
            ->paginate(500);


        foreach ($data as $key => $value) {
            $value->bidder_name = ($value->auctionStatus != "expired") ? "xxxxxx" : $value->bidder_name;
        }

        return $data;
    }



    function timeAgo(string|\DateTimeInterface $datetime): string
    {
        return Carbon::parse($datetime)->diffForHumans();
    }

    public function printPdfReport($auction_id, $shop_id)
    {
        $auction = DB::table("auctions")->where("id", $auction_id)->first();
        if ($auction->end_date_time > date("Y-m-d H:i:s")) {
            return redirect()->back();
        }
        $shop = DB::table("plaza_shops")
            ->select("plaza_shops.*", "plaza.name as plaza_name")
            ->where('plaza_shops.id', $shop_id)
            ->leftJoin("plaza", "plaza.id", "=", "plaza_shops.plaza_id")
            ->first();

        $bidders = $this->getBidders($auction_id, $shop_id);
        $data['data'] = $bidders;
        $data['shop'] = $shop;
        $data['auction'] = $auction;
        $data['max_bid_amount'] = $this->getMaxBid($auction_id, $shop_id);
        $pdf = PDF::loadView('print', $data);
        return $pdf->download("auction_report_$auction->id.pdf");
    } //.... end of function printPdfReport .....//

    public function expireJob()
    {
        DB::table("test")->insert(["created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")]);
        return ["status" => true, "message" => "done"];
    }
}
