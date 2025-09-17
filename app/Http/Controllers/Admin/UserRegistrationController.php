<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\Auction;
use App\Models\CourtCase;
use App\Models\CourtCaseDetails;
use App\Models\CustomerProperty;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\OrganizationDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;

class UserRegistrationController extends Controller
{

    public function userRegistrartion()
    {

        $data["title"] = "User Registration";
        $data["user"] = [];
        return view("frontend.user_registration",$data);
    }

    public function signUpUser(FilesController $filesController)
    {
        $insert_user = 1;
        $confirm_password = request()->confirm_password;
        $data = request()->except(["id","_token","confirm_password"]);
        $data['created_at'] = date("Y-m-d H:i");
        $data['updated_at'] = date("Y-m-d H:i");
        $check_user = User::whereEmail(request()->email)->first();
        if(($check_user) && ($check_user->is_verified == 1 || $check_user->is_active == 1)){
            return redirect()->back()->with('error_message', 'User with this email already exist.')
                ->withInput(request()->input());
        }
        $userCnic = User::whereCnic(request()->cnic)->first();
        $cnic = request()->cnic ?? "";
        if(($userCnic) && ($userCnic->is_verified == 1 || $userCnic->is_active == 1)){
            return redirect()->back()->with('error_message', "User with this CNIC ($cnic) already exist.")
                ->withInput(request()->input());
        }
        if($check_user && $check_user->is_verified == 0){
            $insert_user = 0;
            //User::whereEmail(request()->email)->delete();
        }



        if(request()->password <> $confirm_password){
            return redirect()->back()->with('error_message', 'Password and confirm password did not matched.')
                ->withInput(request()->input());
        }

        if (request()->has("image") && !empty(request()->image))
            $data['image'] = $filesController->uploadFile("image","uploads/organization_logo/");
        if (request()->has("cnic_image") && !empty(request()->cnic_image))
            $data['cnic_image'] = $filesController->uploadFile("cnic_image","uploads/organization_logo/");
        if (request()->has("affidavit") && !empty(request()->affidavit))
            $data['affidavit'] = $filesController->uploadFile("affidavit","uploads/organization_logo/");
        if (request()->has("deposit_slip") && !empty(request()->deposit_slip))
            $data['deposit_slip'] = $filesController->uploadFile("deposit_slip","uploads/organization_logo/");


        $data['password'] = Hash::make(request()->password);
        $data['user_type'] = "customer";
        $otp = $this->generateOtp();
        $data['otp'] = $otp;
        if($insert_user)
            User::insert($data);
        else
            User::whereEmail(request()->email)->update($data);

        $user = User::whereEmail(request()->email)->first();
        $message = "Your OTP code is: $otp";
        $mobileNo = "92".substr($user->phoneNumber,-10);
        // (new AuctionController())->sendRegistrationSms($mobileNo,$message);
        // $this->sendEmail("Verification Code",$message,request()->email);
        //return redirect()->to("organizationVerification/$user->id")->with("show_popup","true");
        return redirect()->to("registration")->with("show_popup",$user->id);


        //Account created successfully. Your account will be activated soon.Thanks

    }

    public function testSms()
    {

       $m =  (new AuctionController())->sendSms("923459305301","Hellow testing testing");
      // dd($m);

    }

    public function superadminView()
    {
        $data["title"] = "Admin Registration";
        $org_id = auth()->user()->org_id != 0 ? "yes" : "";
        $data['data'] = User::select("users.*","office.name as office_name","organization.org_name")
            ->leftJoin("office","office.id","=","users.office_id")
            ->leftJoin("organization","organization.id","=","users.org_id")
            ->when($org_id,function($query,$org_id){
                     
                return $query->where("users.org_id",auth()->user()->org_id);
            })
            ->get(200);
        return view("admin.super_admin.manage-superadmin",$data);
    }


