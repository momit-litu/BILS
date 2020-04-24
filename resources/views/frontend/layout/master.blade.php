<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
    <title>{{isset($page_title) ? $page_title : ''}} | BILS </title>
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rating.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme_navy.css') }}" type="text/css" id="skin_color">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" type="text/css" media="print"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome-ie7.min.css') }}">
    <![endif]-->
    <!-- end: MAIN CSS -->
    <link href="{{ asset('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/build/summernote.css') }}">
    <!--SweetalertCSS-->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert2.min.css')}}" type="text/css" />
    <!-- Form elements-->

    <link rel="stylesheet" href="{{asset('assets/plugins/DataTables/media/css/DT_bootstrap.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/plugins/css3-animation/animations.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/build/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.jgrowl.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}"/>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/image-uploader.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-editable.css') }}"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    {{-- Auto Load css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
    <style type="text/css" media="screen">
        .jumbotron p {
            /*margin-bottom: 15px;*/
            font-size: 20px !important;
            /*font-weight: 200;*/
        }
    </style>
    <link rel="shortcut icon" href="favicon.ico" />
    @yield('style')
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body>


<!-- start: HEADER -->
@include('frontend.layout.header')
<!-- end: HEADER -->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <div class="navbar-content">
        <!-- start: SIDEBAR -->
        @include('frontend.layout.sidebar')
		
        <!-- end: SIDEBAR -->
    </div>
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container">
            <!-- start: PAGE HEADER -->
            @include('frontend.layout.breadcrumb')
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            @yield('content')
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<!-- start: FOOTER -->
<div class="footer clearfix">
    <div class="footer-inner">
        &copy; Copyright {{date('Y')}} .All Rights Reserved. Developed by <a href="https://mbrotherssolution.com" target="_blank">Mbrothers Solution.</a>
    </div>
    <div class="footer-items">
        <span class="go-top"><i class="clip-chevron-up"></i></span>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="admin_user_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-body">
            <div id="order-div">
                <div class="title text-center">
                    <h4 class="text-info" id="modal_title"></h4><hr>
                </div>
                <div class="done_registration ">                                
                    <div class="doc_content">
                        <div class="col-md-12">
                            <div class="" style="text-align:left;">
                                <div class="byline">
                                    <span id="modal_body"></span>
                                </div>
                            </div>
                        </div>
                    </div>                                  
                </div>                          
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
     
   
</div>
{{-- End Modal --}}




<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalIMG" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document" style="width:100% !important;">
        <div class="modal-content">
            
                <img id="load_zoom_img" src="" alt="" style="height: 410px;width: 100%;">
            
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>





<!-- end: FOOTER -->
<!-- start: MAIN JAVASCRIPTS -->
<!--[if lt IE 9]>
<script src="{{asset('assets/plugins/respond.min.js') }}"></script>
<script src="{{asset('assets/plugins/excanvas.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jQuery-lib/1.10.2/jquery.min.js') }}"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="{{ asset('assets/plugins/jQuery-lib/2.0.3/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/DataTables/media/js/DT_bootstrap.js')}}"></script>
<script src="{{asset('assets/js/table-data.js')}}"></script>

<script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('assets/plugins/blockUI/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/iCheck/jquery.icheck.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/less/less-1.5.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- end: MAIN JAVASCRIPTS -->

<script src="{{ asset('assets/plugins/bootstrap-modal/js/bootstrap-modal.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"></script>
<script src="{{ asset('assets/js/ui-modals.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/build/summernote.min.js') }}"></script>
<!--sweetlertJs-->
<script src="{{asset('assets/plugins/sweetalert/sweetalert2.min.js')}}"></script>

<script src="{{ asset('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/autosize/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-maskmoney/jquery.maskMoney.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/commits.js') }}"></script>
<script src="{{ asset('assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
{{--<script src="{{ asset('assets/plugins/summernote/build/summernote.min.js') }}"></script>--}}
<script src="{{ asset('assets/js/summernote.js') }}"></script>
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ asset('assets/js/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/jquery.jgrowl.min.js') }}"></script>
<script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-sortable-min.js') }}"></script>
<script src="{{ asset('assets/js/underscore.js')}}"></script>

<!--<script src="{{ asset('js/notify.js')}}"></script>-->

<script src="{{ asset('assets/js/datatables.min.js')}}"></script>
<script src="{{ asset('assets/js/dropzone.js')}}"></script>
<script src="{{ asset('assets/js/image-uploader.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-editable-poshytip.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.poshytip.min.js')}}"></script>
<script src="{{asset('/assets/js/pusher.min.js')}}"></script>
<script src="{{ asset('assets/js/bils/common.js')}}"></script>
{{--<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script--}}


<script>
    jQuery(document).ready(function() {
        Main.init();
        UIModals.init();
        FormElements.init();
        TableData.init();
    });
    var APP_URL = '{!! url('/') !!}';

    </script>

<input type="hidden" class="site_url" value="{{url('/')}}">
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('assets/js/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>

<script src="{{ asset('assets/js/ui-animation.js')}}"></script>
@yield('JScript')
<script>
	jQuery(document).ready(function() {
		Main.init();
		Animation.init();
	});
</script>
</body>
<!-- end: BODY -->
</html>
