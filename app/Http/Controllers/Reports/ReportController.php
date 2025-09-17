<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrganizationDashboardController;
use App\Http\Controllers\Controller;
use App\Models\PropertyRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == "super_admin"){
            $data = (new AdminDashboardController())->getDashboardData();
        }else{
            $data = (new OrganizationDashboardController())->getDashboardData();
        }
        $from_date = $_GET["from_date"] ?? "";
        $to_date = $_GET["to_date"] ?? "";
        $query = PropertyRent::with("banks")->leftJoin("users","users.id","=","property_rents.customer_id")
            ->leftJoin("customer_property","customer_property.id","property_rents.customer_property_id")
            ->leftJoin("plaza_shops","plaza_shops.id","customer_property.plaza_shop_id")
            ->when($from_date,function ($query,$from_date){
                return $query->whereDate("bill_generate_date",">=",$from_date);
            })
            ->when($to_date,function ($query,$to_date){

                return $query->whereDate("bill_generate_date","<=",$to_date);
            });
        $data["recipts"] = $query->where('dr',"!=",0)->get(["property_rents.*","users.name","users.cnic","plaza_shops.shop_name","plaza_shops.current_rent"]);

        return view("Reports.report_view",$data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function printAllRecipts()
    {
        $from_date = $_GET["from_date"] ?? "";
        $to_date = $_GET["to_date"] ?? "";

        $query = PropertyRent::with("banks")->leftJoin("users","users.id","=","property_rents.customer_id")
            ->leftJoin("customer_property","customer_property.id","property_rents.customer_property_id")
            ->leftJoin("plaza_shops","plaza_shops.id","customer_property.plaza_shop_id")
            ->when($from_date,function ($query,$from_date){
                return $query->whereDate("bill_generate_date",">=",$from_date);
            })
            ->when($to_date,function ($query,$to_date){
                return $query->whereDate("bill_generate_date","<=",$to_date);
            });
        $data["recipts"] = $query->where('dr',"!=",0)->get(["property_rents.*","users.name","users.cnic","plaza_shops.shop_name","plaza_shops.current_rent"]);

        return view("Reports.print_all_recipts",$data);
    }
}
