@extends('admin.template2')
@section('content')
    <section class="content-header">
        <h1>
            Rent & Outstandings
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Rent & Outstandings</a></li>

        </ol>
    </section>
    <br/>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Rent & Outstandings Listing</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="pull-right">
                            <a href="#" onclick="print_status('Commercial')"  style="font-size: 18px; margin-right: 10px" ><i class="fa fa-print"></i>Print All Data</a>
                            <a  href="#" style="font-size: 17px;margin-right:4px; " onclick="print_all();"><i class="fa fa-print"></i> Print All</a>
                        </div>
                        <div><br><br></div>
                        <br/>

                        <table id="example1" class="table table-bordered ">


                            <thead>
                            <tr>

                                <th>S.N</th>
                                <th>CNIC</th>
                                <th>Customer Name</th>
                                <th>Shop Name</th>
                                <th>Monthly Rent</th>
                                <th>Outstanding</th>
                                <th>Classification</th>
                                <th>Address</th>
                                <th>Duration</th>
                                <th>Lease Date</th>

                                <th style="width: 100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        @if($value->customer)
                                            <a href="javascript:void(0)" class="show_customer" data-value="{{json_encode($value)}}">{{$value->cnic}}<br>{{$value->name}}</a>
                                        @else
                                        @endif
                                        </td>
                                    <td>{{$value->name}}</td>
                                    <td><a class="show_shop" data-value="{{json_encode($value)}}" style="text-decoration: underline">{{$value->shop_name}}</a></td>

                                    <td>{{$value->current_rent}}</td>
                                    <td>{{$value->details['balance']}}</td>
                                    <td>{{$value->property_type ?? ""}}</td>
                                    <td>{{$value->address ?? ""}}</td>
                                    <td>{{$value->duration}} Years</td>
                                    <td>{{$value->lease_date}}</td>

                                    <td>

                                        <a  href="{{route("rent.show",$value->id)}}" class="btn btn-success"><i class="fa  fa-calculator"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <div class="modal fade" id="user_information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h3 class="modal-title" id="customer_name">Fazal Raheem</h3>
                    <img src="{{asset("images/tenant.png")}}" height="60" width="60" style="float: right;margin-top: -1.5em;"/>

                </div>
                <div class="modal-body">

                    <strong>CNIC: </strong><span id="customer_cnic"></span><br/>
                    <strong>Contact No: </strong><span id="customer_phone"></span><br/>
                    <strong>Email Address: </strong> <span id="customer_email"></span>                     </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="info8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <center class="span4"><br>
                    <img alt="No image on This path With This Name" src="http://lcbkp.gov.pk/img/logo.png" width="50%">
                </center>
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;font-size:20px"><strong>Property Information</strong></h5>
                    <img id="customer_img" src="" height="60" width="60" style="float: right;margin-top: -1.5em;"/>
                </div>
                <div class="modal-body">
                    <div class="brow"><strong>Demand Number: </strong><span id="shp_number"></span><br/></div>
                    <div class="brow"><strong>Property Address: </strong><span id="shp_address"></span><br/></div>
                    <div class="brow"><strong>Location: </strong><span id="shp_location"></span><br/></div>

                    <div class="brow"><strong>Geo Location: </strong><span id="shp_geo"></span><br/></div>
                    <div class="brow"><strong>Classification: </strong><span id="shp_property_type"></span><br/></div>
                    <div class="brow"><strong>Monthly Rent: </strong><span id="shp_rent"></span><br/></div>
                    <div class="brow"><strong>Paid Amount Till Today: </strong><span id="shp_dr"></span><br/></div>
                    <div class="brow"><strong>Total Payable Till Now: </strong><span id="shp_cr"></span><br/></div>
                    <div class="brow"><strong>Balance: </strong><span id="shp_balance"></span><br/></div>
                    <div class="brow"><strong>Reference No: </strong>1-2<br/></div>
                    <div class="brow"><strong>Registration Date: </strong><span id="shp_lease_date"></span><br/></div>
                    <div class="brow"><strong>Expiry Date: </strong><span id="shp_expiry_date"></span><br/></div>
                    <div class="brow"><strong>Property transfer: </strong><strong style='margin-left: 11px;color: red;'>There is No File Attachment</strong><br></div>
                    <div class="brow"><strong>Agreement upload: </strong><strong style='margin-left: 11px;color: red;'>There is No File Attachment</strong><br></div>

                    <div class="brow"><strong>Image: </strong>
                        <img alt="No image on This path With This Name" id="shp_img"  src="" width="80%">
                    </div>

                    <br/>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $("body").on("click",".show_shop",function(e){
        $("#shp_img").attr("src","");
        $("#customer_img").attr("src","");
        var value = JSON.parse($(this).attr("data-value"));
            console.log(value);
        var details = value.details;
        var customer = details.tenant.customer;
        var shop = details.tenant.shop;
        var customer_image = BaseUrl+"/"+customer.image
        var shop_image = BaseUrl+"/"+shop.attachment
        $("#shp_number").html(shop.shop_name);
        $("#shp_address").html(value.address);
        $("#shp_location").html(value.address);
        $("#shp_geo").html(shop.lat+","+shop.lng);
        $("#shp_property_type").html(shop.property_type);
        $("#shp_rent").html(shop.current_rent);
        $("#shp_dr").html(details.dr);
        $("#shp_cr").html(details.cr);
        $("#shp_balance").html(parseFloat(details.balance));
        $("#shp_lease_date").html(details.tenant.lease_date);
        $("#shp_expiry_date").html(details.tenant.expiry_date);
        $("#info8").modal("show");
        $("#shp_img").attr("src",customer_image);
        $("#customer_img").attr("src",shop_image);

    });


    $("body").on("click",".show_customer",function(e){

        var value = JSON.parse($(this).attr("data-value"));

        $("#customer_name").html(value.name);
        $("#customer_cnic").html(value.cnic);

        $("#customer_phone").html(value.phoneNumber);
        $("#customer_email").html(value.email);
        $("#user_information").modal("show");

    });

    function print_all() {
        var w = window.open("{{url('/printAllOutstanding')}}",'name','width=800,height=500');
        w.onload = w.print;
        w.focus();
    }

    function print_single(id) {
        var w = window.open("{{url('/printCommercial/')}}/"+id,'name','width=800,height=500');
        w.onload = w.print;
        w.focus();
    }

    function print_status(status = "") {
        var w = window.open("{{url('/printMonthlyReport')}}?type="+status,'name','width=800,height=500');
        w.onload = w.print;
        w.focus();
    }
</script>

@endsection






