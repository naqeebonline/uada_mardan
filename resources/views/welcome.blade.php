<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{env("APP_NAME")}}</title>
    <!-- Favicon-->
    <!-- link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" / -->
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset("welcome/css/styles.css")}}" rel="stylesheet" />
    <link href="{{asset("welcome/css/price.css")}}" rel="stylesheet" />
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        img{ width: 100%; height: auto }
        header.masthead{ height: auto; }
        header.masthead p{
            font-family: 'Oswald', sans-serif;
            font-size: 4em;
            text-transform: uppercase;
            color: #cef556;
            text-shadow: 2px 2px 5px #000;
        }
        header.masthead .family {
            background-size: 50%;
            background-repeat: no-repeat;
            background-position: bottom right;
        }
        .page-section {
            position: relative;
            background-image: url( '{{asset("/")}}/welcome/assets/img/laptop.png' );
            background-position: bottom left;
            background-size: 50%;
            background-repeat: no-repeat;
            padding-top: 4em;
        }
        .page-section .register_button{
            top: -150px;
            right: 0;
            position: absolute;
        }
        .page-section .register_button img{ width: 400px; }
        .page-section .laptop{
            position: absolute;
            bottom: -180px;
            left: -120px;
        }
        .page-section h2{
            font-family: 'Oswald', sans-serif;
        }
        footer{ background-color: #ededed }
        @media (max-width: 768px) {
            header.masthead p{ font-size: 3em; }
            .page-section .register_button img{ width: 250px; }
            .pricing-table { flex-direction: column; }
            .pricing-box { margin: 10px; }
        }
    </style>
</head>
<body id="page-top">
<!-- Masthead-->
<header class="masthead">
    <div class="family" style="background-image: url('{{asset("/")}}//welcome/assets/img/family.png') ">
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <p><img id="site-logo" src="{{asset("/")}}/welcome/assets/img/logo.png" alt="" style="width: 100%; height: auto"></p>
                    <p class="font-weight-bold mb-5 text-center">Manage your congregation by allowing members to book their seat before service!</p>
                </div>
                <div class="col-lg">&nbsp;</div>
            </div>
        </div>
    </div>
</header>
<!-- Contact-->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col">
                @if (Route::has('login'))
                    @if (Route::has('register'))
                        <a href="/registration" class="register_button"><img src="{{asset("/")}}/welcome/assets/img/register_button.png" alt=""></a>
                    @endif
                @endif

                <div class="pricing-table">
                    <div class="pricing-box">
                        <h2>Features</h2>
                        <span class="description">You are able to:</span>
                        <span class="pricing-table-divider"></span>
                        <ul>
                            <li>Set the number of seats available</li>
                            <li>Capture your guess data</li>
                            <li>Create multiple events on the same day</li>
                            <li>Close a event at anytime</li>
                            <li>Custom link page to send out via email and social media platforms</li>
                            <li>Check off all attendants from the system</li>
                            <li>Send thank you email to each attendant when checked-in</li>
                        </ul>
                        @if (Route::has('login'))
                            @if (Route::has('register'))
                                <p><a href="/registration" class="btn">Register</a></p>
                            @endif
                        @endif
                    </div>
                    <div class="pricing-box">
                        <h2>Organization Packages</h2>
                        <span class="description">USD per month:</span>
                        <span class="pricing-table-divider"></span>
                        <ul>
                            <li>30 Day Free Trial</li>
                            <li>1 - 50 seats - $15.00 USD / month</li>
                            <li>51 - 100 seats - $25.00 USD / month</li>
                            <li>101 - 200 seats - $35.00 USD / month</li>
                            <li>201 - 350 seats - $45.00 USD / month</li>
                            <li>351 - 550 seats - $55.00 USD / month</li>
                        </ul>
                        @if (Route::has('login'))
                            @if (Route::has('register'))
                                <p><a href="/registration" class="btn">Register</a></p>
                            @endif
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="pt-1">
    <div class="container text-center">
            	<span class="copyright">
            		<i class="fas fa-map-marker"></i> Shop #8, 90B Red Hills Road, Kingston Jamaica
            		| <i class="fas fa-phone"></i> +1 (876) 855-7751
            		| <i class="fas fa-envelope"></i> contact@uniquemediadesigns.com <br>
            	&copy; 2020 {{env("APP_NAME")}}</span>
    </div>
</footer>
</body>
</html>