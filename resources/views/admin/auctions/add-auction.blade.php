@extends('admin.template2')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title mb-1">
                                <i class="fas fa-gavel text-primary me-2"></i>
                                {{ isset($data) ? 'Edit Auction' : 'Add New Auction' }}
                            </h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}" class="text-decoration-none">
                                            <i class="fas fa-home"></i> Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('auctions/manage-auctions') }}" class="text-decoration-none">
                                            Manage Auctions
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ isset($data) ? 'Edit Auction' : 'Add New Auction' }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('auctions/manage-auctions') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <form method="POST" id="auctionForm" enctype="multipart/form-data" action="{{ url('auctions/save-auctions') }}">
                @csrf
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-building me-2"></i>Auction Information
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Auction Name -->
                            <div class="col-md-6 mb-3">
                                <label for="auction_name" class="form-label">
                                    <i class="fas fa-tag text-primary me-1"></i>Auction Name *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="auction_name"
                                       name="auction_name" 
                                       value="{{ old('auction_name', isset($data) ? $data->auction_name : '') }}" 
                                       placeholder="Enter auction name"
                                       required>
                                <input type="hidden" name="id" value="{{ isset($data) ? $data->id : 0 }}">
                                @error('auction_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Property Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="plaza_id" class="form-label">
                                    <i class="fas fa-building text-primary me-1"></i>Property *
                                </label>
                                <select class="form-select" id="plaza_id" name="plaza_id" required>
                                    <option value="">Select Property...</option>
                                    @foreach($plaza as $key => $value)
                                        <option value="{{ $value->id }}" 
                                                {{ (isset($data) && isset($data->plaza_id) && $data->plaza_id == $value->id) ? 'selected' : '' }}>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('plaza_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Newspaper Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="newspaper_id" class="form-label">
                                    <i class="fas fa-newspaper text-primary me-1"></i>Newspaper
                                </label>
                                <select class="form-select" id="newspaper_id" name="newspaper_id">
                                    <option value="">Select Newspaper...</option>
                                    @foreach($news_paper as $key => $value)
                                        <option value="{{ $value->newspaper_id }}" 
                                                {{ (isset($data) && isset($data->newspaper_id) && $data->newspaper_id == $value->newspaper_id) ? 'selected' : '' }}>
                                            {{ $value->newspaper_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('newspaper_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Published Date -->
                            <div class="col-md-6 mb-3">
                                <label for="date_published" class="form-label">
                                    <i class="fas fa-calendar text-primary me-1"></i>Published Date *
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       id="date_published"
                                       name="date_published" 
                                       value="{{ old('date_published', isset($data) && $data->date_published ? date('Y-m-d', strtotime($data->date_published)) : '') }}"
                                       required>
                                @error('date_published')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-md-6 mb-3">
                                <label for="start_date_time" class="form-label">
                                    <i class="fas fa-play text-primary me-1"></i>Auction Start Date & Time *
                                </label>
                                <input type="datetime-local" 
                                       class="form-control" 
                                       id="start_date_time"
                                       name="start_date_time" 
                                       value="{{ old('start_date_time', isset($data) && $data->start_date_time ? date('Y-m-d\TH:i', strtotime($data->start_date_time)) : '') }}"
                                       required>
                                @error('start_date_time')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6 mb-3">
                                <label for="end_date_time" class="form-label">
                                    <i class="fas fa-stop text-primary me-1"></i>Auction End Date & Time *
                                </label>
                                <input type="datetime-local" 
                                       class="form-control" 
                                       id="end_date_time"
                                       name="end_date_time" 
                                       value="{{ old('end_date_time', isset($data) && $data->end_date_time ? date('Y-m-d\TH:i', strtotime($data->end_date_time)) : '') }}"
                                       required>
                                @error('end_date_time')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <!-- Duration -->
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">
                                    <i class="fas fa-clock text-primary me-1"></i>Duration (in Years) *
                                </label>
                                <input type="number" 
                                       class="form-control" 
                                       id="duration"
                                       name="duration" 
                                       value="{{ old('duration', isset($data) ? $data->duration : '') }}"
                                       placeholder="Enter duration in years"
                                       min="1"
                                       required>
                                @error('duration')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remarks -->
                            <div class="col-md-6 mb-3">
                                <label for="remarks" class="form-label">
                                    <i class="fas fa-comment text-primary me-1"></i>Remarks *
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="remarks"
                                       name="remarks" 
                                       value="{{ old('remarks', isset($data) ? $data->remarks : '') }}"
                                       placeholder="Enter remarks"
                                       required>
                                @error('remarks')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <!-- Terms & Conditions -->
                            <div class="col-12 mb-3">
                                <label for="terms_and_conditions" class="form-label">
                                    <i class="fas fa-file-contract text-primary me-1"></i>Terms & Conditions *
                                </label>
                                <textarea class="form-control" 
                                          id="terms_and_conditions"
                                          name="terms_and_conditions" 
                                          rows="4"
                                          placeholder="Enter terms and conditions for the auction"
                                          required>{{ old('terms_and_conditions', isset($data) ? $data->terms_and_conditions : '') }}</textarea>
                                @error('terms_and_conditions')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Newspaper Attachment -->
                            <div class="col-12 mb-4">
                                <label for="attachment" class="form-label">
                                    <i class="fas fa-paperclip text-primary me-1"></i>Newspaper Attachment
                                </label>
                                <input type="file" 
                                       class="form-control" 
                                       id="attachment"
                                       name="attachment" 
                                       accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                <div class="form-text">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Supported formats: PDF, JPG, PNG, DOC, DOCX. Max size: 5MB
                                    </small>
                                </div>
                                @if(isset($data) && isset($data->attachment) && $data->attachment)
                                    <div class="mt-2">
                                        <small class="text-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Current file: {{ basename($data->attachment) }}
                                        </small>
                                    </div>
                                @endif
                                @error('attachment')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-1"></i>
                                        {{ isset($data) ? 'Update Auction' : 'Create Auction' }}
                                    </button>
                                    <a href="{{ url('auctions/manage-auctions') }}" class="btn btn-outline-secondary px-4">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Tenant Registration Modal -->
<div class="modal fade" id="user_popup" tabindex="-1" aria-labelledby="tenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="save_user" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="tenantModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Tenant Registration
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" class="form-control" id="user_image" name="image" accept="image/*">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="user_name" name="name" 
                                   placeholder="Enter full name" 
                                   value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            <input type="hidden" name="user_type" value="official">
                            <input type="hidden" name="id" value="0">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phoneNumber" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" 
                                   placeholder="Enter phone number" 
                                   value="{{ old('phoneNumber', isset($user) ? $user->phoneNumber : '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">CNIC</label>
                            <div id="tenant_cnic_lab" class="form-control-plaintext text-muted">
                                Will be populated automatically
                            </div>
                            <input type="hidden" id="tenant_cnic" name="cnic" 
                                   value="{{ old('cnic', request('cnic', '')) }}">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   placeholder="Enter complete address" 
                                   value="{{ old('address', isset($user) ? $user->address : '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="org_id" class="form-label">Department</label>
                            <select class="form-select" id="org_id" name="org_id">
                                <option value="">Select Department...</option>
                                <!-- Add department options here -->
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" class="form-control" id="designation" name="designation" 
                                   placeholder="Enter designation" 
                                   value="{{ old('designation', isset($user) ? $user->designation : '') }}" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="place_of_duty" class="form-label">Place of Duty *</label>
                            <input type="text" class="form-control" id="place_of_duty" name="place_of_duty" 
                                   placeholder="Enter place of duty" 
                                   value="{{ old('place_of_duty', isset($user) ? $user->place_of_duty : '') }}" required>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Close
                    </button>
                    <button type="button" class="btn btn-success save_tanant">
                        <i class="fas fa-save me-1"></i>Save Official
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>





@push('styles')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
.form-label {
    font-weight: 500;
    color: #333;
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
.btn {
    border-radius: 0.375rem;
    font-weight: 500;
}
.required::after {
    content: " *";
    color: #dc3545;
}

/* Native datetime-local input styling */
input[type="datetime-local"] {
    font-family: inherit;
}
input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    border-radius: 4px;
    margin-left: 4px;
    opacity: 0.6;
}
input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
    opacity: 1;
}
</style>
@endpush

@push('scripts')
<!-- Toastr for notifications -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    // Configure Toastr
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    console.log('Initializing native datetime inputs...');

    // Handle datetime validation between start and end dates
     

    // Convert existing values to proper format if needed
    function formatDateTimeValue(input) {
        const value = input.val();
        if (value && value.includes(' ') && !value.includes('T')) {
            // Convert "YYYY-MM-DD HH:MM:SS" to "YYYY-MM-DDTHH:MM"
            const formatted = value.replace(' ', 'T').substring(0, 16);
            input.val(formatted);
        }
    }

    // Format existing values
    formatDateTimeValue($('#start_date_time'));
    formatDateTimeValue($('#end_date_time'));

    console.log('Native datetime inputs initialized successfully');

    // Form validation
    $('#auctionForm').on('submit', function(e) {
        let isValid = true;
        const requiredFields = ['auction_name', 'plaza_id', 'date_published', 'duration', 'remarks', 'terms_and_conditions'];
        
        requiredFields.forEach(function(field) {
            const input = $(`[name="${field}"]`);
            const value = input.val().trim();
            
            if (!value || (field === 'plaza_id' && value === '')) {
                input.addClass('is-invalid');
                isValid = false;
            } else {
                input.removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            toastr.error('Please fill in all required fields');
            return false;
        }

        // Show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true)
                 .html('<i class="fas fa-spinner fa-spin me-1"></i>Processing...');
    });

    // File input validation
    $('#attachment').on('change', function() {
        const file = this.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (file) {
            if (file.size > maxSize) {
                toastr.error('File size must be less than 5MB');
                $(this).val('');
                return;
            }
            
            if (!allowedTypes.includes(file.type)) {
                toastr.error('Please select a valid file format (PDF, JPG, PNG, DOC, DOCX)');
                $(this).val('');
                return;
            }
        }
    });

    // Save tenant functionality
    $('.save_tanant').on('click', function() {
        const form = $('#save_user');
        const formData = new FormData(form[0]);
        
        // Show loading state
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Saving...');
        
        $.ajax({
            method: 'POST',
            url: '{{ url("/save-tenant") }}', // Adjust URL as needed
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if (res.status) {
                    toastr.success('Official saved successfully!');
                    var modal = bootstrap.Modal.getInstance(document.getElementById('user_popup'));
                    modal.hide();
                    form[0].reset();
                } else {
                    toastr.error(res.message || 'Failed to save official');
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while saving');
            },
            complete: function() {
                $('.save_tanant').prop('disabled', false).html('<i class="fas fa-save me-1"></i>Save Official');
            }
        });
    });

    // Image preview functionality
    $('#user_image').on('change', function() {
        readURL(this);
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Create or update image preview
            let preview = $('#imagePreview');
            if (preview.length === 0) {
                preview = $('<img id="imagePreview" class="img-thumbnail mt-2" style="max-width: 150px; height: auto;">');
                $(input).parent().append(preview);
            }
            preview.attr('src', e.target.result);
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection




