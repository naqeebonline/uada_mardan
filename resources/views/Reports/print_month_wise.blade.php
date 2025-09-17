


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

    @media print {


        @page {
            size: landscape;
            size: 500mm 310mm;
        }
        /* Whatever */


        .invoice-head td {
            padding: 0 8px;
        }
        .container-fluid {
            padding-top:30px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .well{
            margin-bottom:none;
            padding:10px;
        }
        .invoice-thank{
            margin-top: 20px;
            padding: 5px;

        }
        .divFooter{
            page-break-before: always;

        }
        address{
            margin-top:15px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <center class="span4">
            <img alt="No Image on This Path With This Name" src="http://lcbkp.gov.pk/img/logo.png" width="50%">
        </center>
    </div>


    <tr>
        <h5 style="text-align:center;"> <p style="font-size:25px"> <strong>LIST OF ALL PROPERTIES AND TENANTS</strong></p></h5>


    </tr>

    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
                <tr>
                    <th>Sr.</th>
                    <th>D.No #</th>
                    <th>Name of Tenants</th>
                    <th>Type</th>
                    <th>Monthly Rent</th>
                    <th>Jan 2021/arears</th>
                    <th>Feb 2021/arears</th>
                    <th>Mar 2021/arears</th>
                    <th>Apr 2021/arears</th>
                    <th>May 2021/arears</th>
                    <th>Jun 2021/arears</th>
                    <th>Jul 2021/arears</th>
                    <th>Aug 2021/arears</th>
                    <th>Sep 2021/arears</th>
                    <th>Oct 2021/arears</th>
                    <th>Nov 2021/arears</th>
                    <th>Dec 2021/arears</th>
                    <th>Total Outstanding</th>
                </tr>

                @foreach($reports as $key => $value)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$value->shop_name ?? ""}}</td>
                    <td>{{$value->name ?? ""}}</td>
                    <td>{{$value->property_type ?? ""}}</td>
                    <td>{{$value->current_rent ?? ""}}</td>
                    <td>{{$value->January ?? ""}}</td>
                    <td>{{$value->February ?? ""}}</td>
                    <td>{{$value->March ?? ""}}</td>
                    <td>{{$value->April ?? ""}}</td>
                    <td>{{$value->May ?? ""}}</td>
                    <td>{{$value->June ?? ""}}</td>
                    <td>{{$value->July ?? ""}}</td>
                    <td>{{$value->August ?? ""}}</td>
                    <td>{{$value->September ?? ""}}</td>
                    <td>{{$value->October ?? ""}}</td>
                    <td>{{$value->November ?? ""}}</td>
                    <td>{{$value->December ?? ""}}</td>

                    <td>{{$value->balance ?? ""}}                       </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-thank">
            <h5 style="text-align:center;">Thank You! </h5>
        </div>
    </div>
    <div class="row">
        <hr>
        <center class="span3">
            <small><strong>Phone:</strong>+92 922 3000 / +92 921 3355&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email:</strong> info@lcbkp.gov.pk<strong>&nbsp;&nbsp;&nbsp;&nbsp;Website:</strong>http://eproperty.lcbkp.gov.pk</small>
        </center>
    </div>
</div>
<div class="divFooter"></div>