    public function adminDashboard()
    {

        $data["title"] = env("APP_NAME");
        if(Auth::user()->user_type == "super_admin"){
            $org_id = (isset($_GET["org_id"])) ? $_GET['org_id'] : auth()->user()->org_id;
            $data = (new AdminDashboardController())->getDashboardData();
            $data["title"] = "Dashboard";
            $data['org'] = DB::table("organization")->where(["office_id"=>Auth::user()->office_id])->get();
            $data['case'] = $this->getCases();
            $data['tenants'] = $this->getTenants();
            $data['property'] = $this->getOrganizationProperty();
            if($org_id){
                $data['property'] = $this->getSingleOrganizationProperty($org_id);
            }



            return view("admin.admin_dashboard2",$data);
            return view("admin.admin_dashboard",$data);
        }elseif (Auth::user()->user_type == "admin_user"){
            $data = (new OrganizationDashboardController())->getDashboardData();
            $data["title"] = "Admin Dashboard";
            $data['case'] = $this->getCases();
            $data['tenants'] = $this->getTenants();
            $data['property'] = $this->getSingleOrganizationProperty(auth()->user()->org_id);
            return view("admin.admin_dashboard2",$data);
            return view("admin.organization_dashboard",$data);
        }else{
            $data["title"] = "Customer Dashboard";
            return Redirect::to(url("/"));
            /*return view("home",$data);
            return view("admin.customer.customer_dashboard",$data);*/
        }

    }

