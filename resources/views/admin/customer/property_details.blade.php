@extends('admin.template')
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-table "></i>Property Details</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">

                        </div>

                    </div>
                    <br><br>
                    <div class="table-responsive">

                        <table class="table table-advance">
                            <thead>
                            <tr>

                                <th>Shop Name</th>
                                <th>Covered Area</th>
                                <th>Plaza</th>
                                <th>Floor</th>
                                <th>Start Rent</th>
                                <th>Current Rent</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Status</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{$value->shop_name}}</td>
                                    <td>{{$value->coveredarea}}</td>
                                    <td>{{$value->plaza_name}}</td>
                                    <td>{{$value->floor_name}}</td>
                                    <td>{{$value->start_rent}}</td>
                                    <td>{{$value->current_rent}}</td>
                                    <td>{{$value->lng}}</td>
                                    <td>{{$value->lat}}</td>
                                    <td>{{$value->shop_status}}</td>
                                    <td>
                                       <a class="btn btn-success" href="{{url("auctions/add-customer-cdr/$auction_id/$value->id")}}">Add CDR</a>
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
                // Hide modal immediately
                $("#delete_modal").modal("hide");
                
                $.ajax({
                    method:"POST",
                    data:{
                        id:delete_id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'<?php echo url("/settings/delete-plaza"); ?>',
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
    </script>

@endsection


