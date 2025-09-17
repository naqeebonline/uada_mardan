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
                    <h3><i class="fa fa-file"></i> Case Court Details</h3>
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
                                <div class="table-responsive">

                                    <table class="table table-advance">
                                        <thead>
                                        <tr>

                                            <th>Plaza: {{$case->plaza_name ?? ""}}</th>
                                            <th>Shop: {{$case->shop_name ?? ""}}</th>
                                            <th>Case#: {{$case->case_number ?? ""}}</th>
                                            <th>Case Title: {{$case->case_title ?? ""}}</th>
                                            <th>Lawyer: {{$case->lawyer_name ?? ""}}</th>
                                            <th>Status: {{ucfirst(str_replace("_"," ",$case->case_status)) ?? ""}} </th>
                                        </tr>

                                        <tr>


                                            <th colspan="2">Perv Hearing Date: {{(count($data) >= 2) ? date("d-m-Y",strtotime($data[1]->heiring_date)) : ""}}</th>
                                            <th colspan="2">Next Hearing Date: {{(count($data) >= 1) ? date("d-m-Y",strtotime($data[0]->heiring_date)) : ""}}</th>


                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                    </table>

                                </div>
                                <div class="row">


                                    <form id="theForm" enctype="multipart/form-data">
                                    <div class="col-md-4" id="case_title" >
                                        <div class="form-group">
                                            <label>Hearing Date<small class="text-normal"></small></label>
                                            <input type="hidden" name="id" id="id" value="0">
                                            <input type="text" class="form-control case_title" required  name="heiring_date" id="heiring_date"   >
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="case_number" >
                                        <div class="form-group">
                                            <label>Outcome<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="outcome" id="outcome">
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="case_number" >
                                        <div class="form-group">
                                            <label>Remarks<small class="text-normal"></small></label>
                                            <input type="text" class="form-control"  name="remarks" id="remarks">

                                        </div>
                                    </div>

                                    <div class="col-md-4" id="case_number" >
                                        <div class="form-group">
                                            <label>Attachment if any (Optional)<small class="text-normal"></small></label>
                                            <input type="file" class="form-control"  name="file" id="file">

                                        </div>
                                    </div>
                                    </form>


                                </div>





                                <div class="clearfix"></div>
                                <button class="btn btn-primary save_details">Submit</button>
                                <a href="{{url("/")}}" class="btn btn-default">Cancel</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-green">
            <div class="box-title">
                <h3><i class="fa fa-table "></i> Manage Property Cases</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">


                <div class="table-responsive">

                    <table class="table table-advance">
                        <thead>
                        <tr>

                            <th>Hearing Date</th>
                            <th>Outcome</th>
                            <th>Remarks</th>
                            <th>Attachments</th>
                            <th style="width: 300px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)

                                <tr>
                                    <td>{{$value->heiring_date}}</td>
                                    <td>{{$value->outcome ?? ""}}</td>
                                    <td>{{$value->remarks ?? ""}}</td>
                                    <td>
                                        @if($value->attachments)
                                            <a target="_blank" href="{{url("/")."/".$value->attachments}}">Click Here</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-circle show-tooltip edit_record" data-value="{{json_encode($value)}}"  href="javascript:void(0)" data-original-title="Edit selected"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-circle show-tooltip delete_record" id="{{$value->id}}" title="" href="javascript:void(0)" data-original-title="Delete selected"><i class="fa fa-trash-o"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <p class="text-right">

                    {{--{{ $data->links()??"" }}--}}
                </p>
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
    <!-- Content Wrapper END -->

    <script type="text/javascript">

        $(document).ready(function(e){
            id =0;
            $('#heiring_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $("body").on("click",".edit_record",function(e){
                var value = JSON.parse($(this).attr("data-value"));
                $("#id").val(value.id);
                $("#heiring_date").val(value.heiring_date);
                $("#outcome").val(value.outcome);
                $("#remarks").val(value.remarks);

            });
            $("body").on("click",".save_details",function(e){
                var id = $("#id").val();
                var heiring_date = $("#heiring_date").val();
                var outcome = $("#outcome").val();
                var remarks = $("#remarks").val();
                var court_case_id = "{{$id}}";
                var formData = new FormData();

                $("#theForm").ajaxSubmit({
                    method:"POST",
                    url:'<?php echo url("/save-case-details") ?>',
                    data:{court_case_id},
                    success:function(res){
                        if(res.status){
                            $.notify(res.message, 'success');
                            setTimeout(function () {
                                window.location.reload();
                            },2000);

                        }else{
                            $.notify(res.message, 'error');
                        }

                    }

                })

                /*$.ajax({
                    method:"POST",
                    data:{id,heiring_date,outcome,remarks,court_case_id,formData},
                    url:'<?php echo url("/save-case-details") ?>',
                    success:function(res){
                        if(res.status){
                            $.notify(res.message, 'success');
                            setTimeout(function () {
                                window.location.reload();
                            },2000);

                        }else{
                            $.notify(res.message, 'error');
                        }

                    }
                });*/
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
                $.ajax({
                    method:"POST",
                    data:{id:delete_id},
                    url:'<?php echo url("/settings/delete-case-details"); ?>',
                    success:function(res){
                        if(res.status){
                            window.location.reload();
                        }else{
                            $.notify(res.message, 'error');
                        }

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


    </script>
@endsection


