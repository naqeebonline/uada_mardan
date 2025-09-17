

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

    @media print {



        /* Whatever */


        .invoice-head td {
            padding: 0 8px;
        }
        .container {
            padding-top:30px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .invoice-thank{
            margin-top: 60px;
            padding: 5px;
        }
        address{
            margin-top:15px;
        }
    }
</style>
<div class="container">
    <div class="row">
        <center class="span4">
            <img alt="No Image on This Path With This Name" src="http://lcbkp.gov.pk/img/logo.png" width="50%">
        </center>

        <tr>
            <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>BALANCE RECORD</strong></p></h5>

        </tr>
        <div class="span4 well">
            <table class="invoice-head">
                <tbody>



                <tr>
                    <td class="pull-right"><strong>Demand Number:&nbsp; </strong></td>
                    <td>{{$customer->shop->shop_name ?? ""}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Tenant Name: &nbsp; </strong></td>
                    <td> {{$customer->customer->name ?? ""}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Tenant Cnic: &nbsp;</strong></td>
                    <td>{{$customer->customer->cnic ?? ""}}</td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Address:&nbsp; </strong></td>
                    <td>{{$customer->customer->address ?? ""}}</td>
                </tr>


                <tr>
                    <td class="pull-right"><strong>Contact:&nbsp; </strong></td>
                    <td>{{$customer->customer->phoneNumber ?? ""}}</td>
                </tr>

                <img src="{{url("/")}}/{{$customer->customer->image}}" style="float:right; width:113px;height:113px;">


                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="span8 well invoice-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Trans Date</th>
                    <th>Receipt Mode</th>
                    <th>Descripton</th>
                    <th>Amount</th>

                </tr>
                </thead>
                <tbody>
                @foreach($recipts as $key => $value)
                    <tr id="receipt_8">
                        <td>{{$value->bill_generate_date}}</td>
                        <td>CASH</td>
                        <td>{{$value->remarks}}</td>
                        <td class="r" style="text-decoration: underline">{{$value->dr}}</td>
                    </tr>
                @endforeach


                </tbody>
                <tfoot>

                </tfoot>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-thank">
            <h5 style="text-align:center;">Thank You!</h5>
        </div>
    </div>
    <div class="row">
        <hr>
        <center class="span3">
            <small><strong>Phone:</strong>+92 922 3000 / +92 921 3355&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email:</strong> info@lcbkp.gov.pk<strong>&nbsp;&nbsp;&nbsp;&nbsp;Website:</strong>http://eproperty.lcbkp.gov.pk</small>
        </center>
    </div>
</div>