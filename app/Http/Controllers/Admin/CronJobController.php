<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronJobController extends Controller
{
    public function checkAuctionExpiration()
    {

        $auctions = Auction::select("auctions.id as auction_id", "auctions.*")
            ->where("status", "published")
            // ->whereRaw("end_date_time >= STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')" , Carbon::now()->format('Y-m-d H:i'))
            ->where("auctions.end_date_time", "<=", date("Y-m-d H:i:s"))
            ->get();

        if (count($auctions) == 0) {
            echo "sorry. There is no Active Auction Found.";
            exit;
        }
        foreach ($auctions as $key => $value) {
            $res = (new HomeController())->makeAuctionExpired($value->id);
            if ($res["status"]) {
                echo "true";
            } else {

                echo "false";
            }
        }
    }
}