    public function getTenants()
    {
        $org_id = auth()->user()->org_id ?? "";
        $admin = Auth::user()->user_type == "super_admin" ? "" : "true";
        $data = CustomerProperty::
        leftJoin("plaza_shops","plaza_shops.id","=","customer_property.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("users","users.id","=","customer_property.customer_id")
            ->when($org_id,function ($query,$org_id){
                $query->where("plaza.org_id",$org_id);
            })
            ->when($admin,function($query,$admin){
                return $query->where(["plaza.org_id" => auth()->user()->org_id]);
            })
            ->where(["customer_property.is_active" => 1])
            ->take(10)
            ->get(["users.name","plaza_shops.lat","plaza_shops.lng"]);
        $res = [];
        foreach ($data as $key => $value){
            $res[] = [$value->name,$value->lat,$value->lng];

        }
        return ["status" => true,"data" => $res];

    }


    public function getCases()
    {
        $org_id = auth()->user()->org_id ?? "";
        $admin = Auth::user()->user_type == "super_admin" ? "" : "true";
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);
        //$cases = CourtCaseDetails::whereBetween('hearing_date', [$startDate, $endDate])->get()->pluck("court_case_id");
        $data = CourtCase::leftJoin("plaza_shops","plaza_shops.id","=","court_case.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("court","court_case.court_id","=","court.id")
            ->whereBetween('court_case.hearing_date', [$startDate, $endDate])
            ->when($admin,function($query,$admin){
                return $query->where(["court_case.org_id" => auth()->user()->org_id]);
            })
            ->when($org_id,function ($query,$org_id){
                $query->where("court_case.org_id",$org_id);
            })
            ->select(["court_case.*","plaza_shops.shop_name","plaza.name as plaza_name","plaza.id as plaza_id","court.name as court_name"])
            ->paginate(20);

        /*foreach ($data as $key => $value){
            $value->hearing = DB::table("court_case_details")->where(["court_case_id" => $value->id])->orderBy("heiring_date","DESC")->get();
        }*/
        return $data;
    }

    public function customerDashboards()
    {
        $data["title"] = "Customer";
        $data['total_property'] =  DB::table("plaza_shops")->where(["customer_id"=>Auth::user()->id])->count();
        $data['total_payable_rent'] =  DB::table("plaza_shops")->where(["customer_id"=>Auth::user()->id])->sum('current_rent');
        $data['total_shops'] =  DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza.*")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(["plaza.property_type"=>"plaza"])
            ->where(["plaza_shops.customer_id"=>Auth::user()->id])
            ->count();
        $data['total_plots'] =  DB::table("plaza_shops")
            ->select("plaza_shops.*","plaza.*")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(["plaza.property_type"=>"plot"])
            ->where(["plaza_shops.customer_id"=>Auth::user()->id])
            ->count();
        $data['open_auctions'] =      $this->getTotalOpenAuctions();
        $data['upcomming_auctions'] = $this->upcommingAuctions();
        $data['total_value_property'] = $this->totalValueProperty();
        $data['highest_value_shop'] = $this->getHighestBidShop();
        $data['highest_value_plot'] = $this->getHighestBidPlot();

        $data['auction_participation'] = $this->employeAuctionParticipation()->count();
        $data['number_of_bids'] = $this->employeTotalBids();


        //$data['totalAuctions'] = DB::table("auctions")->where(["office_id"=>Auth::user()->office_id,"org_id"=>Auth::user()->org_id])->count();

        return view("admin.customer.customer_dashboard",$data);
    }

    public function employeTotalBids()
    {
        return DB::table('aution_bids')
            ->select("auction_id")
            ->where(["customer_id"=>Auth::user()->id])
            ->count();

    }

    public function employeAuctionParticipation()
    {
        return DB::table('aution_bids')
            ->select("auction_id")
            ->where(["customer_id"=>Auth::user()->id])
            ->groupBy("auction_id")
            ->get();

    }

    public function getTotalOpenAuctions()
    {
        return DB::table("auctions")
            ->where(["status"=>"published"])
            ->whereDate("auctions.start_date_time","<=",date("Y-m-d H:i:s"))
            ->whereDate("auctions.end_date_time",">=",date("Y-m-d H:i:s"))
            ->count();
    }

    public function upcommingAuctions()
    {
       return Auction::select("auctions.*", "news_paper.newspaper_name", "plaza.name as plaza_name", "plaza.property_type")
            ->leftJoin("news_paper", "news_paper.newspaper_id", "=", "auctions.newspaper_id")
            ->leftJoin("plaza", "plaza.id", "=", "auctions.plaza_id")
            ->where("auctions.start_date_time",">", date("Y-m-d H:i:s"))
           ->where("auctions.status", "published")
            ->count();
    }

    public function getHighestBidShop()
    {
        $data = DB::table("plaza_shops")
            ->select("aution_bids.bid_amount")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("aution_bids","aution_bids.customer_id","=","plaza_shops.customer_id")
            ->where(["plaza.property_type"=>"plaza"])
            ->where(["plaza_shops.customer_id"=>Auth::user()->id])
            ->max("aution_bids.bid_amount");

        return $data ? $data : 0 ;
    }

    public function getHighestBidPlot()
    {
        $data = DB::table("plaza_shops")
            ->select("aution_bids.bid_amount")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->leftJoin("aution_bids","aution_bids.customer_id","=","plaza_shops.customer_id")
            ->where(["plaza.property_type"=>"plot"])
            ->where(["plaza_shops.customer_id"=>Auth::user()->id])
            ->max("aution_bids.bid_amount");

        return $data ? $data : 0 ;
    }

    public function totalValueProperty()
    {

        $property = DB::table("plaza_shops")->where(["shop_status"=>"rent_out","customer_id"=>Auth::user()->id])->get();
        $total = 0;
        foreach ($property as $key => $value){
            $data = DB::table("aution_bids")
                ->where(["auction_id"=>$value->auction_id,"shop_id"=>$value->id,"customer_id"=>Auth::user()->id])
                ->max('bid_amount');
            $total = ($total) + (!empty($data) ? $data : 0);
        }
        return $total;


    }



    public function addSuperAdmin()
    {
        $data["title"] = "Add Admin";
        $data["offices"] = DB::table("office")->get();
        
        return view("admin.super_admin.addsuperadmin",$data);
    }

    public function saveSuperAdmin(FilesController $filesController)
    {

        $insertData = request()->except(["id","_token","confirm_password","password"]);

        if (request()->has("image") && !empty(request()->image))
            $insertData['image'] = $filesController->uploadFile("image","uploads/organization_logo/");
        if(trim(request()->password,' ') !="" && trim(request()->confirm_password,' ') &&  request()->password == request()->confirm_password)
            $insertData['password'] = Hash::make(request()->password);



        if(request()->id == 0){
            $user = User::where(["email"=>request()->email])->first();
            if($user){
                return redirect()->back()->with('error_message', 'User with this email already exist.')
                    ->withInput(request()->input());
            }

            if(trim(request()->password,' ') =="" || trim(request()->password,' ') =="" ){
                return redirect()->back()->with('error_message', 'Password and confirm password fields are required.')
                    ->withInput(request()->input());
            }
            if(request()->password != request()->confirm_password ){
                return redirect()->back()->with('error_message', 'Password and confirm password fields did not matched.')
                    ->withInput(request()->input());
            }else{
                $insertData['password'] = Hash::make(request()->password);
            }


            $insertData['is_active'] = 1;
            $insertData['is_verified'] = 1;
            User::insert($insertData);
            return redirect()->to('users/manage-admins')->with('success_message', 'User Created Successfully.');
        }else{
            User::where(["id"=>request()->id])->update($insertData);
            return redirect()->to('users/manage-admins')->with('success_message', 'User updated Successfully.');
        }


    }


    public function saveCustomer(FilesController $filesController)
    {

        $insertData = request()->except(["id","_token"]);

        if(request()->id == 0){
            $user = User::where(["email"=>request()->email])->first();
            if($user){
                return redirect()->back()->with('error_message', 'User with this email already exist.')
                    ->withInput(request()->input());
            }
            $insertData['password'] = Hash::make(12345678);
            $insertData['is_active'] = 0;
            $insertData['is_verified'] = 0;
            if (request()->has("image") && !empty(request()->image))
                $insertData['image'] = $filesController->uploadFile("image","uploads/organization_logo/");
            User::insert($insertData);
            return redirect()->back()->with('success_message', 'User Created Successfully.');
        }else{
            User::where(["id"=>request()->id])->update($insertData);
            return redirect()->to('users/manage-admins')->with('success_message', 'User updated Successfully.');
        }


    }


    public function saveCustomerAjax(FilesController $filesController)
    {

        $insertData = request()->except(["id","_token"]);

        if(request()->id == 0){
            $user = User::where(["email"=>request()->email])->first();
            if($user){
                return redirect()->back()->with('error_message', 'User with this email already exist.')
                    ->withInput(request()->input());
            }
            $insertData['password'] = Hash::make(12345678);
            $insertData['is_active'] = 0;
            $insertData['is_verified'] = 0;
            if (request()->has("image") && !empty(request()->image))
                $insertData['image'] = $filesController->uploadFile("image","uploads/organization_logo/");
            $id = User::insertGetId($insertData);
            return ["status" => true,"message"=>"Tenant Registered Successfully","data" => User::whereId($id)->first() ];
        }else{

            return ["status" => false,"message"=>"error"];
        }


    }




    public function addCustomer()
    {
        $data["title"] = "Add Customer";
        $data["offices"] = DB::table("office")->get();
        return view("admin.super_admin.addcustomer",$data);
    }

    public function editSuperAdmin($id)
    {
        $data["title"] = "Add Admin";
        $data["user"] = User::where(["id"=>$id])->first();
        $data["offices"] = DB::table("office")->get();
        return view("admin.super_admin.addsuperadmin",$data);
    }
    public function deleteSuperAdmin()
    {
        $user = User::whereId(request()->id)->first();
        User::whereId(request()->id)->update(["is_active" => request()->status]);
        if(request()->status == 0){
            $message = "Your account has been blocked on the e-Property website. Please contact the TMA Admin.";
        }else{
            $message = "Your account is activated in eProperty. Now you can participate in online bidding. Thank you.";
        }
        $mobileNo = "92".substr($user->phoneNumber,-10);
        (new AuctionController())->sendSms($mobileNo,$message);
        return ["status" => true,"message"=>"Organization Deleted successfully"];
    }

    public function getOrganization()
    {
        $data = DB::table("organization")->whereOfficeId(request()->office_id)->get();
        return ["status" => true,"data"=>$data];
    }

    public function organizationVerification($id)
    {
        $user = User::whereId($id)->first();
        $success_message = "Please enter 6 digit OTP code sent to your mobile number $user->phoneNumber.";
        return view("frontend.customer_otp",["message"=>$success_message,"user"=>$user]);

    }

    public function organizationOtpVerification()
    {


        $apply = User::whereId(request()->id)->first();
        if($apply->otp == request()->verification_code){

            User::whereId(request()->id)->update(["is_verified" => 1,"is_active"=>0]);
            //$message = "Hello Admin, <br> <b>$apply->organization_name</b>. created an account please verify them and activate the user account.Thanks";
           // $this->sendAdminEmail("New User Verification Verification",$message,"ronald@igdjamaica.com"); //
            return redirect()->to('registration')
                ->with('success_message', "Congratulations $apply->name , Your account is registered and send for activation & approval  آپ کا اکاؤنٹ رجسٹر ہو گیا ہے اور اسے فعال کرنے اور منظوری کے لیے بھیج دیا گیا ہے۔ ");

        }else{
            $user = User::whereId(request()->id)->first();
            return redirect()->to("organizationVerification/$user->id")->with("error_message","You have entered Invalid OTP");

        }
    }


    public function sendEmail($email_subject,$message,$user_email)
    {


        $email_from = env("MAIL_FROM_ADDRESS");
        $viewName = 'email.referral_code';
        $request['text'] = $message."<br><b>Regards:</b><br>Smart City Wing <br>Local Council Board";
        try{
            Mail::send($viewName, $request, function ($message) use ($email_from, $user_email, $email_subject) {
                $message->to($user_email, $user_email)
                    //->cc("burhan@plutuscommerce.net")
                    ->subject($email_subject);
            });
            return true;
        }catch(\Exception $e){
            dd($e->getMessage());
            return false;
        }

    }

    public function generateOtp()
    {
        return mt_rand(100000, 999999);
    }

    public function customerDashboard()
    {
        $data["title"] = "Customer";
        return view("admin.customer.customer_dashboard",$data);
    }

    public function getUserByCnic()
    {
        $user = User::whereCnic(request()->cnic)->where("user_type",request()->type)->first();
        if($user){
            return ["status" => true,"data" => $user];
        }else{
            return ["status" => false,"data" => []];
        }

    }

    public function getOrganizationProperty()
    {
        $query = "select a.org_name, sum(TotalCommercial) as TotalCommercial, sum(TotalResidential) as TotalResidential,
                    sum(OpenCommercial) as OpenCommercial ,sum(RentCommercial) as RentCommercial ,
                    sum(OpenResidential) as OpenResidential ,sum(RentResidential) as RentResidential
                    from
                    (
                    select o.org_name, ps.property_type, 
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Commercial') as TotalCommercial,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Residential') as TotalResidential,
                    
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Commercial' and shop_status='open_for_aution') as OpenCommercial,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Commercial' and shop_status='rent_out') as RentCommercial,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Residential' and shop_status='open_for_aution') as OpenResidential,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Residential' and shop_status='rent_out') as RentResidential
                    
                    
                    from 
                    organization o 
                    left join plaza p on o.id=p.org_id
                    left join plaza_shops ps on ps.plaza_id=p.id
                    ) a
                    group by a.org_name";
        return DB::select($query);

    }

    public function getSingleOrganizationProperty($id)
    {
        $query = "select a.org_name, sum(TotalCommercial) as TotalCommercial, sum(TotalResidential) as TotalResidential,
                    sum(OpenCommercial) as OpenCommercial ,sum(RentCommercial) as RentCommercial ,
                    sum(OpenResidential) as OpenResidential ,sum(RentResidential) as RentResidential
                    from
                    (
                    select o.org_name, ps.property_type, 
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Commercial') as TotalCommercial,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Residential') as TotalResidential,
                    
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Commercial' and shop_status='open_for_aution') as OpenCommercial,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Commercial' and shop_status='rent_out') as RentCommercial,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Residential' and shop_status='open_for_aution') as OpenResidential,
                    (select Count(*) from plaza_shops pp where pp.id=ps.id and pp.property_type='Residential' and shop_status='rent_out') as RentResidential
                    
                    
                    from 
                    organization o 
                    left join plaza p on o.id=p.org_id
                    left join plaza_shops ps on ps.plaza_id=p.id
                    where p.org_id = ?
                    ) a
                    group by a.org_name";
        return DB::select($query,[$id]);

    }

    public function changeTma()
    {
            User::whereId(auth()->user()->id)->update(["office_id" => 1,"org_id" =>request()->org_id]);
            return ["status" => true,"message" => "TMA changed successfully"];

    }









}
