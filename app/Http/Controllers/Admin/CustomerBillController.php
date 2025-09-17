<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerProperty;
use App\Models\PropertyRent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerBillController extends Controller
{
    public function generateRent()
    {
        CustomerProperty::select(["customer_property.*","plaza_shops.current_rent","plaza_shops.increment_percentage"])->leftJoin("plaza_shops","plaza_shops.id","=","customer_property.plaza_shop_id")
            ->chunk(100, function ($property) {
                $insert_data = [];
            foreach ($property as $value) {
                $insert_data[] = [
                    "customer_property_id" => $value->id,
                    "customer_id" => $value->customer_id,
                    "plaza_shop_id" => $value->plaza_shop_id,
                    "cr" => $value->current_rent,
                    "dr" => 0,
                    "bill_generate_date" => Carbon::now(),
                    "last_date" => date("Y-m")."-10",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ];

            }
            PropertyRent::insert($insert_data);
        });
        return ["status" => true,"message" => "Rent Generated successfully"];
    }
}
