

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
            <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>RESIDENTIAL Properties</strong></p></h5>

        </tr>
        <div class="span4 well">
            <table class="invoice-head">
                <tbody>

                <tr>
                    <td class="pull-right"><strong>Serial No: &nbsp; </strong></td>
                    <td> {{$data->shop_name ?? ""}}</td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Name Officer/official: &nbsp; </strong></td>
                    <td> {{$data->customer->name ?? ""}} </td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Designating: &nbsp;</strong></td>
                    <td>P{{$data->customer->designation ?? ""}} </td>
                </tr>

                <tr>
                    <td class="pull-right"><strong>Place of Duty:&nbsp; </strong></td>
                    <td>{{$data->customer->place_of_duty ?? ""}} </td>
                </tr>


                <tr>
                    <td class="pull-right"><strong>Location of Residential Accommodation:&nbsp; </strong></td>
                    <td>{{$data->address ?? ""}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Area:&nbsp; </strong></td>
                    <td>2 Marla</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Outstanding:&nbsp; </strong></td>
                    <td>{{$data->ledger->balance ?? 0}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Description:&nbsp; </strong></td>
                    <td>1</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Monthly Rent:&nbsp; </strong></td>
                    <td>{{$data->current_rent ?? 0}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Paid for:&nbsp; </strong></td>
                    <td>{{$data->ledger->dr ?? 0}}</td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Image:&nbsp; </strong></td>
                    <td>                  <img alt="No image on This path With This Name" src="{{url('/')."/".$data->attachment}}" style="float:left; width:100%;height:auto;">
                    </td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Attachment Order:&nbsp; </strong></td>
                    <td> <br><br>           <img alt="No image on This path With This Name" style="float:left; width:113px;height:113px;" src="{{url('/')."/".$data->document}}" ><br/>
                    </td>
                </tr>
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