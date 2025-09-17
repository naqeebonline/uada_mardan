@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-dark fw-bold">
                    <i class="fas fa-building me-2 text-primary"></i>
                    Manage Properties
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Properties</li>
                    </ol>
                </nav>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-calendar me-1"></i>{{date('d M, Y')}}</small>
            </div>
        </div>
    </div>
    <!-- Properties Management -->
    <div class="row">
        <div class="col-12">
            <div class="card simple-card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2 text-success"></i>
                            Properties List
                        </h5>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="badge bg-info">{{count($data)}} Properties</span>
                            <button class="btn btn-sm btn-outline-primary" onclick="print_all()">
                                <i class="fas fa-print me-1"></i>Print
                            </button>
                            <a href="{{url('settings/add-plaza')}}" class="btn btn-success">
                                <i class="fas fa-plus me-1"></i>Add New Property
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th class="fw-semibold">
                                    <i class="fas fa-building me-1"></i>Property Name
                                </th>
                                <th class="fw-semibold">
                                    <i class="fas fa-user me-1"></i>Focal Person
                                </th>
                                <th class="fw-semibold">
                                    <i class="fas fa-phone me-1"></i>Contact
                                </th>
                                <th class="fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1"></i>Address
                                </th>
                                <th class="fw-semibold text-center">
                                    <i class="fas fa-globe me-1"></i>Coordinates
                                </th>
                                <th class="fw-semibold text-center">
                                    <i class="fas fa-map me-1"></i>Map
                                </th>
                                <th class="fw-semibold text-center">
                                    <i class="fas fa-home me-1"></i>Type
                                </th>
                                <th class="fw-semibold text-center">
                                    <i class="fas fa-store me-1"></i>Units
                                </th>
                                <th class="fw-semibold text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $key => $value)
                                <tr>
                                    <td class="fw-medium">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle bg-primary bg-opacity-10 text-primary me-2" style="width: 32px; height: 32px;">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            {{$value->name}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-tie text-muted me-2"></i>
                                            {{$value->focal_person ?? 'N/A'}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-phone text-success me-2"></i>
                                            <a href="tel:{{$value->contact_no}}" class="text-decoration-none">
                                                {{$value->contact_no ?? 'N/A'}}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-location-dot text-danger me-2"></i>
                                            <span class="text-truncate" style="max-width: 200px;" title="{{$value->address}}">
                                                {{$value->address}}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted">
                                            <i class="fas fa-crosshairs me-1"></i>
                                            <strong>Lat:</strong> {{number_format($value->lat, 6)}}<br>
                                            <strong>Lng:</strong> {{number_format($value->lng, 6)}}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" 
                                           href="https://maps.google.com/maps?q={{$value->lat}},{{$value->lng}}&zoom=15" 
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip"
                                           title="View on Google Maps">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            View Map
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{$value->property_type == 'Commercial' ? 'info' : 'success'}}">
                                            {{$value->property_type}}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark">
                                            {{$value->shops_for_auction ?? 0}}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{url('settings/edit-plaza').'/'.$value->id}}" 
                                               class="btn btn-sm btn-outline-primary"
                                               data-bs-toggle="tooltip"
                                               title="Edit Property">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger delete_record" 
                                                    data-id="{{$value->id}}"
                                                    data-name="{{$value->name}}"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete Property">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-building fa-2x mb-2 d-block"></i>
                                            <p class="mb-0">No properties found</p>
                                            <a href="{{url('settings/add-plaza')}}" class="btn btn-primary btn-sm mt-2">
                                                <i class="fas fa-plus me-1"></i>Add First Property
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>
                    
                    <!-- Table Footer with Summary -->
                    <div class="card-footer bg-light border-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Showing {{count($data)}} properties
                                </small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted">
                                    <i class="fas fa-calculator me-1"></i>
                                    Total Units: <span class="fw-semibold">{{$data->sum('shops_for_auction') ?? 0}}</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                        <h6>Are you sure you want to delete this property?</h6>
                        <p class="text-muted mb-0" id="propertyName">This action cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">
                        <i class="fas fa-trash me-1"></i>Delete Property
                    </button>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function(){
            let deleteId = null;
            
            // Initialize DataTable with Bootstrap 5
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 10,
                "order": [[0, "asc"]],
                "language": {
                    "search": "Search properties:",
                    "lengthMenu": "Show _MENU_ properties per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ properties",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>t<"row"<"col-sm-6"i><"col-sm-6"p>>'
            });

            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Delete record handler
            $(document).on("click", ".delete_record", function(e){
                e.preventDefault();
                deleteId = $(this).data("id");
                const propertyName = $(this).data("name");
                
                $("#propertyName").text(`Property: ${propertyName}`);
                $("#deleteModal").modal("show");
            });

            // Confirm delete
            $("#confirmDelete").on("click", function(){
                if(deleteId) {
                    $.ajax({
                        method: "POST",
                        data: {
                            id: deleteId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{url('/settings/delete-plaza')}}",
                        beforeSend: function(){
                            $("#confirmDelete").prop("disabled", true).html('<i class="fas fa-spinner fa-spin me-1"></i>Deleting...');
                        },
                        success: function(res){
                            if(res.status){
                                $("#deleteModal").modal("hide");
                                if(typeof $.notify !== 'undefined') {
                                    $.notify('Property deleted successfully!', 'success');
                                }
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                if(typeof $.notify !== 'undefined') {
                                    $.notify(res.message || 'Error deleting property', 'error');
                                }
                            }
                        },
                        error: function(){
                            if(typeof $.notify !== 'undefined') {
                                $.notify('Network error occurred', 'error');
                            }
                        },
                        complete: function(){
                            $("#confirmDelete").prop("disabled", false).html('<i class="fas fa-trash me-1"></i>Delete Property');
                        }
                    });
                }
            });
        });

        // Print function
        function print_all() {
            window.print();
        }
    </script>

    <!-- Additional CSS for background -->
    <style>
        #example1 {
            background-image: url(https://properties-cdgp.com/newlogo.png);
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            background-attachment: fixed;
        }
        
        .icon-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
    </style>

@endsection


