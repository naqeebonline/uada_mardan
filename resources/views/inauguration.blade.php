<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        var count_down = 11;
        function open_curtain()
        {
            $("#curtain1").animate({width:20},1000);
            $("#curtain2").animate({width:20},1000);
            setTimeout(function(){
                $("#curtain1").hide();
                $("#curtain2").hide();
            },1000)
        }
        function close_curtain()
        {
            $("#curtain1").animate({width:200},1000);
            $("#curtain2").animate({width:191},1000);
        }

        setTimeout(function(){
            open_curtain();
            countDown();
        },2000);

        function countDown(){

            setInterval(function(){
                count_down = count_down - 1;

                $("#count_down").text(count_down);
                if(count_down == 0){
                    window.location = "http://eproperty.lcbkp.gov.pk";
                }
            },1000);
        }
    </script>

    <style>
        body
        {
            text-align:center;
            width:100%;
            margin:0 auto;
            padding:0px;
            font-family:helvetica;
            background-color:#F79F81;
        }
        #wrapper
        {
            text-align:center;
            margin:0 auto;
            padding:0px;
            width:995px;
        }
        #effect
        {
            background-color:  #26ae61;
            position:relative;
            width:680px;
            height:420px;
            margin-left:200px;
            box-shadow:0px 0px 10px 0px #26ae61;
        }
        #effect p {
            margin-top: 100px;
            font-size: 24px;
            color: white;
        }
        #curtain1
        {
            top:0px;
            position:absolute;
            left:0px;
            height:420px;
        }
        #curtain2
        {
            top:0px;
            position:absolute;
            height:420px;
            right:0px;
        }
        #curtain_buttons input[type="button"]
        {
            margin-top:20px;
            width:150px;
            height:45px;
            border-radius:2px;
            color:white;
            background-color:#B43104;
            border:none;
            border-bottom:6px solid #8A2908;
        }

    </style>

    <style>
        .img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 119px;
            float: left;
            margin-left: 3px;
            margin-top: 4px;
        }

        .img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

        .img2 {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 119px;
            float: right;
            margin-right: 3px;
            margin-top: 4px;
        }

        .img2:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>
</head>
<body style="height:369px; background-image: url({{asset('front_end_assets/images/main.jpeg')}}); padding:50px 0">
<div id="wrapper" style="margin-top: 10px;" >

    <div id="effect">
        <img class="img" {{--style="height: 85px; width: 105px; float: left;" --}} src="{{asset("/mehmood.jpeg")}}" >
        <img class="img2" {{--style="height: 85px; width: 105px; float: left;" --}} src="{{asset("/kamran.jpeg")}}" >
            
            <br><br>

        <h2 style="color: white; padding: 20px">e-Property Management System </h2><br>
        <h2 style="color: white">INAUGURATED BY<br>
            HON’BLE CHIEF MINISTER KP MEHMOOD KHAN</h2>
        
        <h1 style="color: white" id="count_down"></h1>
        <img src="{{asset("/curtain1.jpg")}}" id="curtain1">
        <img src="{{asset("/curtain2.jpg")}}" id="curtain2">
<div style="color: white;">
        <h5>Developed & implemented by Smart City Wing LCB</h5>
        </div>
    </div>

    {{--<div id="curtain_buttons">
        <input type="button" value="OPEN CURTAIN" onclick="open_curtain();">
        <input type="button" value="CLOSE CURTAIN" onclick="close_curtain();">
    </div>--}}

</div>
</body>
</html>