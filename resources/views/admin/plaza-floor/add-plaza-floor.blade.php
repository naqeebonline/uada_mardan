@extends('admin.template')
@section('content')
<style>
    .disabled{
        pointer-events: none;
        opacity: .5;
    }
</style>

    <!-- BEGIN Main Content -->
    <div class="row">

        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Add Details </h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12 col-lg-12  c ml-auto mr-auto">
                            @if(session()->has('error_message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error_message') }}
                                </div>
                            @endif

                            @if(session()->has('success_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                            @endif
                            <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("settings/save-plaza-floor")}}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="floor_name" placeholder="" value="{{old('floor_name', $data->floor_name ?? "")}}" required >
                                            <input type="hidden" class="form-control" name="plaza_id"   value="{{$plaza_id}}" required >
                                            <input type="hidden" class="form-control" name="id"  value="{{ $data->id ?? 0  }}" required >
                                        </div>
                                    </div>
                                   {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Plaza <small class="text-normal"></small></label>
                                            <select class="form-control" id="plaza_id" name="plaza_id">
                                                <option value="0">Select Plaza...</option>
                                                @foreach($plaza as $key => $value)
                                                    <option value="{{$value->id}}" {{(isset($data) && $data->plaza_id == $value->id) ? "selected" : "" }} >{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>--}}




                                </div>

                                <button class="btn btn-primary">Submit</button>
                                <a href="{{url("/")}}" class="btn btn-default">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->

    <script type="text/javascript">

        $(document).ready(function(e){
            id =0;





        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(50)
                        .height(50);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>
@endsection


