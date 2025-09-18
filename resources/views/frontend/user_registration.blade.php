<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>{{env("APP_NAME")}} | Registration</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/jpg">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script type="text/javascript">
        var BaseUrl = {!! json_encode(url('/')) !!}
    </script>
    
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
            padding: 20px 0;
        }

        .registration-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px;
            position: relative;
            overflow: hidden;
        }

        .registration-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-section .subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .form-section {
            padding: 40px;
        }

        .section-title {
            color: #2d3748;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: #4a5568;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .required {
            color: #e53e3e;
            font-size: 16px;
            margin-left: 3px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-display {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border: 2px dashed #e2e8f0;
            border-radius: 10px;
            background: #f7fafc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-display:hover {
            border-color: #667eea;
            background: #edf2f7;
        }

        .file-input-display i {
            color: #667eea;
            margin-right: 10px;
            font-size: 18px;
        }

        .file-input-display span {
            color: #4a5568;
            font-size: 14px;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            color: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 15px 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-cancel {
            background: #e2e8f0;
            border: none;
            border-radius: 12px;
            color: #4a5568;
            font-size: 16px;
            font-weight: 500;
            padding: 15px 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: #cbd5e0;
            color: #2d3748;
            text-decoration: none;
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .footer-links p {
            color: #718096;
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .input-hint {
            font-size: 12px;
            color: #a0aec0;
            margin-top: 5px;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .registration-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .header-section {
                padding: 30px 20px;
            }
            
            .header-section h1 {
                font-size: 1.8rem;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }

        .loading {
            pointer-events: none;
            opacity: 0.7;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
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
</head>

<body>
<?php
        $show_popup = false;
        $org_id = 0;

if(session()->has('show_popup')){
    $show_popup = true;
    $org_id = session()->get('show_popup');
}

?>

<div class="container-fluid">
    <div class="registration-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1><i class="fas fa-user-plus me-3"></i>Customer Registration</h1>
            <p class="subtitle">کسٹمر رجسٹریشن فارم - Create your account to get started</p>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            @if(session()->has('error_message'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session()->get('error_message') }}
                </div>
            @endif

            @if(session()->has('success_message'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session()->get('success_message') }}
                </div>
            @endif




            <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("signUpUser")}}">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="mb-5">
                    <h3 class="section-title">
                        <i class="fas fa-user me-2"></i>Personal Information
                    </h3>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Customer Name <span class="required">*</span></label>
                                <input type="hidden" class="form-control" name="id" value="{{$user->id ?? 0}}" required>
                                <input type="text" class="form-control" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Father Name <span class="required">*</span></label>
                                <input type="text" class="form-control" name="fathername" placeholder="Enter father's name" value="{{ old('fathername') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">CNIC Number <span class="required">*</span></label>
                                <input type="number" class="form-control" onKeyPress="if(this.value.length==13) return false;" maxlength="13" name="cnic" placeholder="Enter 13-digit CNIC" value="{{ old('cnic') }}" required>
                                <div class="input-hint">Enter 13-digit CNIC without dashes</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address <span class="required">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Enter your complete address" value="{{ old('address') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-5">
                    <h3 class="section-title">
                        <i class="fas fa-envelope me-2"></i>Contact Information
                    </h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email Address <span class="required">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mobile Number <span class="required">*</span></label>
                                <input type="text" class="form-control" onKeyPress="if(this.value.length==11) return false;" maxlength="11" name="phoneNumber" placeholder="03xxxxxxxxx" value="{{ old('phoneNumber') }}" required>
                                <div class="input-hint">Format: 03xxxxxxxxx (11 digits)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Information Section -->
                <div class="mb-5">
                    <h3 class="section-title">
                        <i class="fas fa-lock me-2"></i>Security Information
                    </h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Password <span class="required">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="Create a strong password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Confirm Password <span class="required">*</span></label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your password" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Document Upload Section -->
                <div class="mb-5">
                    <h3 class="section-title">
                        <i class="fas fa-upload me-2"></i>Document Upload
                    </h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">CNIC Front Picture <span class="required">*</span></label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="form-control" name="cnic_image" id="cnic_front" accept="image/*" required>
                                    <label for="cnic_front" class="file-input-display">
                                        <i class="fas fa-id-card"></i>
                                        <span>Choose CNIC front image</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">CNIC Back Picture <span class="required">*</span></label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="form-control" name="affidavit" id="cnic_back" accept="image/*" required>
                                    <label for="cnic_back" class="file-input-display">
                                        <i class="fas fa-id-card"></i>
                                        <span>Choose CNIC back image</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Customer Picture <span class="required">*</span></label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="form-control" name="image" id="customer_photo" accept="image/*" required>
                                    <label for="customer_photo" class="file-input-display">
                                        <i class="fas fa-user-circle"></i>
                                        <span>Choose your photo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">CDR Slip(s) Picture <span class="required">*</span></label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="form-control" name="deposit_slip" id="cdr_slip" accept="image/*" required>
                                    <label for="cdr_slip" class="file-input-display">
                                        <i class="fas fa-receipt"></i>
                                        <span>Choose CDR slip image</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="text-center mb-4">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-user-plus me-2"></i>
                        <span class="btn-text">Create Account</span>
                    </button>
                    <a href="{{url("/")}}" class="btn-cancel">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>





            <!-- Footer Links -->
            <div class="footer-links">
                <p>Already have an account? <a href="{{route('login')}}">Sign In</a></p>
                <small>By signing up you agree to our <a href="#">Terms & Policy</a></small>
            </div>
        </div>
    </div>
</div>


<div id="otp_verification_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Confirmation</h5>
                <button type="button" class="close"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body alert_message box_message">
                Thank you for apply for an account please check your mobile for the confirmation code.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn_cancel">Ok</button>
            </div>
        </div>
    </div>
</div>



</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(e){
        let show_popup = "{{$show_popup}}";

        if(show_popup){
            $("#otp_verification_modal").modal("show");
        }

        $("body").on("click",".close",function(e){
            window.location = BaseUrl+"/organizationVerification/{{$org_id}}";
        });

        $("body").on("click",".btn_cancel",function(e){
            window.location = BaseUrl+"/organizationVerification/{{$org_id}}";
        });

        // Enhanced form interactions
        const form = document.getElementById('form-validation');
        const submitBtn = document.getElementById('submitBtn');
        const inputs = document.querySelectorAll('.form-control');
        const fileInputs = document.querySelectorAll('input[type="file"]');

        // Add focus/blur effects to form inputs
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'translateY(-1px)';
            });

            input.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
            });

            // Real-time validation styling
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.classList.remove('is-invalid');
                    this.style.borderColor = '#667eea';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });
        });

        // File input enhancements
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const label = document.querySelector(`label[for="${this.id}"] span`);
                if (this.files && this.files[0]) {
                    const fileName = this.files[0].name;
                    label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                    label.style.color = '#667eea';
                    label.style.fontWeight = '500';
                } else {
                    label.textContent = label.getAttribute('data-default') || 'Choose file';
                    label.style.color = '#4a5568';
                    label.style.fontWeight = '400';
                }
            });
        });

        // Password confirmation validation
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="confirm_password"]');
        
        if (confirmPassword) {
            confirmPassword.addEventListener('input', function() {
                if (password.value !== this.value && this.value.length > 0) {
                    this.style.borderColor = '#e53e3e';
                    this.setCustomValidity('Passwords do not match');
                } else {
                    this.style.borderColor = '#667eea';
                    this.setCustomValidity('');
                }
            });
        }

        // Form submission with loading state
        form.addEventListener('submit', function(e) {
            // Check password confirmation
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                confirmPassword.style.borderColor = '#e53e3e';
                confirmPassword.focus();
                return false;
            }

            submitBtn.classList.add('loading');
            submitBtn.querySelector('.btn-text').textContent = 'Creating Account...';
            submitBtn.disabled = true;
        });

        // CNIC formatting
        const cnicInput = document.querySelector('input[name="cnic"]');
        if (cnicInput) {
            cnicInput.addEventListener('input', function() {
                // Remove any non-digit characters
                this.value = this.value.replace(/\D/g, '');
                
                // Limit to 13 digits
                if (this.value.length > 13) {
                    this.value = this.value.slice(0, 13);
                }
            });
        }

        // Phone number formatting
        const phoneInput = document.querySelector('input[name="phoneNumber"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                // Remove any non-digit characters
                this.value = this.value.replace(/\D/g, '');
                
                // Ensure it starts with 03
                if (this.value.length >= 1 && this.value[0] !== '0') {
                    this.value = '0' + this.value;
                }
                if (this.value.length >= 2 && this.value[1] !== '3') {
                    this.value = this.value[0] + '3' + this.value.slice(2);
                }
                
                // Limit to 11 digits
                if (this.value.length > 11) {
                    this.value = this.value.slice(0, 11);
                }
            });
        }

        // Add smooth scrolling animation for form sections
        setTimeout(() => {
            document.querySelector('.registration-container').style.animation = 'fadeInUp 0.8s ease-out';
        }, 100);
    });

    // Custom validation messages
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.getElementsByTagName("INPUT");
        for (let i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    if (e.target.type === 'email') {
                        e.target.setCustomValidity("Please enter a valid email address");
                    } else if (e.target.name === 'cnic') {
                        e.target.setCustomValidity("Please enter a valid 13-digit CNIC number");
                    } else if (e.target.name === 'phoneNumber') {
                        e.target.setCustomValidity("Please enter a valid 11-digit mobile number starting with 03");
                    } else {
                        e.target.setCustomValidity("Please fill in this field correctly");
                    }
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }
    });

    // Animation keyframes
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