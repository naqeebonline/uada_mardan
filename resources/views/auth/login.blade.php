

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Property Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/jpg">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .logo-section {
        text-align: center;
        margin-bottom: 40px;
    }

    .logo-section img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
    }

    .welcome-text {
        color: #2d3748;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .subtitle {
        color: #718096;
        font-size: 16px;
        font-weight: 400;
    }

    .form-group {
        position: relative;
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        color: #4a5568;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px 15px 50px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #fff;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .form-control:focus + .form-icon {
        color: #667eea;
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .forgot-password {
        text-align: center;
        margin-top: 25px;
    }

    .forgot-password a {
        color: #667eea;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-password a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .invalid-feedback {
        display: block;
        color: #e53e3e;
        font-size: 12px;
        margin-top: 5px;
        padding-left: 5px;
    }

    .form-control.is-invalid {
        border-color: #e53e3e;
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 30px 0;
        color: #a0aec0;
        font-size: 14px;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e2e8f0;
        z-index: 1;
    }

    .divider span {
        background: rgba(255, 255, 255, 0.95);
        padding: 0 15px;
        position: relative;
        z-index: 2;
    }

    .register-link {
        text-align: center;
        margin-top: 20px;
        color: #718096;
        font-size: 14px;
    }

    .register-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-container {
            margin: 10px;
            padding: 30px 25px;
        }
        
        .welcome-text {
            font-size: 24px;
        }
        
        .form-control {
            padding: 12px 15px 12px 45px;
        }
        
        .btn-login {
            padding: 12px;
        }
    }

    /* Loading animation */
    .btn-loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="{{asset('logo.png')}}" alt="Company Logo">
            <h1 class="welcome-text">Welcome Back</h1>
            <p class="subtitle">URBAN AREA DEVELOPMENT AUTHORITY MARDAN</p>
        </div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div style="position: relative;">
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email" 
                        autofocus
                        placeholder="Enter your email address"
                    >
                    <i class="fas fa-envelope form-icon"></i>
                </div>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div style="position: relative;">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    >
                    <i class="fas fa-lock form-icon"></i>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                <span class="btn-text">Sign In</span>
            </button>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot your password?</a>
        </div>

        @if(Route::has('register'))
        <div class="divider">
            <span>or</span>
        </div>
        
        <div class="register-link">
            Don't have an account? <a href="{{ route('user.registration') }}">Sign up</a>
        </div>
        @endif
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const inputs = document.querySelectorAll('.form-control');

            // Add focus/blur effects to form inputs
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });

                // Real-time validation styling
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                loginBtn.classList.add('btn-loading');
                loginBtn.querySelector('.btn-text').textContent = 'Signing In...';
                
                // Prevent double submission
                loginBtn.disabled = true;
            });

            // Add subtle animations on load
            setTimeout(() => {
                document.querySelector('.login-container').style.animation = 'fadeInUp 0.6s ease-out';
            }, 100);
        });

        // CSS animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>












