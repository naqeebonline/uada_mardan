@extends('admin.template2')
@section('content')
    <section class="content" style="min-height: 0px;">
        <!-- Info boxes -->
        <div class="row">
            <div class="box-body">
                <div class="pull-right">
                    <a href="#" onclick="print_status('Commercial')" style="font-size: 17px;margin-right:4px; "><i class="fa fa-print"></i>All Commercial</a>
                    <a href="#" onclick="print_status('Residential')" style="font-size: 17px;margin-right:4px; " ><i class="fa fa-print"></i>All Residential </a>
                    <a href="#" onclick="print_status()"  style="font-size: 18px; margin-right: 10px" ><i class="fa fa-print"></i>Print All Data</a>
                    {{--<a href="#" style="font-size: 17px;margin-right:10px;" onclick="print_res();"><i class="fa fa-print"></i>Print All Receipts</a>--}}

                    <div style="float: right;display:flex;">
                        <select id="depart"  onchange="location = this.value;"   class=" form-control">
                            <option disabled >Department Wise Residential Property Print</option>
                            <option value="https://properties-cdgp.com/root/print_residential_property_all/">All</option>
                            <option value='https://properties-cdgp.com/root/print_residential_property_all/City District Government '>City District Government  </option>  <option value='https://properties-cdgp.com/root/print_residential_property_all/TMA Town-1 Peshawar '>TMA Town-1 Peshawar  </option>  <option value='https://properties-cdgp.com/root/print_residential_property_all/WSSP'>WSSP </option>                 </select>
                        <!--<a href="#" onclick="print_all()"  style="font-size: 18px;" ><i class="fa fa-print"></i></a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Tenants</span>
                        <span class="info-box-number">{{$active_tenants ?? 0}}<small></small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Open Plots</span>
                        <span class="info-box-number">{{$open_plots}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-pie-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Premium / Auction property</span>
                        <span class="info-box-number">2</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-edit"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Court cases In Progress</span>
                        <span class="info-box-number">{{$case_in_progress ?? 0}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-6">


                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Search Criteria</h3>

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                     <div class="box-body" style="position:releative;">

                            <div class="form-group row">
                                <label class="col-sm-3">Select From Date:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control form-control-round" name="first_date" id="first_date" placeholder="" required value="{{$_GET['from_date'] ?? ""}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Select To Date:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control form-control-round"  name="second_date"  id="second_date" placeholder="" required value="{{$_GET['to_date'] ?? ""}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <div class="col-sm-8">

                                    <a class="btn btn-success pull-right show_history" >Show History</a>
                                </div>
                            </div>


                        </div>


                </div>

                <style>
                    .im
                    {
                        position: absolute;
                        top: 43px;
                        right: 10px;
                        width: 128px;
                        height: 128px;
                    }
                </style>




            </div>

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-6">
                <div class="box  box-success">
                    <div class="box-header" style="padding-bottom:0px;">
                        <h3 class="box-title">Receipt History</h3>
                        <a class="btn btn-primary float-right" onclick="print_all()" style="float: right !important;">Print All</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>Date</th>
                                <th>Amount</th>
                                <th>Tenant Name</th>
                                <th>Nic</th>
                                <th>Demand No</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0; ?>
                            @foreach($recipts as $key => $value)
                                <?php $total = ($total)+($value->dr) ?>
                            <tr>
                                <td>  {{date("d-m-Y",strtotime($value->bill_generate_date))}}</td>
                                <td class="r"> {{$value->dr}}</td>
                                <td>{{$value->name}}                  </td>
                                <td>{{$value->cnic}}</td>
                                <td> {{$value->shop_name}}</td>

                            </tr>
                           @endforeach

                            </tbody>
                            <tfoot>
                            <td>Total Amount</td>
                            <td class="r">{{$total}}.00</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tfoot>

                        </table>
                    </div>

                </div>


            </div>

            <div class="col-xs-6">


                <div class="box  box-success">
                    <div class="box-header" style="padding-bottom:0px;">
                        <h3 class="box-title">Rent History</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>Date</th>
                                <th>Month</th>
                                <th>Tenant Name</th>
                                <th>Nic</th>
                                <th>Demand No</th>
                                <th>Rent</th>
                                <th>Paid</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Total Balance</td>
                                <td class="r">0.00</td>
                                <td></td><td></td>
                                <td></td><td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>


    </section>

    <link rel="stylesheet" href="{{asset('plaza_admin_assets/css/bootstrap-datetimepicker.css')}}">
    <script src="{{asset('plaza_admin_assets/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript">
        $("body").on("click",".show_history",function(e){
           var from_date = $("#first_date").val();
           var to_date = $("#second_date").val();
           window.location = "{{route('reports.index')}}?from_date="+from_date+"&to_date="+to_date
        });
        function print_all() {
            var from_date = $("#first_date").val();
            var to_date = $("#second_date").val();
            if(from_date !="" && to_date !=""){
                var w = window.open("{{url('/printAllRecipts')}}?from_date="+from_date+"&to_date="+to_date,'name','width=800,height=500');
                w.onload = w.print;
                w.focus();
            }else{
                var w = window.open("{{url('/printAllRecipts')}}",'name','width=800,height=500');
                w.onload = w.print;
                w.focus();
            }

        }

        function print_status(status = "") {
            var w = window.open("{{url('/printAllByType')}}?type="+status,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }
    </script>



@endsection






