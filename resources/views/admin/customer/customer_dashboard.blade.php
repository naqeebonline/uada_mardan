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
                            <p class="big">{{$total_property ?? 0}}</p>
                            <p class="title">My Properties</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_shops ?? 0}}</p>
                            <p class="title">My Shops</p>
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
                            <p class="title">My Plots</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$open_auctions ?? 0}}</p>
                            <p class="title">Open Auctions</p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_value_property ?? 0}}</p>
                            <p class="title"><p class="title">My Property Value</p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa fa-signal"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$highest_value_plot ?? 0}}</p>
                            <p class="title">Highest value Plot</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-signal"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$highest_value_shop ?? 0}}</p>
                            <p class="title">Highest value Shop</p>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$upcomming_auctions ?? 0}}</p>
                            <p class="title">UpComming Auctions</p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa-building-o"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$auction_participation ?? 0}}</p>
                            <p class="title"><p class="title">No of auction Participated</p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile tile-orange">
                        <div class="img">
                            <i class="fa fa fa-square"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$number_of_bids ?? 0}}</p>
                            <p class="title">Number of Bids Placed</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_payable_rent ?? 0}}</p>
                            <p class="title">Payable Rent/Month</p>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="tile tile-dark-blue">
                        <div class="img">
                            <i class="fa fa-times"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{($auction_participation)-($total_property)}}</p>
                            <p class="title">un-successful Auctions</p>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    <!-- END Tiles -->

@endsection


