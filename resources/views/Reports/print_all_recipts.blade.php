

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

    @media print {
        @page {size: landscape;
            margin-left:0;
        }


        /* Whatever */


        /*.invoice-head td {padding: 0 8px;*/
        /*}*/
        .container {
            padding-top:30px;

        }
        td,
        th,
        td{
            padding:5px !important;
        }
        .well{
            padding:6px !important;
        }
        .invoice-body{
            background-color:transparent;
        }
        .invoice-thank{
            margin-top: 2em;
            /*padding: 5px;*/
        }
        address{
            /*margin-top:15px;*/
        }
    }
    td,
    th,
    td{
        padding:5px !important;
    }
    .well{
        padding:6px !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <center class="span4">
            <img alt="No Image on This Path With This Name" src="http://lcbkp.gov.pk/img/logo.png" width="50%">
        </center>
    </div>


    <tr>
        <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>LIST ALL Receipts</strong></p></h5>


    </tr>

    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th>Date</th>
                    <th>Amount</th>
                    <th>Tenant Name</th>
                    <th>Nic</th>
                    <th>Demand No</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0; ?>
                @foreach($recipts as $key => $value)
                    <?php $total = ($total)+($value->dr) ?>
                    <tr>
                        <td>  {{date("d-m-Y",strtotime($value->bill_generate_date))}}</td>
                        <td class="r"> {{$value->dr}}</td>
                        <td>{{$value->name}}                  </td>
                        <td>{{$value->cnic}}</td>
                        <td> {{$value->shop_name}}</td>

                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <td>Total Amount</td>
                <td class="r">{{$total}}.00</td>
                <td></td>
                <td></td>
                <td></td>
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