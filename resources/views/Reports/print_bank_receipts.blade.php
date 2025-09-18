

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>


<?php
$customer_name = $customer->customer->name ?? "";
$rent = $customer->shop->current_rent ?? "";
$shop_name = $customer->shop->shop_name ?? "";
?>
<div style="overflow: hidden;  margin: 0 auto; display: table;width: 960px;">
    <div style=" border: 1px solid; float: left;height: 285px;">
        <div style="float: left; width: inherit;  padding-top: 5px;">
            <img src="https://properties-cdgp.com/images/hbl.jpg" style="height: 40px;    width: 86px;    float: left;    margin-left: 0px;"/>

            <div style="float: left;    width: 763px;    margin-top: 1px;    text-align: center !important;">
                <h1 style="float: left;    margin: 0px;    font-size: 17px;    text-align: center;    width: inherit;">Local Council Board </h1>
                <h6 style="font-family: sans-serif; margin: 0px;  float: right; background: black; color: white; padding: 4px 7px; -webkit-border-radius: 7px; -moz-border-radius:7px; border-radius: 7px;"> Property</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: left;    width: 62%;    font-size: 13px;    margin-top: 1px;    text-align: right;">HBL A/C No: 11817901426803</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: right;    width: 100%;    font-size: 11px;    margin-top: 10px;">GT Road Peshawar</h6>
            </div>

            <img src="https://properties-cdgp.com/images/logo.png" style="margin-right: 10px;    height: 45px;    width: 60px;    float: right;"/>

            <ul style='padding: 5px 0px;    margin: 0px;    float: left;    width: inherit;    list-style: none;'>
                <li style='float: left;    font-size: 12px;    width: 150px;font-family: sans-serif;  padding-left: 10px;  '>B.No:  <span style="font-weight: bold;">6</span> </li>
                <li style='float: left;    font-size: 11px;    text-align: center;    width: 598px;    font-weight: bold;   font-family: sans-serif;'> AC Title: Local Council Board DIRECTOR GENERAL</li>
                <li style='float: right;    font-size: 12px;    width: 200px;    text-align: right;font-family: sans-serif;   '>S.No:  <span style="font-weight: bold;">29-A</span> </li>
            </ul>
            <div style="margin-left:10px;">
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px;font-size: 9px;    margin-bottom: 8px; clear:both;">Tenant / Lessee Name: {{$customer_name ?? ""}}</h5>
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 8px;">Demand No:  {{$shop_name?? ""}}</h5>
                {{--<h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 1px;">Circle / Locality:A</h5>--}}
            </div>


        </div>

        <div style="float: left;">
            <table style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;border-collapse: collapse;width: 100%;">
                <thead>
                <tr>
                    <th colspan='6' style="font-family: sans-serif;font-size: 9px; word-break: break-all;width: 200px;padding: 2px;">Deposit Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Current</td>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Arrear</td>
                    <td colspan='2' rowspan="2" style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: center;padding: 2px;font-weight: bold;" class='Price'>Grand Total</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;height:30px;">{{date("M Y")}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;">{{$rent ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>Previous Balance</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;" class='Price'>{{$balance ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>{{ ($rent)+($balance) }}</td>
                </tr>
                </tbody>
            </table>


            <div style="float: left;  width: 99.4%; font-family: sans-serif; font-size: 12px;padding-left: 4px; padding-bottom: 5px;margin-top: 6px;">
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Cash / Checque No: CASH</h5>
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Amount in Words ______________________________________________________________________________________________________________________________________________________________________________</h5>


                <ul style='padding: 0px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;       font-family: sans-serif;font-weight: bold;'>Date of Issue: 2021-01-07</li>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Due Date ______________________________________________________________</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;'>Signature___________________________________________   </li>
                </ul>

                <ul style='padding: 4px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Acceptable at any HBL Branch for Deposit</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;margin-right: 5px;'>Dispatch office Copy to HBL G.T Road Branch (1151) Firdus Chowk Peshawar City</li>
                </ul>

            </div>
        </div>
    </div>

    <div style="float: left;    width: 100%;    border-top: 1px dashed;    margin-right: 7px;    margin: 8px 0px;"></div>

    <div style=" border: 1px solid; float: left;height: 285px;">
        <div style="float: left; width: inherit;  padding-top: 5px;">
            <img src="https://properties-cdgp.com/images/hbl.jpg" style="height: 40px;    width: 86px;    float: left;    margin-left: 0px;"/>

            <div style="float: left;    width: 763px;    margin-top: 1px;    text-align: center !important;">
                <h1 style="float: left;    margin: 0px;    font-size: 17px;    text-align: center;    width: inherit;">Local Council Board </h1>
                <h6 style="font-family: sans-serif; margin: 0px;  float: right; background: black; color: white; padding: 4px 7px; -webkit-border-radius: 7px; -moz-border-radius:7px; border-radius: 7px;"> Property</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: left;    width: 62%;    font-size: 13px;    margin-top: 1px;    text-align: right;">HBL A/C No: 11817901426803</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: right;    width: 100%;    font-size: 11px;    margin-top: 1px;">GT Road Peshawar</h6>
            </div>

            <img src="https://properties-cdgp.com/images/logo.png" style="margin-right: 10px;    height: 45px;    width: 60px;    float: right;"/>

            <ul style='padding: 5px 0px;    margin: 0px;    float: left;    width: inherit;    list-style: none;'>
                <li style='float: left;    font-size: 12px;    width: 150px;font-family: sans-serif;  padding-left: 4px;  '>B.No:  <span style="font-weight: bold;">6</span> </li>
                <li style='float: left;    font-size: 11px;    text-align: center;    width: 598px;    font-weight: bold;   font-family: sans-serif;'> AC Title: Local Council Board DIRECTOR GENERAL</li>
                <li style='float: right;    font-size: 12px;    width: 200px;    text-align: right;font-family: sans-serif;   '>S.No:  <span style="font-weight: bold;">29-A</span> </li>
            </ul>

            <div style="margin-left:10px;">
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px;font-size: 9px;    margin-bottom: 8px; clear:both;">Tenant / Lessee Name: {{$customer_name ?? ""}}</h5>
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 8px;">Demand No:  {{$shop_name?? ""}}</h5>
                {{--<h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 1px;">Circle / Locality:A</h5>--}}
            </div>

        </div>

        <div style="float: left;">
            <table style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;border-collapse: collapse;width: 100%;">
                <thead>
                <tr>
                    <th colspan='6' style="font-family: sans-serif;font-size: 9px; word-break: break-all;width: 200px;padding: 2px;">Deposit Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Current</td>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Arrear</td>
                    <td colspan='2' rowspan="2" style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: center;padding: 2px;font-weight: bold;" class='Price'>Grand Total</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;height:30px;">{{date("M Y")}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;">{{$rent ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>Previous Balance</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;" class='Price'>{{$balance ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>{{ ($rent)+($balance) }}</td>
                </tr>
                </tbody>
            </table>


            <div style="float: left;  width: 99.4%; font-family: sans-serif; font-size: 12px;padding-left: 4px; padding-bottom: 5px;margin-top: 6px;">
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Cash / Checque No: CASH</h5>
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Amount in Words ______________________________________________________________________________________________________________________________________________________________________________</h5>


                <ul style='padding: 0px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;       font-family: sans-serif;font-weight: bold;'>Date of Issue: 2021-01-07</li>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Due Date ______________________________________________________________</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;'>Signature___________________________________________   </li>
                </ul>

                <ul style='padding: 4px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Acceptable at any HBL Branch for Deposit</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;margin-right: 5px;'>Dispatch office Copy to HBL G.T Road Branch (1151) Firdus Chowk Peshawar City</li>
                </ul>

            </div>
        </div>
    </div>

    <div style="float: left;    width: 100%;    border-top: 1px dashed;    margin-right: 7px;    margin: 8px 0px;"></div>

    <div style=" border: 1px solid; float: left;height: 285px;">
        <div style="float: left; width: inherit;  padding-top: 5px;">
            <img src="https://properties-cdgp.com/images/hbl.jpg" style="height: 40px;    width: 86px;    float: left;    margin-left: -0px;"/>

            <div style="float: left;    width: 763px;    margin-top: 1px;    text-align: center !important;">
                <h1 style="float: left;    margin: 0px;    font-size: 17px;    text-align: center;    width: inherit;">Local Council Board </h1>
                <h6 style="font-family: sans-serif; margin: 0px;  float: right; background: black; color: white; padding: 4px 7px; -webkit-border-radius: 7px; -moz-border-radius:7px; border-radius: 7px;"> Property</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: left;    width: 62%;    font-size: 13px;    margin-top: 1px;    text-align: right;">HBL A/C No: 11817901426803</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: right;    width: 100%;    font-size: 11px;    margin-top: 1px;">GT Road Peshawar</h6>
            </div>

            <img src="https://properties-cdgp.com/images/logo.png" style="margin-right: 10px;    height: 45px;    width: 60px;    float: right;"/>

            <ul style='padding: 5px 0px;    margin: 0px;    float: left;    width: inherit;    list-style: none;'>
                <li style='float: left;    font-size: 12px;    width: 150px;font-family: sans-serif;  padding-left: 4px;  '>B.No:  <span style="font-weight: bold;">6</span> </li>
                <li style='float: left;    font-size: 11px;    text-align: center;    width: 598px;    font-weight: bold;   font-family: sans-serif;'> AC Title: Local Council Board DIRECTOR GENERAL</li>
                <li style='float: right;    font-size: 12px;    width: 200px;    text-align: right;font-family: sans-serif;   '>S.No:  <span style="font-weight: bold;">29-A</span> </li>
            </ul>
            <div style="margin-left:10px;">
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px;font-size: 9px;    margin-bottom: 8px; clear:both;">Tenant / Lessee Name: {{$customer_name ?? ""}}</h5>
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 8px;">Demand No:  {{$shop_name?? ""}}</h5>
                {{--<h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 1px;">Circle / Locality:A</h5>--}}
            </div>
        </div>

        <div style="float: left;">
            <table style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;border-collapse: collapse;width: 100%;">
                <thead>
                <tr>
                    <th colspan='6' style="font-family: sans-serif;font-size: 9px; word-break: break-all;width: 200px;padding: 2px;">Deposit Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Current</td>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Arrear</td>
                    <td colspan='2' rowspan="2" style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: center;padding: 2px;font-weight: bold;" class='Price'>Grand Total</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;height:30px;">{{date("M Y")}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;">{{$rent ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>Previous Balance</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;" class='Price'>{{$balance ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>{{ ($rent)+($balance) }}</td>
                </tr>
                </tbody>
            </table>


            <div style="float: left;  width: 99.4%; font-family: sans-serif; font-size: 12px;padding-left: 4px; padding-bottom: 5px;margin-top: 6px;">
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Cash / Checque No: CASH</h5>
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Amount in Words ______________________________________________________________________________________________________________________________________________________________________________</h5>


                <ul style='padding: 0px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;       font-family: sans-serif;font-weight: bold;'>Date of Issue: 2021-01-07</li>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Due Date ______________________________________________________________</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;'>Signature___________________________________________   </li>
                </ul>

                <ul style='padding: 4px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Acceptable at any HBL Branch for Deposit</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;margin-right: 5px;'>Dispatch office Copy to HBL G.T Road Branch (1151) Firdus Chowk Peshawar City</li>
                </ul>

            </div>
        </div>
    </div>

    <div style="float: left;    width: 100%;    border-top: 1px dashed;    margin-right: 7px;    margin: 8px 0px;"></div>

    <div style=" border: 1px solid; float: left;height: 285px;">
        <div style="float: left; width: inherit;  padding-top: 5px;">
            <img src="https://properties-cdgp.com/images/hbl.jpg" style="height: 40px;    width: 86px;    float: left;    margin-left: 0px;"/>

            <div style="float: left;    width: 763px;    margin-top: 1px;    text-align: center !important;">
                <h1 style="float: left;    margin: 0px;    font-size: 17px;    text-align: center;    width: inherit;">Local Council Board </h1>
                <h6 style="font-family: sans-serif; margin: 0px;  float: right; background: black; color: white; padding: 4px 7px; -webkit-border-radius: 7px; -moz-border-radius:7px; border-radius: 7px;"> Property</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: left;    width: 62%;    font-size: 13px;    margin-top: 1px;    text-align: right;">HBL A/C No: 11817901426803</h6>
                <h6 style="font-family: sans-serif;    margin: 0px;    float: right;    width: 100%;    font-size: 11px;    margin-top: 1px;">GT Road Peshawar</h6>
            </div>

            <img src="https://properties-cdgp.com/images/logo.png" style="margin-right: 10px;    height: 45px;    width: 60px;    float: right;"/>

            <ul style='padding: 5px 0px;    margin: 0px;    float: left;    width: inherit;    list-style: none;'>
                <li style='float: left;    font-size: 12px;    width: 150px;font-family: sans-serif;  padding-left: 4px;  '>B.No:  <span style="font-weight: bold;">6</span> </li>
                <li style='float: left;    font-size: 11px;    text-align: center;    width: 598px;    font-weight: bold;   font-family: sans-serif;'> AC Title: Local Council Board DIRECTOR GENERAL</li>
                <li style='float: right;    font-size: 12px;    width: 200px;    text-align: right;font-family: sans-serif;   '>S.No:  <span style="font-weight: bold;">29-A</span> </li>
            </ul>
            <div style="margin-left:10px;">
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px;font-size: 9px;    margin-bottom: 8px; clear:both;">Tenant / Lessee Name: {{$customer_name ?? ""}}</h5>
                <h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 8px;">Demand No:  {{$shop_name?? ""}}</h5>
                {{--<h5 style="padding-left: 4px;font-family: sans-serif;    margin: 0px; font-size: 9px;    margin-bottom: 1px;">Circle / Locality:A</h5>--}}
            </div>
        </div>

        <div style="float: left;">
            <table style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;border-collapse: collapse;width: 100%;">
                <thead>
                <tr>
                    <th colspan='6' style="font-family: sans-serif;font-size: 9px; word-break: break-all;width: 200px;padding: 2px;">Deposit Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Current</td>
                    <td colspan='2' style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Arrear</td>
                    <td colspan='2' rowspan="2" style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: center;padding: 2px;font-weight: bold;" class='Price'>Grand Total</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Period</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;font-weight: bold;">Amount</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;height:30px;">{{date("M Y")}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;padding: 2px;text-align: center;">{{$rent ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>Previous Balance</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;" class='Price'>{{$balance ?? 0}}</td>
                    <td style="border: 1px solid #000;font-family: sans-serif;font-size: 9px;word-break: break-all;text-align: right;padding: 2px;text-align:center;" class='Price'>{{ ($rent) + ($balance) }}</td>
                </tr>
                </tbody>
            </table>


            <div style="float: left;  width: 99.4%; font-family: sans-serif; font-size: 12px;padding-left: 4px; padding-bottom: 5px;margin-top: 6px;">
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Cash / Checque No: CASH</h5>
                <h5 style="font-family: sans-serif;    margin: 0px;    float: left;font-size: 9px;    margin-bottom: 9px;">Amount in Words ______________________________________________________________________________________________________________________________________________________________________________</h5>


                <ul style='padding: 0px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;       font-family: sans-serif;font-weight: bold;'>Date of Issue: 2021-01-07</li>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Due Date ______________________________________________________________</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;'>Signature___________________________________________   </li>
                </ul>

                <ul style='padding: 4px 0px;    margin: 0px;    float: left;    width: 100%;    list-style: none;'>
                    <li style='float: left;    font-size: 9px;    text-align: center;    font-family: sans-serif;font-weight: bold;'> Acceptable at any HBL Branch for Deposit</li>
                    <li style='float: right;    font-size: 9px;    text-align: right;   font-family: sans-serif;font-weight: bold;margin-right: 5px;'>Dispatch office Copy to HBL G.T Road Branch (1151) Firdus Chowk Peshawar City</li>
                </ul>

            </div>
        </div>
    </div>

</div>
</body>
</html>
