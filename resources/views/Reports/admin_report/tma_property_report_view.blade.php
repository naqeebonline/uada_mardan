@extends('admin.template')
@section('content')
    <style>
        .disabled{
            pointer-events: none;
            opacity: .5;
        }
    </style>



    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-table "></i> TMA Property Report</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <a class="btn btn-primary print_report">Print</a>
                    <br>
                    <br>

                    <div class="row">
                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "super_admin")
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Organization <small class="text-normal"></small></label>
                                <select class="form-control" id="org_id" name="org_id" >
                                    <option value="0">Select Organization...</option>
                                    @foreach($org as $key => $value)
                                        <option value="{{$value->id}}" {{(isset($_GET['org_id']) &&  $_GET['org_id'] == $value->id) ? "selected" : "" }} >{{$value->org_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Property Type <small class="text-normal"></small></label>
                                <select class="form-control" id="property_type" name="property_type">
                                    <option value="">All...</option>
                                    <option value="plaza" {{ isset($data) && $data->property_type == "plaza" ? "selected" : ""}}>Plaza</option>
                                    <option value="plots" {{isset($data) && $data->property_type == "plots" ? "selected" : ""}}>Plots</option>
                                    <option value="open_shops" {{isset($data) && $data->property_type == "open_shops" ? "selected" : ""}}>Open Shops</option>
                                    <option value="building" {{isset($data) && $data->property_type == "building" ? "selected" : ""}}>Building</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Property Type <small class="text-normal"></small></label>
                                <select class="form-control" id="shop_status" name="shop_status">
                                    <option value="">All...</option>
                                    <option value="open_for_aution" >Open For Auction</option>
                                    <option value="rent_out" >Rent Out</option>

                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="delete_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body alert_message box_message">
                        Are you sure to delete this organization ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success save_btn delete_yes" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-danger btn_cancel">No</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <link rel="stylesheet" href="{{asset('plaza_admin_assets/css/bootstrap-datetimepicker.css')}}">
    <script src="{{asset('plaza_admin_assets/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function(e){
            var admin_type = "{{\Illuminate\Support\Facades\Auth::user()->user_type}}";
            $("body").on("click",".print_report",function(){
                var type = $("#property_type").val();
                var shop_status = $("#shop_status").val();
                var org_id = $("#org_id").val();
                var url = "";
                if(type != "")
                    var url = "?type="+type;
                if(shop_status !=""){
                    if(url == "")
                        url = url+"?shop_status="+shop_status;
                    else
                        url = url+"&shop_status="+shop_status;
                }

                if(admin_type == "super_admin"){
                    if(url == "")
                        url = url+"?org_id="+org_id;
                    else
                        url = url+"&org_id="+org_id;

                    window.location = BaseUrl+"/print_tma_report"+url;
                }

                if(shop_status == "rent_out"){

                    window.location = BaseUrl+"/print_tma_rentOut_report"+url;
                }else{

                    window.location = BaseUrl+"/print_tma_report"+url;
                }

            });

        });

    </script>
@endsection


