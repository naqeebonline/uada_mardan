
<footer class="modern-footer text-light">
    <div class="container py-3">
        <div class="row g-3 align-items-center">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <img src="{{asset('logo.jpg')}}" alt="Logo" class="footer-logo mb-2" height="35">
                    <p class="text-light-gray mb-0">Sheikh Maltoon Town Property Auction Platform - Your trusted partner in property auctions.</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h6 class="mb-2">Quick Links</h6>
                    <ul class="footer-links list-unstyled mb-0">
                        <li><a href="{{url('/')}}"><i class="fas fa-home me-2"></i>Home</a></li>
                        <li><a href="{{url('/upComingAuctions')}}"><i class="fas fa-calendar me-2"></i>Upcoming Auctions</a></li>
                        <li><a href="{{url('/completedAuctions')}}"><i class="fas fa-archive me-2"></i>Archive</a></li>
                        <li><a href="#"><i class="fas fa-info-circle me-2"></i>About Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-md-12">
                <div class="footer-section">
                    <h6 class="mb-2">Contact Info</h6>
                    <div class="contact-info">
                        <div class="contact-item mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span class="text-light-gray">Sector-F Sheikh Maltoon Town Mardan Pakistan</span>
                        </div>
                        <div class="contact-item mb-0">
                            <i class="fas fa-phone me-2"></i>
                            <span class="text-light-gray">Director Office (0937)9230433</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center py-2">
                <div class="col-md-8 text-center text-md-start">
                    <p class="mb-0 text-light-gray small">
                        &copy; <span id="copyright"></span> Sheikh Maltoon Town. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <a href="#" id="back-to-top" class="back-to-top">
                        <i class="fas fa-arrow-up me-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Styles -->
    <style>
        .modern-footer {
            background: linear-gradient(135deg, #a8c356 0%, #8fb53f 50%, #7a9e35 100%);
            position: relative;
        }
        
        .modern-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #bad164, transparent);
        }
        
        .footer-logo {
            filter: brightness(1.2);
            transition: transform 0.3s ease;
            max-width: 35px;
            height: auto;
        }
        
        .footer-logo:hover {
            transform: scale(1.05);
        }
        
        .text-light-gray {
            color: #ffffff !important;
            font-size: 14px;
            opacity: 0.9;
        }
        
        .footer-section h6 {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff !important;
        }
        
        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .footer-links li {
            margin: 0;
        }
        
        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 13px;
            padding: 2px 0;
            opacity: 0.9;
        }
        
        .footer-links a:hover {
            color: #bad164;
            transform: translateX(3px);
            opacity: 1;
        }
        
        .footer-links a i {
            font-size: 12px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            font-size: 13px;
        }
        
        .contact-item i {
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .back-to-top {
            color: #ffffff !important;
            font-weight: 500;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s ease;
            opacity: 0.9;
        }
        
        .back-to-top:hover {
            color: #bad164 !important;
            transform: translateY(-2px);
            opacity: 1;
        }
        
        .footer-bottom {
            padding: 8px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .contact-item i {
            font-size: 14px;
            flex-shrink: 0;
            color: #bad164 !important;
        }

        .text-primary {
            color: #bad164 !important;
        }
        
        @media (max-width: 768px) {
            .footer-section {
                text-align: center;
                margin-bottom: 1rem;
            }
            
            .footer-links {
                justify-content: center;
                gap: 10px;
            }
            
            .contact-item {
                justify-content: center;
                text-align: center;
                font-size: 12px;
            }
            
            .text-light-gray {
                font-size: 13px;
            }
            
            .footer-section h6 {
                font-size: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .footer-links {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</footer>
<!--=================================
footer-->






<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>

<!-- Mirrored from themes.potenzaglobalsolutions.com/html/real-villa/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jun 2020 12:28:15 GMT -->
</html>