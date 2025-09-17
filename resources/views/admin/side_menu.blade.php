<?php
    $uri = Route::getFacadeRoot()->current()->uri();
    $uri = explode("/",$uri);
    $uri = $uri[0] ?? "";

?>
<!-- Modern Admin Sidebar -->
<div class="sidebar-header">
    <div class="sidebar-brand">
        <i class="fas fa-building"></i>
        <span class="brand-name">E-Property</span>
    </div>
</div>

<div class="sidebar-content">
    <!-- Search Form -->
    <form class="search-form" method="GET">
        <div class="search-pan">
            <input type="text" name="search" placeholder="Search menu..." autocomplete="off" />
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <!-- Navigation Menu -->
    <ul class="nav nav-list">
        <!-- Quick Actions -->
        <li class="nav-header">
            <span>Quick Actions</span>
        </li>
        
        <li>
            <a href="{{URL::to('/')}}" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>Visit Website</span>
            </a>
        </li>

        <!-- Super Admin Menu -->
        @if(Auth::user() && Auth::user()->user_type == "super_admin")
            <li class="nav-header">
                <span>Administration</span>
            </li>
            
            <li class="{{($uri == "dashboard") ? "active" : ""}}">
                <a href="{{URL::to('dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="{{($uri == "users") ? "active" : ""}}">
                <a href="{{URL::to('users/manage-admins')}}">
                    <i class="fas fa-users-cog"></i>
                    <span>Manage Admins</span>
                </a>
            </li>

            <li class="{{($uri == "users-verification") ? "active" : ""}}">
                <a href="{{URL::to('users-verification')}}">
                    <i class="fas fa-user-check"></i>
                    <span>User Verification</span>
                </a>
            </li>
        @endif

        <!-- Admin User Menu -->
        @if(Auth::user() && (Auth::user()->user_type == "admin_user" || Auth::user()->user_type == "super_admin"))
            @if(Auth::user()->user_type != "super_admin")
                <li class="nav-header">
                    <span>Main</span>
                </li>
                
                <li class="{{($uri == "dashboard") ? "active" : ""}}">
                    <a href="{{URL::to('dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            @endif

            <li class="nav-header">
                <span>Property Management</span>
            </li>

            <li class="nav-item {{($uri == "settings") ? "active" : ""}}">
                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                    <i class="fas fa-chevron-right submenu-arrow"></i>
                </a>
                <div class="collapse submenu {{($uri == "settings") ? "show" : ""}}" id="settingsSubmenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{url('settings/manage-plaza')}}" class="nav-link">
                                <i class="fas fa-building"></i>
                                <span>Manage Property</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('settings/list-cases')}}" class="nav-link">
                                <i class="fas fa-gavel"></i>
                                <span>Manage Cases</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="{{($uri == "rent") ? "active" : ""}}">
                <a href="{{route('rent.index')}}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Rent Collection</span>
                </a>
            </li>

            <li class="{{($uri == "commercial-properties") ? "active" : ""}}">
                <a href="{{url('commercial-properties')}}">
                    <i class="fas fa-store"></i>
                    <span>Commercial Property</span>
                </a>
            </li>

            <li class="{{($uri == "residential-properties") ? "active" : ""}}">
                <a href="{{url('residential-properties')}}">
                    <i class="fas fa-home"></i>
                    <span>Residential Property</span>
                </a>
            </li>

            <li class="nav-item {{($uri == "auctions") ? "active" : ""}}">
                <a href="#auctionsSubmenu" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="fas fa-gavel"></i>
                    <span>Auctions</span>
                    <i class="fas fa-chevron-right submenu-arrow"></i>
                </a>
                <div class="collapse submenu {{($uri == "auctions") ? "show" : ""}}" id="auctionsSubmenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{url('auctions/manage-auctions')}}" class="nav-link">
                                <i class="fas fa-hammer"></i>
                                <span>Manage Auctions</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{($uri == "reports") ? "active" : ""}}">
                <a href="#reportsSubmenu" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                    <i class="fas fa-chevron-right submenu-arrow"></i>
                </a>
                <div class="collapse submenu {{($uri == "reports") ? "show" : ""}}" id="reportsSubmenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{url("reports/tma_report")}}" class="nav-link">
                                <i class="fas fa-file-alt"></i>
                                <span>TMA Property Report</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        <!-- Customer Menu -->
        @if(Auth::user() && Auth::user()->user_type == "customer")
            <li class="nav-header">
                <span>Customer Panel</span>
            </li>
            
            <li class="{{($uri == "customer-dashboard") ? "active" : ""}}">
                <a href="{{URL::to('customer-dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item {{($uri == "auctions") ? "active" : ""}}">
                <a href="#customerAuctionsSubmenu" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="fas fa-gavel"></i>
                    <span>Auctions</span>
                    <i class="fas fa-chevron-right submenu-arrow"></i>
                </a>
                <div class="collapse submenu {{($uri == "auctions") ? "show" : ""}}" id="customerAuctionsSubmenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{url("auctions/manage-auction")}}" class="nav-link">
                                <i class="fas fa-hammer"></i>
                                <span>My Auctions</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{($uri == "reports") ? "active" : ""}}">
                <a href="#customerReportsSubmenu" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                    <i class="fas fa-chevron-right submenu-arrow"></i>
                </a>
                <div class="collapse submenu {{($uri == "reports") ? "show" : ""}}" id="customerReportsSubmenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{url("reports/customer_report")}}" class="nav-link">
                                <i class="fas fa-file-chart-line"></i>
                                <span>Property Report</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

    </ul>
</div>

<!-- Sidebar Toggle Button -->
<div class="sidebar-toggle d-lg-block">
    <button class="btn btn-sm btn-outline-light" onclick="toggleSidebar()">
        <i class="fas fa-angle-double-left"></i>
    </button>
</div>

<style>
    /* Sidebar Header */
    .sidebar-header {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .sidebar-brand {
        display: flex;
        align-items: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
    }
    
    .sidebar-brand i {
        margin-right: 10px;
        color: #3b82f6;
    }
    
    /* Navigation Headers */
    .nav-header {
        padding: 1rem 1.5rem 0.5rem;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 1rem;
    }
    
    .nav-header:first-child {
        margin-top: 0;
    }
    
    /* Submenu Styles */
    .submenu {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 0 0 8px 8px;
        margin: 0 8px;
    }
    
    .submenu .nav-link {
        padding: 8px 16px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.7);
    }
    
    .submenu .nav-link:hover {
        color: white;
        background: rgba(255, 255, 255, 0.05);
    }
    
    .submenu-arrow {
        margin-left: auto;
        transition: transform 0.3s ease;
        font-size: 12px;
    }
    
    .nav-link:not(.collapsed) .submenu-arrow {
        transform: rotate(90deg);
    }
    
    /* Sidebar Toggle */
    .sidebar-toggle {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
    }
    
    .admin-sidebar.collapsed .sidebar-toggle .fa-angle-double-left {
        transform: rotate(180deg);
    }
    
    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar-brand .brand-name {
            display: none;
        }
        
        .nav-header {
            display: none;
        }
        
        .sidebar-toggle {
            display: none;
        }
    }
</style>