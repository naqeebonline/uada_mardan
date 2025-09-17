<aside class="sidebar bg-dark" style="width: 280px; min-height: 100vh;">
    <div class="d-flex flex-column h-100">
        <!-- User Panel -->
        <div class="user-panel p-3 mb-3 border-bottom border-secondary">
            <div class="d-flex align-items-center">
                <img src="http://eproperty.lcbkp.gov.pk/uploads/organization_logo/default.png" 
                     class="rounded-circle me-3" 
                     style="width: 50px; height: 50px; background: white;" 
                     alt="User Image">
                <div class="flex-grow-1">
                    <h6 class="text-light mb-1">{{auth()->user()->name}}</h6>
                    <small class="text-success">
                        <i class="fas fa-circle me-1" style="font-size: 8px;"></i>Online
                    </small>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-grow-1">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu"">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{URL::to('/dashboard')}}" class="nav-link active">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(Auth::user() && Auth::user()->user_type == "super_admin")
                <!-- Manage Admin -->
                <li class="nav-item">
                    <a href="{{URL::to('users/manage-admins')}}" class="nav-link">
                        <i class="fas fa-users-cog me-2"></i>
                        <span>Manage Admin</span>
                    </a>
                </li>

                <!-- User Verifications -->
                <li class="nav-item">
                    <a href="{{URL::to('users-verification')}}" class="nav-link">
                        <i class="fas fa-user-check me-2"></i>
                        <span>User Verifications</span>
                    </a>
                </li>
                @endif

                <!-- Configuration Dropdown -->
                <li class="nav-item">
                    <a href="#configSubmenu" class="nav-link collapsed" data-bs-toggle="collapse" role="button">
                        <i class="fas fa-cogs me-2"></i>
                        <span>Configuration</span>
                        <i class="fas fa-angle-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="configSubmenu">
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{url('settings/manage-plaza')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span>Manage Property</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Auctions Dropdown -->
                <li class="nav-item">
                    <a href="#auctionSubmenu" class="nav-link collapsed" data-bs-toggle="collapse" role="button">
                        <i class="fas fa-gavel me-2"></i>
                        <span>Auctions</span>
                        <i class="fas fa-angle-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="auctionSubmenu">
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{url('auctions/manage-auctions')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span>Manage Auctions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Commercial Properties -->
                <li class="nav-item">
                    <a href="{{url('commercial-properties')}}" class="nav-link">
                        <i class="fas fa-building me-2"></i>
                        <span>Commercial Properties</span>
                    </a>
                </li>

                <!-- Residential Properties -->
                <li class="nav-item">
                    <a href="{{url('residential-properties')}}" class="nav-link">
                        <i class="fas fa-home me-2"></i>
                        <span>Residential Properties</span>
                    </a>
                </li>

                <!-- Rent & Outstandings -->
                <li class="nav-item">
                    <a href="{{route('rent.index')}}" class="nav-link">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        <span>Rent & Outstandings</span>
                    </a>
                </li>

                <!-- Court Cases -->
                <li class="nav-item">
                    <a href="{{url('settings/list-cases')}}" class="nav-link">
                        <i class="fas fa-balance-scale me-2"></i>
                        <span>Court Cases</span>
                    </a>
                </li>

                <!-- Reports -->
                <li class="nav-item">
                    <a href="{{route('reports.index')}}" class="nav-link">
                        <i class="fas fa-chart-bar me-2"></i>
                        <span>Reports</span>
                    </a>
                </li>





            </ul>
        </nav>
    </div>
</aside>

<!-- User Profile Modal -->
<div class="modal fade" id="user" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="form1" method="post" action="https://properties-cdgp.com/root/edit_user" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Edit User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="Administrator">
                    </div>

                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter old password">
                    </div>

                    <div class="mb-3">
                        <label for="newpass" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Enter new password">
                    </div>

                    <div class="mb-3">
                        <label for="new_user_photo" class="form-label">Profile Photo</label>
                        <input type="hidden" name="current_photo" value="">
                        <input type="file" class="form-control" id="new_user_photo" name="new_user_photo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>