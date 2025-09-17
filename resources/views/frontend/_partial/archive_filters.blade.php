<section class="banner bg-holder bg-overlay-black-30" style="height:369px; background-image: url({{asset('front_end_assets/images/main.jpeg')}}); padding:50px 0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-white text-center mb-2"></h1>
                <p class="lead text-center text-white mb-4 font-weight-normal"></p>
                <div class="property-search-field bg-white">
                    <div class="property-search-item">
                        <div class="form-row basic-select-wrapper">
                            <div class="form-group col-lg col-md-6">
                                <label>Property type</label>
                                <select class="form-control basic-select" id="property_type">
                                    <option value="">All Type</option>
                                    <option value="Plaza" {{ (isset($_GET["type"]) && $_GET['type'] =="Plaza") ? "selected" : "" }}>Plaza</option>
                                    <option value="Plot" {{ (isset($_GET["type"]) && $_GET['type'] =="Plot") ? "selected" : "" }}>Plot</option>

                                </select>
                            </div>
                            <div class="form-group col-lg col-md-6">
                                <label>Office</label>
                                <select class="form-control basic-select" id="office_id">
                                    <option value="">All</option>
                                    @foreach($office as $key => $value)
                                        <option value="{{$value->id}}" {{ (isset($_GET["office_id"]) && $_GET['office_id'] ==$value->id) ? "selected" : "" }}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-flex col-lg-5">
                                <div class="form-group-search">
                                    <label>Organization</label>
                                    <select class="form-control basic-select" id="organization_id">
                                        <option value="">Select Organization</option>
                                    @foreach($organization as $key => $value)
                                            <option value="{{$value->id}}" {{ (isset($_GET["organization"]) && $_GET['organization'] ==$value->id) ? "selected" : "" }}>{{$value->org_name}}</option>
                                    @endforeach
                                    </select>

                                </div>
                                <span class="align-items-center ml-3 d-none d-lg-block"><button class="btn btn-primary d-flex align-items-center search_property" > <span>Search</span></button></span>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){


        $("body").on("change","#office_id",function(e){
            var id = $(this).val();
            if(id == ""){
                $("#organization_id").html("");
                var html = `<option value="">Select Organization</option>`;
                $("#organization_id").append(html);
                return false;
            }
            $.ajax({
                method:"GET",
                url:"{{url('getOrganizationOffice')}}/"+id,
                success:function(res){
                    $("#organization_id").html("");
                    var html = `<option value="">Select Organization</option>`;
                    res.data.forEach(function(value,key){
                       html += `<option value="${value.id}">${value.org_name}</option>`;
                    });
                    $("#organization_id").append(html);

                },
                error: function (request, status, error) {

                }
            });

        });

        $("body").on("click",".search_property",function(e){

            var property_type = $("#property_type").val();
            var office_id = $("#office_id").val();
            var organization_id = $("#organization_id").val();
            if(office_id != "" || property_type !="" || organization_id != ""){
                window.location = "{{url("/")}}/completedAuctions/?type="+property_type+"&office_id="+office_id+"&organization="+organization_id;
            }

        });
    });

</script>