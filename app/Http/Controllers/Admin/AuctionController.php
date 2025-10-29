<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\Auction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    public function auctionView()
    {

        $data["title"] = "Add Auction";
        $data['data'] = Auction::select("auctions.*", "news_paper.newspaper_name", "plaza.name as plaza_name", "plaza.attachment as plaza_image")
            ->leftJoin("news_paper", "news_paper.newspaper_id", "=", "auctions.newspaper_id")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id");
        if(Auth::user()->user_type != "super_admin"){
            $data['data'] = $data['data']->where(["auctions.office_id"=>Auth::user()->office_id,"auctions.org_id"=>Auth::user()->org_id]);
        }

        $data['data']=  $data['data']->paginate(20);
        return view("admin.auctions.manage-auction", $data);
    }


    public function addAuction()
    {

        $data["title"] = "Add Auction";
        $plazas = DB::table('plaza_shops')->select('plaza_id')
            ->leftJoin("plaza", "plaza.id", "=", "plaza_shops.plaza_id")
            ->where("shop_status", "open_for_aution")
            ->where("plaza_shops.property_type", "Commercial");

        if (Auth::user()->user_type != "super_admin")
            $plazas = $plazas->where('plaza.org_id', Auth::user()->org_id);

        $plazas = $plazas->groupBy("plaza_id")->pluck("plaza_id");
        $data['plaza'] = DB::table("plaza")->whereIn("id", $plazas)->get();

        $data['news_paper'] = DB::table('news_paper')->get();
        return view("admin.auctions.add-auction", $data);
    }

    public function saveAuction(FilesController $filesController)
    {
       try{
           $auction_shops = DB::table('plaza_shops')->select('id')
               ->where("shop_status", "open_for_aution")
               ->where("plaza_id", request()->plaza_id)->pluck("id");
           if(count($auction_shops) > 0){
               DB::table("plaza_shops")->whereIn("id",$auction_shops)->update(["shop_status"=>"auctioned"]);
               $auction_shops = json_encode($auction_shops);
           }



           $insertData = request()->except(["id", "_token"]);
           if (request()->has("attachment") && !empty(request()->attachment))
               $insertData['attachment'] = $filesController->uploadFile("attachment", "uploads/auctions/");


           if (request()->id == 0) {
               $insertData['office_id'] = Auth::user()->office_id;
               $insertData['org_id'] = Auth::user()->org_id;
               $insertData['auction_shops'] = $auction_shops;
               Auction::create($insertData);
               return redirect()->to('auctions/manage-auctions')->with('success_message', 'Auction Created Successfully.');
           } else {
               $insertData['office_id'] = Auth::user()->office_id;
               $insertData['org_id'] = Auth::user()->org_id;
               Auction::where(["id" => request()->id])->update($insertData);
               return redirect()->to('auctions/manage-auctions')->with('success_message', 'Auction updated Successfully.');
           }
       }catch (\Exception $e){
           dd($e->getMessage());
       }
    }

    public function editAuction($id)
    {
        $data["title"] = "Edit Plaz";
        $data["data"] = Auction::where(["id" => $id])->first();
        $plazas = DB::table('plaza_shops')->select('plaza_id')->where("shop_status", "open_for_aution")
            ->groupBy("plaza_id")
            ->pluck("plaza_id");
        $data['plaza'] = DB::table("plaza")->whereIn("id", $plazas)->orWhere("id",$data["data"]->plaza_id)->get();

        $data['news_paper'] = DB::table('news_paper')->get();

        return view("admin.auctions.add-auction", $data);
    }

    public function deleteAuction()
    {
        Auction::whereId(request()->id)->delete();
        return ["status" => true, "message" => "Plaza Deleted successfully"];
    }

    public function publishedAuction()
    {
        $auctions = Auction::where(["auctions.id"=>request()->id])
            ->leftJoin("office","office.id","auctions.office_id")
            ->leftJoin("organization","organization.id","auctions.org_id")
            ->first();

      /*  $message = $auctions->auction_name." has been published in TMA:".$auctions->org_name
            .". \nAuction Start Date:".date("d-m-Y H:i:s",strtotime($auctions->start_date_time))
            ."\nEnd Date: ".date("d-m-Y H:i:s",strtotime($auctions->start_date_time))
            .". For more details please visit our official website\nhttp://eproperty.lcbkp.gov.pk/upComingAuctions"; */
        Auction::whereId(request()->id)->update(["status" => "published"]);
       // $this->sendAnnouncementSms($message);
        return ["status" => true, "message" => "Auction Published successfully"];
    }


    public function upComingAuctions()
    {
        $data["office"] = DB::table("office")->get();
        $data["organization"] = [];

        $office_id = $_GET['office_id'] ?? "";

        if($office_id != ""){
            $data['organization'] = DB::table("organization")->where("office_id",$office_id)->get();
        }
        $data['auctions'] = Auction::select("auctions.*", "news_paper.newspaper_name", "plaza.name as plaza_name", "plaza.property_type","plaza.attachment as plaza_img")
            ->leftJoin("news_paper", "news_paper.newspaper_id", "=", "auctions.newspaper_id")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            ->where("auctions.start_date_time",">", date("Y-m-d H:i:s"))
            ->where("auctions.status", "published")
            ->paginate(20);
        foreach ($data['auctions'] as $key => $value) {
            $value->getOpenShops = (new HomeController())->getOpenForAcutionShops($value->plaza_id);
            $value->totalImages = (1) + (new HomeController())->plazaImagesCount($value->plaza_id);
            $value->timeAgo = $this->timeAgo($value->created_at);
        }

        return view("frontend.pages.upcoming_auctions", $data);
    }

    public function completedAuctions()
    {
        $data["office"] = DB::table("office")->get();
        $data["organization"] = [];

        $office_id = $_GET['office_id'] ?? "";
        $type = $_GET["type"] ?? "";
        $org_id = $_GET["organization"] ?? "";
        //dd($type);
        if($office_id != ""){
            $data['organization'] = DB::table("organization")->where("office_id",$office_id)->get();
        }
         
        $data['auctions'] = Auction::select("auctions.*", "news_paper.newspaper_name", "plaza.name as plaza_name", "plaza.property_type", "plaza.attachment as plaza_img")
            ->leftJoin("news_paper", "news_paper.newspaper_id", "=", "auctions.newspaper_id")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            ->where("auctions.end_date_time","<", date("Y-m-d H:i:s"))
            ->orderBy("auctions.id","DESC")
            ->when($type,function ($query,$type){
                return $query->where(["plaza.property_type" => strtolower($type)]);
            })
            ->when($office_id,function ($query,$office_id){
                return $query->where(["plaza.office_id" => $office_id]);
            })
            ->when($org_id,function ($query,$org_id){
                return $query->where(["plaza.org_id" => $org_id]);
            })
            //->orderBy("auctions.id","DESC")
            ->paginate(50);
        foreach ($data['auctions'] as $key => $value) {
            $count = json_decode($value->auction_shops);
            $value->getOpenShops = count($count);
            $value->timeAgo = "";//$this->timeAgo($value->created_at);
            //$value->getOpenShops = (new HomeController())->getOpenForAcutionShops($value->plaza_id);
            $value->totalImages = (1) + (new HomeController())->plazaImagesCount($value->plaza_id);

        }
        return view("frontend.pages.completed_auctions", $data);
    }


     function sendSmsToAllBidders($auction_id,$shop_id,$bid_amount){
        $shop = DB::table("plaza_shops")->where(["id"=>$shop_id])->first();
        $plaza = DB::table("plaza")->where(["id"=>$shop->plaza_id])->first();
        $office = DB::table("office")->where(["id"=>$plaza->office_id])->first();
        $org = DB::table("organization")->where(["id"=>$plaza->org_id])->first();
        $bidders =  DB::table("customer_cdr")
            ->select("customer_id")
            ->where(["auction_id"=>$auction_id,"plaza_shop_id"=>$shop_id])
            ->groupBy('customer_id')->pluck("customer_id");

        $users = User::whereIn("id",$bidders)->get();

        $mobiles = "";
        foreach ($users as $key => $value){
            if($value->phoneNumber !="")
                $mobiles = $mobiles .$value->phoneNumber.",";
        }
        $mobiles = rtrim($mobiles,",");

                $message = "Maximum Bid of ".$bid_amount." is placed on ".$shop->shop_name;
               //  ."\n Plaza: ".$plaza->name ?? ''."  \nOffice: ".$office->name ?? ''."  \nOrg:". $org->org_name ?? '';

        //............ uncomment the sms api  ......./
     //  $this->sendSms($mobiles,$message);


    }

    function sendSms($mobileNo, $message)
    {

        $username = "923452116444";
        $password = "2211";
        $mobile = rtrim($mobileNo, ',');
        //$sender = "8023";
        $sender = "L.C.B";
        //$url = "https://sendpk.com/api/sms.php?api_key=923452116444-4d143246-ac49-49e5-9e04-0f8c3234e066&username=$username&password=$password&sender=$sender &mobile=$mobileNo&message=$message";
        $url = "https://sendpk.com/api/sms.php?api_key=923452116444-b6a52f23-70a7-48b1-b47e-265d5da960dd&username=" . $username . "&password=" . $password . "&sender=" . $sender . "&mobile=" . $mobile ."&message=" . urlencode($message) . "";

        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $responce = curl_exec($ch);
       // print_r($responce);

        curl_close($ch);

    }
    
    function sendRegistrationSms($mobileNo, $message)
    {

        $username = "923452116444";
        $password = "2211";
        $mobile = rtrim($mobileNo, ',');
        //$sender = "8023";
        $sender = "L.C.B";
        //$url = "https://sendpk.com/api/sms.php?username=$username&password=$password&sender=$sender &mobile=$mobileNo&message=$message";
        $url = "https://sendpk.com/api/sms.php?api_key=923452116444-b6a52f23-70a7-48b1-b47e-265d5da960dd&username=" . $username . "&password=" . $password . "&sender=" . $sender . "&mobile=" . $mobile ."&message=" . urlencode($message) . "";

        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $responce = curl_exec($ch);

        curl_close($ch);

    }


    public function getWinnerName($auctionID)
    {
        $this->db->select('*');
        $this->db->from("auction_bit");
        $this->db->where("AuctionID", $auctionID);
        $this->db->order_by("BidID DESC");
        $res = $this->db->get()->row();
        $winnerName = " Not Available. Because No Bid is Placed on that Auction therefore there is no winner";
        if ($res) {
            $winnerName = $this->get_contractor_name($res->ContractorID);
        }
        return $winnerName;
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

    protected function sendAnnouncementSms($message=""){
        if($message !=""){
            $mobiles = "";
            DB::table('users')->select("phoneNumber")->where("user_type","customer")
                ->orderBy("created_at","ASC")
                ->chunk(100, function ($users) use($mobiles,$message) {
                    foreach ($users as $key => $value2) {
                        if($value2->phoneNumber !="")
                            $mobiles = $mobiles .$value2->phoneNumber.",";
                    }
                    $mobiles = rtrim($mobiles,$message);
                    $this->sendSms($mobiles,$message);
                });
            return ["status" => "true","message" =>"Message has been sent to all customers."];
        }else{
            return ["status" => "false","message" =>"Please Provide Message"];
        }


        //............ uncomment the sms api  ......./
    }
    
 


}
