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
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bils/messages.css') }}">

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
<audio id="myAudio">
    <source src="{{ asset('assets/tone/eventually.mp3')}}" type="audio/mpeg">
    <source src="{{ asset('assets/tone/eventually.m4r')}}" type="audio/mpeg">
    <source src="{{ asset('assets/eventually.ogg')}}" type="audio/mpeg">
</audio>

<audio id="myNotificationAudio">
    <source src="{{ asset('assets/tone/inflicted.mp3')}}" type="audio/mpeg">
    <source src="{{ asset('assets/tone/inflicted.m4r')}}" type="audio/mpeg">
    <source src="{{ asset('assets/inflicted.ogg')}}" type="audio/mpeg">
</audio>
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

                <div id="responsive" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
                    <div class="modal-header">
                        <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
						&nbsp;&nbsp;<br>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body">
                            <h4 class="modal-title" id="modal_title_content"></h4>
                            <div id="modal_body_content">

                            </div>

                        </div>
                    </div>

                </div>

				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container padding-left-0 padding-right-0" style="margin-bottom: 0px;">
					@yield('content')
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
			</div>
			<div class="footer-items">
				<!--<span class="go-top"><i class="clip-chevron-up"></i></span>-->
				<ul class="nav navbar-right"><li><a class="sb-toggle" href="#"><i class="fa fa-outdent" style="color:#a7b4d1; font-size:18px;"></i></a></li></ul>
			</div>
		</div>
		<!-- end: FOOTER -->
		<div id="responsive" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>

			</div>
			<div class="modal-body">
				<div class="panel-body">
				</div>
			</div>
		</div>
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalIMG" role="dialog" tabindex="-1">

    <div class="modal-content">

        <img id="load_zoom_img" src="" alt="" style="width:100%; max-height:600px">

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>

</div>
<!-- start: RIGHT SIDEBAR -->
		<div id="page-sidebar">
			<!--<a class="sidebar-toggler sb-toggle" href="#"><i class="fa fa-indent"></i></a>-->
			<div class="sidebar-wrapper">
				<ul class="nav nav-tabs nav-justified" id="sidebar-tab">
					<li class="active">
						<a href="#menus" role="tab" data-toggle="tab">Menu</a>
					</li>
					<li>
						<a href="#favorites" role="tab" data-toggle="tab">Course</a>
					</li>
					<li>
						<a href="#settings" role="tab" data-toggle="tab">Survey</a>
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
							<ul class="media-list">
								<h5 class="media-heading padding-10">Interested Course</h5>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>

								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<h5 class="media-heading padding-10">Registered Course</h5>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<h5 class="media-heading padding-10">Completed Course</h5>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
							</ul>
						</div>
						<div class="user-chat">
							<div class="sidebar-content">
								<a class="sidebar-back" href="#"><i class="fa fa-chevron-circle-left"></i> Back</a>
								<div class="panel-body panel-scroll ps-container ps-active-y" style="height: 377px;">
								</div>
							</div>

						</div>
					</div>
						<div class="tab-pane" id="settings">
						<div class="users-list">
							<ul class="media-list">
								<h5 class="media-heading padding-10">Open Survey</h5>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>

								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<h5 class="media-heading padding-10">Completed Survey</h5>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
								<li class="media">
									<a class="activity" href="javascript:void(0)">
										<span class="desc">You added a new event to the calendar.</span>
									</a>
								</li>
							</ul>
							<div class="sidebar-content">
								<button class="btn btn-success">
									<i class="icon-settings"></i> Save Changes
								</button>
							</div>
						</div>
						<div class="user-chat">
							<div class="sidebar-content">
								<a class="sidebar-back" href="#"><i class="fa fa-chevron-circle-left"></i> Back</a>
								<div class="panel-body panel-scroll ps-container ps-active-y" style="height: 377px;">
									<h4> Vertical description </h4>
									<dl>
										<dt>
											Description lists
										</dt>
										<dd>
											A description list is perfect for defining terms.
										</dd>
										<dt>
											Euismod
										</dt>
										<dd>
											Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
										</dd>
										<dd>
											Donec id elit non mi porta gravida at eget metus.
										</dd>
										<dt>
											Malesuada porta
										</dt>
										<dd>
											Etiam porta sem malesuada magna mollis euismod.
										</dd>
									</dl>
									<h4> Horizontal description </h4>
									<dl class="dl-horizontal">
										<dt>
											Description lists
										</dt>
										<dd>
											A description list is perfect for defining terms.
										</dd>
										<dt>
											Euismod
										</dt>
										<dd>
											Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
										</dd>
										<dd>
											Donec id elit non mi porta gravida at eget metus.
										</dd>
										<dt>
											Malesuada porta
										</dt>
										<dd>
											Etiam porta sem malesuada magna mollis euismod.
										</dd>
										<dt>
											Felis euismod semper eget lacinia
										</dt>
										<dd>
											Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
										</dd>
									</dl>
								</div>
							</div>

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
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>

