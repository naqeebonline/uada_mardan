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



    <table width="100%" >
        <thead>

        <tr>
            <td width="16%" style="font-weight: bold;">Property</td>
            <td width="16%">{{$case->plaza_name ?? ""}}</td>
            <td width="17%" style="font-weight: bold;">Property Title</td>
            <td width="17%">{{$case->shop_name ?? ""}}</td>
            <td width="17%" style="font-weight: bold;">Case Number</td>
            <td width="17%">{{$case->case_number ?? ""}}</td>
        </tr>
        <tr>
            <td width="16%" style="font-weight: bold;">Case Title</td>
            <td width="16%">{{$case->case_title ?? ""}}</td>
            <td width="17%" style="font-weight: bold;">Lawyer Name</td>
            <td width="17%">{{$case->lawyer_name ?? ""}}</td>
            <td width="17%"></td>
            <td width="17%"></td>
        </tr>
        </thead>


    </table>
    @if(count($data) > 0)
        <table id="printTable" width="100%" st >
            <thead>

            <tr>

                <th width="20%">Hearing Date</th>
                <th>Outcome</th>
                <th>Remarks</th>

            </tr>
            </thead>
            <tbody>

            @foreach($data as $key => $value)

                <tr>
                    <td>{{date("d-m-Y",strtotime($value->heiring_date))}}</td>
                    <td>{{$value->outcome ?? ""}}</td>
                    <td>{{$value->remarks ?? ""}}</td>
                </tr>
            @endforeach


            </tbody>

        </table>
    @endif




</body>
</html>