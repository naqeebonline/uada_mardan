<nav class="navbar navbar-green">
    <!-- Mobile Menu Toggle -->
    <button type="button" class="navbar-toggle d-lg-none" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Brand -->
    <a class="navbar-brand" href="{{url('dashboard')}}">
        <i class="fas fa-building"></i>
        <span class="brand-text">E-Property Admin</span>
    </a>

    <!-- Header Actions -->
    <div class="header-actions d-flex align-items-center gap-3">
        <!-- Notifications -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm position-relative" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                <li class="dropdown-header">
                    <strong>Notifications</strong>
                    <span class="badge bg-primary rounded-pill">3</span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item notification-item" href="#">
                        <div class="notification-icon bg-success">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">New User Registration</div>
                            <div class="notification-time">2 minutes ago</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item notification-item" href="#">
                        <div class="notification-icon bg-warning">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">Auction Ending Soon</div>
                            <div class="notification-time">15 minutes ago</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item notification-item" href="#">
                        <div class="notification-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">Payment Received</div>
                            <div class="notification-time">1 hour ago</div>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-center" href="#">
                        <small>View all notifications</small>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="dropdown">
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-plus"></i>
                <span class="d-none d-md-inline">Quick Add</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-building me-2"></i>Add Property
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-gavel me-2"></i>Create Auction
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user me-2"></i>Add User
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cog me-2"></i>Settings
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Profile -->
        <div class="dropdown user-profile">
            <a href="#" class="user-menu dropdown-toggle" data-bs-toggle="dropdown">
                <img class="nav-user-photo" src="{{url("/")."/".\Illuminate\Support\Facades\Auth::user()->image}}" alt="User Avatar" />
                <span class="user-info d-none d-md-inline">
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </span>
                <i class="fas fa-chevron-down ms-1"></i>
            </a>

            <ul class="dropdown-menu dropdown-navbar dropdown-menu-end">
                <li class="dropdown-header">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle me-2" src="{{url("/")."/".\Illuminate\Support\Facades\Auth::user()->image}}" width="40" height="40" alt="User">
                        <div>
                            <div class="fw-bold">{{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                            <small class="text-muted">{{\Illuminate\Support\Facades\Auth::user()->email ?? 'Administrator'}}</small>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user me-2"></i>My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cog me-2"></i>Account Settings
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-bell me-2"></i>Preferences
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{URL::to('admin/logout')}}">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .header-actions .btn {
        border-radius: 8px;
        font-weight: 500;
    }
    
    .notification-dropdown {
        width: 320px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .notification-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    
    .notification-item:hover {
        background: #f8fafc;
    }
    
    .notification-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 12px;
        font-size: 14px;
    }
    
    .notification-content {
        flex: 1;
    }
    
    .notification-title {
        font-weight: 500;
        font-size: 14px;
        color: #1e293b;
        margin-bottom: 2px;
    }
    
    .notification-time {
        font-size: 12px;
        color: #64748b;
    }
    
    .brand-text {
        margin-left: 8px;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .brand-text {
            display: none;
        }
        
        .notification-dropdown {
            width: 280px;
        }
    }
</style>