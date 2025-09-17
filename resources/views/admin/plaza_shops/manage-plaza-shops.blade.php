@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-store me-2 text-primary"></i>
                    Manage Shops / Plots
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('settings/manage-plaza')}}" class="text-decoration-none">Properties</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Shops / Plots
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{url('settings/add-floor-shop/').'/'.$plaza_id.'/'.$floor_id}}" 
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Add New Shop
                </a>
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
                            Shops & Plots Management
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="shopsTable" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-store me-1"></i>Shop Name</th>
                                        <th><i class="fas fa-expand-arrows-alt me-1"></i>Covered Area</th>
                                        <th><i class="fas fa-building me-1"></i>Plaza</th>
                                        <th><i class="fas fa-layer-group me-1"></i>Floor</th>
                                        <th><i class="fas fa-money-bill me-1"></i>Start Rent</th>
                                        <th><i class="fas fa-money-check me-1"></i>Current Rent</th>
                                        <th><i class="fas fa-map-marker me-1"></i>Location</th>
                                        <th><i class="fas fa-map me-1"></i>Map</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th width="200"><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $value)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-store text-primary me-2"></i>
                                                    <strong>{{ $value->shop_name }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $value->coveredarea }} <small class="text-muted">sq ft</small></td>
                                            <td>{{ $value->plaza_name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $value->floor_name }}</span>
                                            </td>
                                            <td>
                                                <span class="text-success fw-bold">{{ number_format($value->start_rent) }}</span>
                                            </td>
                                            <td>
                                                <span class="text-primary fw-bold">{{ number_format($value->current_rent) }}</span>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="fas fa-crosshairs text-muted"></i>
                                                    {{ $value->lat }}, {{ $value->lng }}
                                                </small>
                                            </td>
                                            <td>
                                                <a href="https://maps.google.com/maps?q={{$value->lat}},{{$value->lng}}&zoom=11" 
                                                   target="_blank" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge {{ $value->shop_status == 'Available' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $value->shop_status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{url('settings/edit-floor-shop').'/'.$value->id}}" 
                                                       class="btn btn-outline-primary btn-sm" 
                                                       title="Edit Shop">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-outline-danger btn-sm delete_record" 
                                                            data-id="{{$value->id}}" 
                                                            title="Delete Shop">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <a href="{{url('settings/manage-attachments')}}?id={{$value->id}}&type=Shop" 
                                                       class="btn btn-outline-success btn-sm" 
                                                       title="Manage Uploads">
                                                        <i class="fas fa-upload"></i>
                                                    </a>
                                                    @if(count($value->rentout) > 0)
                                                        <a href="{{url('settings/shop_details').'/'.$value->id}}" 
                                                           class="btn btn-outline-info btn-sm" 
                                                           title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-store fa-3x mb-3"></i>
                                                    <p>No shops/plots found</p>
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

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="box_message">Are you sure you want to delete this shop/plot?</p>
                </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-danger confirm_delete">
                        <i class="fas fa-trash me-1"></i>Delete
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
    let deleteId;
    
    $(document).ready(function() {
        // Initialize DataTable
        if (typeof $.fn.DataTable !== 'undefined') {
            $('#shopsTable').DataTable({
                responsive: true,
                pageLength: 25,
                language: {
                    search: "Search shops:",
                    lengthMenu: "Show _MENU_ shops per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ shops"
                }
            });
        }
        
        // Handle delete button click
        $(document).on('click', '.delete_record', function() {
            deleteId = $(this).data('id');
            $('.box_message').text('Are you sure you want to delete this shop/plot?');
            $('#confirmModal').modal('show');
        });
        
        // Handle confirmation
        $(document).on('click', '.confirm_delete', function() {
            if (deleteId) {
                $.ajax({
                    method: "POST",
                    data: {
                        id: deleteId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url("settings/delete-floor-shop") }}',
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
</script>
@endpush

@endsection


