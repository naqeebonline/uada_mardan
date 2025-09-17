@extends('admin.template')
@section('content')
    <style>
        .tile p.title {
            font-size: 12px;
            margin-bottom: 2px;
        }

        .tile .content > p.big {
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 0;
        }
        .tile .img > [class*="fa-"] {
            font-size: 43px;
        }
    </style>


    <!-- BEGIN Tiles -->
    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa-building-o"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_tma_properties ?? 0}}</p>
                            <p class="title">TMA Properties</p>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa fa-square"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_plots ?? 0}}</p>
                            <p class="title">Total Number of Plots</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_shops ?? 0}}</p>
                            <p class="title">Total Number of Shops</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-building-o"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_plaza ?? 0}}</p>
                            <p class="title">Total Number of Plaza</p>
                        </div>
                    </div>
                </div>


            </div>




        </div>
    </div>

    <!-- END Tiles -->

    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa-building-o"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_lease_out ?? 0}}</p>
                            <p class="title">Total Property Lease Out</p>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$lease_out_plaza ?? 0}}</p>
                            <p class="title">No of Shops Lease out</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa fa-square"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$lease_out_plots ?? 0}}</p>
                            <p class="title">No of Plots Lease out</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-building-o"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$proprty_to_be_auctioned ?? 0}}</p>
                            <p class="title">Properties to be Auctioned</p>
                        </div>
                    </div>
                </div>




            </div>




        </div>
    </div>

    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$property_rent_per_month ?? 0}}</p>
                            <p class="title">Property Rent/Month</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$estimated_premium ?? 0}}</p>
                            <p class="title">Estimated Premium</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$offeredPermium ?? 0}}</p>
                            <p class="title">Offered by Customer</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_plots ?? 0}}</p>
                            <p class="title">Increase in Premium (%age)</p>
                        </div>
                    </div>
                </div>




            </div>




        </div>
    </div>

    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$getTotalOpenAuctions ?? 0}}</p>
                            <p class="title">Published Auctions</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$getTotalOpenAuctions ?? 0}}</p>
                            <p class="title">Active Auctions</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$upcommingAuctions ?? 0}}</p>
                            <p class="title">Upcomming Auctions</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa fa-lock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$completedAuctions ?? 0}}</p>
                            <p class="title">Archive Auctions</p>
                        </div>
                    </div>
                </div>




            </div>




        </div>
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$active_tenants ?? 0}}</p>
                            <p class="title">Active Tenants</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$deactive_tenants ?? 0}}</p>
                            <p class="title">Deactive Tenants</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{($deactive_tenants) + ($active_tenants)}}</p>
                            <p class="title">TOTAL TENANTS</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$recipts ?? 0}}</p>
                            <p class="title">TOTAL RECEIPTS</p>
                        </div>
                    </div>
                </div>






            </div>




        </div>
    </div>




        <h3>Within 7 Days Hearing Date Court Cases</h3>
        <hr>
        <div class="table-responsive" style="background: white !important;">

            <table class="table table-advance">
                <thead>
                <tr>
                    <th style="width: 13%">Court Name</th>
                    <th style="width: 13%">Case Title</th>
                    <th style="width: 13%">Case Number</th>
                    <th style="width: 13%">Lawyer Name</th>
                    <th style="width: 13%">Case Status</th>
                    <th style="width: 13%" >Prev Hearing Date</th>
                    <th style="width: 13%">Next Hearing Date</th>

                    <th style="width: 300px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($case as $key => $value)
                    <tr>
                        <td>{{$value->court_name}}</td>
                        <td>{{$value->case_title}}</td>
                        <td>{{$value->case_number}}</td>
                        <td>{{$value->lawyer_name ?? ""}}</td>
                        <td>{{$value->case_status}}</td>
                        <td>{{(count($value->hearing) >= 2) ? date("d-m-Y",strtotime($value->hearing[1]->heiring_date)) : ""}}</td>
                        <td>{{(count($value->hearing) >= 1) ? date("d-m-Y",strtotime($value->hearing[0]->heiring_date)) : ""}}</td>
                        <td>

                            <a class="btn btn-circle show-tooltip" target="_blank" href="{{url("settings/case-details")."/$value->id"}}" ><i class="fa fa-eye"></i></a>
                            <a class="btn btn-circle show-tooltip" title=""href="{{url("print-case")."/$value->id"}}" ><i class="fa fa-print"></i></a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


@endsection


