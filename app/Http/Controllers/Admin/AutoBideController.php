<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class AutoBideController extends Controller
{


    public function placeBid($auction_id,$shop_id,$customer_id,$value)
    {


            $auction = DB::table("auctions")->whereId($auction_id)->first();
            $auction_end_time = $auction->end_date_time;
            $shop = DB::table("plaza_shops")->where(["id"=>$shop_id])->first();

            $premium = $shop->starting_bid_amount;
            $maxBid = $this->getHighstBid($auction_id,$shop_id);
            if($maxBid == 0){
                $maxBid = $premium;
            }

            $maxBid = $maxBid + ($value);
            $premium = ($maxBid > $premium) ? $maxBid : $premium;


                $insertData['auction_id'] = $auction_id;
                $insertData['shop_id'] = $shop_id;
                $insertData['customer_id'] = $customer_id;
                $insertData['bid_amount'] = $premium;
                $insertData['status'] = "active";
                $insertData['created_at'] = date("Y-m-d")." 23:59:59";
                $insertData['updated_at'] = date("Y-m-d")." 23:59:59";
                DB::table("aution_bids")->insert($insertData);
                (new AuctionController())->sendSmsToAllBidders($auction_id,$shop_id,$premium);
                return ["status" => "true","message"=>"Your Bid is placed successfully.","data"=>$this->getHighstBid($auction_id,$shop_id)];

            //.......  end of auction expiration  ................//



    }
    
    
        public function placeLastBid($auction_id,$shop_id,$customer_id,$value,$end_date_time='')
    {


            $auction = DB::table("auctions")->whereId($auction_id)->first();
            $auction_end_time = $auction->end_date_time;
            $shop = DB::table("plaza_shops")->where(["id"=>$shop_id])->first();

            $premium = $shop->starting_bid_amount;
            $maxBid = $this->getHighstBid($auction_id,$shop_id);
            if($maxBid == 0){
                $maxBid = $premium;
            }

            $maxBid = $maxBid + ($value);
            $premium = ($maxBid > $premium) ? $maxBid : $premium;


                $insertData['auction_id'] = $auction_id;
                $insertData['shop_id'] = $shop_id;
                $insertData['customer_id'] = $customer_id;
                $insertData['bid_amount'] = $premium;
                $insertData['status'] = "active";
                $insertData['created_at'] = $end_date_time ? $end_date_time : $auction_end_time;
                $insertData['updated_at'] = $end_date_time ? $end_date_time : $auction_end_time;
                DB::table("aution_bids")->insert($insertData);
                (new AuctionController())->sendSmsToAllBidders($auction_id,$shop_id,$premium);
                return ["status" => "true","message"=>"Your Bid is placed successfully.","data"=>$this->getHighstBid($auction_id,$shop_id)];

            //.......  end of auction expiration  ................//



    }



    public function getCustomerCdrAmount()
    {
        return DB::table("customer_cdr")
            ->where(["auction_id"=>request()->auction_id,"plaza_shop_id"=>request()->shop_id,"customer_id"=>Auth::user()->id])
            ->sum('amount');
    }

    public function getHighstBid($auction_id,$shop_id){

        $data =  DB::table("aution_bids")
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->max('bid_amount');
        return !empty($data) ? $data : 0;
    }



    public function getMaxBid($auction_id,$shop_id){
        $data =  DB::table("aution_bids")
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->max('bid_amount');
        return !empty($data) ? $data : 0;
    }

    public function getWinner($auction_id,$shop_id){
        $data =  DB::table("aution_bids")
            ->select('customer_id')
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->orderBy("bid_amount","DESC")
            ->first();
        return !empty($data) ? $data->customer_id : [];
    }

    protected function getAuctionBids($auction_id,$shop_id){
        $shop = DB::table("plaza_shops")->where(["id"=>$shop_id])->first();
        $premium = $shop->starting_bid_amount;
        $maxBid = DB::table("aution_bids")
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->max('bid_amount');
        $maxBid =  !empty($maxBid) ? $maxBid : 0;
        $premium = ($maxBid > $premium) ? $maxBid : $premium;
        return $premium;
    }

    protected function totalBidders($auction_id,$shop_id){
        $data =  DB::table("aution_bids")
            ->select("customer_id")
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->groupBy('customer_id')->get();
        return $data->count();
    }

    protected function totalBidds($auction_id,$shop_id){
        $data =  DB::table("aution_bids")
            ->select("customer_id")
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->get();
        return $data->count();
    }

    public function getBidders($auction_id,$shop_id)
    {
        $data =  DB::table("aution_bids")
            ->select("users.name as bidder_name","aution_bids.*","auctions.*")
            ->leftJoin("users","users.id","=","aution_bids.customer_id")
            ->leftJoin("auctions","auctions.id","=","aution_bids.auction_id")
            ->where(["auction_id"=>$auction_id,"shop_id"=>$shop_id])
            ->orderBy("bid_amount","DESC")
            ->paginate(50);
        foreach ($data as $key => $value){
            $value->bidder_name = ($value->status != "expired") ? "xxxxxx" : $value->bidder_name;

        }
        return $data;
    }


    function timeAgo($datetime, $full = false) {
        $now = Carbon::now();
        $ago = date("Y-m-d",strtotime($datetime));
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    public function printPdfReport($auction_id,$shop_id)
    {
        $auction = DB::table("auctions")->where("id",$auction_id)->first();
        if($auction->end_date_time > date("Y-m-d H:i:s")){
            return redirect()->back();
        }
        $shop = DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza.name as plaza_name")
            ->where('plaza_shops.id',$shop_id)
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->first();

        $bidders = $this->getBidders($auction_id,$shop_id);
        $data['data']= $bidders;
        $data['shop'] = $shop;
        $data['auction'] = $auction;
        $data['max_bid_amount'] = $this->getMaxBid($auction_id,$shop_id);
        $pdf = PDF::loadView('print', $data);
        return $pdf->download("auction_report_$auction->id.pdf");

    }//.... end of function printPdfReport .....//








}
