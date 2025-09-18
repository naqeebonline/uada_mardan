@extends('frontend.master')

@section('content')

    <?php $type = isset($_GET['type']) ? "?type=rent_out" : ""; ?>
<style>
    .colorDefinition {
        background: #ffffff !important;;
        color: #b5061b !important;
        border-color: #b5061b;
        font-size: 12px;
    }

    .colorDefinition1 {
        font-weight: bold;
        font-size: 21px;
        letter-spacing: 0.20em;
        color: #b5061b !important;
    }

    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 0px solid #dee2e6;
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

</style>
<!--=================================
breadcrumb -->
<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index-2.html"> <i class="fas fa-homes"></i> </a></li>
                    {{--<li class="breadcrumb-item"> <i class="fas fa-chevron-right"></i> <a href="#">Library</a></li>
                    <li class="breadcrumb-item active"> <i class="fas fa-chevron-right"></i> <span> Property List </span></li>--}}
                </ol>
            </div>
        </div>
    </div>
</div>
<!--=================================
breadcrumb -->

<!--=================================
Listing – grid view -->
<section class="space-ptb" style="padding: 14px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="section-title mb-3 mb-lg-4">
                    {{--<h2><span class="text-primary"></span> Results</h2>--}}
                </div>
            </div>

            <div class="col-md-8">
                <div class="section-title mb-3 mb-lg-8">
                     <h5>{{$plaza_details->name ?? ""}}</h5>
                    <table >
                         
                        <tr>
                            <td>
                                <span class="colorDefinition1">Days:Hr:Min:Sec</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span id="given_date"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-12">


            @foreach($data as $key => $value)
                <div class="property-item property-col-list mt-4" style="margin-bottom: 24px">
                    <div class="row no-gutters">
                        <div class="col-lg-2 col-md-2">
                            <div class="property-image bg-overlay-gradient-04 ">
                                <img class="img-fluid" style="height: 150px;" src="{{url("/")."/".$value->attachment}}" alt="">
                                <div class="property-lable">
                                    <span class="badge badge-md badge-primary">{{($value->property_type == "plaza") ? "shop" : "plot"}}</span>

                                </div>


                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                            <div class="property-details">
                                <div class="property-details-inner">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="property-details-inner-box">
                                                <div class="property-details-inner-box-left">
                                                    <h4 class="property-title"><a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}">{{$value->shop_name}} </a></h4>
                                                    <div class="property-price blink_me" style="font-size: 20px !important; color:red !important;">{{$value->premium}} /{{$value->future_use}} in PKR</span> </div>
                                                     
                                                    <span class="flex-fill property-m-sqft"><i class="far fa-square"></i>{{$value->org_name}} </span>
                                                    <br>
                                                   <span class="property-address"><i class="fas fa-map-marker-alt fa-xs"></i>{{$value->location}}</span>
                                                    <br>
                                                    <span class="flex-fill property-m-sqft"><i class="far fa-square"></i>Total area in sqft:{{$value->coveredarea}}</span>
                                                    <br>
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}"><span class="label label-success" >Details</span></a>
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}"><span class="label label-primary">Bidders ({{$value->totalBidders}})</span></a>
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}"><span class="label label-warning">Bids ({{$value->totalBidds}})</span></a>
                                                 <div class="col-md-2"> 
                                                
                                                 </div>
                                                </div>



                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            @if($show_clock)
                                            <table class="table submit_bid_amount">
                                                <tr>
                                                    <td  style="width: 70%">
                                                        <input type="number" onkeyup="word.innerHTML=convertNumberToWords(this.value)"  id="input_{{$value->id}}" class="form-control entered_amount" placeholder="" >
                                                        <div id="word" style="  color: red;"></div>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm place_bid" shp_id="{{$value->id}}" auction_id="{{$auction_id}}"  style="width:100%; color:black; padding: 12px 4px; ">Place Bid</a>
                                                    </td>
                                                </tr>

                                            </table>
                                                @endif
                                        </div>

                                    </div>







                                </div>

                                </div>

                            </div>
                        </div>
                    </div>

            @endforeach


            </div>
        </div>
    </div>

    <div id="submit_cdr_confirmation" class="modal fade" id="submit_cdr_confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Confirmation</h5>
                    <button type="button" class="close close_popup" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message box_message">
                    Please submit your CDR for this auction.
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
</section>
<script type="text/javascript" src="{{asset('js/jquery.countdownTimer.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('js/jquery.countdownTimer.css')}}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.css" integrity="sha512-IScV5kvJo+TIPbxENerxZcEpu9VrLUGh1qYWv6Z9aylhxWE4k4Fch3CHl0IYYmN+jrnWQBPlpoTVoWfSMakoKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.js" integrity="sha512-CyYoxe9EczMRzqO/LsqGsDbTl3wBj9lvLh6BYtXzVXZegJ8VkrKE90fVZOk1BNq3/9pyg+wn+TR3AmDuRjjiRQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--=================================
Listing – grid view -->

    <script>

        plaza_id = "{{request()->plaza_id}}";
        auction_id = "{{$auction_id}}";
        count = 0;
        page_type = "<?php echo $_GET['type'] ?? '' ?>";

        $(function(){
           if(page_type == ""){
            $("#given_date").countdowntimer({
                startDate : "{{$auctionStartTime}}",
                dateAndTime : "{{$auctionEndTime}}",
                size:"lg",
                timeUp : timeIsUp
            });
           }
            function timeIsUp() {

                $(".submit_bid_amount").remove();
                /*$.ajax({
                    method:"GET",
                    url:"{{url('makeAuctionExpired')}}/"+auction_id,
                    success:function(res){
                        window.location = BaseUrl+`/property-details/${auction_id}/${plaza_id}?type=rent_out`;

                    },
                    error: function (request, status, error) {
                        if(request.responseJSON.message == "Unauthenticated."){
                            window.location = BaseUrl+"/login";
                        }
                    }
                });*/
                $("body").hide();

                
                setTimeout(function () {
                    alert("Auction is expired");
                    //window.location = BaseUrl+`/property-details/${auction_id}/${plaza_id}?type=rent_out`;
                   // window.location = "{{route('completedAuctions')}}";
                },2000);

            }
        });



        $(document).ready(function(){
            $("body").on("click",".place_yes",function(e){
                // Hide the modal first
                $("#confirm_place_bid").modal("hide");
                
                $.ajax({
                    method:"POST",
                    url:"{{url('placeBid')}}",
                    data:{
                        shop_id:shp_id,
                        bid_amount:bid_amount,
                        auction_id:auction_id,
                        // _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(res){
                        $(".entered_amount").val("");
                        $(".entered_amount").val("");
                        if(res.status == "submit_full_cdr"){
                            $(".box_message").text("Please submit your CDR for this auction.");
                            $("#submit_cdr_confirmation").modal("show");

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
                        if(request.responseJSON && request.responseJSON.message == "Unauthenticated."){
                            window.location = BaseUrl+"/login";
                        }
                        console.error('AJAX Error:', error);
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
                // Hide modal first
                $("#submit_cdr_confirmation").modal("hide");
                
                var url = "{{url('auctions/add-customer-cdr')}}/"+auction_id+"/"+shp_id;
                window.open(url, '_blank');
            });

            $("body").on("click",".close_popup",function(e){
                $("#submit_cdr_confirmation").modal("hide");
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

        function getAuction_details(plaza_id) {
            setInterval(function () {
                $.ajax({
                    method:"GET",
                    url:"{{url('getPropertyDetails/')}}/"+plaza_id,
                    data:{plaza_id:plaza_id},
                    success:function(res){
                        if(count != 0){
                            console.log(res);
                        }else{
                            count = parseInt(count) + parseInt(1);
                        }

                    },
                    error: function (request, status, error) {

                    }
                });
            }, 30000);

        }


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

    </script>

@endsection