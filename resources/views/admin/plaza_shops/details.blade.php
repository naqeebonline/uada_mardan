@extends('admin.template')
@section('content')
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1><i class="fa fa-file-o"></i> Details</h1>

            </div>
        </div>
        <!-- END Page Title -->

        <!-- BEGIN Breadcrumb -->

        <!-- END Breadcrumb -->

        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-content">
                        <div class="invoice">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold">Main Category</h6>
                                    <h6>{{strtoupper($data->plaza->property_type) ?? ""}}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold">Property Title</h6>
                                    <h6>{{strtoupper($data->plaza->name) ?? ""}}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold">Property</h6>
                                    <h6>{{strtoupper($data->property_type) ?? ""}}</h6>
                                </div>

                                <div class="col-md-3">
                                    <h6 style="font-weight: bold">Unit#</h6>
                                    <h6>1/2</h6>
                                </div>

                            </div>

                            <hr class="margin-0" />



                            <br/><br/>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="center">CNIC</th>
                                        <th>Customer Name</th>
                                        <th >Phone</th>
                                        <th >Email</th>
                                        <th>Lease Date</th>
                                        <th>Duration</th>
                                        <th>Expirty Date</th>
                                        <th>Current Rent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$owner->customer->cnic ?? ""}}</td>
                                        <td>{{ucfirst($owner->customer->name) ?? ""}}</td>
                                        <td>{{$owner->customer->phoneNumber ?? ""}}</td>
                                        <td>{{$owner->customer->email ?? ""}}</td>
                                        <td>{{$owner->lease_date ?? ""}}</td>
                                        <td>{{$owner->duration ?? ""}} Years</td>
                                        <td>{{date("d-m-Y", strtotime("$owner->duration years", strtotime($owner->lease_date)))}}</td>
                                        <td>{{$owner->shop->current_rent ?? ""}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <hr class="margin-0" />
                            <h3>Tenant Details</h3>
                            <hr class="margin-0" />
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="center">CNIC</th>
                                        <th>Name</th>
                                        <th >Lease Date</th>
                                        <th >Duration</th>
                                        <th>Expiry Date</th>
                                        <th>Remarks</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tenant as $key => $value)
                                    <tr>
                                        <td>{{$value->customer->cnic ?? ""}}</td>
                                        <td>{{ucfirst($value->customer->name) ?? ""}}</td>

                                        <td>{{$value->lease_date ?? ""}}</td>
                                        <td>{{$value->duration ?? ""}} Years</td>
                                        <td>{{date("d-m-Y", strtotime("$value->duration years", strtotime($value->lease_date)))}}</td>
                                        <td>{{$value->alloted_by == "manual" ? "Manually auctioned" : "Auction through e property"}}</td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Main Content -->

        <footer>
            <p>2013 © FLATY Admin Template.</p>
        </footer>

        <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
@endsection


