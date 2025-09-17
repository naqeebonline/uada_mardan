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
<h3 colspan="3" style="text-align: center;">Bidding Report</h3>
<table width="100%" id="printTable" >
    <thead>

    <tr>
        <td>Plaza Name</td>
        <td>{{$shop->plaza_name}}</td>
        <td>Shop Name</td>
        <td>{{$shop->shop_name}}</td>
    </tr>

    <tr>
        <td>Starting Bid (Premium)</td>
        <td>{{$shop->starting_bid_amount}}</td>
        <td>Maximum Bid Received</td>
        <td>{{$max_bid_amount}}</td>
    </tr>
    </thead>


</table>
<table width="100%" id="printTable" >
    <thead>

    <tr>
        <th >Bidder Name</th>
        <th>Amount</th>
        <th>Date Time</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $value)
        <tr >
            <td >{{$value->bidder_name}}</td>
            <td >{{$value->bid_amount}}</td>
            <td >{{date("d-m-Y h:i:s A",strtotime($value->created_at))}}</td>
        </tr>

     @endforeach
    </tbody>

</table>

</body>
</html>