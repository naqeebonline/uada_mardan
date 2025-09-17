@extends('frontend.master')

@section('content')
    <style>

        img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
        }


    </style>
    {{--@include('frontend._partial.archive_filters')--}}
    <br>
    <section class="space-pb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2>Completed Auctions</h2>

                    </div>
                    @if(count($auctions) == 0)
                        <div class="section-title text-center">
                            <h4 style="color: red; ">No Auction found</h4>

                        </div>

                    @endif
                </div>
            </div>
            {{ $auctions->links() }}
            <div class="row">
              
                @foreach($auctions as $key => $value)
                    <div class="col-sm-6 col-md-4">
                    <div class="property-item">
                        <div class="property-image bg-overlay-gradient-04 item" >
                            <a href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}">
                            <img class="" style="width:380px; height:150px;" src="{{url("/")."/".$value->plaza_img}}" alt="">
                            <div class="property-lable">
                                <span class="badge badge-md badge-primary">{{ucfirst($value->property_type)}}</span>

                            </div>
                            <span class="property-trending" title="trending"><i class="fas fa-bolt"></i></span>

                            <div class="property-agent-popup">
                                <a href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}"><i class="fas fa-camera"></i> {{$value->totalImages}}</a>
                            </div>
                            </a>
                        </div>
                        <div class="property-details">
                            <div class="property-details-inner">
                                <h5 class="property-title"><a href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}">{{$value->auction_name}} </a></h5>
                                <span class="property-address"><i class="fas fa-map-marker-alt fa-xs"></i>{{$value->address}}</span>
                                <span class="property-agent-date"><i class="far fa-clock fa-md"></i>{{$value->timeAgo ?? ""}}</span>
                                <div class="property-price">{{$value->getOpenShops}}

                                    @if($value->property_type == "plaza")
                                    <span> / Shops  available for auction. </span>
                                    @else
                                        <span> / Plot  available for auction.</span>
                                    @endif


                                </div>

                            </div>
                            <div class="property-btn">
                                <a class="property-link" href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}">See Details</a>
                                <ul class="property-listing-actions list-unstyled mb-0">
                                    <li class="property-compare"><a data-toggle="tooltip" data-placement="top" title="Compare" href="#"><i class="fas fa-exchange-alt"></i></a></li>
                                    <li class="property-favourites"><a data-toggle="tooltip" data-placement="top" title="Favourite" href="#"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                

               {{-- <div class="col-12 text-center">
                    <a class="btn btn-link" href="property-list.html"><i class="fas fa-plus"></i>View All Listings</a>
                </div>--}}
            </div>
        </div>
    </section>

@endsection
