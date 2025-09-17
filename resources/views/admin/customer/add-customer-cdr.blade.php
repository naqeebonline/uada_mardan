@extends('admin.template')
@section('content')
    <style>
        .disabled{
            pointer-events: none;
            opacity: .5;
        }
    </style>

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Add Customer CDR</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12 col-lg-12  c ml-auto mr-auto">
                            @if(session()->has('error_message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error_message') }}
                                </div>
                            @endif

                            @if(session()->has('success_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                            @endif
                            <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("auctions/save-customer-cdr")}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Property Name<small class="text-normal"></small></label>
                                            <input type="text" readonly disabled class="form-control"  value="{{$details->plaza_name}}"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Shop / Plot Name<small class="text-normal"></small></label>
                                            <input type="text" readonly disabled class="form-control"  value="{{$details->shop_name}}"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Property Type<small class="text-normal"></small></label>
                                            <input type="text" readonly disabled class="form-control"  value="{{strtoupper($details->property_type)}}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Banks <small class="text-normal"></small></label>
                                            <select class="form-control" id="bank_id" name="bank_id">
                                                <option value="0">Select Bank...</option>
                                                @foreach($banks as $key => $value)
                                                    <option value="{{$value->bank_id}}" {{(isset($data) &&  $data->bank_id == $value->bank_id) ? "selected" : "" }} >{{$value->bank_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CDR No<small class="text-normal"></small></label>
                                            <input type="hidden" class="form-control" name="customer_id"  value="{{$customer_id}}">
                                            <input type="hidden" class="form-control" name="auction_id"  value="{{$auction_id}}">
                                            <input type="hidden" class="form-control" name="plaza_shop_id"  value="{{$plaza_shop_id}}">
                                            <input type="text" class="form-control" name="cdrno"  value="{{old('cdrno', $data->cdrno ?? "")}}" required >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="date" id="start_date_time" placeholder="" value="{{old('date', $data->date ?? "")}}" required >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="amount" id="amount" placeholder="" value="{{old('amount', $data->amount ?? "")}}" required >
                                        </div>
                                    </div>






                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CDR Attachment<small class="text-normal"></small></label>
                                            <input type="file" onchange="readURL(this);"  class="form-control" accept="image/*"  name="attachment"  value="">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label></label>
                                            <div class='list-info mrg-top-10'><img style="height: 50px; width: 50px;" id="blah" class='thumb-img' src="{{url('/').'/'}}{{$data->attachment ?? ''}}" alt=''><div class='info'><span class='title'></span>
                                                    <span class='sub-title'></span></div></div>
                                        </div>
                                    </div>



                                </div>

                                <button class="btn btn-success">Submit</button>
                                <a href="{{url("/")}}" class="btn btn-default">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->



    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-table "></i> Manage Customer CDR</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-left ">
                        <p>&nbsp;&nbsp;&nbsp;<strong>Required Amount :</strong> {{$details->cdr_amount}} &nbsp;&nbsp; <strong>Submitted Amount:</strong> {{$submited_amount}} </p>
                    </div>
                    <br><br>
                    <div class="table-responsive">

                        <table class="table table-advance">
                            <thead>
                            <tr>
                                <th>Bank Name</th>
                                <th>CDR No</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Attachment</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cdr as $key => $value)
                                <tr>
                                    <td>{{strtoupper($value->bank_name)}}</td>
                                    <td>{{$value->cdrno ?? ""}}</td>
                                    <td>{{$value->amount}}</td>
                                    <td>{{date("d-m-Y",strtotime($value->date))}}</td>
                                    <td>
                                            <a href="{{url("/")."/$value->attachment"}}">
                                                <img style="width: 35px; height: 35px" src="{{url("/")."/$value->attachment"}}" class="img img-circle">
                                            </a>
                                    </td>

                                    <td>
                                        @if($is_delete == 0)
                                        <a class="btn btn-circle show-tooltip delete_record" id="{{$value->id}}" title="" href="javascript:void(0)" data-original-title="Delete selected"><i class="fa fa-trash-o"></i></a>
                                            @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                    <p class="text-right">
                        {{ $cdr->links() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="delete_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Confirmation</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body alert_message box_message">
                        Are you sure to delete this organization ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success save_btn delete_yes" data-bs-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-danger btn_cancel" data-bs-dismiss="modal">No</button>
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
            delete_id = 0;
            $('#start_date_time').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $("body").on("click",".delete_record",function(e){

                delete_id = $(this).attr("id");
                $(".box_message").text("Are you sure to delete this record ?");
                $("#delete_modal").modal("show");
            });

            $("body").on("click",".btn_cancel",function(e){
                $("#delete_modal").modal("hide");
            });


            $("body").on("click",".delete_yes",function(e){
                // Hide modal immediately
                $("#delete_modal").modal("hide");
                
                $.ajax({
                    method:"POST",
                    data:{
                        id:delete_id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'<?php echo url("auctions/delete-customer-cdr"); ?>',
                    success:function(res){
                        if(res.status){
                            window.location.reload();
                        }else{
                            $.notify(res.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $.notify('An error occurred while processing your request', 'error');
                    }
                });

            });


        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(50)
                        .height(50);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function getOrganization(office_id) {
            $.ajax({
                method:"POST",
                data:{office_id:office_id},
                url:'<?php echo url("/get-organization") ?>',
                success:function(res){
                    if(res.status){
                        $("#select_organization").html("");
                        var html = `<option value='0'>Select office...</option>`;
                        res.data.forEach(function(value,key){
                            html = html + `<option value="${value.id}" ${organization_id == value.id ? "selected" : ""} >${value.org_name}</option>`;
                        });
                        $("#select_organization").html(html);
                    }else{
                        $.notify(res.message, 'error');
                    }

                }
            });
        }
    </script>
@endsection


