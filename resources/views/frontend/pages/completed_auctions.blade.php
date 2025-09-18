@extends('frontend.master')

@section('content')
    <style>
        img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
        }

        /* Professional Green Theme for Completed Auctions */
        .property-item {
            background: linear-gradient(135deg, #f8fcf9 0%, #e8f5e8 100%) !important;
            border: 1px solid #27a844 !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 25px rgba(39, 168, 68, 0.15), 0 4px 10px rgba(39, 168, 68, 0.1) !important;
            transition: all 0.3s ease !important;
            overflow: hidden !important;
            position: relative !important;
            margin-bottom: 20px !important;
        }

        .property-item:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 12px 35px rgba(39, 168, 68, 0.2), 0 6px 15px rgba(39, 168, 68, 0.15) !important;
            border-color: #1e7e34 !important;
        }

        .property-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #27a844, #28a745, #20c997);
            z-index: 2;
        }

        .property-details {
            background: rgba(255, 255, 255, 0.9) !important;
            padding: 20px !important;
            border-radius: 0 0 12px 12px !important;
        }

        .property-title a {
            color: #1e7e34 !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: color 0.3s ease !important;
            font-size: 18px !important;
        }

        .property-title a:hover {
            color: #155724 !important;
        }

        .property-address, .property-agent-date {
            color: #495057 !important;
            margin: 5px 0 !important;
            font-size: 14px !important;
            display: block !important;
        }

        .property-address i, .property-agent-date i {
            color: #28a745 !important;
            margin-right: 8px !important;
        }

        .property-price {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
            color: white !important;
            padding: 8px 15px !important;
            border-radius: 25px !important;
            display: inline-block !important;
            font-weight: bold !important;
            box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3) !important;
            margin: 10px 0 !important;
            font-size: 14px !important;
        }

        .property-btn {
            background: rgba(255, 255, 255, 0.8) !important;
            padding: 15px 20px !important;
            border-radius: 0 0 12px 12px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .property-link {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
            color: white !important;
            padding: 8px 20px !important;
            border-radius: 20px !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3) !important;
        }

        .property-link:hover {
            background: linear-gradient(135deg, #218838, #17a2b8) !important;
            color: white !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4) !important;
        }

        .property-listing-actions li a {
            background: #f8f9fa !important;
            border: 1px solid #28a745 !important;
            color: #28a745 !important;
            width: 35px !important;
            height: 35px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-left: 8px !important;
            transition: all 0.3s ease !important;
        }

        .property-listing-actions li a:hover {
            background: #28a745 !important;
            color: white !important;
            transform: scale(1.1) !important;
        }

        .badge-primary {
            background: #28a745 !important;
            color: white !important;
            border-radius: 15px !important;
            padding: 5px 12px !important;
            font-weight: 500 !important;
            font-size: 12px !important;
        }

        .property-trending {
            background: linear-gradient(135deg, #ffc107, #ffca28) !important;
            color: #212529 !important;
            width: 35px !important;
            height: 35px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: bold !important;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3) !important;
        }

        .property-agent-popup a {
            background: rgba(40, 167, 69, 0.9) !important;
            color: white !important;
            padding: 6px 12px !important;
            border-radius: 15px !important;
            text-decoration: none !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            transition: background 0.3s ease !important;
        }

        .property-agent-popup a:hover {
            background: rgba(40, 167, 69, 1) !important;
        }

        .property-image {
            border-radius: 12px 12px 0 0 !important;
            overflow: hidden !important;
            position: relative !important;
        }

        .section-title h2 {
            color: #1e7e34 !important;
            font-weight: 700 !important;
            margin-bottom: 30px !important;
        }

        .section-title h4 {
            color: #dc3545 !important;
            padding: 15px !important;
            background: #f8d7da !important;
            border-radius: 8px !important;
            border: 1px solid #f5c6cb !important;
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
                         
                            <div class="">
                                <a href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}">  {{$value->totalImages}}</a>
                            </div>
                            </a>
                        </div>
                        <div class="property-details">
                            <div class="property-details-inner">
                                <h5 class="property-title"><a href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}">{{$value->auction_name}} </a></h5>
                                <!-- <div class="property-price" style="text-align: center;">{{$value->getOpenShops}}
                                    @if($value->property_type == "plaza")
                                    <span style="color: white !important;"> / Shops  available for auction. </span>
                                    @else
                                        <span style="color: white !important;"> / Plot  available for auction.</span>
                                    @endif
                                </div> -->

                            </div>
                            <div class="property-btn">
                                <a class="property-link" href="{{url("property-details/$value->id/$value->plaza_id?type=expired")}}">See Details</a>
                                <ul class="property-listing-actions list-unstyled mb-0">
                                    
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
