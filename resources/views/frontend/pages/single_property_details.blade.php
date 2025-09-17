@extends('frontend.master')

@section('content')

<style>
    .owl-carousel .owl-item img {

        width: 100% !important;
    }

    .colorDefinition {
        background: #ffffff !important;;
        color: #b5061b !important;
        border-color: #b5061b;
        font-size: 12px;
    }

    .colorDefinition1 {
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 0.05em;
        color: #2d3748 !important;
        text-transform: uppercase;
    }
    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 0px solid #dee2e6;
    }
    .font_size{
        font-weight: bold;
    }

    .modal-body {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 0.50rem;
    }
    
    .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

/* Enhanced Tab Styling */
.nav-tabs {
    border-bottom: 2px solid #bad164;
    margin-bottom: 1rem;
}

.nav-tabs .nav-item {
    margin-bottom: -1px;
}

.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    padding: 4px 8px;
    font-weight: 600;
    font-size: 10px;
    color: #6c757d;
    background: #f8f9fa;
    margin-right: 3px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.nav-tabs .nav-link:hover {
    border-color: #bad164;
    color: #a8c356;
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(186, 209, 100, 0.2);
}

.nav-tabs .nav-link.active {
    color: #ffffff !important;
    background: linear-gradient(135deg, #bad164, #a8c356) !important;
    border-color: #bad164;
    box-shadow: 0 8px 25px rgba(186, 209, 100, 0.3);
    transform: translateY(-3px);
}

.nav-tabs .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.nav-tabs .nav-link:hover::before {
    left: 100%;
}

/* Enhanced Tab Content */
.tab-content {
    background: #ffffff;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(186, 209, 100, 0.2);
}

.tab-pane {
    animation: fadeInUp 0.5s ease;
}

.nav-tabs .nav-item .nav-link {
    border: none;
    font-size: 12px !important;
    padding: 20px 20px;
    font-family: "Barlow Semi Condensed", sans-serif;
    text-transform: uppercase;
    font-weight: 600;
    border-bottom: 3px solid transparent;
    color: #001935;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Table Styling */
.table {
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #bad164, #a8c356);
    color: white;
    font-weight: 600;
    border: none;
    padding: 15px;
}

.table tbody tr:nth-child(even) {
    background-color: rgba(186, 209, 100, 0.05);
}

.table tbody tr:hover {
    background-color: rgba(186, 209, 100, 0.1);
    transform: scale(1.01);
    transition: all 0.2s ease;
}

.table td {
    padding: 12px 15px;
    vertical-align: middle;
}

/* Print Button Enhancement */
.btn-warning {
    background: linear-gradient(135deg, #bad164, #a8c356) !important;
    border: none !important;
    color: white !important;
    font-weight: 600;
    border-radius: 25px;
    padding: 10px 20px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(186, 209, 100, 0.3);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(186, 209, 100, 0.4);
    color: white !important;
}

/* Professional Countdown Timer Styling */
.countdown-container {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 1px solid #bad164;
    border-radius: 8px;
    padding: 10px;
    margin: 8px 0;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.countdown-label {
    font-size: 9px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
    display: block;
}

.countdown-timer {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    font-weight: 700;
    color: #a8c356;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    line-height: 1;
}

/* Property Info Styling */
.property-info-card {
    background: #ffffff;
    border-radius: 8px;
    padding: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(186, 209, 100, 0.2);
    margin-bottom: 10px;
}

.property-title {
    color: #2d3748;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
}

.property-info-item {
    display: flex;
    align-items: center;
    margin-bottom: 6px;
    padding: 3px 0;
}

.property-info-item i {
    color: #a8c356;
    margin-right: 10px;
    font-size: 14px;
    width: 20px;
}

.property-info-text {
    color: #5a6b2e;
    font-size: 11px;
    font-weight: 500;
}

.bid-info-section {
    background: linear-gradient(135deg, #fff5f5, #fef2f2);
    border: 1px solid #fed7d7;
    border-radius: 8px;
    padding: 10px;
    margin: 10px 0;
    text-align: center;
}

.max-bid-text {
    font-size: 10px;
    font-weight: 600;
    color: #c53030;
    margin-bottom: 10px;
}

.bid-amount {
    font-size: 16px;
    font-weight: 800;
    color: #c53030;
    font-family: 'Arial', sans-serif;
}

/* Bid Input Styling */
.bid-input-section {
    background: #ffffff;
    border: 1px solid #bad164;
    border-radius: 8px;
    padding: 10px;
    margin-top: 10px;
}

.bid-input-section .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 8px 10px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.bid-input-section .form-control:focus {
    border-color: #bad164;
    box-shadow: 0 0 0 3px rgba(186, 209, 100, 0.1);
}

.place-bid-btn {
    background: linear-gradient(135deg, #bad164, #a8c356) !important;
    border: none !important;
    color: white !important;
    font-weight: 600;
    border-radius: 10px;
    padding: 12px 20px;
    width: 100%;
    transition: all 0.3s ease;
}

.place-bid-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(186, 209, 100, 0.4);
}

.word-display {
    color: #a8c356 !important;
    font-size: 12px;
    font-style: italic;
    margin-top: 8px;
}

/* Mobile Responsive Styles */
@media (max-width: 992px) {
    .property-title {
        font-size: 14px;
    }
    
    .countdown-timer {
        font-size: 12px;
    }
    
    .bid-amount {
        font-size: 14px;
    }
    
    .property-info-card {
        padding: 20px;
        margin-bottom: 15px;
    }
    
    .property-info-text {
        font-size: 10px;
    }
}

@media (max-width: 768px) {
    .property-title {
        font-size: 13px;
        text-align: center;
    }
    
    .countdown-container {
        padding: 8px;
        margin: 5px 0;
    }
    
    .countdown-timer {
        font-size: 11px;
    }
    
    .bid-amount {
        font-size: 13px;
    }
    
    .property-info-card {
        padding: 10px;
    }
    
    .bid-input-section {
        padding: 8px;
    }
    
    .nav-tabs .nav-link {
        padding: 3px 6px;
        font-size: 9px;
    }
    
    .tab-content {
        padding: 10px;
    }
    
    .table {
        font-size: 10px;
    }
    
    .table td, .table th {
        padding: 6px;
    }
    
    .property-info-text {
        font-size: 10px;
    }
    
    .max-bid-text {
        font-size: 9px;
    }
}

@media (max-width: 576px) {
    .property-title {
        font-size: 12px;
    }
    
    .countdown-timer {
        font-size: 10px;
    }
    
    .bid-amount {
        font-size: 12px;
    }
    
    .nav-tabs .nav-link {
        padding: 2px 4px;
        font-size: 8px;
    }
    
    .tab-content {
        padding: 8px;
    }
    
    .property-info-card {
        padding: 8px;
    }
    
    .bid-input-section {
        padding: 8px;
    }
    
    .table {
        font-size: 9px;
    }
    
    .table td, .table th {
        padding: 4px;
    }
    
    .property-info-text {
        font-size: 9px;
    }
    
    .max-bid-text {
        font-size: 8px;
    }
    
    .bid-input-section .form-control {
        font-size: 9px;
        padding: 4px 6px;
    }
}

/* Image Gallery Responsive */
@media (max-width: 768px) {
    .owl-carousel .owl-item img {
        height: 300px;
        object-fit: cover;
    }
}

@media (max-width: 576px) {
    .owl-carousel .owl-item img {
        height: 250px;
    }
}

/* Additional small font size controls */
.table {
    font-size: 11px;
}

.table th {
    font-size: 11px;
    font-weight: 600;
}

.table td {
    font-size: 11px;
}

/* Print button font size */
.btn-warning {
    font-size: 11px;
    padding: 8px 16px;
}

/* Modal font sizes */
.modal-title {
    font-size: 12px;
}

.modal-body {
    font-size: 11px;
}

.btn {
    font-size: 11px;
}

/* General text content */
p {
    font-size: 11px;
    line-height: 1.4;
}

/* Breadcrumb font size */
.breadcrumb {
    font-size: 10px;
}

/* Icon sizes */
.property-info-item i {
    font-size: 12px;
}

/* Label sizes */
.countdown-label {
    font-size: 10px;
}

.word-display {
    font-size: 10px !important;
}

/* Minimal container spacing for ultra-compact design */
body {
    margin: 0;
    padding: 0;
}

.container, .container-fluid {
    padding-left: 6px;
    padding-right: 6px;
}

.row {
    margin-left: -3px;
    margin-right: -3px;
}

.col, .col-md-8, .col-md-4, .col-lg-8, .col-lg-4 {
    padding-left: 3px;
    padding-right: 3px;
}

@media (max-width: 576px) {
    .container, .container-fluid {
        padding-left: 2px;
        padding-right: 2px;
    }
    
    .row {
        margin-left: -1px;
        margin-right: -1px;
    }
    
    .col, .col-md-8, .col-md-4, .col-lg-8, .col-lg-4 {
        padding-left: 1px;
        padding-right: 1px;
    }
}

</style>
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb mb-0 flex-wrap" style="font-size: 10px;">
                    <li class="breadcrumb-item">
                        <a href="{{url('/')}}" class="text-decoration-none"> 
                            <i class="fas fa-home" style="font-size: 10px;"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fas fa-chevron-right mx-2" style="font-size: 8px;"></i> 
                        <a href="#" class="text-decoration-none">Property Details</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <i class="fas fa-chevron-right mx-2" style="font-size: 8px;"></i> 
                        <span class="text-truncate" style="max-width: 200px;" title="{{$value->shop_name}}">{{$value->shop_name}}</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="wrapper">
    <!--=================================
    Property details -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0 order-lg-2">
                    <div class="sticky-top">
                        <div class="property-info-card">
                            <h3 class="property-title">{{$value->shop_name}}</h3>
                            
                            <div class="property-info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="property-info-text">{{$value->location}}</span>
                            </div>
                            
                            <div class="property-info-item">
                                <i class="fas fa-tag"></i>
                                <span class="property-info-text"><strong>Starting Bid:</strong> {{$value->starting_bid_amount}}</span>
                            </div>
                            
                            <div class="countdown-container">
                                <span class="countdown-label">Auction Ends In</span>
                                <div id="given_date" class="countdown-timer"></div>
                            </div>
                            
                            <div class="bid-info-section">
                                <div class="max-bid-text blink_me">Highest {{$value->future_use}} Bid Received</div>
                                <div class="bid-amount blink_me">{{$value->premium}} PKR</div>
                            </div> 
                            @if($show_clock)
                            <div class="bid-input-section">
                                <div class="row">
                                    <div class="col-8 col-sm-7">
                                        <input type="number" 
                                               onkeyup="word.innerHTML=convertNumberToWords(this.value)"  
                                               id="input_{{$value->id}}" 
                                               class="form-control entered_amount" 
                                               placeholder="Enter bid amount">
                                        <div id="word" class="word-display"></div>
                                    </div>
                                    <div class="col-4 col-sm-5">
                                        <a class="btn place-bid-btn place_bid" 
                                           shp_id="{{$value->id}}" 
                                           auction_id="{{$auction_id}}">Place Bid</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 order-lg-1">
                    <div class="property-detail-img popup-gallery mb-4">
                        <div class="owl-carousel" 
                             data-animateOut="fadeOut" 
                             data-nav-arrow="true" 
                             data-items="1" 
                             data-md-items="1" 
                             data-sm-items="1" 
                             data-xs-items="1" 
                             data-xx-items="1" 
                             data-space="0"
                             style="border-radius: 15px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">

                            @foreach($value->getShopsImages as $key2 => $value2)
                            <div class="item">
                                <a class="portfolio-img" href="{{url("/")."/".$value2->attachment}}">
                                    <img class="img-fluid" src="{{url("/")."/".$value2->attachment}}" alt="Property Image" style="width: 100%; height: 400px; object-fit: cover;">
                                </a>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="w-100">

                        <ul class="nav nav-tabs mb-4" id="propertyTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-03-tab" data-bs-toggle="tab" data-toggle="tab" href="#tab-03" role="tab" aria-controls="tab-03" aria-selected="true">Bids</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-04-tab" data-bs-toggle="tab" data-toggle="tab" href="#tab-04" role="tab" aria-controls="tab-04" aria-selected="false">Documents</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-05-tab" data-bs-toggle="tab" data-toggle="tab" href="#tab-05" role="tab" aria-controls="tab-05" aria-selected="false">Advertisement Details</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-06-tab" data-bs-toggle="tab" data-toggle="tab" href="#tab-06" role="tab" aria-controls="tab-06" aria-selected="false">Terms And Conditions</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="tab-03" role="tabpanel" aria-labelledby="tab-03-tab">
                                @if(!$show_clock && $auction_status !="published")
                              <a class="btn btn-warning btn-sm " href="{{url("printPdfReport/")."/$auction_id/$value->id"}}" shp_id="{{$value->id}}" auction_id="{{$auction_id}}"  style=" color:black; padding: 12px 4px; float: right; ">Print Bidders</a>
                                @endif
                                <br>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Bidder Name</th>
                                        <th>Bid Amount</th>
                                        <th>Date Time</th>
                                    </tr>
                                @foreach($bidders as $key => $value)
                                    <tr>
                                        <td>{{$value->bidder_name}}</td>
                                        <td>{{$value->bid_amount}}</td>
                                        <td>{{date("d-m-Y h:i:s A",strtotime($value->created_at))}}</td>
                                    </tr>
                                @endforeach
                                </table>
                                <p class="text-right">


                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab-04" role="tabpanel" aria-labelledby="tab-04-tab">
                                <table class="table table-advance">
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Image/Document</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shop_documents as $key => $value)
                                        <tr>
                                            <td>{{strtoupper($value->type)}}</td>
                                            <td>
                                                {{$value->title}}
                                            </td>
                                            <td>
                                                @if($value->type == "image")
                                                    <a href="{{url("/")."/$value->attachment"}}">
                                                        <img style="width: 35px; height: 35px" src="{{url("/")."/$value->attachment"}}" class="img img-circle">
                                                    </a>
                                                @elseif($value->type == "document" && $value->extention == "pdf")
                                                    <a target="_blank" href="{{url("/")."/$value->attachment"}}"><img style="width: 35px; height: 35px" src="{{url("/")."/images/pdf.png"}}" class="img img-circle"></a>
                                                @elseif($value->type == "document" && ($value->extention == "docx" || $value->extention == "rtf" ))
                                                    <a href="{{url("/")."/$value->attachment"}}"><img style="width: 35px; height: 35px" src="{{url("/")."/images/word.png"}}" class="img img-circle"></a>
                                                @elseif($value->type == "document" && ($value->extention == "xlsx"))
                                                    <a  href="{{url("/")."/$value->attachment"}}"><img style="width: 35px; height: 35px" src="{{url("/")."/images/excel.png"}}" class="img img-circle"></a>
                                                @else
                                                    <img style="width: 35px; height: 35px" src="{{url("/")."/$value->attachment"}}" class="img img-circle">
                                                @endif
                                            </td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab-05" role="tabpanel" aria-labelledby="tab-05-tab">
                                <table class="table table-advance">
                                    <thead>
                                    <tr>
                                        <td class="font_size">News Paper</td>
                                        <td>{{$auction_details->newspaper_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font_size">Publish Date</td>
                                         <td>{{date("d-m-Y",strtotime($auction_details->date_published))}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td class="font_size">Start Date</td>
                                        <td>{{date("d-m-Y h:i:s A",strtotime($auction_details->start_date_time))}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="font_size">End Date</td>
                                       
                                         <td>{{date("d-m-Y h:i:s A",strtotime($auction_details->end_date_time))}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font_size">Duration</td>
                                        <td>{{$auction_details->duration}} Year(s)</td>
                                    </tr>

                                    <tr>
                                        <td class="font_size">Advertisment Image</td>
                                        <td><a target="_blank" href="{{url("/")."/".$auction_details->attachment}}"><img src="{{url("/")."/".$auction_details->attachment}}" style="width: 55px; height: 55px"></a></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab-06" role="tabpanel" aria-labelledby="tab-06-tab">
                                <p>{{$auction_details->terms_and_conditions}}</p>
                            </div>
                        </div>
                    </div>

                </div>





            </div>
            <br>
        </div>
    </section>


</div>

<div id="submit_cdr" class="modal fade" id="submit_cdr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Confirmation</h5>
                <button type="button" class="close close_popup" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body alert_message box_message">
                Please submit your CDR for this auction ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn_pub_yes" data-bs-dismiss="modal">Okay</button>

            </div>
        </div>
    </div>
</div>


<div id="confirm_place_bid" class="modal fade" id="submit_cdr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Confirmation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body alert_message box_message">

            </div>
            <div class="modal-body alert_message amount_in_figure">

            </div>
            <div class="modal-body alert_message amount_in_text">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success place_yes" data-bs-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-danger btn_cancel" data-bs-dismiss="modal">No</button>

            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="http://www.eauction.lcbkp.gov.pk/js/jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.eauction.lcbkp.gov.pk/js/jquery.countdownTimer.css" />
<script>
    plaza_id = "{{$plaza_id}}";
    auction_id = "{{$auction_id}}";
    shop_id = "{{$shop_id}}";
    count = 0;
    page_type = "<?php echo $_GET['type'] ?? '' ?>";
    expiration_alert = "<?php echo $expiration_alert ?>";
     
    if(expiration_alert == "show_alert"){
           alert("Auction is expired");
            window.location = BaseUrl+`/details/${auction_id}/${plaza_id}/${shop_id}?type=rent_out`;
    }


    $(function(){
        if(page_type == "") {
            $("#given_date").countdowntimer({
                startDate: "{{$auctionStartTime}}",
                dateAndTime: "{{$auctionEndTime}}",
                size: "lg",
                timeUp: timeIsUp
            });
        }
        function timeIsUp() {
 
            $(".submit_bid_amount").remove();
            /*$.ajax({
                method:"GET",
                url:"{{url('makeAuctionExpired')}}/"+auction_id,
                success:function(res){

                        window.location = BaseUrl+`/details/${auction_id}/${plaza_id}/${shop_id}?type=rent_out`;
                },
                error: function (request, status, error) {
                    if(request.responseJSON.message == "Unauthenticated."){
                        window.location = BaseUrl+"/login";
                    }
                }
            });*/

            alert("Auction is expired");
            setTimeout(function () {
                window.location = BaseUrl+`/details/${auction_id}/${plaza_id}/${shop_id}?type=rent_out`;
            },3000);


        }
    });

    $(document).ready(function(){


        $("body").on("click",".place_yes",function(e){
            // Hide the modal first
            $("#confirm_place_bid").modal("hide");
            
            $.ajax({
                method:"POST",
                url:"{{url('placeBid')}}",
                data:{shop_id:shp_id,bid_amount:bid_amount,auction_id:auction_id},
                success:function(res){
                    $(".entered_amount").val("");
                    $(".entered_amount").val("");
                    if(res.status == "submit_full_cdr"){
                        $(".box_message").text("Please submit your CDR for this auction ?")
                        $("#submit_cdr").modal("show");

                        return false;
                    }else if(res.status == "min_bid"){
                        $.notify(res.message, 'error');
                        return false;
                    }else if(res.status == "expire"){
                        $.notify(res.message, 'error');
                        setTimeout(function(){
                            window.location.reload();
                        },5000);
                        return false;
                    }else{
                        $.notify(res.message, 'success');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);

                    }
                },
                error: function (request, status, error) {
                    if(request.responseJSON.message == "Unauthenticated."){
                        window.location = BaseUrl+"/login";
                    }
                }
            });
        });

        $("body").on("click",".btn_cancel",function(e){
            $("#confirm_place_bid").modal("hide");
        });


        $("body").on("click",".delete_yes",function(e){
            $.ajax({
                method:"POST",
                data:{id:delete_id},
                url:'<?php echo url("/settings/delete-plaza-floor"); ?>',
                success:function(res){
                    if(res.status){
                        window.location.reload();
                    }else{
                        $.notify(res.message, 'error');
                    }

                }
            });

        });



        $("body").on("click",".btn_pub_yes",function(e){
            window.location = "{{url("auctions/add-customer-cdr")}}/"+auction_id+"/"+shp_id;

        });

        $("body").on("click",".close_popup",function(e){
            window.location = "{{url("auctions/add-customer-cdr")}}/"+auction_id+"/"+shp_id;

        });

        //getAuction_details(plaza_id);
        $("body").on("click",".place_bid",function(e){

            shp_id = $(this).attr("shp_id");
            auction_id = $(this).attr("auction_id");
            bid_amount = $("#input_"+shp_id).val();
            if(bid_amount.trim() == "" || bid_amount == 0){
                return false;
            }
            words = convertNumberToWords(bid_amount);
            $(".box_message").text("Are you sure to place this bid ?");
            $(".amount_in_figure").html(`<b>Rs: ${bid_amount}</b>`);
            $(".amount_in_text").html(`<b>${words}</b>`);
            $("#confirm_place_bid").modal("show");

        }) ;
    });
   ////////////time update fuction by MSK ///////
     /*CALL auctions_TimeUpdate();*/
    function convertNumberToWords(amount) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        console.log(words_string);
        return words_string;
    }

    // Fix for tab functionality
    $(document).ready(function() {
        // Handle tab clicks
        $('[data-toggle="tab"]').on('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs and panes
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('show active');
            
            // Add active class to clicked tab
            $(this).addClass('active');
            
            // Get target pane and show it
            var target = $(this).attr('href');
            $(target).addClass('show active');
        });
        
        // Alternative method for Bootstrap 5 compatibility
        if (typeof bootstrap !== 'undefined') {
            var triggerTabList = [].slice.call(document.querySelectorAll('#propertyTabs a[data-bs-toggle="tab"]'));
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl);
                
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });
        }
    });
    </script>

@endsection