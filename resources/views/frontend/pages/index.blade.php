@extends('frontend.master')
@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
        color: white;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }
    
    .category-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
    }
    
    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .category-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    .modern-dropdown {
        border-radius: 25px;
        border: 2px solid #e9ecef;
        padding: 12px 25px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .modern-btn {
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .modern-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <h1 class="hero-title">Find Your Perfect Property Auction</h1>
                <p class="lead mb-4 fs-5">Discover upcoming auctions, completed properties, and manage your bidding experience with ease.</p>
                
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mt-4">
                    <div class="dropdown">
                        <button class="btn btn-light modern-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown" id="drop_down_value">
                            Select Category
                        </button>
                        <ul class="dropdown-menu shadow-lg border-0">
                            @foreach($categories as $key => $value)
                                <li><a class="dropdown-item" value="{{$value->catName}}" href="javascript:void(0)">{{$value->catName}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="btn btn-warning modern-btn text-dark" type="button">
                        Set Your Own Price <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-primary mb-3">Explore Categories</h2>
                <p class="lead text-muted">Browse through our diverse property categories</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($categories as $key => $value)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 shadow-sm">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset("$value->catImage") }}" alt="{{$value->catName}}" class="category-image">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-end">
                                <div class="p-4 w-100">
                                    <h4 class="text-white fw-bold mb-0">{{$value->catName}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">Explore properties in this category</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">View Properties</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Properties/Activities Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold text-primary mb-3">Featured Properties</h2>
                    <p class="text-muted">Browse through our latest property listings and auctions</p>
                </div>
                <div class="col-md-6 text-end">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle modern-dropdown" type="button" data-bs-toggle="dropdown" id="drop_down_value_search">
                            <?php echo $_GET['category'] ?? "Select Category..." ?>
                        </button>
                        <ul class="dropdown-menu shadow-lg border-0">
                            <li><a class="dropdown-item chose_category" value="All" href="javascript:void(0)">All Categories</a></li>
                            @foreach($categories as $key => $value)
                                <li><a class="dropdown-item chose_category" value="{{$value->catName}}" href="javascript:void(0)">{{$value->catName}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-4 append_task">
                @foreach($posts as $key => $value)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 property-card">
                            <div class="card-header bg-transparent border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="badge bg-primary rounded-pill">Featured</span>
                                    @if(file_exists(public_path()."$value->attachment"))
                                        <a href="<?php echo $value->attachment; ?>" class="text-decoration-none text-success">
                                            <i class="fas fa-images me-1"></i>View Photos
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark mb-3">{{$value->task_name}}</h5>
                                
                                <div class="property-details mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span class="text-muted">{{$value->city_id}}, {{$value->state_id}}</span>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar text-primary me-2"></i>
                                        <span class="text-muted">{{date("d M Y",strtotime($value->date_of_task))}}</span>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        <span class="text-muted">{{$value->time_of_task}}</span>
                                    </div>
                                </div>
                                
                                <div class="price-section mb-3">
                                    <h4 class="text-success fw-bold mb-1">${{number_format($value->offer_price)}}</h4>
                                    <small class="text-muted">Listed on: {{date("d M Y",strtotime($value->date_listed))}}</small>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <a href="{{url('/')."/viewTask/$value->id"}}" class="btn btn-primary w-100 modern-btn" post_id="{{$value->id}}">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary btn-lg see_more">
                        <i class="fas fa-plus me-2"></i>Load More Properties
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- End Properties Section -->

    <style>
        .property-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        }
        
        .property-details i {
            width: 20px;
        }
        
        .price-section {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            padding: 15px;
            border-radius: 10px;
        }
    </style>

    <!-- Call to Action Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="cta-block text-center p-5 rounded">
                        <h2 class="display-6 fw-bold text-white mb-4">Ready to Start Your Property Journey?</h2>
                        <p class="lead text-white-50 mb-4">Join thousands of satisfied customers who found their perfect property through our auction platform</p>
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                            <button class="btn btn-light btn-lg modern-btn">
                                <i class="fas fa-rocket me-2"></i>Get Started Today
                            </button>
                            <button class="btn btn-outline-light btn-lg modern-btn">
                                <i class="fas fa-phone me-2"></i>Contact Us
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Section -->

    <style>
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .cta-block {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
    <!-- Button trigger modal -->

    <!---  popup   ------>
    <!-- Modal -->
    <div id="custom_message" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn_yes">Yes</button>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function(e){
            listoffset = "{{$offset ?? 0}}";
           $("body").on("click",".accept_task",function(e){
               post_id = $(this).attr("post_id");
               $("#custom_message").modal("show");
               $('.alert_message').text("Are you sure to accept this task ?");
               //window.location = BaseUrl+"/accept-task/"+post_id;
           });


           $("body").on("click",".chose_category",function(e){
               var value = $(this).attr("value");
               $("#drop_down_value_search").text(value);
               if(value != "All")
                window.location = BaseUrl+"?category="+value;
               else
                   window.location = BaseUrl;
           });
            $("body").on("click",".btn_yes",function(e){
                window.location = BaseUrl+"/accept-task/"+post_id;
            });

            $("body").on("click",".see_more",function(e){
                $.ajax({
                    method:"POST",
                    data:{category_id:"{{isset($_GET['category']) ? $_GET['category'] : 0}}",offset:listoffset},
                    url:'<?php echo url("/getMoreTasks") ?>',
                    success:function(res){
                        if(res.status){
                            var data = res.data;
                            listoffset = res.offset;
                           if(data.length == 0){
                               $(".see_more").hide();
                           }

                            data.forEach(function(value,key){
                               $(".append_task").append(
                                   ` <div class="col-12 col-md-6 col-lg-4">
                        <div class="activities_block shadow1">
                            <div class="activities_content">
                                <h4 class="CircularStd-Black mb-2">Task name</h4>
                                <p>${value.city_id}, ${value.state_id}</p>
                                <p>Date: ${value.date_of_task}</p>
                                <p>Time: ${value.time_of_task}</p>
                                <h3 class="CircularStd-Black">${value.offer_price}  <span>



                                            <a href="#" class="font-italic text-success float-right CircularStd-book">
                                            <u>View Photos</u>
                                            </a>

                                         <h1></h1>
                                        </span>
                                </h3>
                                <p class="font-italic CircularStd-book">List on: ${value.date_listed}</p>

                                <a href="javascript:void(0)"  class="btn btn-success btn-lg mt-4 accept_task" post_id="${value.id}">Accept </a>

                            </div>
                        </div>
                    </div>`
                               );
                            });

                        }else{
                            $.notify("Error occurred while updating status.", 'error');
                        }

                    }
                });
            });

        });
    </script>
@endsection