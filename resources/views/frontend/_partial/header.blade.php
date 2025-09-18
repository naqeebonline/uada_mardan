<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="LOCAL COUNCIL BOARD" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title ?? ""}}</title>

    <!-- Favicon -->

    <link rel="shortcut icon" href="{{asset('logo.png')}}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- CSS Global Compulsory (keeping custom assets)-->
    <link rel="stylesheet" href="{{asset("front_end_assets/css/flaticon/flaticon.css")}}" />

    <!-- Page CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset("front_end_assets/css/select2/select2.css")}}" />
    <link rel="stylesheet" href="{{asset("front_end_assets/css/range-slider/ion.rangeSlider.css")}}" />
    <link rel="stylesheet" href="{{asset("front_end_assets/css/owl-carousel/owl.carousel.min.css")}}" />
    <link rel="stylesheet" href="{{asset("front_end_assets/css/magnific-popup/magnific-popup.css")}}" />

    <!-- Template Style -->
    <link rel="stylesheet" href="{{asset("front_end_assets/css/style.css")}}" />

    <!-- Modern Custom Styles -->
    <link rel="stylesheet" href="{{asset("css/modern-styles.css")}}" />

    <!-- jQuery (keeping your version for compatibility) -->
    <script src="{{asset("front_end_assets/js/jquery-3.4.1.min.js")}}"></script>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Page JS Implementing Plugins -->
    <script src="{{asset("front_end_assets/js/jquery.appear.js")}}"></script>
    <script src="{{asset("front_end_assets/js/counter/jquery.countTo.js")}}"></script>
    <script src="{{asset("front_end_assets/js/select2/select2.full.js")}}"></script>
    <script src="{{asset("front_end_assets/js/range-slider/ion.rangeSlider.min.js")}}"></script>
    <script src="{{asset("front_end_assets/js/owl-carousel/owl.carousel.min.js")}}"></script>
    <script src="{{asset("front_end_assets/js/jarallax/jarallax.min.js")}}"></script>
    <script src="{{asset("front_end_assets/js/jarallax/jarallax-video.min.js")}}"></script>
    <script src="{{asset("front_end_assets/js/magnific-popup/jquery.magnific-popup.min.js")}}"></script>

    <!-- Template Scripts -->
    <script src="{{asset("front_end_assets/js/custom.js")}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/notify.min.js') }}"></script>
    <style>
        :root {
            --primary-color: #bad164;
            --primary-dark: #a8c356;
            --accent-color: #8fb53f;
            --text-color: #5a6b2e;
            --light-bg: #f7fafc;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Enhanced Header Styles */
        .modern-header {
            position: sticky;
            top: 0;
            z-index: 1050;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .modern-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            opacity: 0.8;
        }

        .modern-header.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        .navbar {
            padding: 1rem 0;
            transition: all 0.4s ease;
        }

        .modern-header.scrolled .navbar {
            padding: 0.5rem 0;
        }

        /* Enhanced Logo Styles */
        .navbar-brand {
            display: flex !important;
            align-items: center;
            gap: 15px;
            padding: 0;
            margin-right: 2rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .logo-image {
            height: 65px;
            width: auto;
            object-fit: contain;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .modern-header.scrolled .logo-image {
            height: 50px;
        }

        .navbar-brand:hover .logo-image {
            transform: scale(1.05) rotate(2deg);
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.15));
        }

        .brand-text {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover .brand-text {
            transform: translateX(5px);
        }

        /* Enhanced Navigation */
        .navbar-nav {
            gap: 0.5rem;
        }

        .nav-link {
            position: relative;
            color: var(--text-color) !important;
            font-weight: 500;
            font-size: 15px;
            padding: 12px 18px !important;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: -1;
            opacity: 0.1;
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            transform: translateY(-2px) scale(1.02);
            background: rgba(var(--primary-color), 0.1) !important;
        }

        .nav-link i {
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        /* Enhanced Buttons */
        .btn {
            font-family: 'Poppins', sans-serif;
            border-radius: 25px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-size: 14px;
            padding: 10px 20px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color) !important;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)) !important;
            border: none;
            color: white !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color)) !important;
        }

        /* Enhanced Dropdown */
        .dropdown-menu {
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: none;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            padding: 10px;
            margin-top: 10px;
            animation: fadeInDown 0.3s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 15px;
            margin: 3px 0;
            padding: 12px 16px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            transition: left 0.3s ease;
            z-index: -1;
        }

        .dropdown-item:hover::before {
            left: 0;
        }

        .dropdown-item:hover {
            color: white !important;
            transform: translateX(8px);
        }

        /* Mobile Toggler */
        .navbar-toggler {
            border: none !important;
            padding: 8px 12px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(var(--primary-color), 0.1);
        }

        .navbar-toggler:hover {
            background: rgba(var(--primary-color), 0.2);
            transform: scale(1.1);
        }

        .navbar-toggler:focus {
            box-shadow: none !important;
        }

        /* User Profile Section */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d !important;
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: #6c757d !important;
            color: white !important;
            border-color: #6c757d !important;
        }

        /* Loading Animation */
        .loading-bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .loading-bar {
            transform: scaleX(1);
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.8rem 0;
            }

            .modern-header.scrolled .navbar {
                padding: 0.5rem 0;
            }

            .navbar-brand {
                margin-right: 1rem;
                gap: 10px;
            }

            .brand-text {
                font-size: 16px;
            }

            .logo-image {
                height: 50px;
            }

            .modern-header.scrolled .logo-image {
                height: 40px;
            }

            .navbar-nav {
                text-align: center;
                padding: 2rem 0 1rem;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                margin: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .nav-link {
                padding: 15px 25px !important;
                margin: 8px 0;
                border-radius: 15px;
                font-size: 16px;
            }

            .user-profile {
                flex-direction: column;
                gap: 10px;
                padding: 20px;
            }

            .btn {
                width: 200px;
                justify-self: center;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                flex-direction: column !important;
                align-items: center !important;
                gap: 4px;
                margin-right: 0;
                width: 100%;
                text-align: center;
            }
            .logo-image {
                height: 36px;
                max-width: 80vw;
                margin-bottom: 2px;
            }
            .brand-text {
                font-size: 12px;
                line-height: 1.1;
                word-break: break-word;
                max-width: 90vw;
            }
        }

        /* Scroll Effects */
        .scroll-indicator {
            position: absolute;
            bottom: -2px;
            left: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.2s ease-out;
        }

        .navbar .navbar-nav .nav-link {
            font-weight: 500;
            font-size: 12px;
            padding: 10px 20px;
            color: #001935;
            text-transform: capitalize;
        }
    </style>

