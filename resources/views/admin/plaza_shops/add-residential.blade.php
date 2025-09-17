@extends('admin.template2')
@section('content')
    <!-- Custom Styles -->
    <style>
        .form-label, .col-form-label, th, td {
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
    <div class="container-fluid mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="text-dark mb-1">
                    <i class="fas fa-home me-2 text-primary"></i>New Residential Property
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sm">
                        <li class="breadcrumb-item">
                            <a href="https://properties-cdgp.com/" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="https://properties-cdgp.com/root/property_tenants" class="text-decoration-none">
                                Residential Property Details
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            New Residential Property
                        </li>
                    </ol>
                </nav>
            </div>
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
                                <i class="fas fa-home me-2"></i>Property Information
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

                            <!-- Row 2: Property Type & Status -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="property_type" class="form-label">
                                        <i class="fas fa-home text-primary me-1"></i>Property Type *
                                    </label>
                                    <select class="form-select" disabled>
                                        <option value="Residential" selected>Residential</option>
                                    </select>
                                    <input type="hidden" name="property_type" value="Residential" required>
                                    <input type="hidden" name="id" value="{{ $data->id ?? 0 }}" required>
                                    <input type="hidden" name="floor_id" value="0" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="shop_status" class="form-label">
                                        <i class="fas fa-info-circle text-primary me-1"></i>Plot Status *
                                    </label>
                                    <select class="form-select" required id="shop_status" name="shop_status">
                                        <option value="">Select Plot status...</option>
                                        <option value="rent_out" {{ isset($data) && $data->shop_status == 'rent_out' ? 'selected' : '' }}>
                                            Allotted
                                        </option>
                                        <option value="open_for_aution" {{ isset($data) && $data->shop_status == 'open_for_aution' ? 'selected' : '' }}>
                                            Not Allotted
                                        </option>
                                    </select>
                                    @error('shop_status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 3: Location & More Fields -->
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
                                               placeholder="Enter area"
                                               min="0"
                                               required>
                                        <span class="input-group-text">sq ft</span>
                                    </div>
                                    @error('coveredarea')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 4: Starting Bid & CDR Amount -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="starting_bid_amount" class="form-label">
                                        <i class="fas fa-gavel text-primary me-1"></i>Starting Bid *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
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
                                
                                <div class="col-md-6">
                                    <label for="cdr_amount" class="form-label">
                                        <i class="fas fa-receipt text-primary me-1"></i>CDR Amount *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
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

                            <!-- Row 5: Start Rent & Current Rent -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="start_rent" class="form-label">
                                        <i class="fas fa-money-bill text-primary me-1"></i>Start Rent *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="start_rent" 
                                               id="start_rent"
                                               value="{{ old('start_rent', $data->start_rent ?? '') }}" 
                                               placeholder="Enter start rent"
                                               min="0"
                                               required>
                                    </div>
                                    @error('start_rent')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="current_rent" class="form-label">
                                        <i class="fas fa-coins text-primary me-1"></i>Current Rent *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
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

                            <!-- Row 6: Location Coordinates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="lat_value" class="form-label">
                                        <i class="fas fa-globe text-primary me-1"></i>Latitude *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="lat" 
                                           id="lat_value"
                                           value="{{ old('lat', $data->lat ?? '') }}" 
                                           placeholder="Enter latitude"
                                           pattern="^-?([0-8]?[0-9]|90)(\.[0-9]{1,10})?$"
                                           required>
                                    @error('lat')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="lng" class="form-label">
                                        <i class="fas fa-globe-americas text-primary me-1"></i>Longitude *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="lng" 
                                           id="lng"
                                           value="{{ old('lng', $data->lng ?? '') }}" 
                                           placeholder="Enter longitude"
                                           pattern="^-?((1?[0-7]?[0-9])|180)(\.[0-9]{1,10})?$"
                                           required>
                                    @error('lng')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 7: Property Details -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="increment_percentage" class="form-label">
                                        <i class="fas fa-percentage text-primary me-1"></i>Annual Increase (%) *
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
                                               step="0.1"
                                               required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('increment_percentage')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="property_value" class="form-label">
                                        <i class="fas fa-calculator text-primary me-1"></i>Rate/Marla *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" 
                                               class="form-control" 
                                               name="property_value" 
                                               id="property_value"
                                               value="{{ old('property_value', $data->property_value ?? '') }}" 
                                               placeholder="Enter rate per marla"
                                               min="0"
                                               required>
                                    </div>
                                    @error('property_value')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 8: Future Use & Ownership -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="future_use" class="form-label">
                                        <i class="fas fa-lightbulb text-primary me-1"></i>Future Use *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           name="future_use" 
                                           id="future_use"
                                           value="{{ old('future_use', $data->future_use ?? '') }}" 
                                           placeholder="Enter future use"
                                           required>
                                    @error('future_use')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="ownership" class="form-label">
                                        <i class="fas fa-certificate text-primary me-1"></i>Ownership *
                                    </label>
                                    <select class="form-select" id="ownership" required name="ownership">
                                        <option value="">Select Ownership Type...</option>
                                        <option value="Property By Rent" {{ isset($data) && $data->ownership == 'Property By Rent' ? 'selected' : '' }}>Property By Rent</option>
                                        <option value="Tma Owned" {{ isset($data) && $data->ownership == 'Tma Owned' ? 'selected' : '' }}>TMA Owned</option>
                                        <option value="Provincial Govt" {{ isset($data) && $data->ownership == 'Provincial Govt' ? 'selected' : '' }}>Provincial Govt</option>
                                        <option value="Local Govt" {{ isset($data) && $data->ownership == 'Local Govt' ? 'selected' : '' }}>Local Govt</option>
                                        <option value="District Council" {{ isset($data) && $data->ownership == 'District Council' ? 'selected' : '' }}>District Council</option>
                                        <option value="Federal Govt" {{ isset($data) && $data->ownership == 'Federal Govt' ? 'selected' : '' }}>Federal Govt</option>
                                        <option value="Any Other" {{ isset($data) && $data->ownership == 'Any Other' ? 'selected' : '' }}>Any Other</option>
                                    </select>
                                    @error('ownership')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 9: Ownership Title & Document -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ownership_title" class="form-label">
                                        <i class="fas fa-file-contract text-primary me-1"></i>Ownership Title *
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
                                
                                <div class="col-md-6">
                                    <label for="document" class="form-label">
                                        <i class="fas fa-paperclip text-primary me-1"></i>Document Attachment
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           name="document" 
                                           id="document"
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    @error('document')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 10: Property Image -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="attachment" class="form-label">
                                        <i class="fas fa-camera text-primary me-1"></i>Property Image
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           name="attachment" 
                                           id="attachment"
                                           onchange="readURL(this);"
                                           accept="image/*">
                                    @error('attachment')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Court Case Information -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="is_court_case" class="form-label">
                                        <i class="fas fa-gavel text-primary me-1"></i>Is Court Case *
                                    </label>
                                    <select class="form-select" id="is_court_case" required name="is_court_case">
                                        <option value="">Select Option...</option>
                                        <option value="Yes" {{ isset($data) && $data->is_court_case == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ isset($data) && $data->is_court_case == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_court_case')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group" id="court_name" style="display: none">
                                <label class="col-sm-3 control-label">Court Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control court_name"   name="court_name">
                                        <option value="">Select Court....</option>
                                        @foreach($court as $key => $value)
                                            <option value="{{$value->id}}" {{(isset($court_case) && $court_case->court_id == $value->id) ? "selected" : ""}} >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="case_title" style="display: none">
                                <label class="col-sm-3 control-label">Case Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control case_title"  name="case_title" value="{{(isset($court_case->case_title)) ? $court_case->case_title : ""}}"  >
                                </div>
                            </div>

                            <div class="form-group" id="case_number" style="display: none">
                                <label class="col-sm-3 control-label">Case Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control case_number"  name="case_number" value="{{(isset($court_case->case_number)) ? $court_case->case_number : ""}}"  >
                                </div>
                            </div>

                            <div class="form-group" id="case_status" style="display: none">
                                <label class="col-sm-3 control-label">Case Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="case_status" name="case_status">
                                        <option value="">Select Case Status....</option>
                                        <option value="in_progress" {{(isset($court_case) && $court_case->case_status == "in_progress") ? "selected" : ""}} >In Progress</option>
                                        <option value="in_favour" {{(isset($court_case) && $court_case->case_status == "in_favour") ? "selected" : ""}} >Decided in Favour</option>
                                        <option value="decided_against" {{(isset($court_case) && $court_case->case_status == "decided_against") ? "selected" : ""}} >Decided Against</option>
                                    </select>
                                </div>

                            </div>



                            <div class="form-group">
                                <label class="col-sm-3 control-label">Allotment Order</label>

                                <div class="col-sm-9">
                                    <input type="file" onchange="readURL(this);"  class="form-control" accept="image/*"  name="attachment"  value="">

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
                            <h6 class="card-title mb-0" style="font-size: 10px;">
                                <i class="fas fa-map-marked-alt me-1"></i>Property Location & Map
                            </h6>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="box-body">

                                <div id="user_informations" style="display: none">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">User CNIC </label>

                                        <div class="col-sm-9">
                                            <input type="number" maxlength="13" class="form-control customer_details" id="user_cnic" placeholder="" value="{{isset($customerProperty) ? $customerProperty->cnic : ""}}" >
                                            <input type="hidden"  class="form-control customer_details" name="customer_id" id="user_id" placeholder="" value="{{isset($customerProperty) ? $customerProperty->user_id : ""}}" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name</label>

                                        <div class="col-sm-9">
                                            <input type="text" disabled value="{{isset($customerProperty) ? $customerProperty->name : ""}}" class="form-control customer_details" id="user_name" >
                                        </div>
                                    </div>

                                    <div class="form-group" style="display:none;">
                                        <label class="col-sm-3 control-label">Email</label>

                                        <div class="col-sm-9">
                                            <input type="text" disabled value="{{isset($customerProperty) ? $customerProperty->email : ""}}" class="form-control customer_details" id="user_email" >
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Lease Date</label>
                                            <input type="text" name="lease_date" value="{{isset($customerProperty) ? $customerProperty->lease_date : ""}}" class="form-control customer_details" id="lease_date">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Duration</label>
                                            <input type="number" name="duration" value="{{isset($customerProperty) ? $customerProperty->duration : ""}}" class="form-control customer_details" placeholder="Duration...">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- Map Section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="card-title mb-0" style="font-size: 10px;">
                                        <i class="fas fa-map-marker-alt me-1"></i>Interactive Map
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="map-container mb-3">
                                        <iframe
                                                width="100%"
                                                height="270"
                                                frameborder="0"
                                                scrolling="no"
                                                marginheight="0"
                                                marginwidth="0"
                                                id="current_iframe"
                                                src="https://maps.google.com/maps?q={{$data->lat ?? "34.33"}},{{$data->lng ?? "72.19"}}&hl=es&z=14&amp;output=embed"
                                                class="rounded border"
                                        >
                                        </iframe>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                <a href="https://www.maps.ie/route-planner.htm" target="_blank" class="text-decoration-none">
                                                    <i class="fas fa-route me-1"></i>Google Route Planner
                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        </form>







                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (right) -->
            </form>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


    <!-- Modal -->
    <div class="modal fade" id="user_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <form role="form" method="POST" id="save_user" id="form-validation" enctype="multipart/form-data" >
                    @csrf

                    <div class="modal-header" style="background-color: #00a65a;color: white;">
                        <h4 class="modal-title" id="exampleModalLabel">Tenant Registration</h4>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User Image<small class="text-normal"></small></label>
                            <input type="file" class="form-control" name="image"  >
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Name <small class="text-normal"></small></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{old('name', $user->name ?? "")}}" required >
                                <input type="hidden" class="form-control" name="user_type"  value="official" required >
                                <input type="hidden" class="form-control" name="id"  value="0" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number<small class="text-normal"></small></label>
                            <input type="text" class="form-control" name="phoneNumber" placeholder="Enter your Phone number..." value="{{old('phoneNumber', $user->phoneNumber ?? "")}}"  >
                        </div>
                        <div class="form-group">
                            <label>Email<small class="text-normal"></small></label>
                            <input type="text" class="form-control" name="email" name="res_email" placeholder="Enter your Email..." value="{{old('email', $user->email ?? "")}}"  >
                        </div>
                        <div class="form-group">
                            <label>CNIC<small class="text-normal"></small></label>
                            <h4 id="tenant_cnic_lab"></h4>
                            <input type="hidden" class="form-control" id="tenant_cnic" name="cnic" placeholder="Enter your CNIC number..." value="{{old('cnic', isset($_GET['cnic']) ? $_GET['cnic'] : "" )}}"  >
                        </div>


                        <div class="form-group">
                            <label>Address<small class="text-normal"></small></label>
                            <input type="text" class="form-control" name="address" placeholder="Enter your address..." value="{{old('address', $user->address ?? "")}}"  >
                        </div>

                        <div class="form-group">
                            <label>Department<small class="text-normal"></small></label>
                            <select class="form-control" name="org_id">
                                <option value="">Select Department....</option>
                                @foreach($org as $key => $value)
                                    <option value="{{$value->id}}">{{$value->org_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Designation<small class="text-normal"></small></label>
                            <input type="email" class="form-control" name="designation" placeholder="Enter designation..." value="{{old('designation', $user->designation ?? "")}}" required >
                        </div>

                        <div class="form-group">
                            <label>Place of Duty<small class="text-normal"></small></label>
                            <input type="email" class="form-control" name="place_of_duty" placeholder="Enter Place of Duty..." value="{{old('place_of_duty', $user->place_of_duty ?? "")}}" required >
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <div  class="btn btn-success save_tanant">Save Official</div>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                    data:{cnic:cnic,"type":"official"},
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




