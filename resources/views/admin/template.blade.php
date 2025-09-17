<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title ?? "Admin Dashboard"}}</title>
    <meta name="description" content="Modern Admin Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Chart.js for Dashboard Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- jQuery (keeping for compatibility) -->
    <script src="{{asset('plaza_admin_assets/assets/jquery/jquery-2.1.1.min.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/jquery.form.min.js')}}"></script>
    
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Notifications -->
    <script type="text/javascript" src="{{ asset('frontend/js/notify.min.js') }}"></script>
    
    <!-- Admin Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/modern-admin.css')}}">
    
    <script>
        BaseUrl = '{{ url('/') }}';
    </script>
    <style>
        .selcls {
            padding: 3px;
            border: solid 1px #517B97;
            outline: 0;
            background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #CAD9E3), to(#FFFFFF));
            background: -moz-linear-gradient(top, #FFFFFF, #CAD9E3 1px, #FFFFFF 25px);
            box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            width:150px;
        }
        .seldemo {
            background: #A0CFCF;
            height: 75px;
            width:250px;
            border-radius: 15px;
            padding:20px;
            font-size:22px;
            color:#fff;
        }


        #app_loader{
            justify-content: center !important;
            height: 74px !important;
        }
        .loader_background{
            text-align: center;
            color: white;
            position: fixed;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            top: -30px;
            background: #003a5d;
            width: 152px;
            border-radius: 16px;
            padding: 27px 10px 10px 10px;
            z-index: 1000;
        }
        .loader_background image{
            text-align: center;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
        .disabled_loader{
            display: none !important;
        }
        .enabled_loader{
            display: flex !important;
        }
        #modal-overlay {
            position: fixed;
            z-index: 10;
            background: black;
            opacity: .25;
            filter: alpha(opacity=75);
            width: 100%;
            height: 100%;
        }



    </style>

</head>
<body class="modern-admin-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay disabled_loader">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <!-- Admin Layout -->
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            @include('admin.side_menu')
        </aside>

        <!-- Main Content Area -->
        <div class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                @include('admin.header')
            </header>

            <!-- Content -->
            <main class="admin-content">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                @include('admin.footer')
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" onclick="scrollToTop()">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const main = document.querySelector('.admin-main');
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('expanded');
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Show/hide scroll to top button
        window.addEventListener('scroll', function() {
            const scrollBtn = document.getElementById('scrollToTop');
            if (window.pageYOffset > 300) {
                scrollBtn.classList.add('visible');
            } else {
                scrollBtn.classList.remove('visible');
            }
        });
    </script>


<!--basic scripts-->


<script>
    $(".alert-success").delay(3000).fadeOut();
    $(".alert-danger").delay(3000).fadeOut();

    var imgArray = [];
    /*var myDropzone = new Dropzone(".dropzone", {
        url: APP_URL+"/workout/files/upload",
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        maxFiles: 100,
        success : function(file, response){
            file.temp_name = response.image;
            imgArray.push(response.image);
            $("#save_img_btn").removeAttr('disabled');
            $("#images").val(imgArray);
            console.log(imgArray);
        }
    });*/
    $('#pally_size').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function show_loader(hide = false) {
        if (hide) {
            $("#app_loader").removeClass("enabled_loader");
            $("#app_loader").addClass("disabled_loader");
            $("#modal-overlay").hide();
            return;
        }//..... end if() .....//

        if($("#app_loader").hasClass("disabled_loader")){
            $("#app_loader").removeClass("disabled_loader");
            $("#app_loader").addClass("enabled_loader");
            $("#modal-overlay").show();
        }else{
            $("#app_loader").removeClass("enabled_loader");
            $("#app_loader").addClass("disabled_loader");
            $("#modal-overlay").hide();
        }
    }

    $(document).ajaxStart(function(){
        show_loader();
    });
    $(document).ajaxStop(function(){
        show_loader(true);
    });

    //$('input[type="number"]').keyup(function(e)
    $("body").on("keyup","input[type='number']",function(){

        if (/\D/g.test(this.value))
        {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    function forceNumeric(){

        var $input = $(this);

        $input.val($input.val().replace(/[^0-9\.]/g,''));
    }
    $('body').on('keyup', 'input[type="number"]', forceNumeric);

</script>

</body>

<!-- Mirrored from thetheme.io/flaty/more_blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 Jun 2020 20:11:59 GMT -->
</html>