</head>

<body>

    <!--=================================
Enhanced Modern Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg modern-header" id="mainNavbar">
            <div class="scroll-indicator" id="scrollIndicator"></div>
            <div class="container-fluid px-3 px-lg-4">
                <a class="navbar-brand" href="{{url("/")}}">
                    <div class="loading-bar"></div>
                    <img src="{{asset('logo.png')}}" alt="URBAN AREA DEVELOPMENT AUTHORITY MARDAN Logo" class="logo-image">
                    <span class="brand-text">URBAN AREA DEVELOPMENT AUTHORITY MARDAN</span>
                    
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-3" href="{{url("/")}}">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-3" href="{{url("/upComingAuctions")}}">
                                <i class="fas fa-calendar-alt me-1"></i>Upcoming Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-3" href="{{url("/completedAuctions")}}">
                                <i class="fas fa-archive me-1"></i>Archive Auctions
                            </a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user())
                        @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->user_type == "customer")
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-3" href="{{url('customer-dashboard')}}">
                                <i class="fas fa-user-circle me-1"></i>Bidder Dashboard
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-3" href="{{url('dashboard')}}">
                                <i class="fas fa-tachometer-alt me-1"></i>My Dashboard
                            </a>
                        </li>
                        @endif
                        @endif
                    </ul>

                    <div class="user-profile">
                        @guest
                        <a class="btn btn-outline-primary" href="{{ url('registration') }}">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a>
                        <a class="btn btn-primary" href="{{url("login")}}">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                        @endguest

                        @if(\Illuminate\Support\Facades\Auth::user())
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>{{auth()->user()->name}}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-3"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script>
        BaseUrl = '{{ url(' / ') }}';

        // Enhanced Header Scroll Effects
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNavbar');
            const scrollIndicator = document.getElementById('scrollIndicator');
            let lastScrollY = window.scrollY;
            let ticking = false;

            function updateNavbar() {
                const currentScrollY = window.scrollY;

                // Add/remove scrolled class
                if (currentScrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Update scroll indicator
                const scrollPercentage = (currentScrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
                scrollIndicator.style.transform = `scaleX(${scrollPercentage / 100})`;

                lastScrollY = currentScrollY;
                ticking = false;
            }

            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(updateNavbar);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', requestTick);

            // Smooth scroll for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Enhanced dropdown animations
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.dropdown-menu');

                dropdown.addEventListener('shown.bs.dropdown', function() {
                    menu.style.animation = 'fadeInDown 0.3s ease';
                });
            });

            // Navbar collapse animation for mobile
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse) {
                navbarCollapse.addEventListener('shown.bs.collapse', function() {
                    this.style.animation = 'fadeInDown 0.4s ease';
                });
            }

            // Add ripple effect to buttons
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Add ripple CSS
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
        document.head.appendChild(rippleStyle);
    </script>
    <!--End Enhanced Header -->