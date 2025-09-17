@extends('admin.template2')
@section('content')
    <section class="content-header">
        <h1>
            Court Cases
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#"> Court Cases</a></li>

        </ol>
    </section>
    <br/>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box table-responsive">
                    <div class="box-header">
                        <h3 class="box-title">Court Cases Listing</h3>
                        <a href="javascript:void(0)" class="btn btn-block btn-success pull-right add_court_case" style="width:20%;">Add New Court Case</a>
                    </div>
                    <div style="float: right;margin-right: 20px;">
                        <a href="#" onclick="print_all()"  style="font-size: 18px;" ><i class="fa fa-print"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br/>
                        <style>
                            #example1
                            {
                                background-image: url(https://properties-cdgp.com/newlogo.png);

                                background-repeat: no-repeat;background-position: center;

                            }
                        </style>
                        <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOyN30AYEzkEYIIC69j_krdLt2VKLjG9A"></script>




                        <table id="example1" class="table table-bordered ">
                            <thead>
                            <tr>
                                <th>Case Title</th>
                                <th>Case Number</th>
                                <th>Court Name</th>
                                <th>Lawyer Name</th>
                                <th>Plaza Name</th>
                                <th>Shop Name</th>
                                <th>Hearing Date</th>
                                <th>Next Hearing Date</th>




                                <th>Case Status</th>

                                <th style="width: 100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td><a class="show_info" data-value="{{json_encode($value)}}" style="text-decoration: underline">{{$value->case_title}}</a></td>
                                    <td>{{$value->case_number}}</td>
                                    <td>{{$value->court_name}}</td>
                                    <td>{{$value->lawyer_name ?? ""}}</td>
                                    <td>{{$value->plaza_name}}</td>
                                    <td>{{$value->shop_name}}</td>
                                    <td>{{$value->hearing_date}}</td>
                                    <td>{{$value->next_hearing_date}}</td>
                                    <td>{{$value->case_status}}</td>
                                    <td>
                                        <a class="btn btn-circle show-tooltip edit_case" title="" href="javascript:void(0)" data-value="{{json_encode($value)}}" data-original-title="Edit selected"><i class="fa fa-edit"></i></a>
                                        {{--<a class="btn btn-circle show-tooltip" title=""href="{{url("settings/case-details")."/$value->id"}}" ><i class="fa fa-eye"></i></a>--}}
                                        <a class="btn btn-circle show-tooltip" title=""href="{{url("print-case")."/$value->id"}}" ><i class="fa fa-print"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>


                    </div>
                    <!-- /.box-body -->
                </div>
                <p class="text-right">

                    {{ $data->links() }}
                </p>





            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>



    <!-- Modal -->
    <div class="modal fade" id="courtCaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <form role="form" method="POST" id="saveCase" id="form-validation" enctype="multipart/form-data" >
                    @csrf

                    <div class="modal-header" style="background-color: #00a65a;color: white;">
                        <h4 class="modal-title" id="exampleModalLabel"> Court Case Information</h4>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Shop Name<small class="text-normal"></small></label>
                            <select class="form-control"  required  name="plaza_shop_id" id="plaza_shop_id">
                                <option value="">Select Shop....</option>
                                @foreach($shops as $key => $value)
                                    <option value="{{$value->id}}"  >{{$value->shop_name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" id="primary_key" value="0">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Court Name <small class="text-normal"></small></label>

                                <select class="form-control court_name" required   name="court_id" id="court_name">
                                    <option value="">Select Court....</option>
                                    @foreach($court as $key => $value)
                                        <option value="{{$value->id}}" >{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Case Title<small class="text-normal"></small></label>
                            <input type="text" class="form-control case_title" required  name="case_title" id="case_title" value=""  >
                        </div>
                        <div class="form-group">
                            <label>Case Number<small class="text-normal"></small></label>
                            <h4 id="tenant_cnic_lab"></h4>
                            <input type="text" class="form-control case_number" required  name="case_number" id="case_number" value=""  >
                        </div>


                        <div class="form-group">
                            <label>Layer Name<small class="text-normal"></small></label>
                            <input type="text" class="form-control lawyer_name" required  name="lawyer_name" id="lawyer_name" value=""  >
                        </div>

                        <div class="form-group">
                            <label>Case Status<small class="text-normal"></small></label>
                            <select class="form-control" id="case_status" required name="case_status">
                                <option value="">Select Case Status....</option>
                                <option value="in_progress" >In Progress</option>
                                <option value="in_favour"  >Decided in Favour</option>
                                <option value="decided_against">Decided Against</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Hearing Date<small class="text-normal"></small></label>
                            <input type="text" class="form-control hearing_date" required  name="hearing_date" id="hearing_date" value=""  >
                        </div>

                        <div class="form-group">
                            <label>Next Hearing Date<small class="text-normal"></small></label>
                            <input type="text" class="form-control next_hearing_date"   name="next_hearing_date" id="next_hearing_date" value=""  >
                        </div>


                        <div class="form-group">
                            <label>Final decision<small class="text-normal"></small></label>
                            <input type="file" class="form-control lawyer_name"   name="final_decision" id="final_decision" value=""  >
                        </div>

                        <div class="form-group">
                            <label>Final decision Remarks<small class="text-normal"></small></label>
                            <input type="text" class="form-control final_remarks"   name="final_remarks" id="final_remarks" value=""  >
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <div  class="btn btn-success save_case">Save Case</div>
                    </div>
                </form>
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


    <div class="modal fade" id="info7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >

                    <div class="span4">
                        <center class="span4"><br>
                            <img alt="No image on This path With This Name" src="http://lcbkp.gov.pk/img/logo.png" width="50%">
                        </center>    		                  </div><br>
                    <h4 class="modal-title" id="exampleModalLabel"><span id="case_title_top"></span></h4>
                    <h4 style="text-align:right;"> <p style="font-size:18px"> <strong>LITIGATION</strong></p></h5>
                </div>
                <div class="modal-body">
                    <strong>Case Title: </strong><span id="case_title_info"></span><br/>
                    <strong>Writ Petition / Case / Suit Number: </strong><span id="case_number_info"></span><br/>
                    <strong>Court Name: </strong><span id="court_name_info"></span> <br/>
                    <strong>Case Hints: </strong><span id="case_remarks"></span><br/>
                    <strong>Status: </strong><span id="case_status_info"></span><br/>
                    <strong>Last Date of Hearing: </strong><span id="hearing_date_info"></span> <br/>
                    <strong>Next Date of Hearing: </strong><span id="next_hearing_date_info"></span> <br/>
                    <strong>Decision if Made: </strong><span id="final_remarks_info"></span> <br/>

                    <strong>Attachment : </strong><br/>
                    <strong style='margin-left: 11px;color: red;'>There is No File Attachment</strong><br>
                    <strong>Legal counsel: </strong><span id="lawyer_name_info"></span><br/>

                    <strong>Final decision: </strong><br/>
                    <strong style='margin-left: 11px;color: red;'>There is No File Attachment</strong><br>
                    <br>
                    <hr>

                    <center class="span3">
                        <small><strong>Phone:</strong>+92 922 3000 / +92 921 3355&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email:</strong> <a href="info@lcbkp.gov.pk">info@lcbkp.gov.pk</a><strong>&nbsp;&nbsp;&nbsp;&nbsp;Website:</strong> <a href="http://eproperty.lcbkp.gov.pk">http://eproperty.lcbkp.gov.pk</a></small>
                    </center>




                </div>
            </div>
        </div>
    </div>



    <link rel="stylesheet" href="{{asset('plaza_admin_assets/css/bootstrap-datetimepicker.css')}}">
    <script src="{{asset('plaza_admin_assets/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/bootstrap-datetimepicker.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(e){
            $("body").on("click",".add_court_case",function(e){
                resetForm();
                $("#courtCaseModal").modal("show");
            });

            $('#hearing_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            $('#next_hearing_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });


            $("body").on("click",".show_info",function(e){
                var value = JSON.parse($(this).attr("data-value"));
                console.log(value);
                $("#case_title_top").html(value.case_title);
                $("#case_title_info").html(value.case_title);
                $("#court_name_info").html(value.court_name);
                $("#case_remarks").html(value.final_remarks);
                $("#case_status_info").html(value.case_status);
                $("#hearing_date_info").html(value.hearing_date);
                $("#next_hearing_date_info").html(value.next_hearing_date);
                $("#final_remarks_info").html(value.final_remarks);
                $("#lawyer_name_info").html(value.lawyer_name);
                $("#info7").modal('show');
            });


            $("body").on("click",".edit_case",function(e){
                var item = JSON.parse($(this).attr("data-value"));
                 $("#primary_key").val(item.id);
                 $("#plaza_shop_id").val(item.plaza_shop_id);
                 $("#court_name").val(item.court_id);
                 $("#case_title").val(item.case_title);
                 $("#case_number").val(item.case_number);
                 $("#lawyer_name").val(item.lawyer_name);
                 $("#case_status").val(item.case_status);
                 $("#hearing_date").val(item.hearing_date);
                 $("#next_hearing_date").val(item.next_hearing_date);
                 $("#final_remarks").val(item.final_remarks);
                 $("#courtCaseModal").modal("show");
            });


            $("body").on("click",".save_case",function(e){
                $("#saveCase").ajaxSubmit({
                    method:"POST",
                    url:'<?php echo url("/settings/store") ?>',

                    success:function(res){
                        if(res.status){
                            $.notify(res.message, 'success');
                            resetForm();
                            $("#courtCaseModal").modal("hide");
                            setTimeout(function () {
                                window.location.reload();
                            },2000);
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }

                })
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
                    url:'<?php echo url("/settings/delete-case"); ?>',
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

        function print_all() {
            var w = window.open("{{url('/printCases')}}",'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }

        function resetForm() {
            $("#primary_key").val(0);
            $("#plaza_shop_id").val("");
            $("#court_name").val("");
            $("#case_title").val("");
            $("#case_number").val("");
            $("#lawyer_name").val("");
            $("#case_status").val("");
            $("#hearing_date").val("");
            $("#next_hearing_date").val("");
            $("#final_remarks").val("");
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       /* $('#test_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('view') !!}',
            columns: [
                { data: 'case_number', name: 'case_number' },
                { data: 'court_name', name: 'court.name' },
                { data: 'lawyer_name', name: 'lawyer_name' },
                { data: 'plaza_name', name: 'plaza.name' },
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ]
        });*/
    </script>


@endsection






