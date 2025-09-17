@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-gavel me-2 text-primary"></i>
                    Manage Auctions
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Manage Auctions
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{url('auctions/add-auctions')}}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Add New Auction
                </a>
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
                            Auctions Management
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="auctionsTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-gavel me-1"></i>Auction Name</th>
                                        <th><i class="fas fa-building me-1"></i>Plaza Name</th>
                                        <th><i class="fas fa-newspaper me-1"></i>Newspaper</th>
                                        <th><i class="fas fa-calendar-plus me-1"></i>Start Date</th>
                                        <th><i class="fas fa-calendar-minus me-1"></i>End Date</th>
                                        <th><i class="fas fa-calendar-check me-1"></i>Date Published</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th width="200"><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $value)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-gavel text-primary me-2"></i>
                                                    <strong>{{ $value->auction_name }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $value->plaza_name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $value->newspaper_name }}</span>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="fas fa-calendar text-success me-1"></i>
                                                    {{ date('M d, Y g:i A', strtotime($value->start_date_time)) }}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="fas fa-calendar text-danger me-1"></i>
                                                    {{ date('M d, Y g:i A', strtotime($value->end_date_time)) }}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="fas fa-calendar-check text-info me-1"></i>
                                                    {{ $value->date_published ? date('M d, Y', strtotime($value->date_published)) : 'Not Published' }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($value->status == "pending")
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-clock me-1"></i>Pending
                                                    </span>
                                                @elseif($value->status == "published")
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Published
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-check-double me-1"></i>Completed
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @if($value->status == "pending" || \Illuminate\Support\Facades\Auth::user()->user_type == "super_admin")
                                                        <a href="{{url('auctions/edit-auctions').'/'.$value->id}}" 
                                                           class="btn btn-outline-primary btn-sm" 
                                                           title="Edit Auction">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" 
                                                                class="btn btn-outline-danger btn-sm delete_record" 
                                                                data-id="{{$value->id}}" 
                                                                title="Delete Auction">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        @if($value->status == "pending")
                                                            <div type="button" 
                                                                    class="btn btn-outline-success btn-sm published_auction" 
                                                                    data-id="{{$value->id}}" 
                                                                    title="Publish Auction">
                                                                <i class="fas fa-bullhorn"></i>
                                                        </div>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">No actions available</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-gavel fa-3x mb-3"></i>
                                                    <p>No auctions found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</section>

    <!-- Customer Information Modal -->
    <div class="modal fade" id="user_information" tabindex="-1" aria-labelledby="userInformationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer_name">Customer Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-2">
                                <strong>Father Name:</strong> 
                                <span id="customer_father" class="text-muted">-</span>
                            </div>
                            <div class="mb-2">
                                <strong>CNIC:</strong> 
                                <span id="customer_cnic" class="text-muted">-</span>
                            </div>
                            <div class="mb-2">
                                <strong>Contact No:</strong> 
                                <span id="customer_phone" class="text-muted">-</span>
                            </div>
                            <div class="mb-2">
                                <strong>Email Address:</strong> 
                                <span id="customer_email" class="text-muted">-</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{asset('images/tenant.png')}}" 
                                 class="img-fluid rounded-circle" 
                                 style="max-width: 80px; height: 80px; object-fit: cover;" 
                                 alt="Customer Avatar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-trash text-danger me-2"></i>Delete Confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div class="box_message">
                            Are you sure you want to delete this auction record?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn_cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-danger delete_yes">
                        <i class="fas fa-check me-1"></i>Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Publish Confirmation Modal -->
    <div class="modal fade" id="publish_modal" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">
                        <i class="fas fa-bullhorn text-success me-2"></i>Publish Confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div class="alert_message box_message">
                            Are you sure you want to publish this auction?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn_pub_cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-success btn_pub_yes">
                        <i class="fas fa-check me-1"></i>Yes, Publish
                    </button>
                </div>
            </div>
        </div>
    </div>

 
<script>
      $("body").on('click', '.published_auction', function(e) {
        alert("hi");
        e.preventDefault();
        currentActionId = $(this).data('id');
        
        // Use Bootstrap 5 modal
        var publishModal = new bootstrap.Modal(document.getElementById('publish_modal'));
        publishModal.show();
    });
     $("body").on('click', '.btn_pub_yes', function() {
        if (!currentActionId) return;

        // Show loading state
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Publishing...');

        $.ajax({
            method: 'POST',
            url: '{{ url("auctions/published-auction") }}',
            data: {
                id: currentActionId,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.status) {
                    // Show success message and reload
                    toastr.success('Auction published successfully!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error(res.message || 'Failed to publish auction');
                    $('.btn_pub_yes').prop('disabled', false).html('<i class="fas fa-check me-1"></i>Yes, Publish');
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while publishing the auction');
                $('.btn_pub_yes').prop('disabled', false).html('<i class="fas fa-check me-1"></i>Yes, Publish');
            }
        });
    });

 
    // Initialize DataTable
    $('#auctionsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'desc']],
        columnDefs: [
            { orderable: false, targets: [-1] } // Disable ordering on action column
        ],
        language: {
            search: "Search auctions:",
            lengthMenu: "Show _MENU_ auctions per page",
            info: "Showing _START_ to _END_ of _TOTAL_ auctions",
            infoEmpty: "No auctions available",
            emptyTable: "No auctions found in the database"
        }
    });

    let currentActionId = null;

    // Delete record handler
    $(document).on('click', '.delete_record', function(e) {
        e.preventDefault();
        currentActionId = $(this).data('id');
        $('.box_message').text('Are you sure you want to delete this auction record?');
        
        // Use Bootstrap 5 modal
        var deleteModal = new bootstrap.Modal(document.getElementById('delete_modal'));
        deleteModal.show();
    });

    // Cancel delete
    $(document).on('click', '.btn_cancel', function() {
        var deleteModal = bootstrap.Modal.getInstance(document.getElementById('delete_modal'));
        if (deleteModal) {
            deleteModal.hide();
        }
        currentActionId = null;
    });

    // Confirm delete
    $(document).on('click', '.delete_yes', function() {
        if (!currentActionId) return;

        // Show loading state
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Deleting...');

        $.ajax({
            method: 'POST',
            url: '{{ url("auctions/delete-auctions") }}',
            data: {
                id: currentActionId,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.status) {
                    // Show success message and reload
                    toastr.success('Auction deleted successfully!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error(res.message || 'Failed to delete auction');
                    $('.delete_yes').prop('disabled', false).html('<i class="fas fa-check me-1"></i>Yes, Delete');
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while deleting the auction');
                $('.delete_yes').prop('disabled', false).html('<i class="fas fa-check me-1"></i>Yes, Delete');
            }
        });
    });

    // Publish auction handler
  

    // Cancel publish
    $(document).on('click', '.btn_pub_cancel', function() {
        var publishModal = bootstrap.Modal.getInstance(document.getElementById('publish_modal'));
        if (publishModal) {
            publishModal.hide();
        }
        currentActionId = null;
    });

    // Confirm publish
   
    // Customer info display (if needed for future functionality)
    $(document).on('click', '.view-customer', function(e) {
        e.preventDefault();
        const customerData = $(this).data();
        
        $('#customer_name').text(customerData.name || 'N/A');
        $('#customer_father').text(customerData.father || 'N/A');
        $('#customer_cnic').text(customerData.cnic || 'N/A');
        $('#customer_phone').text(customerData.phone || 'N/A');
        $('#customer_email').text(customerData.email || 'N/A');
        
        var customerModal = new bootstrap.Modal(document.getElementById('user_information'));
        customerModal.show();
    });
 
</script>
 
@endsection






