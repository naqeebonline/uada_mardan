

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
            margin-top: 10px;
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
            <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>Tenant Property Details</strong></p></h5>

        </tr>
        @if($data->customer)
        <div class="span4 well">
            <table class="invoice-head">
                <tbody>


                <tr>
                    <td class="pull-right"><strong>Demand No: &nbsp; </strong></td>
                    <td> {{$data->shop_name ?? ""}}</td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Tenant Name: &nbsp; </strong></td>
                    <td> {{$data->customer->name ?? ""}}</td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Tenant CNIC: &nbsp;</strong></td>
                    <td>{{$data->customer->cnic ?? ""}}</td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Address:&nbsp; </strong></td>
                    <td>{{$data->customer->address ?? ""}}</td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Contact:&nbsp; </strong></td>
                    <td>{{$data->customer->phoneNumber ?? ""}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Expiry Date:&nbsp; </strong></td>
                    <td>{{$data->expiry_date ?? ""}}</td>
                </tr>

                <img alt="No image on This path With This Name" src="{{asset("/")}}{{$data->customer->image}}" style="float:right; width:113px;height:113px;">



                </tbody>
            </table>
        </div>
        @endif

    </div>

    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Demand Number:</strong></td>
                    <td>{{$data->shop_name ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Location:</strong></td>
                    <td>{{$data->location ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Area:</strong></td>
                    <td>{{$data->coveredarea ?? ""}} </td>
                </tr>


                <tr>
                    <td><strong>Geo Location:</strong></td>
                    <td>{{$data->lat ?? ""}},{{$data->lng ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Classification:</strong></td>
                    <td>{{$data->property_type ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Monthly Rent:</strong></td>
                    <td>Rs. {{$data->current_rent ?? ""}}</td>
                </tr>

                <tr>
                    <td><strong>Expiry Date:</strong></td>
                    <td>{{$data->expiry_date ?? ""}}</td>
                </tr>
            </table>
        </div>
    </div>



    <div class="row">
        <img alt="No image on This path With This Name" src="{{url('/')}}/{{$data->document ?? ""}}" style="width: 50%;"><br/>

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
</div>