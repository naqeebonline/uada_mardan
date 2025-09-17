@extends('frontend.master')
@section('content')
    <!-- Login Section -->
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="login-card">
                        <div class="text-center mb-4">
                            <div class="login-icon mb-3">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-2">Welcome Back</h2>
                            <p class="text-muted">Sign in to your account to continue</p>
                        </div>

                        <form id="myForm" method="post" action="{{url("login-user")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-medium text-dark">
                                    <i class="fas fa-user me-2 text-primary"></i>Username
                                </label>
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="Enter your username" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-medium text-dark">
                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                </label>
                                <div class="position-relative">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                                    <button type="button" class="btn-password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="#" class="text-primary text-decoration-none fw-medium">Forgot Password?</a>
                                </div>
                            </div>
                            
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg modern-btn">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center">
                            <p class="text-muted mb-0">Don't have an account?</p>
                            <a href="{{URL::to('customer-registration')}}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="fas fa-user-plus me-2"></i>Create New Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .login-section {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .login-icon {
            font-size: 4rem;
            color: #007bff;
        }
        
        .form-control-lg {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control-lg:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.15);
        }
        
        .btn-password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
        }
        
        .btn-password-toggle:hover {
            color: #007bff;
        }
        
        @media (max-width: 768px) {
            .login-card {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }
            
            .login-section {
                min-height: 70vh;
            }
        }
    </style>

    <script>
        function togglePassword() {
            const passwordInput = document.querySelector('input[name="password"]');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }
    </script>


    <!-- Inner -->
    <section class="planningsec py-4 inner-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="inner_block text-center">
                        <h1 class="CircularStd-Black text-primary mb-0">List a task needs for your own offer  <button class="btn get-started text-white btn-lg ml-md-3">Get Started</button></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Inner -->
@endsection