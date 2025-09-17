@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-users me-2 text-primary"></i>
                    User Verification
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User Verification
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button onclick="print_all()" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-print me-1"></i>Print
                </button>
                <small class="text-muted align-self-center">
                    <i class="fas fa-calendar me-1"></i>{{date('d M, Y')}}
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
                            Admin Users Verification List
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userVerificationTable" class="table table-striped table-hover">
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
                                                    <div class="avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2">
                                                        {{ strtoupper(substr($value->name, 0, 1)) }}
                                                    </div>
                                                    {{ $value->name }}
                                                </div>
                                            </td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phoneNumber }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $value->user_type }}</span>
                                            </td>
                                            <td>{{ $value->office_name }}</td>
                                            <td>{{ $value->org_name }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{url('users-verification/details').'/'.$value->id}}" 
                                                       class="btn btn-outline-primary btn-sm" 
                                                       title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($value->is_active == 1)
                                                        <button type="button" 
                                                                class="btn btn-outline-danger btn-sm delete_record" 
                                                                status="0" 
                                                                id="{{$value->id}}"
                                                                title="Deactivate User">
                                                            <i class="fas fa-user-slash"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" 
                                                                class="btn btn-outline-success btn-sm delete_record" 
                                                                status="1" 
                                                                id="{{$value->id}}"
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
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <p>No users found for verification</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($data->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $data->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="delete_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message box_message">
                    Are you sure to delete this organization ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success save_btn delete_yes" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-danger btn_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Confirm Action
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="box_message">Are you sure to activate/deactivate this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary confirm_action">
                        <i class="fas fa-check me-1"></i>Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('styles')
<style>
    .content-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        padding: 1.5rem;
    }
    
    .simple-card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 0.875rem;
    }
    
    .table th {
        background-color: #f8f9fa;
        border-top: none;
        font-weight: 600;
        color: #495057;
    }
    
    .btn-group .btn {
        margin-right: 0.25rem;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentUserId, currentStatus;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        if (typeof $.fn.DataTable !== 'undefined') {
            $('#userVerificationTable').DataTable({
                responsive: true,
                pageLength: 25,
                language: {
                    search: "Search users:",
                    lengthMenu: "Show _MENU_ users per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ users"
                }
            });
        }
        
        // Handle user status toggle
        $(document).on('click', '.delete_record', function() {
            currentUserId = $(this).attr('id');
            currentStatus = $(this).attr('status');
            
            const action = currentStatus === '1' ? 'activate' : 'deactivate';
            $('.box_message').text(`Are you sure you want to ${action} this user?`);
            
            $('#confirmModal').modal('show');
        });
        
        // Handle confirmation
        $(document).on('click', '.confirm_action', function() {
            if (currentUserId && currentStatus) {
                $.ajax({
                    method: "POST",
                    data: {
                        id: currentUserId,
                        status: currentStatus,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url("users/delete-superadmin") }}',
                    success: function(res) {
                        $('#confirmModal').modal('hide');
                        if (res.status) {
                            window.location.reload();
                        } else {
                            alert(res.message || 'Error occurred');
                        }
                    },
                    error: function() {
                        $('#confirmModal').modal('hide');
                        alert('An error occurred');
                    }
                });
            }
        });
    });
    
    // Print functionality
    function print_all() {
        window.print();
    }
</script>
@endpush

@endsection






