@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-plus-circle me-2 text-success"></i>
                    {{ isset($data) && $data->id ? 'Edit Property' : 'Add New Property' }}
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('settings/manage-plaza')}}" class="text-decoration-none">Properties</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ isset($data) && $data->id ? 'Edit' : 'Add New' }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-calendar me-1"></i>{{date('d M, Y')}}</small>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Property Form -->
            <div class="col-lg-7">
                <div class="card simple-card">
                <div class="card-header border-0 pb-0">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-building me-2 text-primary"></i>
                        Property Information
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" id="propertyForm" enctype="multipart/form-data" 
                          action="{{url('settings/save-plaza')}}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <!-- Property Name -->
                            <div class="col-12">
                                <label for="name" class="form-label">
                                    Property Name <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-building text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name"
                                           name="name" 
                                           placeholder="Enter property name" 
                                           value="{{old('name', $data->name ?? '')}}" 
                                           required>
                                    <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="col-12">
                                <label for="property_type" class="form-label">
                                    Property Type <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-home text-muted"></i>
                                    </span>
                                    <select class="form-select @error('property_type') is-invalid @enderror" 
                                            id="property_type" 
                                            name="property_type" 
                                            required>
                                        <option value="">Select Property Type...</option>
                                        <option value="plaza" {{ isset($data) && $data->property_type == "plaza" ? "selected" : ""}}>
                                            Plaza
                                        </option>
                                        <option value="plots" {{isset($data) && $data->property_type == "plots" ? "selected" : ""}}>
                                            Plots
                                        </option>
                                        <option value="open_shops" {{isset($data) && $data->property_type == "open_shops" ? "selected" : ""}}>
                                            Open Shops
                                        </option>
                                        <option value="building" {{isset($data) && $data->property_type == "building" ? "selected" : ""}}>
                                            Building
                                        </option>
                                    </select>
                                    @error('property_type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Property Address -->
                            <div class="col-12">
                                <label for="address" class="form-label">
                                    Property Address <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('address') is-invalid @enderror" 
                                           id="address"
                                           name="address" 
                                           placeholder="Enter complete property address..." 
                                           value="{{old('address', $data->address ?? '')}}" 
                                           required>
                                    @error('address')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Focal Person -->
                            <div class="col-12">
                                <label for="focal_person" class="form-label">
                                    Focal Person <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('focal_person') is-invalid @enderror" 
                                           id="focal_person"
                                           name="focal_person" 
                                           placeholder="Enter focal person name..." 
                                           value="{{old('focal_person', $data->focal_person ?? '')}}" 
                                           required>
                                    @error('focal_person')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="col-12">
                                <label for="contact_no" class="form-label">
                                    Contact Number <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('contact_no') is-invalid @enderror" 
                                           id="contact_no"
                                           name="contact_no" 
                                           placeholder="Enter contact number..." 
                                           value="{{old('contact_no', $data->contact_no ?? '')}}" 
                                           required>
                                    @error('contact_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location Coordinates -->
                            <div class="col-md-6">
                                <label for="lat" class="form-label">
                                    Latitude <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-crosshairs text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('lat') is-invalid @enderror" 
                                           id="lat"
                                           name="lat" 
                                           placeholder="Enter latitude..." 
                                           value="{{old('lat', $data->lat ?? '')}}" 
                                           required>
                                    @error('lat')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="lng" class="form-label">
                                    Longitude <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-crosshairs text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('lng') is-invalid @enderror" 
                                           id="lng"
                                           name="lng" 
                                           placeholder="Enter longitude..." 
                                           value="{{old('lng', $data->lng ?? '')}}" 
                                           required>
                                    @error('lng')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Property Image -->
                            <div class="col-12">
                                <label for="attachment" class="form-label">
                                    Property Image
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-image text-muted"></i>
                                    </span>
                                    <input type="file" 
                                           class="form-control @error('attachment') is-invalid @enderror" 
                                           id="attachment"
                                           name="attachment" 
                                           accept="image/*" 
                                           onchange="previewImage(this)">
                                    @error('attachment')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Accepted formats: JPG, PNG, GIF. Max size: 2MB
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ url('settings/manage-plaza') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to List
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i>
                                {{ isset($data) && $data->id ? 'Update Property' : 'Add Property' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map and Preview Section -->
        <div class="col-lg-5">
            <!-- Map Card -->
            <div class="card simple-card">
                <div class="card-header border-0 pb-0">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-map me-2 text-primary"></i>
                        Property Location
                    </h6>
                </div>
                <div class="card-body">

                    <!-- Map Container -->
                    <div class="map-container border rounded mb-3">
                        <iframe
                            class="w-100"
                            style="height: 300px;"
                            frameborder="0"
                            scrolling="no"
                            marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?q={{$data->lat ?? '34.33'}},{{$data->lng ?? '72.19'}}&hl=es&z=14&amp;output=embed">
                        </iframe>
                    </div>
                    
                    <div class="text-center">
                        <a href="https://www.maps.ie/route-planner.htm" 
                           class="btn btn-outline-primary btn-sm" 
                           target="_blank">
                            <i class="fas fa-route me-1"></i>
                            Open Route Planner
                        </a>
                    </div>
                </div>
            </div>

            <!-- Image Preview Card -->
            <div class="card simple-card mt-3">
                <div class="card-header border-0 pb-0">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-image me-2 text-primary"></i>
                        Image Preview
                    </h6>
                </div>
                <div class="card-body">
                    <div id="imagePreview" class="text-center">
                        @if(isset($data) && isset($data->attachment) && $data->attachment)
                            <img src="{{ asset($data->attachment) }}" 
                                 alt="Property Image" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 200px;">
                        @else
                            <div class="bg-light rounded p-4">
                                <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No image selected</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    .content-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .simple-card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        height: fit-content;
    }
    
    .simple-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-bottom: 2px solid #e9ecef;
    }
    
    .input-group-text {
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .map-container {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    }
    
    .btn {
        border-radius: 6px;
        transition: all 0.2s;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .breadcrumb-item a {
        text-decoration: none;
        color: #6c757d;
    }
    
    .breadcrumb-item a:hover {
        color: #0d6efd;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .content-header {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .content-header .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .content-header h4 {
            font-size: 1.25rem;
        }
        
        .col-lg-7, .col-lg-5 {
            margin-bottom: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .input-group {
            flex-wrap: nowrap;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
        }
    }
    
    /* Fix for broken layout */
    .container-fluid {
        padding: 0 15px;
    }
    
    .row {
        margin: 0 -15px;
    }
    
    [class*="col-"] {
        padding: 0 15px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bootstrap form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    });

    // Image preview function
    function previewImage(input) {
        const previewDiv = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewDiv.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Property Image Preview" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-height: 200px;">
                `;
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush


