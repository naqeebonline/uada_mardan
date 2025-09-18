<header class="main-header">
    <!-- Bootstrap 5 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a href="http://eproperty.lcbkp.gov.pk/" class="navbar-brand d-flex align-items-center">
                <img src="{{asset('logo.png')}}" 
                     style="width:180px; height:45px;" 
                     alt="eProperty" 
                     class="me-2">
                <span class="d-none d-md-inline fs-6">UADA</span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Clock -->
                <div class="navbar-text text-white me-3">
                    <i class="fas fa-clock me-1"></i>
                    <span id="clock"></span>
                </div>

                <!-- Organization Selector for Super Admin -->
                @if(Auth::user()->user_type == "super_admin")
                <div class="me-auto">
                    <select class="form-select form-select-sm" id="all_org_id" name="org_id" style="width: 300px;">
                        <option value="0">Select Organization...</option>
                        @foreach($all_organizations as $key => $value)
                            <option value="{{$value->id}}" {{(auth()->user()->org_id == $value->id) ? "selected" : "" }}>
                                {{$value->org_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <!-- Right Menu -->
                <ul class="navbar-nav ms-auto">
                    <!-- Notifications -->
                    <li class="nav-item dropdown d-none">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="badge bg-warning rounded-pill">2</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">Notifications</li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="https://properties-cdgp.com/root/notifications">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="http://eproperty.lcbkp.gov.pk/uploads/organization_logo/default.png" 
                                 class="rounded-circle me-2" 
                                 style="width: 32px; height: 32px; background: white;" 
                                 alt="Profile">
                            <span class="d-none d-md-inline">{{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header d-flex flex-column align-items-center py-3">
                                <img src="http://eproperty.lcbkp.gov.pk/uploads/organization_logo/default.png" 
                                     class="rounded-circle mb-2" 
                                     style="width: 64px; height: 64px; background: white;" 
                                     alt="Profile">
                                <strong>{{auth()->user()->name}}</strong>
                                <small class="text-muted">Administrator</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#user">
                                    <i class="fas fa-user me-2"></i>My Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{URL::to('admin/logout')}}">
                                    <i class="fas fa-sign-out-alt me-2"></i>Sign out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>