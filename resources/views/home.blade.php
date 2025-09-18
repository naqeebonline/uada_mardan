@extends('frontend.master')

@section('content')
    <style>
        /* Enhanced Property Card Styles */
        .property-item {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid rgba(45, 106, 47, 0.1);
            position: relative;
        }

        .property-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(45, 106, 47, 0.25);
            border-color: rgba(74, 140, 82, 0.3);
        }

        .property-image {
            position: relative;
            border-radius: 20px 20px 0 0;
            overflow: hidden;
            height: 220px;
        }

        .property-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .property-item:hover .property-image img {
            transform: scale(1.1);
        }

        .property-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(45, 106, 47, 0.1), rgba(74, 140, 82, 0.2));
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .property-item:hover .property-image::before {
            opacity: 1;
        }

        .property-lable {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 3;
        }

        .badge-primary {
            background: linear-gradient(135deg, #2d6a2f, #4a8c52) !important;
            color: white !important;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(45, 106, 47, 0.3);
        }

        .property-agent-popup {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 3;
        }

        .property-agent-popup a {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #5a6b2e !important;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .property-agent-popup a:hover {
            background: #4a8c52;
            color: white !important;
            transform: scale(1.05);
        }

        .property-details {
            padding: 25px;
            position: relative;
        }

        .property-details::before {
            content: '';
            position: absolute;
            top: 0;
            left: 25px;
            right: 25px;
            height: 3px;
            background: linear-gradient(90deg, #2d6a2f, #4a8c52);
            border-radius: 2px;
        }

        .property-title {
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .property-title a {
            color: #2d3748;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
            line-height: 1.4;
        }

        .property-title a:hover {
            color: #4a8c52;
        }

        .property-home {
            display: block;
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .property-home i {
            color: #4a8c52;
            margin-right: 8px;
        }

        .property-price {
            margin-top: 15px !important;
        }

        .property-agent-date {
            display: block;
            padding: 12px 0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
        }

        .property-agent-date i {
            color: #dc3545;
            margin-right: 8px;
        }

        .auction-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 15px;
            border-radius: 12px;
            margin: 15px 0;
            border-left: 4px solid #4a8c52;
        }

        .shop-count {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(45, 106, 47, 0.1);
            padding: 12px 16px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .shop-count-number {
            font-size: 24px;
            font-weight: 800;
            color: #2d6a2f;
        }

        .shop-count-text {
            font-size: 13px;
            color: #2d6a2f;
            font-weight: 600;
        }

        .property-btn {
            padding: 0 25px 25px;
        }

        .property-link {
            display: block;
            text-align: center;
            background: linear-gradient(135deg, #4a8c52, #2d6a2f);
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .property-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .property-link:hover::before {
            left: 100%;
        }

        .property-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 106, 47, 0.4);
            color: #ffffff !important;
            background: linear-gradient(135deg, #6bb26f, #4a8c52);
            border-color: #6bb26f;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .section-title h2 {
            color: #2d3748;
            font-weight: 800;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #2d6a2f, #4a8c52);
            border-radius: 2px;
        }

        .no-auction-message {
            background: linear-gradient(135deg, #fff5f5, #fed7d7);
            border: 2px solid #feb2b2;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            margin: 40px 0;
        }

        .no-auction-message h4 {
            color: #c53030 !important;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .no-auction-message p {
            color: #744210;
            font-size: 16px;
            margin-bottom: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .property-item {
                margin-bottom: 20px;
            }

            .property-details {
                padding: 20px;
            }

            .property-btn {
                padding: 0 20px 20px;
            }

            .property-image {
                height: 200px;
            }

            .property-image img {
                height: 200px;
            }
        }

        /* Animation for loading */
        .property-item {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered animation for multiple items */
        .property-item:nth-child(1) { animation-delay: 0.1s; }
        .property-item:nth-child(2) { animation-delay: 0.2s; }
        .property-item:nth-child(3) { animation-delay: 0.3s; }
        .property-item:nth-child(4) { animation-delay: 0.4s; }
        .property-item:nth-child(5) { animation-delay: 0.5s; }
        .property-item:nth-child(6) { animation-delay: 0.6s; }
    </style>
    @include('frontend._partial.filters')
    <br>
    <section class="space-pb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2>Open for Auction (نیلامی کے لیے دستیاب ہے)</h2>
                      
                    </div>

                    @if(count($auctions) == 0)
                        <div class="no-auction-message">
                            <h4>No Auction Found</h4>
                            <p>Currently, there are no auctions available for bidding. Please check back later for updates.</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">



                @foreach($auctions as $key => $value)
                    <div class="col-sm-6 col-lg-4">
                        <div class="property-item">
                            <div class="property-image">
                                <a href="{{url("property-details/$value->auction_id/$value->plaza_id")}}">
                                    <img src="{{url("/")."/".$value->plaza_img}}" alt="{{$value->auction_name}}">
                                    <div class="property-lable">
                                        <span class="badge badge-md badge-primary">{{ucfirst($value->property_type)}}</span>
                                    </div>
                                    <div class="property-agent-popup">
                                        <a href="{{url("property-details/$value->auction_id/$value->plaza_id")}}">
                                            <i class="fas fa-camera"></i> {{$value->totalImages}}
                                        </a>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="property-details">
                                <div class="property-details-inner">
                                    <h5 class="property-title">
                                        <a href="{{url("property-details/$value->auction_id/$value->plaza_id")}}">
                                            {{$value->auction_name}}
                                        </a>
                                    </h5>
                                    
                                    <span class="property-home">
                                        <i class="fas fa-map-marker-alt"></i>{{$value->org_name ?? ""}}
                                    </span>
                                    
                                    <div class="auction-info">
                                        <span class="property-agent-date">
                                            <i class="far fa-clock"></i>
                                            {{$value->start_date_time ?? ""}} To {{$value->end_date_time ?? ""}}
                                        </span>
                                    </div>
                                    
                                    <div class="shop-count">
                                        <div>
                                            <div class="shop-count-number">{{$value->getOpenShops}}</div>
                                            <div class="shop-count-text">
                                                @if($value->property_type == "plaza")
                                                    Shops Available
                                                @else
                                                    Plots Available
                                                @endif
                                            </div>
                                        </div>
                                        <i class="fas fa-{{ $value->property_type == 'plaza' ? 'store' : 'map' }}" style="font-size: 24px; color: #4a8c52; opacity: 0.3;"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="property-btn">
                                <a class="property-link" href="{{url("property-details/$value->auction_id/$value->plaza_id")}}">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{--<div class="col-12 text-center">
                    <a class="btn btn-link" href="property-list.html"><i class="fas fa-plus"></i>View All Listings</a>
                </div>--}}
            </div>
        </div>
    </section>

@endsection
