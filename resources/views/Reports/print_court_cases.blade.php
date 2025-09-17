

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
        <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>LIST OF ALL COURT CASES</strong></p></h5>


    </tr>

    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
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

                    </tr>
                @endforeach
                </tbody>


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