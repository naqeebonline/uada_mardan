@extends('admin.template2')
@section('content')
    <!-- Custom Styles -->
    <style>
        .form-label, .col-form-label {
            font-size: 10px !important;
            font-weight: 600;
        }
        .form-control, .form-select {
            font-size: 10px !important;
        }
        .input-group-text {
            font-size: 10px !important;
        }
        .card-title {
            font-size: 12px !important;
        }
        h6 {
            font-size: 11px !important;
        }
        .breadcrumb {
            font-size: 10px !important;
        }
        .btn {
            font-size: 10px !important;
        }
        .text-danger.small {
            font-size: 9px !important;
        }
    </style>
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">
                <i class="fas fa-plus-circle text-primary me-2"></i>New Commercial Property
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="https://properties-cdgp.com/" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="https://properties-cdgp.com/root/property_tenants" class="text-decoration-none">
                            Commercial Property Details
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        New Commercial Property
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <form method="POST" id="form-validation" enctype="multipart/form-data" action="{{ url('settings/save-floor-shop') }}">
            @csrf
            <div class="row">
                <!-- Form Column -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-building me-2"></i>Property Information
                            </h5>
                        </div>

                        <div class="card-body">
                            <!-- Row 1: Property & Unit Name -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="plaza_id" class="form-label">
                                        <i class="fas fa-building text-primary me-1"></i>Property *
                                    </label>
                                    <select class="form-select" name="plaza_id" id="plaza_id" required>
                                        <option value="">Select Property...</option>
                                        @foreach($plaza as $key => $value)
                                            <option value="{{ $value->id }}" {{ (isset($data) && $data->plaza_id == $value->id) ? 'selected' : '' }}>
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('plaza_id')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="shop_name" class="form-label">
                                        <i class="fas fa-tag text-primary me-1"></i>Unit Name/Demand No *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="shop_name" 
                                           id="shop_name"
                                           value="{{ old('shop_name', $data->shop_name ?? '') }}" 
                                           placeholder="Enter unit name or demand number"
                                           required>
                                    @error('shop_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 2: Property Type & Shop Status -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="property_type" class="form-label">
                                        <i class="fas fa-home text-primary me-1"></i>Property Type *
                                    </label>
                                    <select class="form-select" disabled>
                                        <option value="Commercial" selected>Commercial</option>
                                    </select>
                                    <input type="hidden" name="property_type" value="Commercial" required>
                                    <input type="hidden" name="id" value="{{ $data->id ?? 0 }}" required>
                                    <input type="hidden" name="floor_id" value="0" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="shop_status" class="form-label">
                                        <i class="fas fa-store text-primary me-1"></i>Shop/Plot Status *
                                    </label>
                                    <select class="form-select" required id="shop_status" name="shop_status">
                                        <option value="">Select Shop/Plot status...</option>
                                        <option value="rent_out" {{ isset($data) && $data->shop_status == 'rent_out' ? 'selected' : '' }}>
                                            Rent Out
                                        </option>
                                        <option value="open_for_aution" {{ isset($data) && $data->shop_status == 'open_for_aution' ? 'selected' : '' }}>
                                            Open for Auction
                                        </option>
                                    </select>
                                    @error('shop_status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 3: Location & Total Area -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="location" class="form-label">
                                        <i class="fas fa-map-marker-alt text-primary me-1"></i>Location *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="location" 
                                           id="location"
                                           value="{{ old('location', $data->location ?? '') }}" 
                                           placeholder="Enter property location"
                                           required>
                                    @error('location')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="coveredarea" class="form-label">
                                        <i class="fas fa-ruler-combined text-primary me-1"></i>Total Area (Sq Feet) *
                                    </label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="coveredarea" 
                                               id="coveredarea"
                                               value="{{ old('coveredarea', $data->coveredarea ?? '') }}" 
                                               placeholder="Enter total area"
                                               min="0"
                                               required>
                                        <span class="input-group-text">sq ft</span>
                                    </div>
                                    @error('coveredarea')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Financial Information Section -->
                            <h6 class="text-primary mt-4 mb-3">
                                <i class="fas fa-money-bill-wave me-2"></i>Financial Information
                            </h6>

                            <div class="row">
                                <!-- Starting Bid -->
                                <div class="col-md-6 mb-3">
                                    <label for="starting_bid_amount" class="form-label">
                                        <i class="fas fa-gavel text-success me-1"></i>Starting Bid Amount *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₨</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="starting_bid_amount" 
                                               id="starting_bid_amount"
                                               value="{{ old('starting_bid_amount', $data->starting_bid_amount ?? '') }}" 
                                               placeholder="Enter starting bid"
                                               min="0"
                                               required>
                                    </div>
                                    @error('starting_bid_amount')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- CDR Amount -->
                                <div class="col-md-6 mb-3">
                                    <label for="cdr_amount" class="form-label">
                                        <i class="fas fa-money-check text-info me-1"></i>CDR Amount *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₨</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="cdr_amount" 
                                               id="cdr_amount"
                                               value="{{ old('cdr_amount', $data->cdr_amount ?? '') }}" 
                                               placeholder="Enter CDR amount"
                                               min="0"
                                               required>
                                    </div>
                                    @error('cdr_amount')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Start Rent -->
                                <div class="col-md-6 mb-3">
                                    <label for="start_rent" class="form-label">
                                        <i class="fas fa-money-bill text-primary me-1"></i>Start Rent *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₨</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="start_rent" 
                                               id="start_rent"
                                               value="{{ old('start_rent', $data->start_rent ?? '') }}" 
                                               placeholder="Enter starting rent"
                                               min="0"
                                               required>
                                    </div>
                                    @error('start_rent')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Current Rent -->
                                <div class="col-md-6 mb-3">
                                    <label for="current_rent" class="form-label">
                                        <i class="fas fa-money-bill-wave text-success me-1"></i>Current Rent *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₨</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="current_rent" 
                                               id="current_rent"
                                               value="{{ old('current_rent', $data->current_rent ?? '') }}" 
                                               placeholder="Enter current rent"
                                               min="0"
                                               required>
                                    </div>
                                    @error('current_rent')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location Coordinates Section -->
                            <h6 class="text-primary mt-4 mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Location Coordinates
                            </h6>

                            <div class="row mb-3">
                                <!-- Latitude -->
                                <div class="col-md-6">
                                    <label for="lat" class="form-label">
                                        <i class="fas fa-globe-americas text-info me-1"></i>Latitude *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="lat" 
                                           id="lat"
                                           value="{{ old('lat', $data->lat ?? '') }}" 
                                           placeholder="Enter latitude (e.g., 34.33)"
                                           pattern="^-?([0-8]?[0-9](\.[0-9]+)?|90(\.0+)?)$"
                                           title="Valid latitude format: -90 to 90"
                                           required>
                                    @error('lat')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Longitude -->
                                <div class="col-md-6">
                                    <label for="lng" class="form-label">
                                        <i class="fas fa-globe text-warning me-1"></i>Longitude *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="lng" 
                                           id="lng"
                                           value="{{ old('lng', $data->lng ?? '') }}" 
                                           placeholder="Enter longitude (e.g., 72.19)"
                                           pattern="^-?((1[0-7][0-9](\.[0-9]+)?)|(1?[0-9]?[0-9](\.[0-9]+)?)|180(\.0+)?)$"
                                           title="Valid longitude format: -180 to 180"
                                           required>
                                    @error('lng')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Property Details Section -->
                            <h6 class="text-primary mt-4 mb-3">
                                <i class="fas fa-chart-line me-2"></i>Property Details
                            </h6>

                            <div class="row mb-3">
                                <!-- Annual Increase -->
                                <div class="col-md-6">
                                    <label for="increment_percentage" class="form-label">
                                        <i class="fas fa-percentage text-success me-1"></i>Annual Increase (%) *
                                    </label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="increment_percentage" 
                                               id="increment_percentage"
                                               value="{{ old('increment_percentage', $data->increment_percentage ?? '') }}" 
                                               placeholder="Enter percentage"
                                               min="0"
                                               max="100"
                                               step="0.01"
                                               required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('increment_percentage')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Rate per Marla -->
                                <div class="col-md-6">
                                    <label for="property_value" class="form-label">
                                        <i class="fas fa-calculator text-info me-1"></i>Rate/Marla *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₨</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="property_value" 
                                               id="property_value"
                                               value="{{ old('property_value', $data->property_value ?? '') }}" 
                                               placeholder="Enter rate per marla"
                                               min="0"
                                               required>
                                        <span class="input-group-text">/marla</span>
                                    </div>
                                    @error('property_value')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Future Use -->
                                <div class="col-md-6">
                                    <label for="future_use" class="form-label">
                                        <i class="fas fa-lightbulb text-warning me-1"></i>Future Use *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="future_use" 
                                           id="future_use"
                                           value="{{ old('future_use', $data->future_use ?? '') }}" 
                                           placeholder="Enter intended future use"
                                           required>
                                    @error('future_use')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Ownership -->
                                <div class="col-md-6">
                                    <label for="ownership" class="form-label">
                                        <i class="fas fa-user-tie text-primary me-1"></i>Ownership *
                                    </label>
                                    <select class="form-select" id="ownership" name="ownership" required>
                                        <option value="">Select ownership type...</option>
                                        <option value="Property By Rent" {{ isset($data) && $data->ownership == 'Property By Rent' ? 'selected' : '' }}>
                                            Property By Rent
                                        </option>
                                        <option value="Tma Owned" {{ isset($data) && $data->ownership == 'Tma Owned' ? 'selected' : '' }}>
                                            TMA Owned
                                        </option>
                                        <option value="Provincial Govt" {{ isset($data) && $data->ownership == 'Provincial Govt' ? 'selected' : '' }}>
                                            Provincial Government
                                        </option>
                                        <option value="Local Govt" {{ isset($data) && $data->ownership == 'Local Govt' ? 'selected' : '' }}>
                                            Local Government
                                        </option>
                                        <option value="District Council" {{ isset($data) && $data->ownership == 'District Council' ? 'selected' : '' }}>
                                            District Council
                                        </option>
                                        <option value="Federal Govt" {{ isset($data) && $data->ownership == 'Federal Govt' ? 'selected' : '' }}>
                                            Federal Government
                                        </option>
                                        <option value="Any Other" {{ isset($data) && $data->ownership == 'Any Other' ? 'selected' : '' }}>
                                            Any Other
                                        </option>
                                    </select>
                                    @error('ownership')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Ownership Title -->
                                <div class="col-md-6">
                                    <label for="ownership_title" class="form-label">
                                        <i class="fas fa-certificate text-success me-1"></i>Ownership Title *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="ownership_title" 
                                           id="ownership_title"
                                           value="{{ old('ownership_title', $data->ownership_title ?? '') }}" 
                                           placeholder="Enter ownership title"
                                           required>
                                    @error('ownership_title')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Document Attachment -->
                                <div class="col-md-6">
                                    <label for="document" class="form-label">
                                        <i class="fas fa-file-upload text-info me-1"></i>Document Attachment
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           name="document" 
                                           id="document"
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    <div class="form-text">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</div>
                                    @error('document')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Media & Legal Information Section -->
                            <h6 class="text-primary mt-4 mb-3">
                                <i class="fas fa-gavel me-2"></i>Media & Legal Information
                            </h6>

                            <div class="row mb-3">
                                <!-- Property Image -->
                                <div class="col-md-6">
                                    <label for="attachment" class="form-label">
                                        <i class="fas fa-image text-success me-1"></i>Property Image
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           name="attachment" 
                                           id="attachment"
                                           accept="image/*"
                                           onchange="readURL(this);">
                                    <div class="form-text">Accepted formats: JPG, JPEG, PNG, GIF (Max: 2MB)</div>
                                    @error('attachment')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Is Court Case -->
                                <div class="col-md-6">
                                    <label for="is_court_case" class="form-label">
                                        <i class="fas fa-balance-scale text-warning me-1"></i>Is Court Case *
                                    </label>
                                    <select class="form-select" id="is_court_case" name="is_court_case" required>
                                        <option value="">Select option...</option>
                                        <option value="Yes" {{ isset($data) && $data->is_court_case == 'Yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="No" {{ isset($data) && $data->is_court_case == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                    @error('is_court_case')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Court Case Details (Hidden by default) -->
                            <div class="row mb-3" id="court_name" style="display: none;">
                                <div class="col-md-6">
                                    <label for="court_name_select" class="form-label">
                                        <i class="fas fa-university text-danger me-1"></i>Court Name *
                                    </label>
                                    <select class="form-select court_name" name="court_name" id="court_name_select">
                                        <option value="">Select Court...</option>
                                        @foreach($court as $key => $value)
                                            <option value="{{ $value->id }}" {{ (isset($court_case) && $court_case->court_id == $value->id) ? 'selected' : '' }}>
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('court_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6" id="case_status" style="display: none;">
                                    <label for="case_status_select" class="form-label">
                                        <i class="fas fa-flag text-warning me-1"></i>Case Status *
                                    </label>
                                    <select class="form-select case_status" name="case_status" id="case_status_select">
                                        <option value="">Select case status...</option>
                                        <option value="in_progress" {{ (isset($court_case) && $court_case->case_status == 'in_progress') ? 'selected' : '' }}>
                                            In Progress
                                        </option>
                                        <option value="in_favour" {{ (isset($court_case) && $court_case->case_status == 'in_favour') ? 'selected' : '' }}>
                                            Decided in Favour
                                        </option>
                                        <option value="decided_against" {{ (isset($court_case) && $court_case->case_status == 'decided_against') ? 'selected' : '' }}>
                                            Decided Against
                                        </option>
                                    </select>
                                    @error('case_status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" id="case_title" style="display: none;">
                                <div class="col-md-6">
                                    <label for="case_title_input" class="form-label">
                                        <i class="fas fa-file-alt text-info me-1"></i>Case Title *
                                    </label>
                                    <input type="text" 
                                           class="form-control case_title" 
                                           name="case_title" 
                                           id="case_title_input"
                                           value="{{ isset($court_case->case_title) ? $court_case->case_title : '' }}" 
                                           placeholder="Enter case title">
                                    @error('case_title')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6" id="case_number">
                                    <label for="case_number_input" class="form-label">
                                        <i class="fas fa-hashtag text-secondary me-1"></i>Case Number *
                                    </label>
                                    <input type="text" 
                                           class="form-control case_number" 
                                           name="case_number" 
                                           id="case_number_input"
                                           value="{{ isset($court_case->case_number) ? $court_case->case_number : '' }}" 
                                           placeholder="Enter case number">
                                    @error('case_number')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <!-- Submit Section -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        All fields marked with * are required
                                    </small>
                                </div>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary btn-sm me-2">
                                        <i class="fas fa-undo me-1"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-1"></i>Save Property
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map Column -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-map-marked-alt me-2"></i>Property Location
                            </h6>
                        </div>
                        <div class="card-body">                            <!-- Tenant Information (Hidden by default) -->
                            <div id="user_informations" class="mb-4" style="display: none;">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>Tenant Information
                                </h6>
                                
                                <div class="mb-3">
                                    <label for="user_cnic" class="form-label">
                                        <i class="fas fa-id-card text-info me-1"></i>User CNIC *
                                    </label>
                                    <input type="number" 
                                           maxlength="13" 
                                           class="form-control customer_details" 
                                           id="user_cnic" 
                                           value="{{ isset($customerProperty) ? $customerProperty->cnic : '' }}" 
                                           placeholder="Enter 13-digit CNIC">
                                    <input type="hidden" 
                                           class="form-control customer_details" 
                                           name="customer_id" 
                                           id="user_id" 
                                           value="{{ isset($customerProperty) ? $customerProperty->user_id : '' }}">
                                </div>

                                <div class="mb-3">
                                    <label for="user_name" class="form-label">
                                        <i class="fas fa-user text-success me-1"></i>Name
                                    </label>
                                    <input type="text" 
                                           disabled 
                                           value="{{ isset($customerProperty) ? $customerProperty->name : '' }}" 
                                           class="form-control customer_details" 
                                           id="user_name" 
                                           placeholder="Customer name will appear here">
                                </div>

                                <div class="mb-3" style="display: none;">
                                    <label for="user_email" class="form-label">Email</label>
                                    <input type="text" 
                                           disabled 
                                           value="{{ isset($customerProperty) ? $customerProperty->email : '' }}" 
                                           class="form-control customer_details" 
                                           id="user_email">
                                </div>

                                <div class="mb-3">
                                    <label for="lease_date" class="form-label">
                                        <i class="fas fa-calendar text-warning me-1"></i>Lease Date
                                    </label>
                                    <input type="date" 
                                           name="lease_date" 
                                           value="{{ isset($customerProperty) ? $customerProperty->lease_date : '' }}" 
                                           class="form-control customer_details" 
                                           id="lease_date">
                                </div>

                                <div class="mb-3">
                                    <label for="duration" class="form-label">
                                        <i class="fas fa-clock text-primary me-1"></i>Duration (Months)
                                    </label>
                                    <input type="number" 
                                           name="duration" 
                                           value="{{ isset($customerProperty) ? $customerProperty->duration : '' }}" 
                                           class="form-control customer_details" 
                                           id="duration"
                                           placeholder="Enter duration in months" 
                                           min="1">
                                </div>
                            </div>





                            <!-- Google Maps Container -->
                            <div class="map-container mb-3">
                                <div class="ratio ratio-16x9">
                                    <iframe class="border rounded shadow-sm"
                                            src="https://maps.google.com/maps?q={{ $data->lat ?? '34.33' }},{{ $data->lng ?? '72.19' }}&hl=en&z=14&amp;output=embed"
                                            style="border: 0;"
                                            allowfullscreen=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-external-link-alt me-1"></i>
                                        <a href="https://www.maps.ie/route-planner.htm" 
                                           target="_blank" 
                                           class="text-decoration-none">
                                            Google Route Planner
                                        </a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row -->
        </form>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


    <!-- Tenant Registration Modal -->
    <div class="modal fade" id="user_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form role="form" method="POST" id="save_user" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <i class="fas fa-user-plus me-2"></i>Tenant Registration
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_image" class="form-label">
                                        <i class="fas fa-image text-info me-1"></i>User Image
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           id="user_image"
                                           name="image" 
                                           accept="image/*">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tenant_name" class="form-label">
                                        <i class="fas fa-user text-success me-1"></i>Name *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="tenant_name"
                                           name="name" 
                                           placeholder="Enter full name" 
                                           value="{{ old('name', $user->name ?? '') }}" 
                                           required>
                                    <input type="hidden" name="user_type" value="customer">
                                    <input type="hidden" name="id" value="0">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">
                                        <i class="fas fa-phone text-primary me-1"></i>Mobile Number
                                    </label>
                                    <input type="tel" 
                                           class="form-control" 
                                           id="phone_number"
                                           name="phoneNumber" 
                                           placeholder="Enter phone number" 
                                           value="{{ old('phoneNumber', $user->phoneNumber ?? '') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-id-card text-warning me-1"></i>CNIC
                                    </label>
                                    <h5 id="tenant_cnic_lab" class="text-muted"></h5>
                                    <input type="hidden" 
                                           id="tenant_cnic" 
                                           name="cnic" 
                                           value="{{ old('cnic', isset($_GET['cnic']) ? $_GET['cnic'] : '') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>Address
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="address"
                                           name="address" 
                                           placeholder="Enter address" 
                                           value="{{ old('address', $user->address ?? '') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope text-info me-1"></i>Email *
                                    </label>
                                    <input type="email" 
                                           class="form-control" 
                                           id="email"
                                           name="email" 
                                           placeholder="Enter email address" 
                                           value="{{ old('email', $user->email ?? '') }}" 
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Close
                        </button>
                        <button type="button" class="btn btn-success save_tanant">
                            <i class="fas fa-save me-1"></i>Save Tenant
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>






    <!-- Content Wrapper END -->
    <link rel="stylesheet" href="{{asset('plaza_admin_assets/css/bootstrap-datetimepicker.css')}}">
    <script src="{{asset('plaza_admin_assets/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/bootstrap-datetimepicker.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function(e){
            id =0;

            $("body").on("click",".save_tanant",function(e){
                $("#save_user").ajaxSubmit({
                    method:"POST",
                    url:'<?php echo url("/saveCustomerAjax") ?>',

                    success:function(res){
                        if(res.status){
                            $.notify(res.message, 'success');
                            $("#user_name").val(res.data.name);
                            $("#user_email").val(res.data.email);
                            $("#user_cnic").val(res.data.cnic);
                            $("#user_id").val(res.data.id);
                            $("#user_popup").modal("hide");
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }

                })
            });



            @if(isset($data) && $data->shop_status == "rent_out")
            $("#user_informations").show();
            $(".customer_details").attr("required","required");
            $
            @endif
            @if(isset($data) && $data->is_court_case == "Yes")
            $("#court_name").show();
            $("#case_title").show();
            $("#case_number").show();
            $("#case_status").show();
            $(".court_name").attr("required","required");
            $(".case_title").attr("required","required");
            $(".case_status").attr("required","required");
            @endif

            $("body").on("change","#shop_status",function(e){
                var value = $(this).val();
                if(value == "rent_out"){
                    $("#user_informations").show();
                    $(".customer_details").attr("required","required");

                }else{
                    $(".customer_details").removeAttr("required");
                    $("#user_informations").hide();
                }
            });

            /*$("body").on("blur","#user_cnic",function(e){
                var cnic = $(this).val();
                getUser(cnic);
            });*/

            $("body").on("keyup","#user_cnic",function(e){
                var cnic = $(this).val();
                if(cnic.length == 13)
                    getUser(cnic);
            });

            $("body").on("change","#is_court_case",function(e){
                if($(this).val() == "Yes"){
                    $("#court_name").show();
                    $("#case_title").show();
                    $("#case_number").show();
                    $("#case_status").show();
                    $(".court_name").attr("required","required");
                    $(".case_title").attr("required","required");
                    $(".case_number").attr("required","required");
                    $(".case_status").attr("required","required");
                    $(".court_name").val("");
                    $(".case_title").val("");
                    $(".case_number").val("");
                    $(".case_status").val("");

                }else{
                    $("#court_name").hide();
                    $("#case_title").hide();
                    $("#case_number").hide();
                    $("#case_status").hide();
                    $(".court_name").removeAttr("required");
                    $(".case_title").removeAttr("required");
                    $(".case_number").removeAttr("required");
                    $(".case_status").removeAttr("required");
                    $(".court_name").val("");
                    $(".case_title").val("");
                    $(".case_number").val("");
                    $(".case_status").val("");
                }
            });


            $("body").on("click",".btn_save",function(e){
                var id = $("#record_id").val();
                $.ajax({
                    method:"POST",
                    data:{id:id,name:name,table:my_table},
                    url:'<?php echo url("/save-settings") ?>',
                    success:function(res){
                        if(res.status){
                            $.notify(res.message, 'success');
                            $("#custom_message").modal("hide");
                            table.ajax.reload( null, false );
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }
                });
            });


        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(50)
                        .height(50);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function getUser(cnic) {
            if(cnic.length == 13){
                $.ajax({
                    method:"POST",
                    data:{cnic:cnic,type:"customer"},
                    url:'<?php echo url("/get-user-by-cnic") ?>',
                    success:function(res){
                        if(res.status == true){

                            $("#user_name").val(res.data.name);
                            $("#user_email").val(res.data.email);
                            $("#user_id").val(res.data.id);
                            console.log(res.data);
                        }else{
                            $("#user_name").val("");
                            $("#user_email").val("");
                            $("#user_id").val("");
                            $("#user_popup").modal("show");
                            $("#tenant_cnic").val(cnic);
                            $("#tenant_cnic_lab").html(cnic);
                            return false;
                            var url = "{{url("customer/addCustomer")}}?cnic="+cnic;
                            window.open(url,"_blank");
                        }

                    }
                });

            }else{
                alert("Enter 13 digit CNIC number");
            }
        }


    </script>
@endsection




