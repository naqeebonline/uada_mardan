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
<table width="100%" id="printTable" >
    <thead>

    <tr>
        <td width="25%">Customer Name</td>
        <td width="25%">{{\Illuminate\Support\Facades\Auth::user()->name}}</td>
        <td width="25%">Address</td>
        <td width="25%">{{\Illuminate\Support\Facades\Auth::user()->address}}</td>
    </tr>

    <tr>
        <td>Phone</td>
        <td>{{\Illuminate\Support\Facades\Auth::user()->phoneNumber}}</td>
        <td>Email</td>
        <td>{{\Illuminate\Support\Facades\Auth::user()->email}}</td>
    </tr>
    </thead>


</table>
<table width="100%" id="printTable" >
    <thead>

    <tr>
        <th width="5%">S.No</th>
        <th width="15%">Organization</th>
        <th width="10%">Property Type</th>
        <th width="15%">Shop/Plot Name</th>
        <th width="15%">Rent</th>
        <th width="10%">Premium</th>
        <th width="15%">Date Awarded</th>
        <th width="15%">Expiry Date</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $value)
        <tr >
            <td >{{($key + 1) ?? ""}}</td>
            <td >{{$value->org_name ?? ""}}</td>
            <td >{{($value->property_type =="plaza") ? "Shop" : "Plot"}}</td>
            <td >{{$value->shop_name ?? ""}}</td>
            <td >{{$value->current_rent ?? ""}}</td>
            <td >{{$value->starting_bid_amount ?? ""}}</td>
            <td >{{date("d-m-Y H:i:s",strtotime($value->end_date_time)) ?? ""}}</td>
            <td >{{date("d-m-Y H:i:s",strtotime($value->end_date_time)) ?? ""}}</td>

        </tr>

     @endforeach
    </tbody>

</table>

</body>
</html>