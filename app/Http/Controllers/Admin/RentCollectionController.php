<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerProperty;
use App\Models\PropertyRent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = CustomerProperty::
        select(["customer_property.*","plaza_shops.current_rent","plaza_shops.increment_percentage","plaza_shops.property_type","plaza_shops.shop_name","users.name","users.cnic","users.email","users.phoneNumber","plaza.address"])
            ->leftJoin("plaza_shops","plaza_shops.id","=","customer_property.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(['plaza.org_id'=>auth()->user()->org_id])
            ->where(['plaza.office_id'=>auth()->user()->office_id])
            ->leftJoin("users","users.id","=","customer_property.customer_id")
            ->paginate(20);

        foreach ($data['data'] as $key => $value){
            $value->details = $this->getPropertyDetails($value->plaza_shop_id);
        }

       // dd($data);

        return view("admin.rent_collection.index",$data);
    }

    public function printAllOutstanding()
    {
        $data['data'] = CustomerProperty::
        select(["customer_property.*","plaza_shops.current_rent","plaza_shops.increment_percentage","plaza_shops.property_type","plaza_shops.shop_name","users.name","users.cnic","users.email","users.phoneNumber","plaza.address"])
            ->leftJoin("plaza_shops","plaza_shops.id","=","customer_property.plaza_shop_id")
            ->leftJoin("plaza","plaza.id","=","plaza_shops.plaza_id")
            ->where(['plaza.org_id'=>auth()->user()->org_id])
            ->where(['plaza.office_id'=>auth()->user()->office_id])
            ->leftJoin("users","users.id","=","customer_property.customer_id")
            ->paginate(20);

        foreach ($data['data'] as $key => $value){
            $value->details = $this->getPropertyDetails($value->plaza_shop_id);
        }
        return view("Reports.print_all_outstanding",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->all();
        if(request()->id == 0){
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();
        }else{
            $data["updated_at"] = Carbon::now();
        }

        PropertyRent::updateOrCreate(
            ["id" => request()->id],
            $data
        );
        if(request()->id == 0){
            $bank = DB::table("bank_accounts")->whereId(request()->bank_id)->first();
            $user = DB::table("users")->whereId(request()->customer_id)->first();
            $user_phone = $user->phoneNumber;
            $balance = $this->getBalance(request()->customer_property_id);
            $amount = request()->dr;
            $message = "Thank you for submitting your rent of RS:$amount  in ".$bank->name." Acc#".$bank->account." of LCB. Your Remaining Balance is .".$balance['balance'];
           // (new AuctionController())->sendSms("923149465659",$message);
            return ["status" => true,"message" => "Rent Collected successfully"];
        }else{
            return ["status" => true,"message" => "Rent Updated successfully"];
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $customer = CustomerProperty::with(["customer","shop"])->whereId($id)->first();
       // dd($customer);
        $query = PropertyRent::where(["customer_property_id" => $id])->with("banks");
        $data['cr'] = $query->sum("cr");
        $data["dr"] = $query->sum("dr");
        $data["balance"] = ($data['cr']) - $data["dr"];
        $data["id"] = $id;
        $data['data'] = $query->paginate(20);
        $data["banks"] = DB::table("bank_accounts")->get();
        $data["recipts"] = $query->where('dr',"!=",0)->get();
        $data["customer"] = $customer;
        $data['customer_id'] = $customer->customer_id ?? 0;

        $data['ledger'] = PropertyRent::select(
            DB::raw('sum(cr) as totalCr'),
            DB::raw('sum(dr) as totalDr'),
            DB::raw("DATE_FORMAT(bill_generate_date,'%M %Y') as months")

        )
            ->where("customer_id",$customer->customer_id)
            ->where("customer_property_id",$id)
            ->groupBy('months')
            ->get();





        return view("admin.rent_collection.create",$data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBalance($property_id)
    {
        $query = PropertyRent::where(["customer_property_id" => $property_id])->with("banks");
        $data['cr'] = $query->sum("cr");
        $data["dr"] = $query->sum("dr");
        $data["balance"] = ($data["cr"]) - ($data["dr"]);
        return $data;
    }

    public function getPropertyDetails($shop_id)
    {
        $customer = CustomerProperty::with(["customer","shop"])->where(["plaza_shop_id"=>$shop_id,"is_active" => 1])->first();
        $customer->lease_date = date("d-m-Y",strtotime($customer->lease_date));
        $customer->expiry_date = date("d-m-Y", strtotime("$customer->duration years", strtotime($customer->lease_date)));
        // dd($customer);
        $query = PropertyRent::where(["customer_property_id" => $customer->id])->with("banks");
        $data['cr'] = $query->sum("cr");
        $data["dr"] = $query->sum("dr");
        $data["balance"] = ($data['cr']) - $data["dr"];


        $data["tenant"] = $customer;
        return $data;
    }

    public function printTenantRecipts($property_id)
    {
        $customer = CustomerProperty::with(["customer","shop"])->whereId($property_id)->first();
        // dd($customer);
        $query = PropertyRent::where(["customer_property_id" => $property_id])->with("banks");
        $data['cr'] = $query->sum("cr");
        $data["dr"] = $query->sum("dr");
        $data["balance"] = ($data['cr']) - $data["dr"];
        $data["recipts"] = $query->where('dr',"!=",0)->get();
        $data["customer"] = $customer;

        return view("Reports.print_tenant_receipts",$data);
    }

    public function printTenantOutstanding($property_id)
    {
        $customer = CustomerProperty::with(["customer","shop"])->whereId($property_id)->first();
        $data['ledger'] = PropertyRent::select(
            DB::raw('sum(cr) as totalCr'),
            DB::raw('sum(dr) as totalDr'),
            DB::raw("DATE_FORMAT(bill_generate_date,'%M %Y') as months")
        )
            ->where("customer_id",$customer->customer_id)
            ->groupBy('months')
            ->orderBy("months","DESC")
            ->get();
        $data["customer"] = $customer;
        return view("Reports.print_tenant_outstanding",$data);
    }

    public function printBankRecipts($id)
    {


        $customer = CustomerProperty::with(["customer","shop"])->whereId($id)->first();
        // dd($customer);
        $query = PropertyRent::where(["customer_property_id" => $id])->with("banks");
        $data['cr'] = $query->sum("cr");
        $data["dr"] = $query->sum("dr");
        $data["balance"] = ($data['cr']) - $data["dr"];
        $data['data'] = $query->paginate(20);
        $data["banks"] = DB::table("bank_accounts")->get();
        $data["recipts"] = $query->where('dr',"!=",0)->get();
        $data["customer"] = $customer;
        $data['customer_id'] = $customer->customer_id ?? 0;

        return view("Reports.print_bank_receipts",$data);
    }

    public function printMonthlyReport()
    {
        $reports = DB::select("
            select  customer_id, u.name, 
		(select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='January' and pr.customer_id = pri.customer_id) as 'January',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='February' and pr.customer_id = pri.customer_id),0) as 'February',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='March' and pr.customer_id = pri.customer_id),0) as 'March',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='April' and pr.customer_id = pri.customer_id),0) as 'April',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='May' and pr.customer_id = pri.customer_id),0) as 'May',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='June' and pr.customer_id = pri.customer_id),0) as 'June',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='July' and pr.customer_id = pri.customer_id),0) as 'July',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='August' and pr.customer_id = pri.customer_id),0) as 'August',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='September' and pr.customer_id = pri.customer_id),0) as 'September',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='October' and pr.customer_id = pri.customer_id),0) as 'October',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='November' and pr.customer_id = pri.customer_id),0) as 'November',
				COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
				from property_rents pri
				where DATE_FORMAT(pri.bill_generate_date, '%M')='December' and pr.customer_id = pri.customer_id),0) as 'December',
				 sum(pr.cr) - sum(pr.dr) as balance
