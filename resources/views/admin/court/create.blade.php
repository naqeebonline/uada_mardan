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
                    <h3><i class="fa fa-file"></i> Create Property Case</h3>
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
                            <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("settings/store")}}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-3" id="court_name">
                                        <div class="form-group">
                                            <label>Shop Name<small class="text-normal"></small></label>
                                            <input type="hidden" name="id" value="{{isset($data) ? $data->id : 0}}">
                                            <select class="form-control"  required  name="plaza_shop_id">
                                                <option value="">Select Shop....</option>
                                                @foreach($shops as $key => $value)
                                                    <option value="{{$value->id}}" {{(isset($data) && $data->plaza_shop_id == $value->id) ? "selected" : ""}}  >{{$value->shop_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="court_name">
                                        <div class="form-group">
                                            <label>Court Name<small class="text-normal"></small></label>
                                            <select class="form-control court_name" required   name="court_name">
                                                <option value="">Select Court....</option>
                                                @foreach($court as $key => $value)
                                                    <option value="{{$value->id}}" {{(isset($data) && $data->court_id == $value->id) ? "selected" : ""}} >{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="case_title" >
                                        <div class="form-group">
                                            <label>Case Title<small class="text-normal"></small></label>
                                            <input type="text" class="form-control case_title" required  name="case_title" value="{{isset($data) ? $data->case_title : ""}}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="case_number" >
                                        <div class="form-group">
                                            <label>Case Number<small class="text-normal"></small></label>
                                            <input type="text" class="form-control case_number" required  name="case_number" value="{{isset($data) ? $data->case_number : ""}}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="lawyer_name" >
                                        <div class="form-group">
                                            <label>Lawyer Name<small class="text-normal"></small></label>
                                            <input type="text" class="form-control lawyer_name" required  name="lawyer_name" value="{{isset($data) ? $data->lawyer_name : ""}}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="case_status">
                                        <div class="form-group">
                                            <label>Case Status<small class="text-normal"></small></label>
                                            <select class="form-control" id="case_status" required name="case_status">
                                                <option value="">Select Case Status....</option>
                                                <option value="in_progress" {{(isset($data) && $data->case_status == "in_progress") ? "selected" : ""}} >In Progress</option>
                                                <option value="in_favour" {{(isset($data) && $data->case_status == "in_favour") ? "selected" : ""}} >Decided in Favour</option>
                                                <option value="decided_against" {{(isset($data) && $data->case_status == "decided_against") ? "selected" : ""}} >Decided Against</option>
                                            </select>

                                        </div>
                                    </div>

                                </div>




                                <div class="clearfix"></div>
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{url("/")}}" class="btn btn-default">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->

    <script type="text/javascript">

        $(document).ready(function(e){
            id =0;


            $("body").on("click",".btn_save",function(e){
                var id = $("#record_id").val();
                $.ajax({
                    method:"POST",
                    data:{id:id,name:name,table:my_table},
                    url:'<?php echo url("/save-settings") ?>',
                    success:function(res){
                        if(res.status){
                            $.notify(res.message, 'success');
                            $("#custom_message").modal("hide");
                            table.ajax.reload( null, false );
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


