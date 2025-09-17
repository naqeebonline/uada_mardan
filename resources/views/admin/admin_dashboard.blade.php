@extends('admin.template')
@section('content')
    <!-- Dashboard Header -->
    <div class="dashboard-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="dashboard-title">Dashboard Overview</h1>
                <p class="dashboard-subtitle text-muted">Welcome back! Here's what's happening with your property management system.</p>
            </div>
            <div class="col-md-6 text-end">
                <div class="dashboard-filters">
                    <select class="form-select" id="org_id" name="org_id" style="max-width: 300px;">
                        <option value="0">All Organizations</option>
                        @foreach($org as $key => $value)
                            <option value="{{$value->id}}" {{(isset($_GET['org_id']) &&  $_GET['org_id'] == $value->id) ? "selected" : "" }}>
                                {{$value->org_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12  c ml-auto mr-auto">

            <div role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("settings/save-plaza")}}">

                <div class="row">






                </div>




            </div>

        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="row g-4 mb-5">
        <!-- Property Statistics -->
        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-primary">
                <div class="stats-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stats-number">{{$total_tma_properties ?? 0}}</div>
                <div class="stats-label">TMA Properties</div>
                <div class="stats-trend">
                    <i class="fas fa-arrow-up"></i> +5.2% from last month
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-warning">
                <div class="stats-icon">
                    <i class="fas fa-map"></i>
                </div>
                <div class="stats-number">{{$total_plots ?? 0}}</div>
                <div class="stats-label">Total Plots</div>
                <div class="stats-trend">
                    <i class="fas fa-arrow-up"></i> +2.8% from last month
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-success">
                <div class="stats-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stats-number">{{$total_shops ?? 0}}</div>
                <div class="stats-label">Total Shops</div>
                <div class="stats-trend">
                    <i class="fas fa-arrow-down"></i> -1.2% from last month
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-danger">
                <div class="stats-icon">
                    <i class="fas fa-city"></i>
                </div>
                <div class="stats-number">{{$total_plaza ?? 0}}</div>
                <div class="stats-label">Total Plazas</div>
                <div class="stats-trend">
                    <i class="fas fa-arrow-up"></i> +8.1% from last month
                </div>
            </div>
        </div>
    </div>

    <!-- Lease Information Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-gradient-primary text-white">
                <div class="stats-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="stats-number">{{$total_lease_out ?? 0}}</div>
                <div class="stats-label">Properties Leased</div>
                <div class="stats-progress">
                    <div class="progress">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-gradient-success text-white">
                <div class="stats-icon">
                    <i class="fas fa-shop"></i>
                </div>
                <div class="stats-number">{{$lease_out_plaza ?? 0}}</div>
                <div class="stats-label">Shops Leased Out</div>
                <div class="stats-progress">
                    <div class="progress">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa fa-square"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$lease_out_plots ?? 0}}</p>
                            <p class="title">No of Plots Lease out</p>
                        </div>
                    </div>
                </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-gradient-warning text-white">
                <div class="stats-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="stats-number">{{$proprty_to_be_auctioned ?? 0}}</div>
                <div class="stats-label">Properties to Auction</div>
                <div class="stats-progress">
                    <div class="progress">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-gradient-danger text-white">
                <div class="stats-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stats-number">₨{{number_format($estimated_premium ?? 0)}}</div>
                <div class="stats-label">Estimated Premium</div>
                <div class="stats-progress">
                    <div class="progress">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 80%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-money-bill-wave me-2 text-success"></i>
                        Monthly Revenue
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="revenue-stat">
                                <div class="revenue-amount">₨{{number_format($property_rent_per_month ?? 0)}}</div>
                                <div class="revenue-label">Property Rent/Month</div>
                                <div class="revenue-change text-success">
                                    <i class="fas fa-arrow-up"></i> +12.5% vs last month
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <canvas id="revenueChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>
                        Property Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="propertyChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

                <div class="col-md-3">
                    <div class="tile tile-green">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$offeredPermium ?? 0}}</p>
                            <p class="title">Offered by Customer</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile tile-yellow">
                        <div class="img">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="content">
                            <p class="big">{{$total_plots ?? 0}}</p>
                            <p class="title">Increase in Premium (%age)</p>
                        </div>
                    </div>
                </div>




            </div>




        </div>
    </div>

    <!-- Auction Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3"><i class="fas fa-gavel me-2"></i>Auction Analytics</h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-building text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$getTotalOpenAuctions ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Published Auctions</p>
                            <small class="opacity-50">
                                <i class="fas fa-arrow-up me-1"></i>12% from last month
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-unlock text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$getTotalOpenAuctions ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Active Auctions</p>
                            <small class="opacity-50">
                                <i class="fas fa-arrow-up me-1"></i>8% from last month
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$upcommingAuctions ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Upcoming Auctions</p>
                            <small class="opacity-50">
                                <i class="fas fa-arrow-up me-1"></i>15% from last month
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-archive text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$completedAuctions ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Archived Auctions</p>
                            <small class="opacity-50">
                                <i class="fas fa-arrow-up me-1"></i>22% from last month
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Tenant & Receipt Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3"><i class="fas fa-users me-2"></i>Tenant & Receipt Analytics</h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-user-check text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$active_tenants ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Active Tenants</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-white" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-user-times text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$deactive_tenants ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Inactive Tenants</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-white" style="width: 25%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{($deactive_tenants ?? 0) + ($active_tenants ?? 0)}}</h3>
                            <p class="mb-0 opacity-75">Total Tenants</p>
                            <small class="opacity-50">
                                <i class="fas fa-arrow-up me-1"></i>Total count
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon">
                                <i class="fas fa-receipt text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 text-white">
                            <h3 class="mb-0 fw-bold">{{$recipts ?? 0}}</h3>
                            <p class="mb-0 opacity-75">Total Receipts</p>
                            <small class="opacity-50">
                                <i class="fas fa-chart-line me-1"></i>Financial records
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activities -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="card modern-card h-100">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-primary w-100 h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                <span>New Auction</span>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-success w-100 h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                <i class="fas fa-user-plus fa-2x mb-2"></i>
                                <span>Add Tenant</span>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-warning w-100 h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                <i class="fas fa-gavel fa-2x mb-2"></i>
                                <span>Court Case</span>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-info w-100 h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                <i class="fas fa-receipt fa-2x mb-2"></i>
                                <span>Generate Receipt</span>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-secondary w-100 h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                <span>View Reports</span>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-dark w-100 h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                <i class="fas fa-cog fa-2x mb-2"></i>
                                <span>Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card modern-card h-100">
                <div class="card-header bg-gradient-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Recent Activities
                    </h5>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-content">
                                <p class="mb-1 fw-bold">New auction created</p>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-content">
                                <p class="mb-1 fw-bold">Tenant registered</p>
                                <small class="text-muted">4 hours ago</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <div class="activity-content">
                                <p class="mb-1 fw-bold">Court case updated</p>
                                <small class="text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-info">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="activity-content">
                                <p class="mb-1 fw-bold">Receipt generated</p>
                                <small class="text-muted">2 days ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Court Cases Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-balance-scale me-2"></i>
                        Upcoming Court Cases (Within 7 Days)
                    </h5>
                    <span class="badge bg-light text-dark">{{count($case)}} Cases</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover modern-table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="fw-bold">Court Name</th>
                                <th class="fw-bold">Case Title</th>
                                <th class="fw-bold">Case Number</th>
                                <th class="fw-bold">Lawyer Name</th>
                                <th class="fw-bold">Status</th>
                                <th class="fw-bold">Previous Date</th>
                                <th class="fw-bold">Next Date</th>
                                <th class="fw-bold text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($case as $key => $value)
                                <tr>
                                    <td class="fw-medium">{{$value->court_name}}</td>
                                    <td>{{$value->case_title}}</td>
                                    <td>
                                        <span class="badge bg-primary">{{$value->case_number}}</span>
                                    </td>
                                    <td>{{$value->lawyer_name ?? "N/A"}}</td>
                                    <td>
                                        <span class="badge bg-success">{{$value->case_status}}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{$value->hearing_date}}
                                        </small>
                                    </td>
                                    <td>
                                        <small class="text-warning fw-bold">
                                            <i class="fas fa-calendar-exclamation me-1"></i>
                                            {{$value->next_hearing_date}}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-sm btn-outline-primary" target="_blank" 
                                               href="{{url("settings/case-details")."/$value->id"}}" 
                                               data-bs-toggle="tooltip" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-outline-secondary" 
                                               href="{{url("print-case")."/$value->id"}}" 
                                               data-bs-toggle="tooltip" title="Print Case">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($case) == 0)
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-calendar-check fa-2x mb-3 text-success"></i>
                                        <br>
                                        No court cases scheduled within the next 7 days
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Initialize charts if Chart.js is available
            if (typeof Chart !== 'undefined') {
                // Revenue Chart
                const revenueCtx = document.getElementById('revenueChart');
                if (revenueCtx) {
                    new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Revenue',
                                data: [12000, 15000, 18000, 14000, 20000, 25000],
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f1f5f9'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }
                
                // Property Distribution Chart
                const propertyCtx = document.getElementById('propertyChart');
                if (propertyCtx) {
                    new Chart(propertyCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Residential', 'Commercial', 'Industrial', 'Agricultural'],
                            datasets: [{
                                data: [45, 25, 20, 10],
                                backgroundColor: [
                                    '#3b82f6',
                                    '#10b981',
                                    '#f59e0b',
                                    '#ef4444'
                                ],
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }
            
            // Organization change handler
            $("body").on("change","#org_id",function(e){
                var id = $(this).val();
                var baseUrl = "{{ url('dashboard/') }}";
                window.location = baseUrl + "?org_id=" + id;
            });
            
            // Add fade-in animation to cards
            $('.stats-card').each(function(index) {
                $(this).delay(index * 100).queue(function() {
                    $(this).addClass('fade-in-up').dequeue();
                });
            });
        });
    </script>

@endsection




