<style>
    .slider-banner {
        position: relative;
        height: 369px;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 50px 0;
        overflow: hidden;
        /* Enhanced Shadow System */
        box-shadow: 
            /* Inner shadows for depth */
            inset 0 0 150px rgba(0, 0, 0, 0.4),
            inset 0 -50px 100px rgba(0, 0, 0, 0.3),
            /* Outer shadows for elevation */
            0 15px 40px rgba(0, 0, 0, 0.25),
            0 30px 80px rgba(0, 0, 0, 0.15),
            0 45px 120px rgba(0, 0, 0, 0.1);
        /* Slider-like borders */
        border-top: 4px solid rgba(186, 209, 100, 0.7);
        border-bottom: 4px solid rgba(168, 195, 86, 0.7);
        /* Smooth transitions for slider effect */
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slideIn 1.2s ease-out;
    }

    /* Slider Animation */
    @keyframes slideIn {
        0% {
            transform: translateY(30px);
            opacity: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        50% {
            transform: translateY(-5px);
            opacity: 0.8;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
            box-shadow: 
                inset 0 0 150px rgba(0, 0, 0, 0.4),
                0 15px 40px rgba(0, 0, 0, 0.25),
                0 30px 80px rgba(0, 0, 0, 0.15);
        }
    }

    /* Moving background effect for slider feel */
    .slider-banner {
        background-size: 110% auto;
        animation: slideIn 1.2s ease-out, backgroundMove 20s infinite linear;
    }

    @keyframes backgroundMove {
        0% {
            background-position: 0% 50%;
        }
        25% {
            background-position: 100% 50%;
        }
        50% {
            background-position: 100% 100%;
        }
        75% {
            background-position: 0% 100%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    /* Enhanced overlay system */
    .slider-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            45deg,
            rgba(186, 209, 100, 0.2) 0%,
            rgba(168, 195, 86, 0.3) 25%,
            rgba(0, 0, 0, 0.5) 60%,
            rgba(0, 0, 0, 0.7) 100%
        );
        z-index: 1;
        /* Animated overlay for slider effect */
        animation: overlayShift 15s infinite ease-in-out;
    }

    @keyframes overlayShift {
        0%, 100% {
            background: linear-gradient(
                45deg,
                rgba(186, 209, 100, 0.2) 0%,
                rgba(168, 195, 86, 0.3) 25%,
                rgba(0, 0, 0, 0.5) 60%,
                rgba(0, 0, 0, 0.7) 100%
            );
        }
        50% {
            background: linear-gradient(
                135deg,
                rgba(168, 195, 86, 0.25) 0%,
                rgba(186, 209, 100, 0.2) 30%,
                rgba(0, 0, 0, 0.4) 70%,
                rgba(0, 0, 0, 0.6) 100%
            );
        }
    }

    /* Floating light effects */
    .slider-banner::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(186, 209, 100, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 80% 20%, rgba(168, 195, 86, 0.12) 0%, transparent 45%),
            radial-gradient(circle at 40% 80%, rgba(186, 209, 100, 0.1) 0%, transparent 50%);
        z-index: 2;
        animation: floatingLights 12s infinite ease-in-out;
    }

    @keyframes floatingLights {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        33% {
            opacity: 0.7;
            transform: scale(1.1);
        }
        66% {
            opacity: 0.9;
            transform: scale(0.95);
        }
    }

    /* Enhanced content styling */
    .banner-content {
        position: relative;
        z-index: 3;
        text-shadow: 
            3px 3px 6px rgba(0, 0, 0, 0.6),
            0 0 30px rgba(0, 0, 0, 0.4),
            0 0 50px rgba(186, 209, 100, 0.2);
        animation: contentFadeIn 1.5s ease-out 0.3s both;
    }

    @keyframes contentFadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slider-banner .container {
        position: relative;
        z-index: 3;
    }

    /* Hover effect for interactive slider feel */
    .slider-banner:hover {
        box-shadow: 
            inset 0 0 200px rgba(0, 0, 0, 0.5),
            0 20px 50px rgba(0, 0, 0, 0.3),
            0 40px 100px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .slider-banner {
            background-attachment: scroll;
            height: 300px;
            animation: slideIn 1s ease-out, backgroundMove 25s infinite linear;
        }
        
        .banner-content {
            text-shadow: 
                2px 2px 4px rgba(0, 0, 0, 0.6),
                0 0 20px rgba(0, 0, 0, 0.4);
        }
    }
</style>

<section class="banner slider-banner" style="background-image: url({{asset('front_end_assets/images/main.jpeg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner-content">
                    <h1 class="text-white text-center mb-2"></h1>
                    <p class="lead text-center text-white mb-4 font-weight-normal"></p>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){


        $("body").on("change","#office_id",function(e){
            var id = $(this).val();
            if(id == ""){
                $("#organization_id").html("");
                var html = `<option value="">Select Organization</option>`;
                $("#organization_id").append(html);
                return false;
            }
            $.ajax({
                method:"GET",
                url:"{{url('getOrganizationOffice')}}/"+id,
                success:function(res){
                    $("#organization_id").html("");
                    var html = `<option value="">Select Organization</option>`;
                    res.data.forEach(function(value,key){
                       html += `<option value="${value.id}">${value.org_name}</option>`;
                    });
                    $("#organization_id").append(html);

                },
                error: function (request, status, error) {

                }
            });

        });

        $("body").on("click",".search_property",function(e){

            var property_type = $("#property_type").val();
            var office_id = $("#office_id").val();
            var organization_id = $("#organization_id").val();
            if(office_id != "" || property_type !="" || organization_id != ""){
                window.location = "{{url("/")}}/?type="+property_type+"&office_id="+office_id+"&organization="+organization_id;
            }

        });
    });

</script>