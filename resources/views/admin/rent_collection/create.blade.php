@extends('admin.template2')
@section('content')
    <section class="content-header">
        <h1>
            Rent & Outstandings
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Rent & Outstandings</a></li>
            <li class="active">Rent & Outstandings Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-7">


                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tenant Information</h3>

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body" style="position:releative;">

                            <div class="form-group">
                                <label class="col-sm-3">Cnic :</label>
                                <label class="col-sm-9 ">{{$customer->customer->cnic}}</label>

                            </div>

                            <div class="form-group"  >
                                <label class="col-sm-3" >Demand No :</label>
                                <label class="col-sm-9">{{$customer->shop->shop_name}}</label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">Full Name :</label>
                                <label class="col-sm-9">{{$customer->customer->name}}</label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3">Monthly Rent :</label>
                                <label class="col-sm-9" style="letter-spacing: 1px;text-decoration: underline;">Rs. {{round($customer->shop->current_rent ,2)}}</label>
                            </div>

                            <div class="im">
                                <img src="{{url("/")}}/{{$customer->customer->image}}"  width="80px;"/>

                            </div>
                        </div>

                    </form>
                </div>

                <style>
                    .im
                    {
                        position: absolute;
                        top: 43px;
                        right: 10px;
                        width: 128px;
                        height: 128px;
                    }
                </style>




            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-5">
                <!-- Horizontal Form -->

                <form class="form-horizontal" method="post" action="https://properties-cdgp.com/root/post_monthly_rents">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Outstanding Balance</h3>
                            <button type="submit" class="btn btn-danger pull-right" style="display:none;">generate recipts</button>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Outstanding is</label>

                                <div class="col-sm-7" style="margin-top: 5px;">

                                    <strong style="letter-spacing: 1px;text-decoration: underline;">Rs. {{$balance}}</strong>

                                    <br/>

                                </div>



                            </div>


                            <div class="form-group">

                                <div class="col-sm-12" style="text-align:center;">
                                    <br/>
                                    <a  href="#" class="btn btn-default" data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fa   fa-calendar-plus-o"></i> Add New Transaction</a>

                                </div>

                            </div>

                        </div>


                    </div>
                    <!-- /.box -->

            </div></form>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-7">
                <div class="box  box-success">
                    <div class="box-header" style="padding-bottom:0px;">
                        <h3 class="box-title">Monthly Receipt History</h3>
                    </div>
                    <div style="float: right;margin-right: 20px;">
                        <a href="#" onclick="print_all('{{$id}}')"   style="font-size: 18px;" ><i class="fa fa-print"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br/>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Trans Date</th>
                                <th>Receipt Mode</th>
                                <th>Descripton</th>
                                <th>Amount</th>
                                <th>Attachment</th>
                                <th>
                                    --
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recipts as $key => $value)
                                <tr id="receipt_8">
                                    <td>{{$value->bill_generate_date}}</td>
                                    <td>CASH</td>
                                    <td>{{$value->remarks}}</td>
                                    <td class="r" style="text-decoration: underline">
                                        {{$value->dr}}                    </td>
                                    <td></td>
                                    <td>
                                        <a href="#" style="font-size: 17px;margin-right:4px; color:green;" onclick="print_bank_recipts();"><i class="fa fa-print"></i></a>
                                        <a href="#" style="font-size: 17px;"  class="edit_receipt" data-value="{{json_encode($value)}}" data-toggle="modal" data-target="#em8"><i class="fa fa-edit"></i></a>
                                        <a href="#" style="font-size: 18px;color: #de0b0b; margin-right: 4px;" onclick="delete_receipt('8');"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach




                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>

                    </div>

                </div>


            </div>

            <div class="col-xs-5">


                <div class="box  box-info">
                    <div class="box-header" style="padding-bottom:0px;">
                        <h3 class="box-title">Monthly Outstandings</h3>
                    </div>
                    <div style="float: right;margin-right: 20px;">
                        <a href="#" onclick="print_outstanding('{{$id}}')"  style="font-size: 18px;" ><i class="fa fa-print"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br/>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>


                                <th>Month/Year</th>
                                <th>Rent</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>
                                    --
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ledger as $key => $value)
                                <tr class="danger" id="mr_1">
                                    <td>{{$value->months}}</td>
                                    <td  class="r">{{$value->totalCr ?? 0}}</td>
                                    <td class="r">
                                        {{$value->totalDr ?? 0}}                 </td>
                                    <td  class="r">{{($value->totalCr) - ($value->totalDr)}}</td>
                                    <td>
                                        <a href="#" style="font-size: 17px;margin-right:4px; color:green;" onclick="print_me('11');"><i class="fa fa-print"></i></a>
                                        <a href="#" style="font-size: 17px;"  data-toggle="modal" data-target="#emm1"><i class="fa fa-edit"></i></a>
                                        <a href="#" style="font-size: 18px;color: #de0b0b; margin-right: 4px;" onclick="delete_rent('1');"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>


    </section>


    <div id="receiptModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <form id="save_receipts" method="post" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <button type="button" class="btn b" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-header" style="padding: 6px;padding-left: 10px;color: white;background: #00a65a;">
                        <h4 class="modal-title" id="exampleModalLabel">Rent & Outstandings Receiving</h4>

                    </div>
                    <div class="box-body">
                        <div class="form-group row" >
                            <label class="col-sm-3 control-label">Date </label>
                            <div class="col-sm-5">
                                <input type="hidden" id="primary_key" name="id" value="0">
                                <input type="hidden" name="customer_property_id" value="{{$id}}">
                                <input type="hidden" id="customer_id" name="customer_id" value="{{$customer_id}}">
                                <input type="hidden" id="plaza_shop_id" name="plaza_shop_id" value="{{$customer->shop->id}}">
                                <input type="date" id="m_date" name="bill_generate_date" value="" class="form-control" style="margin-bottom:5px;" >
                            </div>

                            <div class="col-sm-3">
                                <select class="form-control" name="receipt_mode" id="receipt_mode" required>
                                    <option value="">Select Receipt Mode</option>
                                    <option value="CASH">CASH</option>
                                    <option value="CASH">CHEQUE</option>
                                </select>
                            </div>


                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Bank </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="bank_id" name="bank_id">
                                    <option value="">Select Bank...</option>
                                    @foreach($banks as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}} ({{$value->account}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Receipt Number </label>
                            <div class="col-sm-8">
                                <input class="form-control" type="number" name="receipt_number" id="receipt_number" value="">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Descriptions </label>
                            <div class="col-sm-8">
                                <textarea id="descr"  name ="remarks" rows="4" cols="50" class="form-control" style="margin-bottom:5px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Outstandings </label>
                            <div class="col-sm-8">
                                <input type="number" id="os"  class="form-control" value="{{$balance ?? 0}}" readonly style="margin-bottom:5px;" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label" >Paid Amount </label>
                            <div class="col-sm-8">
                                <input type="number" required id="paid" name="dr" class="form-control CalculateMe" style="margin-bottom:5px;" >
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Balance </label>
                            <div class="col-sm-8">
                                <input type="number" id="bal" readonly class="form-control" style="margin-bottom:5px;" >
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Attachment if any </label>
                            <div class="col-sm-8">
                                <input type="file" name="attachments" class="form-control" style="margin-bottom:5px;"  />

                            </div>
                        </div>

                        <br/>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                        <div id="submit_data" class="btn btn-success" >Save Information</div>
                    </div>

                </div>
            </div>
        </form>
    </div>



    <script>


        $('.CalculateMe').keyup(function(){
            var Num1 = $('#os').val();
            var Num2 = $('#paid').val();
            if(Num1 && Num2){
                $('#bal').val(Num1 - Num2);
            }
        });

        $("body").on("click",".edit_receipt",function(e){
            var value = JSON.parse($(this).attr("data-value"));
            $("#primary_key").val(value.id);
            console.log("data",value.bill_generate_date);
            $("#m_date").val(value.bill_generate_date);
            $("#receipt_mode").val(value.receipt_mode);
            $("#bank_id").val(value.bank_id);
            $("#receipt_number").val(value.receipt_number);
            $("#descr").val(value.remarks);
            $("#paid").val(value.dr);

            $("#receiptModal").modal("show");

        });
        $("body").on("click","#submit_data",function(e){

            $("#save_receipts").ajaxSubmit({
                method:"POST",
                url:'{{route("rent.store")}}',
                success:function(res){
                    if(res.status){
                        $("#primary_key").val(0);
                        $("#receiptModal").modal("hide");
                        $.notify(res.message, 'success');

                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else{
                        $.notify(res.message, 'error');
                    }

                }

            })
        });

        function print_all(id) {
            var w = window.open("{{url('/printTenantRecipts')}}/"+id,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }

        function print_outstanding(id) {
            var w = window.open("{{url('/printTenantOutstanding')}}/"+id,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }

        function print_bank_recipts() {
            var w = window.open("{{url('/printBankRecipts')}}/{{$id}}",'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }
    </script>




    {{--<script>


        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("m_date").setAttribute("min", today);



        function delete_receipt(value)
        {
            if (confirm("Are you sure?")) {

                $.ajax({
                    url:'https://properties-cdgp.com/root/delete_receipt',
                    type:'post',
                    data:{id:value},
                    dataType: 'json',
                    success:function(result)
                    {
                        console.log(result);

                        if(result['status']==true)
                        {

                            $('#receipt_' + value).hide(800);
                        }
                    }
                });




            }
        }


        function print_me(receipt_id)
        {

            var w = window.open('https://properties-cdgp.com/root/print_receipt/'+receipt_id,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();

        }


        function delete_rent(value)
        {
            if (confirm("Are you sure?")) {

                $.ajax({
                    url:'https://properties-cdgp.com/root/delete_rent',
                    type:'post',
                    data:{id:value},
                    dataType: 'json',
                    success:function(result)
                    {
                        console.log(result);

                        if(result['status']==true)
                        {

                            $('#mr_' + value).hide(800);
                        }
                    }
                });




            }
        }

        function print_monthly_receipts(val)
        {
            //alert(val);
            var w = window.open('https://properties-cdgp.com/root/print_monthly_receipts/'+val,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();

        }

        function print_monthly_balance(val)
        {
            //alert(val);
            var w = window.open('https://properties-cdgp.com/root/print_monthly_balance/'+val,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();

        }
    </script>--}}

@endsection






