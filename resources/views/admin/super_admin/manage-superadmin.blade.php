@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-users me-2 text-primary"></i>
                    Manage Admin Users
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Manage Admin Users
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('users/add-superadmin') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus me-1"></i>Add New User
                </a>
                <button onclick="print_all()" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-print me-1"></i>Print
                </button>
                <small class="text-muted align-self-center">
                    <i class="fas fa-calendar me-1"></i>{{ date('d M, Y') }}
                </small>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card simple-card">
                    <div class="card-header border-0 pb-0">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-list me-2 text-success"></i>
                            Admin Users Management
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Table with Background -->
                            <style>
                                .table-with-bg {
                                    position: relative;
                                }
                                .table-with-bg::before {
                                    content: '';
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-image: url(https://properties-cdgp.com/newlogo.png);
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    background-size: contain;
                                    opacity: 0.05;
                                    z-index: 1;
                                    pointer-events: none;
                                }
                                .table-with-bg table,
                                .table-with-bg .table > * {
                                    position: relative;
                                    z-index: 2;
                                    background: transparent !important;
                                }
                                .table-with-bg .table th,
                                .table-with-bg .table td {
                                    background: rgba(255, 255, 255, 0.9) !important;
                                }
                            </style>

                            <div class="table-with-bg">
                                <table id="example1" class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th><i class="fas fa-user me-1"></i>Name</th>
                                            <th><i class="fas fa-envelope me-1"></i>Email</th>
                                            <th><i class="fas fa-phone me-1"></i>Phone</th>
                                            <th><i class="fas fa-user-tag me-1"></i>User Type</th>
                                            <th><i class="fas fa-building me-1"></i>Office</th>
                                            <th><i class="fas fa-sitemap me-1"></i>Organization</th>
                                            <th width="200"><i class="fas fa-cogs me-1"></i>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user text-primary me-2"></i>
                                                        <strong>{{ $value->name }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small>
                                                        <i class="fas fa-envelope text-info me-1"></i>
                                                        {{ $value->email }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <small>
                                                        <i class="fas fa-phone text-success me-1"></i>
                                                        {{ $value->phoneNumber }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($value->user_type == 'super_admin')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-crown me-1"></i>Super Admin
                                                        </span>
                                                    @else
                                                        <span class="badge bg-primary">
                                                            <i class="fas fa-user me-1"></i>Admin User
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $value->office_name ?? 'N/A' }}</small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $value->org_name ?? 'N/A' }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ url("users/edit-superadmin") . "/$value->id" }}" 
                                                           class="btn btn-outline-primary btn-sm" 
                                                           title="Edit User">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if($value->is_active == 1)
                                                            <button type="button" 
                                                                    class="btn btn-outline-danger btn-sm delete_record" 
                                                                    status="0" 
                                                                    id="{{ $value->id }}" 
                                                                    title="Deactivate User">
                                                                <i class="fas fa-user-slash"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" 
                                                                    class="btn btn-outline-success btn-sm delete_record" 
                                                                    status="1" 
                                                                    id="{{ $value->id }}" 
                                                                    title="Activate User">
                                                                <i class="fas fa-user-check"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="fas fa-users fa-3x mb-3"></i>
                                                        <p>No admin users found</p>
                                                    </div>
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
            
            <!-- Pagination -->
            
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>Confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div class="alert_message box_message">
                            Are you sure you want to perform this action?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn_cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary save_btn delete_yes">
                        <i class="fas fa-check me-1"></i>Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script type="text/javascript">
        // Initialize DataTable
        $('#example1').DataTable({
            responsive: true,
            pageLength: 25,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [-1] } // Disable ordering on action column
            ],
            language: {
                search: "Search users:",
                lengthMenu: "Show _MENU_ users per page",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                infoEmpty: "No users available",
                emptyTable: "No users found in the database"
            }
        });

        let currentUserId = null;
        let currentStatus = null;

        $(document).ready(function(e){
            // Handle activate/deactivate clicks
            $("body").on("click", ".delete_record", function(e){
                e.preventDefault();
                currentStatus = $(this).attr("status");
                let mode = currentStatus == "0" ? "Deactivate" : "Activate";
                currentUserId = $(this).attr("id");
                
                $(".box_message").text(`Are you sure you want to ${mode.toLowerCase()} this user?`);
                
                // Use Bootstrap 5 modal
                var deleteModal = new bootstrap.Modal(document.getElementById('delete_modal'));
                deleteModal.show();
            });

            // Handle cancel button
            $("body").on("click", ".btn_cancel", function(e){
                var deleteModal = bootstrap.Modal.getInstance(document.getElementById('delete_modal'));
                if (deleteModal) {
                    deleteModal.hide();
                }
                currentUserId = null;
                currentStatus = null;
            });

            // Handle confirm action
            $("body").on("click", ".delete_yes", function(e){
                if (!currentUserId || currentStatus === null) return;

                // Show loading state
                $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Processing...');

                $.ajax({
                    method: "POST",
                    data: {
                        id: currentUserId,
                        status: currentStatus,
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ url("users/delete-superadmin") }}',
                    success: function(res){
                        if(res.status){
                            // Show success message and reload
                            toastr.success('User status updated successfully!');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error(res.message || 'Failed to update user status');
                            $('.delete_yes').prop('disabled', false).html('<i class="fas fa-check me-1"></i>Confirm');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred while updating user status');
                        $('.delete_yes').prop('disabled', false).html('<i class="fas fa-check me-1"></i>Confirm');
                    }
                });
            });
        });

        // Print function
        function print_all() {
            window.print();
        }
    </script>



@endsection






