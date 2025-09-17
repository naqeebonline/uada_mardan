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
                    <h3><i class="fa fa-file"></i> Add {{$_GET['type']}} Attachments</h3>
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
                            <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("settings/save-attachment")}}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Documents Type <small class="text-normal"></small></label>
                                            <select class="form-control" id="user_type" name="doc_type">
                                                <option value="0">Select Document type...</option>
                                                <option value="image" >Property Image</option>
                                                <option value="document">Document</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="title"  value="{{old('title', $data->title ?? "")}}" required >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Image/Document<small class="text-normal"></small></label>
                                            <input type="file"  class="form-control"   name="attachment"  value="">
                                            <input type="hidden"   name="type"  value="{{$_GET['type']}}">
                                            <input type="hidden"   name="id"  value="{{$_GET['id']}}">
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
                <h3><i class="fa fa-table "></i> Manage {{$_GET['type']}} Attachments</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right">

                </div>
                <br><br>
                <div class="table-responsive">

                    <table class="table table-advance">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Image/Document</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
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

                                <td>
                                    <a class="btn btn-circle show-tooltip delete_record" id="{{$value->id}}" title="" href="javascript:void(0)" data-original-title="Delete selected"><i class="fa fa-trash-o"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <p class="text-right">

                    {{ $data->links() }}
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

    <script type="text/javascript">

        $(document).ready(function(e){
            id =0;
            office_id = "{{$user->office_id ?? 0}}";
            organization_id = "{{$user->org_id ?? 0}}";
            user_type = "{{$user->user_type ?? ""}}";

            if(office_id != 0){
                getOrganization(office_id);
            }
            if(user_type == "super_admin"){
                $("#select_organization").addClass("disabled")
            }
            /* $('#event_start_time').Zebra_DatePicker({
                 format: 'Y-m-d H:i'
             });*/

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
                    url:'<?php echo url("/settings/delete-attachment"); ?>',
                    success:function(res){
                        if(res.status){
                            window.location.reload();
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }
                });

            });



            $("body").on("change","#select_office",function(e){
                var office_id = $(this).val();
                getOrganization(office_id);

            });

            $("body").on("change","#user_type",function(e){
                var user_type = $(this).val();
                if(user_type == "super_admin"){
                    $("#select_organization").val("0");
                    $("#select_organization").addClass("disabled");
                }else{
                    $("#select_organization").removeClass('disabled');
                }

            });




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


