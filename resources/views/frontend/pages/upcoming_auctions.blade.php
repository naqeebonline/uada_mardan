@extends('frontend.master')

@section('content')
    <!-- Hero Section -->
    <section class="auctions-hero py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold text-white mb-3">Upcoming Auctions</h1>
                    <p class="lead text-white-50 mb-4">Discover exciting property opportunities in our upcoming auction events</p>
                    <div class="hero-stats d-flex justify-content-center gap-4 flex-wrap">
                        <div class="stat-item">
                            <h3 class="text-warning mb-0">{{count($auctions)}}</h3>
                            <p class="text-white-50 mb-0">Active Auctions</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="text-success mb-0">500+</h3>
                            <p class="text-white-50 mb-0">Properties Sold</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="text-info mb-0">1000+</h3>
                            <p class="text-white-50 mb-0">Happy Buyers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend._partial.filters')

    <!-- Auctions Grid Section -->
    <section class="auctions-grid py-5">
        <div class="container">
            @if(count($auctions) == 0)
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="no-auctions-card">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h3 class="text-muted mb-3">No Auctions Found</h3>
                            <p class="text-muted">We couldn't find any upcoming auctions matching your criteria. Please check back later or adjust your filters.</p>
                            <a href="{{url('/')}}" class="btn btn-primary">Back to Home</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    @foreach($auctions as $key => $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="auction-card h-100">
                                <div class="auction-image-container">
                                    <img src="{{url("/")."/".$value->plaza_img}}" alt="{{$value->auction_name}}" class="auction-image">
                                    <div class="auction-overlay">
                                        <div class="auction-badges">
                                            <span class="badge bg-primary">{{ucfirst($value->property_type)}}</span>
                                            <span class="badge bg-warning">
                                                <i class="fas fa-bolt me-1"></i>Trending
                                            </span>
                                        </div>
                                        <div class="auction-gallery">
                                            <a href="{{url("property-details/$value->id/$value->plaza_id")}}" class="gallery-btn">
                                                <i class="fas fa-camera me-1"></i>{{$value->totalImages}} Photos
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="auction-content">
                                    <div class="auction-header">
                                        <h5 class="auction-title">
                                            <a href="{{url("property-details/$value->id/$value->plaza_id")}}" class="text-decoration-none text-dark">
                                                {{$value->auction_name}}
                                            </a>
                                        </h5>
                                        
                                        <div class="auction-meta mb-3">
                                            <div class="meta-item">
                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                <span class="text-muted">{{$value->address}}</span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-clock text-primary me-2"></i>
                                                <span class="text-muted">{{$value->timeAgo}}</span>
                                            </div>
                                        </div>

                                        <div class="auction-stats">
                                            <div class="stat-highlight">
                                                <span class="stat-number">{{$value->getOpenShops}}</span>
                                                @if($value->property_type == "plaza")
                                                    <span class="stat-text">Shops Available</span>
                                                @else
                                                    <span class="stat-text">Plots Available</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="auction-actions">
                                        <a href="{{url("property-details/$value->id/$value->plaza_id")}}" class="btn btn-primary flex-fill">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="Compare">
                                                <i class="fas fa-exchange-alt"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="Add to Favorites">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Load More Auctions
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        .auctions-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        .auctions-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="1000,100 1000,0 0,100"/></svg>') no-repeat bottom;
            background-size: 100% 100px;
        }

        .stat-item {
            text-align: center;
            padding: 0 1rem;
        }

        .no-auctions-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .auction-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: none;
        }

        .auction-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .auction-image-container {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .auction-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .auction-card:hover .auction-image {
            transform: scale(1.05);
        }

        .auction-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, transparent 50%, rgba(0,0,0,0.3) 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
        }

        .auction-badges {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .auction-badges .badge {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .gallery-btn {
            background: rgba(255,255,255,0.9);
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            align-self: flex-end;
        }

        .gallery-btn:hover {
            background: white;
            color: #007bff;
        }

        .auction-content {
            padding: 1.5rem;
        }

        .auction-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .auction-title a:hover {
            color: #007bff !important;
        }

        .meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .stat-highlight {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 1rem;
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 700;
            color: #007bff;
            line-height: 1;
        }

        .stat-text {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
        }

        .auction-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .auction-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .action-buttons {
                width: 100%;
                justify-content: center;
            }
            
            .hero-stats {
                justify-content: center !important;
            }
            
            .stat-item {
                padding: 0 0.5rem;
            }
        }
    </style>

@endsection
