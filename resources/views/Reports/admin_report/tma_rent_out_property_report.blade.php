<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table, td, th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 4px;

    }
    th {
        background: lightgray;
    }
</style>
<body>
@include("Reports.report_header")

@foreach($organization as $key => $value)

<table width="100%" >
    <thead>

    <tr>
        <td width="25%">TMA</td>
        <td width="25%">{{$value->org_name}}</td>
        <td width="25%">Type</td>
        <td width="25%">{{$_GET['type'] ?? "All"}}</td>
    </tr>
    </thead>


</table>
@if(count($value->data) > 0)
        <table id="printTable" width="100%" st >
            <thead>

            <tr>
                <th >S.No</th>
                <th >Property Type</th>
                <th >Name</th>
                <th >CNIC</th>
                <th >Address</th>
                <th >Phone</th>

                <th >Shop/Plot Name</th>
                <th >Area</th>
                <th >Rent</th>
                <th >Premium</th>
                <th >Longitude</th>
                <th >Latitude</th>
            </tr>
            </thead>
            <tbody>
            @foreach($value->data as $key2 => $value2)
                <tr >
                    <td >{{($key2 + 1) ?? ""}}</td>
                    <td >{{($value2->property_type =="plaza") ? "Shop" : "Plot"}}</td>
                    <td >{{$value2->customer_name ?? ""}}</td>
                    <td >{{$value2->cnic ?? ""}}</td>
                    <td >{{$value2->customer_address ?? ""}}</td>
                    <td >{{$value2->phoneNumber ?? ""}}</td>

                    <td >{{$value2->shop_name ?? ""}}</td>
                    <td >{{$value2->coveredarea ?? ""}}</td>
                    <td >{{$value2->current_rent ?? ""}}</td>
                    <td >{{$value2->starting_bid_amount ?? ""}}</td>
                    <td >{{$value2->lng ?? ""}}</td>
                    <td >{{$value2->lat ?? ""}}</td>


                </tr>

            @endforeach
            </tbody>

        </table>
@endif


@endforeach

</body>
</html>