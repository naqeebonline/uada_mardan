@extends('admin.template')
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-table "></i> Manage Floor / Plot</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="{{url('settings/add-plaza-floor')."/$plaza_id"}}" data-original-title="Add new record"><i class="fa fa-plus"></i></a>

                            </div>

                    </div>
                    <br><br>
                    <div class="table-responsive">

                        <table class="table table-advance">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>Property Name</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{$value->floor_name}}</td>
                                    <td>{{$value->plaza_name}}</td>
                                    <td>
                                        <a class="btn btn-circle show-tooltip" title="" id="{{$value->id}}" href="{{url("/settings/edit-plaza-floor")."/$value->id"}}" data-original-title="Edit selected"><i class="fa fa-edit"></i></a>
                                         <a class="btn btn-circle show-tooltip delete_record" id="{{$value->id}}" title="" href="javascript:void(0)" data-original-title="Delete selected"><i class="fa fa-trash-o"></i></a>
                                        <a  href="{{url('settings/manage-floor-shops')."/$plaza_id/$value->id"}}" > {{$value->menu}}</a>
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
        });
    </script>

@endsection


