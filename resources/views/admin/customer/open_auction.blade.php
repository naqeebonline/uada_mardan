@extends('admin.template')
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-table "></i> List Open Auctions</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="{{url('auctions/add-auctions')}}" data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                            {{--<a class="btn btn-circle show-tooltip" title="" href="#" data-original-title="Edit selected"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-circle show-tooltip" title="" href="#" data-original-title="Delete selected"><i class="fa fa-trash-o"></i></a>--}}
                        </div>
                        {{--<div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="#" data-original-title="Print"><i class="fa fa-print"></i></a>
                            <a class="btn btn-circle show-tooltip" title="" href="#" data-original-title="Export to PDF"><i class="fa fa-file-text-o"></i></a>
                            <a class="btn btn-circle show-tooltip" title="" href="#" data-original-title="Export to Exel"><i class="fa fa-table"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="#" data-original-title="Refresh"><i class="fa fa-repeat"></i></a>
                        </div>--}}
                    </div>
                    <br><br>
                    <div class="table-responsive">

                        <table class="table table-advance">
                            <thead>
                            <tr>

                                <th>Auction Name</th>
                                <th>Plaza Name</th>
                                <th>Newspaper</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Date Published</th>
                                <th>Open Shops/Property</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{$value->auction_name}}</td>
                                    <td>{{$value->plaza_name}}</td>
                                    <td>{{$value->newspaper_name}}</td>
                                    <td>{{$value->start_date_time}}</td>
                                    <td>{{$value->end_date_time}}</td>
                                    <td>{{$value->date_published}}</td>
                                    <td>{{$value->openForAuctions}}</td>
                                    {{--<td>
                                        @if($value->status == "pending")
                                            <span class="label label-warning">Pending</span>
                                        @elseif($value->status == "published")
                                            <span class="label label-success">Published</span>
                                        @else
                                            <span class="label label-success">Completed</span>
                                        @endif
                                    </td>--}}
                                    <td>
                                       <a class="btn btn-sm btn-success" title="Published" href="{{url("auctions/property-details/$value->id/$value->plaza_id")}}">View Details</a>



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

        <div id="publish_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body alert_message box_message">
                        Are you sure to published this auction ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn_pub_yes" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-danger btn_pub_cancel">No</button>
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
                    url:'<?php echo url("auctions/delete-auctions"); ?>',
                    success:function(res){
                        if(res.status){
                            window.location.reload();
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }
                });

            });

            $("body").on("click",".published_auction",function(e){

                delete_id = $(this).attr("id");

                $("#publish_modal").modal("show");
            });

            $("body").on("click",".btn_pub_cancel",function(e){
                $("#publish_modal").modal("hide");
            });


            $("body").on("click",".btn_pub_yes",function(e){
                $.ajax({
                    method:"POST",
                    data:{id:delete_id},
                    url:'<?php echo url("auctions/published-auction"); ?>',
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