<script src="{{ asset('assets/js/datatables.min.js')}}"></script>
<script src="{{ asset('assets/js/dropzone.js')}}"></script>
<script src="{{ asset('assets/js/image-uploader.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-editable-poshytip.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.poshytip.min.js')}}"></script>
<script src="{{asset('/assets/js/pusher.min.js')}}"></script>
<!--<script src="{{ asset('assets/js/bils/common.js')}}"></script>-->
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

				if($(".sb-toggle").hasClass("open")) {
					$(this).not(".sidebar-toggler ").find(".fa-indent").removeClass("fa-indent").addClass("fa-outdent");
					$(".sb-toggle").removeClass("open")
					$("#page-sidebar").css({
						right: -$("#page-sidebar").outerWidth()
					});
				}


				$("#load-content").html(data);


				if(pageName=='message'){
					//$('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+103));
				}
				else{
					$('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+40));
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


        notificationView = (id) =>{
            $.ajax({
                url: "{{ url('app/')}}/notification_view/"+id,
                type: 'GET',
                async: true,
                success: function (response) {
                    response = JSON.parse(response)
                    newNotifications();
                    loadPage('notification')
                }
            })
        }

        messageView = (id) =>{
            $.ajax({
                url: "{{ url('app/')}}/message_view/"+id,
                type: 'GET',
                async: true,
                success: function (response) {
                    newMessages();
                    loadPage('message')
                }
            })
        }

        new_message_reload = () =>{
            setTimeout(function(){
                //newMessages();
            }, 5000);
        }


        newMessages =  () => {
            $.ajax({
                url: "{{ url('app/')}}/message_notification",
                type:'GET',
                async:true,
                success: function(response){

                    response = JSON.parse(response)
                    html = '';
                    count = 0;
                    lastMessageNotificationId = 0;
                    $.each(response, function (key, value) {
                        lastMessageNotificationId = lastMessageNotificationId<value.id ? value.id :lastMessageNotificationId;
                        count = value.is_seen==0 ? count+1 :count;
                        if(value.is_seen==0){
                            style = 'style = "background:#DBDAD8"'
                        }else style = ''

                        date = new Date(value["msg_date"]+ 'Z');
                        messageDate 	= date.toDateString()+" "+date.getHours()+":"+date.getMinutes();


                        html +='<li onclick="messageView('+value.id+')" '+style+'> ' +
                            '       <a href="#">' +
                            '           <div class="clearfix" onclick="viewMessage('+value.id+')">' +
                            '               <div class="thread-image">' +
                            '                   <img style="width:20px; height:25px" alt="" src="/assets/images/logo.jpg"> ' +
                            '               </div> ' +
                            '               <div class="thread-content"> ' +
                            '                   <span class="preview">'+value.admin_message+'</span> ' +
                            '                   <span class="time">'+messageDate+'</span>' +
                            '               </div> ' +
                            '           </div>' +
                            '        </a>' +
                            '   </li>'

                    })

                    if(localStorage.getItem('lastMessageNotificationId')<lastMessageNotificationId){
                        document.getElementById("myAudio").play();
                        localStorage.setItem('lastMessageNotificationId',lastMessageNotificationId)
                    }else  if(lastMessageNotificationId>0) {
                        //alert('message-1')
                        if(!localStorage.getItem('lastMessageNotificationId')) {
                             document.getElementById("myAudio").play();
                        }

                        localStorage.setItem('lastMessageNotificationId',lastMessageNotificationId)
                    }
                    $('#app_message_badge').html(count)
                    $('.message_badge').html(count)
                    $('#app_message_top_unread').html('{{__('app.You_have')}} <span id="total_unseen_message"> '+count+' </span> {{__('app.messages')}}')
                    $('#app_header_new_message').html(html)
                }
            })
            new_message_reload()
        }

        //alert($('#myAudio').length)
        //document.getElementById("myAudio").play();
        newMessages();

        new_notification_reload = () =>{
            setTimeout(function(){
                newNotifications();
              //  new_notification_reload();
            }, 10000);
        }

        newNotifications =  () => {
            $.ajax({
                url: "{{ url('app/')}}/new_notifications",
                type:'GET',
                async:true,
                success: function(response){
                    response = JSON.parse(response)
                    html = '';
                    count = 0;
                    notificationId = 0;
                    $.each(response, function (key, value) {
                        date = new Date(value["msg_date"]+ 'Z');
                        notificationDate 	= date.toDateString()+" "+date.getHours()+":"+date.getMinutes();

                        notificationId = notificationId<value.id ? value.id : notificationId;
                        count = value.status==0 ? count+1 :count;
                        if(value.status==0){
                            style = 'style = "background:#DBDAD8"'
                        }else style = ''
                        if(value.module_id==7) title = 'A New Course published '
                        else if(value.module_id==37) title = 'A New Notice published '
                        else if(value.module_id==38) title = 'A New Publication published '
                        else title = value.title

                        html +='<li onclick="notificationView('+value.id+')" '+style+'> ' +
                            '<a href="javascript:void(0)"> ' +
                          //  '<span class="label label-primary"><i class="fa fa-user"></i></span> ' +
                            '<span class="message"> '+title+'</span> ' +
                            '<span class="time">'+notificationDate+'</span> ' +
                            '</a> ' +
                            '</li>'
                    })
                    if(localStorage.getItem('lastNotificationId')<notificationId){
                        $('#lastMessageNotificationId').trigger("play")
						//document.getElementById("myAudio").play();

                        localStorage.setItem('lastNotificationId',notificationId)
                    }else  if(notificationId>0) {
                        if(!localStorage.getItem('lastNotificationId')){
                            $('#lastMessageNotificationId').trigger("play")
							//document.getElementById("myAudio").play();
                        }
                        localStorage.setItem('lastNotificationId',notificationId)
                    }

                    $('#app_notification_badge').html(count)
                    $('.notification_badge').html(count)
                    $('#app_notification_top_unread').html('{{__('app.You_have')}} <span id="total_unseen_message"> '+count+' </span> {{__('app.messages')}}')
                    $('#app_header_new_notification').html(html)
                    //console.log(response)

                }
            })
            new_notification_reload()
        }
        newNotifications();

        badgeCountLoad = () =>{
            $.ajax({
                url: "{{ url('app/')}}/badge_count",
                type: 'GET',
                async: true,
                success: function (response) {
                    //console.log(response)
                    response = JSON.parse(response)
                    $.each(response,function (key, data) {
                        //console.log(data)
                        if(data['module_id']==7){
                            $('.course_badge').html(data['number'])
                        }
                        if(data['module_id']==38){
                            $('.publication_badge').html(data['number'])
                        }
                        if(data['module_id']==37){
                            $('.notice_badge').html(data['number'])
                        }
                        if(data['module_id']==6){
                            $('.survey_badge').html(data['number'])
                        }
                    })
                }
            })
        }
        badgeCountLoad()


        $('.panel-tools .panel-refresh').on('click', function(e) {
            var el = $(this).parents(".panel");
            el.block({
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
            window.setTimeout(function() {
                page =1;
                location.reload()
                el.unblock();
            }, 1000);
            e.preventDefault();
        });

        //alert($('#message_badge').html())

    </script>






</body>


<!-- end: BODY -->
</html>
