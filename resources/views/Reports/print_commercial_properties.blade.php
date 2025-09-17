

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
        <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>LIST OF ALL COMMERCIAL PROPERTIES</strong></p></h5>


    </tr>

    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
                <thead>
                {{--<tr>
                    <th>CNIC</th>
                    <th>Tenant Name</th>
                    <th>Father / Husband Name</th>
                    <th>Contact</th>
                    <th>Demand No</th>
                    <th>Classification</th>
                    <th>Location</th>
                    <th>Area</th>
                    <th>Circle</th>
                    <th>Monthly Rent</th>
                    <th>Reference No</th>
                    <th>Registration Date</th>
                    <th>Expiry Date</th>
                </tr>--}}
                <tr>

                    <th>Tenant</th>

                    <th>Shop Name</th>
                    <th>Covered Area</th>
                    <th>Plaza</th>

                    <th>start_rent</th>
                    <th>current_rent</th>
                    <th>Lat/Lng</th>

                    {{--<th>Map</th>--}}


                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $value)

                    <tr>
                        <td>
                            @if($value->customer)
                                <a href="javascript:void(0)" class="show_customer" data-value="{{json_encode($value->customer)}}">{{$value->customer->cnic}}<br>{{$value->customer->name}}</a>
                            @else
                            @endif
                        </td>
                        <td><a class="show_shop" data-value="{{json_encode($value)}}" style="text-decoration: underline">{{$value->shop_name}}</a></td>
                        <td>{{$value->coveredarea}}</td>
                        <td>{{$value->plaza_name}}</td>

                        <td>{{$value->start_rent}}</td>
                        <td>{{$value->current_rent}}</td>
                        <td>Lat: {{$value->lat}}<br> Lng:{{$value->lng}}</td>




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