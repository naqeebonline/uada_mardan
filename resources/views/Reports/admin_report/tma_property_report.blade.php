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
        padding: 8px;

    }
    th {
        background: lightgray;
    }
</style>
<body>
@include("Reports.report_header")

@foreach($organization as $key => $value)
<table width="100%" id="printTable" >
    <thead>

    <tr>
        <td width="25%">TMA</td>
        <td width="25%">{{$value->org_name ?? ""}}</td>
        <td width="25%">Type</td>
        <td width="25%">{{$_GET['type'] ?? "All"}}</td>
    </tr>
    </thead>


</table>
@if(count($value->data) > 0)
        <table width="100%" id="printTable" >
            <thead>

            <tr>
                <th width="5%">S.No</th>
                <th width="15%">Property Type</th>
                <th width="15%">Shop/Plot Name</th>
                <th width="20%">Area</th>
                <th width="10%">Rent</th>
                <th width="15%">Premium</th>
                <th width="10%">Longitude</th>
                <th width="10%">Latitude</th>
            </tr>
            </thead>
            <tbody>

            @foreach($value->data as $key2 => $value2)
                <tr >
                    <td >{{($key2 + 1) ?? ""}}</td>
                    <td >{{($value2->property_type =="plaza") ? "Shop" : ucfirst(str_replace("_"," ",$value2->property_type))}}</td>
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