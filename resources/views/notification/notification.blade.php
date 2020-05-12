@extends('layout.master')
@section('style')

@endsection
@section('content')
    <!--MESSAGE-->
    <div class="row ">
        <div class="col-md-10 col-md-offset-1" id="master_message_div">
        </div>
    </div>
    <!--END MESSAGE-->

    <!--PAGE CONTENT -->
    <div class="row ">
        <div class="col-sm-12">
            <div class="tabbable">
                <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                    <li class="active">
                        <a id="message_list" data-toggle="tab" href="#message_list_div">
                            <b> Notification List</b>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <!-- PANEL FOR OVERVIEW-->
                    <div id="message_list_div" class="tab-pane in active">
                        <div class="row no-margin-row">
                            <!-- List of Categories -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>

                                    <div class="panel-tools">
                                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                        </a>
                                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-expand" href="#">
                                            <i class="fa fa-resize-full"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-close" href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover message_table" id="notification_table" style="width:100% !important">
                                        <thead>
                                        <tr>
                                            <th>Title </th>
                                            <th>Details </th>
                                            <th>Module Name</th>
                                            <th>App User Name </th>
                                            <th>Seen Status </th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Categoreis -->
                        </div>
                    </div>
                    <!--END PANEL FOR OVERVIEW -->

                </div>
            </div>
        </div>
    </div>
    </div>
    <!--END PAGE CONTENT-->

@endsection


@section('JScript')

    <script>
        var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
        var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
        var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    </script>


    {{-- <script src=" {{ asset('ckeditor/ckeditor.js') }} "></script>
        <script>
            CKEDITOR.replace( 'details' );
        </script> --}}

    <script>
        var url = $('.site_url').val();

        var notification_table = $('#notification_table').DataTable({
            destroy: true,
            "processing": true,
            "serverSide": false,
            "ajax": url+"/notification/all-notification-list",
            "aoColumns": [
                // { mData: 'id'},
                //{ mData: 'message_id' },
                //{ mData: 'admin_id'},
                { mData: 'title'},
                { mData: 'message'},
                { mData: 'module_name'},
                { mData: 'app_user_name'},
                { mData: 'is_seen', className: "text-center"},
                { mData: 'actions' , className: "text-center"},
            ],
        });

    </script>

@endsection