from 	property_rents pr
		inner join users u on (u.id = pr.customer_id)
		
	
where   DATE_FORMAT(bill_generate_date, '%Y') = ?

group by  customer_id, u.name;
        ", [ "2021" ]);
        $data['reports'] = $reports;

        return view("Reports.print_month_wise",$data);
    }


    public function printAllByType()
    {
        $type = $_GET["type"] ?? "";
        $customer_id = $_GET['customer_id'] ?? "";
        $year = $_GET["year"] ?? date("Y");
        $query = "select pr.customer_id, u.name, ps.shop_name, ps.property_type,ps.current_rent,
                    (select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='January' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id) as 'January',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='February' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'February',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='March' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'March',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='April' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'April',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='May' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'May',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='June' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'June',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='July' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'July',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='August' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'August',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='September' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'September',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='October' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'October',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='November' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'November',
                    COALESCE((select concat(CAST(sum(pri.cr) as char) ,'/',cast(sum(pri.dr) as char))
                    from property_rents pri
                    where DATE_FORMAT(pri.bill_generate_date, '%M')='December' and pr.customer_id = pri.customer_id and pr.plaza_shop_id = pri.plaza_shop_id),0) as 'December',
                    sum(pr.cr) - sum(pr.dr) as balance
                    from property_rents pr
                    inner join users u on (u.id = pr.customer_id)
                    inner join customer_property cp on ( cp.id = pr.customer_property_id)
                    inner join plaza_shops ps on (ps.id = cp.plaza_shop_id)
                    where DATE_FORMAT(pr.bill_generate_date, '%Y') = ?";
        if($customer_id){
            $query .=" and pr.customer_id =".$customer_id;
        }
        if($type){
            $query .=" and ps.property_type ='$type'";
        }
        $query.=" group by pr.customer_id, pr.plaza_shop_id, u.name, ps.shop_name, ps.property_type,ps.current_rent";
        $data['reports'] = DB::select($query,[$year]);
        return view("Reports.print_month_wise",$data);
    }


    public function organizationProperty()
    {
        $query = "select A.org_name, sum(TotalCommercial) as TotalCommercial, sum(TotalResidential) as TotalResidential,
                    sum(OpenCommercial) as OpenCommercial ,sum(RentCommercial) as RentCommercial ,
                    sum(OpenResidential) as OpenResidential ,sum(RentResidential) as RentResidential
                    from
                    (
                    select O.org_name, ps.property_type, 
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
                    group by A.org_name";
        $data['reports'] = DB::select($query);
        return view("Reports.print_organization_property",$data);
    }





}
