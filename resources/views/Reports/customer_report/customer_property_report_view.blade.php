@extends('admin.template')
@section('content')
    <style>
        .disabled{
            pointer-events: none;
            opacity: .5;
        }
    </style>



    <div class="row">
        <div class="col-md-12">
            <div class="box box-green">
                <div class="box-title">
                    <h3><i class="fa fa-table "></i> Customer Property Report</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <a class="btn btn-primary print_report">Print</a>

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

    </div>
    <link rel="stylesheet" href="{{asset('plaza_admin_assets/css/bootstrap-datetimepicker.css')}}">
    <script src="{{asset('plaza_admin_assets/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function(e){
            $("body").on("click",".print_report",function(){
               window.location = BaseUrl+"/print_customer_report";
            });

        });

    </script>
@endsection


