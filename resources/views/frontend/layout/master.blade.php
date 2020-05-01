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
    <!--<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">-->
    {{-- Auto Load css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
	  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
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

<body class="footer-fixed">
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
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<!--<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>

					</div>
				</div>-->
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container padding-left-0 padding-right-0">
					@yield('content')
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<!--<div class="footer clearfix">
			<div class="footer-inner">
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>-->
		<!-- end: FOOTER -->

<!-- start: RIGHT SIDEBAR -->
		<div id="page-sidebar">
			<a class="sidebar-toggler sb-toggle" href="#"><i class="fa fa-indent"></i></a>
			<div class="sidebar-wrapper">
				<ul class="nav nav-tabs nav-justified" id="sidebar-tab">
					<li class="active">
						<a href="#menus" role="tab" data-toggle="tab"><i class="fa fa-list"></i></a>
					</li>
					<li>
						<a href="#favorites" role="tab" data-toggle="tab"><i class="fa fa-heart"></i></a>
					</li>
					<li>
						<a href="#settings" role="tab" data-toggle="tab"><i class="fa fa-gear"></i></a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="menus">
						<ul class="activities">
							<li>
								<a class="activity" href="javascript:void(0)" onClick="loadPage('message')">
									<i class="clip-bubbles-3 circle-icon circle-green"></i>
									<span class="desc">{{__('app.Messages')}} </span>
								</a>
							</li>
							<li>
								<a class="activity" href="javascript:void(0)" onClick="loadPage('notice')">
									<i class="clip-notification circle-icon "></i>
									<span class="desc">{{__('app.Notices')}}  </span>
								</a>
							</li>
							<li>
								<a class="activity" href="javascript:void(0)" onClick="loadPage('publication')">
									<i class="clip-file circle-icon circle-yellow"></i>
									<span class="desc">{{__('app.Publications')}}</span>
								</a>
							</li>
							<li>
								<a class="activity" href="javascript:void(0)" onClick="loadPage('course')">
									<i class="clip-book circle-icon circle-purple"></i>
									<span class="desc">{{__('app.Courses')}}</span>
								</a>
							</li>
							<li>
								<a class="activity" href="javascript:void(0)" onClick="loadPage('survey')">
									<i class="clip-users-2 circle-icon circle-orange"></i>
									<span class="desc">{{__('app.Surveys')}}</span>
								</a>
							</li>
							<li>
								<a class="activity" href="javascript:void(0)" onClick="loadPage('notification')">
									<i class="clip-notification-2 circle-icon circle-bricky"></i>
									<span class="desc">{{__('app.Notifications')}}</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="tab-pane" id="favorites">
						<div class="users-list">
							<h5 class="sidebar-title">Pan2</h5>
							<ul class="media-list">
								<li class="media">
									<a href="#">
										<img alt="..." src="assets/images/avatar-7.jpg" class="media-object">
										<div class="media-body">
											<h4 class="media-heading">Momit</h4>
											<span> Developer </span>
										</div>
									</a>
								</li>

							</ul>
						</div>
					</div>
					<div class="tab-pane" id="settings">
						<h5 class="sidebar-title">Pan3</h5>
						<ul class="media-list">
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										Enable Notifications
									</label>
								</div>
							</li>

						</ul>
						<div class="sidebar-content">
							<button class="btn btn-success">
								<i class="icon-settings"></i> Save Changes
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end: RIGHT SIDEBAR -->

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

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


    ajaxPreLoad = () =>{
        $('#load-content').block({
            overlayCSS: {
                backgroundColor: '#fff'
            },
            message: '<img src={{ asset('assets/images/loading.gif') }} /> Loading...',
            css: {
                border: 'none',
                color: '#333',
                background: 'none'
            }
        });
    }

	loadpageFunctionality = function loadpageFunctionality(){

		Main.init();
		//loadPage();
		$('.hometab').on('click', function (){
			page = $(this).attr('id');
			loadPage(page)
		})

		if($(".sb-toggle").hasClass("open")) {
			$(this).not(".sidebar-toggler ").find(".fa-indent").removeClass("fa-indent").addClass("fa-outdent");
			$(".sb-toggle").removeClass("open")
			$("#page-sidebar").css({
				right: -$("#page-sidebar").outerWidth()
			});
		}
		//alert('before  height');

	}


// page name: message notice course survey publication notification
    loadPage = function loadPage(pageName) {
		$('.navbar-toggle').trigger('click');
		// load a ajax loader
		$.ajax({
			type: "GET",
			url:"{{ url('app/')}}/"+pageName,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function( xhr ) {
                ajaxPreLoad()
				//$("#load-content").fadeOut('slow');
			},
			success: function (data) {
				$("#load-content").html(data);
				if(pageName=='message'){
					$('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+98));
				}
				else{
					$('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+88));
				}
				$('#load-content').unblock();
				$("#load-content").fadeIn('slow');

				loadpageFunctionality();
			},
			error: function (xhr, textStatus, errorThrown) {
				console.log("XHR",xhr);
				console.log("status",textStatus);
				console.log("Error in",errorThrown);
			}
		});
    }
	$('.hometab').on('click', function (){
		page = $(this).attr('id');
		loadPage(page)
	})

//function to open quick sidebar

		$(".sb-toggle").on("click", function(e) {
			if($(this).hasClass("open")) {
				$(this).not(".sidebar-toggler ").find(".fa-indent").removeClass("fa-indent").addClass("fa-outdent");
				$(".sb-toggle").removeClass("open")
				$("#page-sidebar").css({
					right: -$("#page-sidebar").outerWidth()
				});
			} else {
				$(this).not(".sidebar-toggler ").find(".fa-outdent").removeClass("fa-outdent").addClass("fa-indent");
				$(".sb-toggle").addClass("open")
				$("#page-sidebar").css({
					right: 0
				});
			}
			e.preventDefault();
		});


		$("#page-sidebar .media a").on("click", function(e) {
			//alert($("#page-sidebar").outerWidth())
			$(this).closest(".tab-pane").css({
				right: $("#page-sidebar").outerWidth()
			});
			e.preventDefault();
		});
		$("#page-sidebar .sidebar-back").on("click", function(e) {
			$(this).closest(".tab-pane").css({
				right: 0
			});
			e.preventDefault();
		});
		$('#page-sidebar .sidebar-wrapper').perfectScrollbar({
			wheelSpeed: 50,
			minScrollbarLength: 20,
			suppressScrollX: true
		});
		$('#sidebar-tab a').on('shown.bs.tab', function (e) {
			$("#page-sidebar .sidebar-wrapper").perfectScrollbar('update');
		});

	</script>
    <script>

        //alert('as')
        new_message_reload = () =>{
            setTimeout(function(){
                newMessages();
                set_time_out_fn();
            }, 100000);
        }

        newMessages =  () => {
            $.ajax({
                url: "{{ url('app/')}}/message_notification",
                type:'GET',
                async:false,
                success: function(response){

                    response = JSON.parse(response)
                    //console.log(response)
                    html = '';
                    count = 0;
                    $.each(response, function (key, value) {
                        count++;
                       // alert(value.admin_message)

                        //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                        html +='<li> ' +
                            '       <a href="#">' +
                            '           <div class="clearfix" onclick="viewMessage('+value.id+')">' +
                            '               <div class="thread-image">' +
                            '                   <img alt="" src="/assets/images/avatar-3.jpg"> ' +
                            '               </div> ' +
                            '               <div class="thread-content"> ' +
                            '                   <span class="author">BILS</span> ' +
                            '                   <span class="preview">'+value.admin_message+'</span> ' +
                            '                   <span class="time">'+value.msg_date+'</span>' +
                            '               </div> ' +
                            '           </div>' +
                            '        </a>' +
                            '   </li>'

                    })
                    $('#app_message_badge').html(count)
                    $('#app_message_top_unread').html('{{__('app.You_have')}} <span id="total_unseen_message"> '+count+' </span> {{__('app.messages')}}')
                    $('#app_header_new_message').html(html)
                    //console.log(response)

                }
            })
            new_message_reload()
        }
        newMessages();

        new_notification_reload = () =>{
            setTimeout(function(){
                newNotifications();
                set_time_out_fn();
            }, 100000);
        }

        newNotifications =  () => {
            $.ajax({
                url: "{{ url('app/')}}/new_notifications",
                type:'GET',
                async:false,
                success: function(response){

                    response = JSON.parse(response)
                    //console.log(response)
                    html = '';
                    count = 0;
                    $.each(response, function (key, value) {
                        count++;
                        // alert(value.admin_message)

                        //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                        html +='<li> ' +
                            '<a href="javascript:void(0)"> ' +
                            '<span class="label label-primary"><i class="fa fa-user"></i></span> ' +
                            '<span class="message"> '+value.title+'</span> ' +
                            '<span class="time">'+value.msg_date+'</span> ' +
                            '</a> ' +
                            '</li>'

                    })
                    $('#app_notification_badge').html(count)
                    $('#app_notification_top_unread').html('{{__('app.You_have')}} <span id="total_unseen_message"> '+count+' </span> {{__('app.messages')}}')
                    $('#app_header_new_notification').html(html)
                    //console.log(response)

                }
            })
            new_notification_reload()
        }
        newNotifications();

    </script>


</body>
<!-- end: BODY -->
</html>
