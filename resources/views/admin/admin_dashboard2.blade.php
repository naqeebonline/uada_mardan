@extends('admin.template2')
@section('content')
   <!-- <div style="text-align:center;text-align: center;background: #ffffff;padding: 10px;"><img src="http://eproperty.lcbkp.gov.pk/public/logo.png" style="width:30%;"/></div> -->


    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-dark fw-bold">
                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>
                    DASHBOARD
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-calendar me-1"></i>{{date('d M, Y')}}</small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-primary mb-0">{{$active_tenants ?? 0}}</h3>
                            <p class="stat-label mb-0">Total Tenants</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-0">{{$recipts ?? 0}}</h3>
                            <p class="stat-label mb-0">Total Receipts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-0">2</h3>
                            <p class="stat-label mb-0">Vacant Plots</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-0">{{$open_plots ?? 0}}</h3>
                            <p class="stat-label mb-0">Open Plots</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Properties Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-0">{{$commercial ?? "0"}}</h3>
                            <p class="stat-label mb-0">Commercial Properties</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-0">{{$residential ?? "0"}}</h3>
                            <p class="stat-label mb-0">Residential Properties</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-0">2</h3>
                            <p class="stat-label mb-0">Auction Properties</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-secondary bg-opacity-10 text-secondary me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-secondary mb-0">{{$proprty_to_be_auctioned ?? 0}}</h3>
                            <p class="stat-label mb-0">Pending Auctions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Court Cases Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-0">{{$case_in_progress ?? 0}}</h3>
                            <p class="stat-label mb-0">Cases In Progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-0">{{$case_in_favour ?? 0}}</h3>
                            <p class="stat-label mb-0">Cases In Favour</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card simple-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-0">{{$case_decided_against ?? 0}}</h3>
                            <p class="stat-label mb-0">Decided Against</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Overview Table -->
    <div class="row">
        <div class="col-12">
            <div class="card simple-card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-building me-2 text-primary"></i>
                            TMA Property Overview
                        </h5>
                        <span class="badge bg-primary">{{count($property ?? [])}} Organizations</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example_1" class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th class="fw-semibold">Organization</th>
                                <th class="fw-semibold text-center">Commercial Total</th>
                                <th class="fw-semibold text-center">Residential Total</th>
                                <th class="fw-semibold text-center">Commercial Rented</th>
                                <th class="fw-semibold text-center">Commercial Open</th>
                                <th class="fw-semibold text-center">Residential Rented</th>
                                <th class="fw-semibold text-center">Residential Open</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($property as $key => $value)
                                <tr>
                                    <td class="fw-medium">
                                        <i class="fas fa-city me-2 text-muted"></i>
                                        {{$value->org_name}}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info">{{$value->TotalCommercial}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">{{$value->TotalResidential}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{$value->RentCommercial ?? "0"}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">{{$value->OpenCommercial}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{$value->RentResidential}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">{{$value->OpenResidential}}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No property data available
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Court Cases -->
    <div class="row">
        <div class="col-12">
            <div class="card simple-card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calendar-alt me-2 text-danger"></i>
                            Upcoming Court Cases (Next 7 Days)
                        </h5>
                        <div class="d-flex gap-2">
                            <span class="badge bg-danger">{{count($case ?? [])}} Cases</span>
                            <button class="btn btn-sm btn-outline-primary" onclick="print_all()">
                                <i class="fas fa-print me-1"></i>Print All
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th class="fw-semibold">Court</th>
                                <th class="fw-semibold">Case Title</th>
                                <th class="fw-semibold">Case Number</th>
                                <th class="fw-semibold">Lawyer</th>
                                <th class="fw-semibold text-center">Status</th>
                                <th class="fw-semibold text-center">Previous Date</th>
                                <th class="fw-semibold text-center">Next Date</th>
                                <th class="fw-semibold text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($case as $key => $value)
                                <tr>
                                    <td class="fw-medium">
                                        <i class="fas fa-university me-2 text-muted"></i>
                                        {{$value->court_name}}
                                    </td>
                                    <td>{{$value->case_title}}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{$value->case_number}}</span>
                                    </td>
                                    <td>{{$value->lawyer_name ?? "Not Assigned"}}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{$value->case_status == 'Active' ? 'success' : 'warning'}}">
                                            {{$value->case_status}}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{$value->hearing_date ? date('d M, Y', strtotime($value->hearing_date)) : 'N/A'}}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small class="text-danger fw-semibold">
                                            <i class="fas fa-clock me-1"></i>
                                            {{$value->next_hearing_date ? date('d M, Y', strtotime($value->next_hearing_date)) : 'N/A'}}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url("print-case")."/$value->id"}}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Print Case Details">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-calendar-check fa-2x mb-2 d-block text-success"></i>
                                        No upcoming court cases in next 7 days
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Tenants Location Map -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card simple-card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-map-marker-alt me-2 text-success"></i>
                            Tenants Locations
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-secondary" onclick="toggleFullscreen()">
                                <i class="fas fa-expand me-1"></i>Fullscreen
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="map_canvas" style="width:100%; height:500px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 0 0 12px 12px;">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <i class="fas fa-map fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Loading map...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables Initialization -->
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize DataTables with Bootstrap 5 styling
            $('#example_1, #example1').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>t<"row"<"col-sm-6"i><"col-sm-6"p>>'
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Print function
        function print_all() {
            window.print();
        }

        // Fullscreen toggle function
        function toggleFullscreen() {
            const mapElement = document.getElementById('map_canvas');
            if (!document.fullscreenElement) {
                mapElement.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }
    </script>

    <script type="text/javascript">

        initialize();
        function initialize() {
            $.ajax({
                method:"GET",
                url:"{{url('getTenants')}}",
                success:function (res) {
                    loadTenants(res.data);

                }
            });
            var loc = [];



        }

        function loadTenants(locations){


            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 13,
                center: new google.maps.LatLng(34.025917, 71.560135),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,icon: 'https://properties-cdgp.com/transparent.png'
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>
@endsection




