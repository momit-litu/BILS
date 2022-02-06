<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
@php
    $token = "";
    if(isset($_GET['token'])) $token = $_GET['token'];
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

<script>
//alert('need to add a loader before load')

</script>

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
   <!-- <link rel="stylesheet" href="{{ asset('assets/css/rating.css') }}">-->
    <link rel="stylesheet" href="{{ asset('assets/css/main-responsive.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/skins/all.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme_navy.css') }}" type="text/css" id="skin_color">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" type="text/css" media="print"/>-->
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
    <!--<link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}">-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">
     <!--<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/build/summernote.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.jgrowl.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}" />
     <!--<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}"/>-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/image-uploader.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-editable.css') }}"/>
    <!--<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">-->
   <!--  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">-->

    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bils/app_messages.css') }}">


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
    <!--
<audio id="myAudio1">
    <source src="{{ asset('assets/tone/eventually.mp3')}}" type="audio/mpeg">
    <source src="{{ asset('assets/tone/eventually.m4r')}}" type="audio/mpeg">
    <source src="{{ asset('assets/eventually.ogg')}}" type="audio/mpeg">
</audio>
<audio id="myAudio" style="float:right;margin-top:100px; width: 190px; display:none" width="190" controls>
    <source src="{{ asset('assets/tone/eventually.mp3')}}" type="audio/mpeg">
    <source src="{{ asset('assets/tone/inflicted.ogg')}}" type="audio/mpeg">
</audio>

<audio id="myNotificationAudio">
    <source src="{{ asset('assets/tone/inflicted.mp3')}}" type="audio/mpeg">
    <source src="{{ asset('assets/tone/inflicted.m4r')}}" type="audio/mpeg">
    <source src="{{ asset('assets/inflicted.ogg')}}" type="audio/mpeg">
</audio>-->
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
	<button onClick="playAudio()" style="display:none">PLAY AUDIO</button>
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
<div class="footer clearfix" id="footer">
    <div class="chat-form" style="display: none; margin-bottom:0px">
        <form id="sent_message_to_user" name="sent_message_to_user" enctype="multipart/form-data" class="form form-horizontal form-label-left">
            @csrf
            <p id="reply_msg"  style="margin-right:0 !important; padding:2px 4px;color:#fff"></p>
            <input type="hidden" id="edit_msg_id" name="edit_msg_id">
            <div class="input-group">
							<span class="input-group-btn dropup ">
                                <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle" style="border-top-width: 5px;border-bottom-width: 1px;">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="category_ul" style="font-size:12px;">
                                    <li onclick="categorySelect(0,'None')" id="0">
                                        <a href="#">
                                            {{__('app.None')}}
                                        </a>
                                    </li>
                                    <li class="divider"></li>

                                </ul>
                                <input type="hidden" name="message_category" id="message_category">
							</span>
                <input type="hidden" name="app_user_id" id="app_user_id">
                <input type="hidden" name="group_id" id="group_id" value="0">
                <input type="hidden" id="reply_msg_id" name="reply_msg_id">
                <input type="text" class="form-control " name="admin_message" id="admin_message" autocomplete="off" placeholder="Write your message..." />
                <span class="input-group-btn">
							<label for="attachment" class="custom-file-upload btn btn-file btn-blue btn-custom-side-padding ">
								<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
							</label>
							<input multiple id="attachment" name="attachment[]" type="file"/>
							</span>
                <span class="input-group-btn">
								<button class="btn btn-success submit" type="submit" id="message_sent_to_user">
									<i class="fa fa-paper-plane"></i>
								</button>
							</span>
            </div>
        </form>
    </div>
    <div class="footer-items">
        <!--<span class="go-top"><i class="clip-chevron-up"></i></span>-->
        <ul class="nav navbar-left pull-left"><li><a class="sb-toggle" href="#"><i class="fa fa-outdent" style="color:#a7b4d1; font-size:18px;"></i></a></li></ul>
    </div>
</div>
<!-- end: FOOTER -->

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
                <a href="#menus" role="tab" data-toggle="tab">{{__('app.Menu')}} </a>
            </li>
            <li>
                <a href="#favorites" role="tab" data-toggle="tab">{{__('app.Course')}} </a>
            </li>
            <li>
                <a href="#settings" role="tab" data-toggle="tab">{{__('app.Survey')}} </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="menus">
                <ul class="activities">
                    <li>
                        <a class="activity" href="javascript:void(0)" onClick="changePage('message')">
                            <i class="clip-bubbles-3 circle-icon circle-teal"></i>
                            <span class="desc">{{__('app.Messages')}} </span>
                        </a>
                    </li>
                    <li>
                        <a class="activity" href="javascript:void(0)" onClick="changePage('notice')">
                            <i class="clip-notification circle-icon "></i>
                            <span class="desc">{{__('app.Notices')}}  </span>
                        </a>
                    </li>
                    <li>
                        <a class="activity" href="javascript:void(0)" onClick="changePage('publication')">
                            <i class="clip-file circle-icon circle-yellow"></i>
                            <span class="desc">{{__('app.Publications')}}</span>
                        </a>
                    </li>
                    <li>
                        <a class="activity" href="javascript:void(0)" onClick="changePage('course')">
                            <i class="clip-book circle-icon circle-purple"></i>
                            <span class="desc">{{__('app.Courses')}}</span>
                        </a>
                    </li>
                    <li>
                        <a class="activity" href="javascript:void(0)" onClick="changePage('survey')">
                            <i class="clip-users-2 circle-icon circle-orange"></i>
                            <span class="desc">{{__('app.Surveys')}}</span>
                        </a>
                    </li>
                    <li>
                        <a class="activity" href="javascript:void(0)" onClick="changePage('notification')">
                            <i class="clip-notification-2 circle-icon circle-bricky"></i>
                            <span class="desc">{{__('app.Notifications')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="favorites">
                <div class="users-list">
                    <ul class="media-list" id="user_course_list">
                        
                    </ul>
                </div>
                <div class="user-chat">
                    <div class="sidebar-content">
                        <a class="sidebar-back" href="#"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        <div class="panel-body panel-scroll ps-container ps-active-y" id="course_description_side" style="height: 377px;">
                           

                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane" id="settings">
                <div class="users-list">
                    <ul class="media-list" id="user_survey_list">
                        
                    </ul>
                </div>
                <div class="user-chat">
                    <div class="sidebar-content">
                        <a class="sidebar-back" href="#"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        <div class="panel-body panel-scroll ps-container ps-active-y" id="survey_description_side" style="height: 377px;">
                           
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
<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/DataTables/media/js/DT_bootstrap.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{asset('assets/js/table-data.js')}}"></script>
<script src="{{ asset('assets/plugins/iCheck/jquery.icheck.min.js') }}"></script>-->
<script src="{{ asset('assets/plugins/blockUI/jquery.blockUI.js') }}"></script>
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
<!-- <script src="{{ asset('assets/plugins/summernote/build/summernote.min.js') }}"></script>-->
<!--sweetlertJs-->
<script src="{{asset('assets/plugins/sweetalert/sweetalert2.min.js')}}"></script>

<script src="{{ asset('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/autosize/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-maskmoney/jquery.maskMoney.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script> -->
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/commits.js') }}"></script>
<script src="{{ asset('assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
{{--<script src="{{ asset('assets/plugins/summernote/build/summernote.min.js') }}"></script>--}}
<!-- <script src="{{ asset('assets/js/summernote.js') }}"></script> -->
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ asset('assets/js/form-elements.js') }}"></script>
<script src="{{ asset('assets/js/jquery.jgrowl.min.js') }}"></script>
<script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-sortable-min.js') }}"></script>
<script src="{{ asset('assets/js/underscore.js')}}"></script>

<!--<script src="{{ asset('js/notify.js')}}"></script>-->
<!--<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>-->

<!-- <script src="{{ asset('assets/js/datatables.min.js')}}"></script>
<script src="{{ asset('assets/js/dropzone.js')}}"></script> -->
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
        //TableData.init();
    });
    var APP_URL = '{!! url('/') !!}';

</script>

<input type="hidden" class="site_url" value="{{url('/')}}">
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('assets/js/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>

<script src="{{ asset('assets/js/ui-animation.js')}}"></script>
<script src="{{ asset('assets/js/jquery.mb.audio.js')}}"></script>

@yield('JScript')
<script>
    jQuery(document).ready(function() {
        //Main.init();
        Animation.init();
    });


    
    var deviceIsAndroid = /(android)/i.test(navigator.userAgent);
    var deviceIsIos     = !!navigator.platform.match(/iPhone|iPod|iPad/);


		//{{ asset('assets/tone/effectsSprite.ogg') }}

    function playAudio(){
    	//	window.addEventListener('load', () => {
			// noinspection JSUnresolvedVariable
			let audioCtx = new (window.AudioContext || window.webkitAudioContext)();
			let xhr = new XMLHttpRequest();
			let url = (deviceIsIos)?'{{ asset('assets/tone/effectsSprite_small.ogg') }}':'{{ asset('assets/tone/effectsSprite_small.mp3') }}';
		//	alert(url)
			xhr.open('GET', url);
			xhr.responseType = 'arraybuffer';
			xhr.addEventListener('load', () => {
				let playsound = (audioBuffer) => {
					let source = audioCtx.createBufferSource();
					source.buffer = audioBuffer;
					source.connect(audioCtx.destination);
					source.loop = false;
					source.start();
				};

				audioCtx.decodeAudioData(xhr.response).then(playsound);
			});
			xhr.send();
	    //	});
    }
    

    $('.showLoading').click(function(){
        //alert('ok')
        $('.box-login').block({
            overlayCSS: {
                backgroundColor: '#fff'
            },
            message: '<img src={{ asset('assets/images/loading.gif') }} /><b>Loading ....</b>',
            css: {
                border: '1px solid black',
                color: '#333',
                background: 'none'
            }
        });
    })

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    localStorage.removeItem('messageMaster')
    //alert("{{$token}}")




   ajaxPreLoad = (show_loading = 0) =>{
	    let message = (show_loading==0)?'<img src={{ asset('assets/images/loading.gif') }} /> Loading...':"";
        $('#load-content').block({
            overlayCSS: {
                backgroundColor: '#fff'
            },
            message:message ,
            css: {
                border: 'none',
                color: '#333',
                background: 'none'
            }
        });
    }

    //alert('.ok')
    changePage = (name) =>{
         ajaxPreLoad('show')
        localStorage.setItem('content',name)
        window.location.href = "{{ url('app/dashboard/content_load')}}"
    }


    answerText = ''
    answerList=[]
    pageNo=0;
    LastpageNo=0;

    surveyId = 0

    surveyTitle = (survey_id) =>{
        $.ajax({
            url: "{{ url('app/')}}/load-survey_title/"+survey_id,
            type:'get',
            async:true,
            contentType: false,
            processData: false,
            beforeSend: function( xhr ) {
                ajaxPreLoad()
                //$("#load-content").fadeOut('slow');
            },
            success: function(response) {
                $('#load-content').unblock();
                var response = JSON.parse(response);
                $('#survey_title').html(response[0]['survey_name'])
                //console.log(response[0]['survey_name'])

            }
        });

    }

    multipleChoice = (data,answer) => {
        //alert('multi')
        answerList = []
        if(answer[0] && answer[0]['options'][0] && answer[0]['options'][0]['option_id']){
            $.each(answer[0]['options'],function (key, value) {
                answerList.push(value['option_id'])
            } )
        }
        //console.log(data)
        html = '<input type="hidden" name="type" id="type" value="4">'
        $.each(data, function (key,option) {
            checked = ''
            if(answerList.includes(option["id"])){
                checked = 'checked';
            }
            html += '<input class="form-check-input" type="checkbox" name="answer[]" '+checked+'  value="'+option["id"]+'" >\n' +
                '     <label class="form-check-label" for="exampleRadios1">'+option["answer_option"]+'</label><br>'
        })
        return html
    }

    singleChoice = (data,answer) => {
        //alert('single')
        //console.log(data)
        //console.log(data[0]['answer_option'])
        if(answer[0] && answer[0]['options'][0] && answer[0]['options'][0]['option_id']){
            option_id = answer[0]['options'][0]['option_id']
        }else{
            option_id = 0
        }
        answerText = option_id

        html = '<input type="hidden" name="type" id="type" value="3">'
        $.each(data, function (key, option) {
            checked = ''
            if(option["id"]==option_id){
                checked = 'checked';
            }
            html += '<input class="form-check-input" type="radio"  name="answer" '+checked+' value="'+option["id"]+'" >\n' +
                '     <label class="form-check-label" for="exampleRadios1">'+option["answer_option"]+'</label><br>'
        })
        return html
    }

    numberInput = (answer) =>{
        if(answer[0] && answer[0]['options'][0]['answer']){
            answer = answer[0]['options'][0]['answer']
        }else{
            answer =''
        }
        answerText = answer

        html = '<input type="hidden" name="type" id="type" value="2">'
        html+='<input type="number" placeholder="" class="form-control" name="answer" id="answer" value="'+answer+'">\n'

        return html;
    }

    textInput = (answer) =>{
        if(answer[0] && answer[0]['options'][0]['answer']){
            answer = answer[0]['options'][0]['answer']
        }else{
            answer =''
        }
        answerText = answer

        html = '<input type="hidden" name="type" id="type" value="1">'
        html+= '<input type="text" placeholder="" class="form-control" name="answer" id="answer" value="'+answer+'">\n'

        return html;
    }

    loadSurveyQuestion = (page) =>{
        //alert('loadSurveyQuestion')
        if(surveyId==0) return false;

        if(page==0) url="{{ url('app/')}}/load-survey_question/"+surveyId;
        else url="{{ url('app/')}}/load-survey_question/"+surveyId+"?page="+page;
        //alert(url)

        $.ajax({
            url: url,
            type:'get',
            async:true,
            contentType: false,
            processData: false,
            beforeSend: function( xhr ) {
                ajaxPreLoad()
                //$("#load-content").fadeOut('slow');
            },
            success: function(response) {
                $('#load-content').unblock();

                var response = JSON.parse(response);
                console.log(response)

                question = '<label class="control-label" id="question">'+response["data"][0]["question_details"]+'</label>'
                question += '<input type="hidden" name="question_no" value="'+response["data"][0]["id"]+'">'

                if(response['data'][0]['question_type'] == 1){
                    html = textInput(response["data"]['answer'])
                }else if(response['data'][0]['question_type'] == 2){
                    html = numberInput(response["data"]['answer'])
                }else if(response['data'][0]['question_type'] == 3){
                    html = singleChoice(response["data"][0]["options"],response["data"]['answer'])
                } else if(response['data'][0]['question_type'] == 4){
                    html = multipleChoice(response["data"][0]["options"],response["data"]['answer'])
                }
                $('#question_body').html(question+'<br>'+html)

                //console.log(response)
                LastpageNo = response['last_page'];

                pageNo = response['current_page'];

                nxtbtn = "";
                prvbtn = "";
                nxtDisplay = 'style="display:block"'
                submitDisplay = 'style="display:none"'

                if(response['current_page']==1){
                    prvbtn = "disabled";
                }else if(response['total']==response['current_page']){
                    nxtbtn = "disabled";
                    nxtDisplay = 'style="display:none"'
                    submitDisplay = 'style="display:block"'

                }

                surveyHtml = ' <div class="alert alert-block alert-info fade in">\n' +
                    '                        <h3 id="survey_title">'+response['data']["title"]+'</h3>\n' +
                    '                        <hr>\n' +
                    '                        <form action="#" role="form" id="question_answer" name="question_answer">\n' +
                    '                            <div class="row">\n' +
                    '                                <div class="col-md-6">\n' +
                    '                                    <div class="form-group" id="question_body">\n' +question+'<br>'+html+
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                            <div class="row">\n' +
                    '                                <div class="col-sm-6 col-xs-6">\n' +
                    '                                    <button class="btn btn-teal btn-block" type="button" onclick="submitAnswer(-1)" '+prvbtn+'id="prvbutton" >\n' +
                    '                                        <i class="fa fa-arrow-circle-left"></i>  {{__("app.previous")}}\n' +
                    '                                    </button>\n' +
                    '                                </div>\n' +
                    '                                <div class="col-sm-6 col-xs-6" '+nxtDisplay+'>\n' +
                    '                                    <button class="btn btn-teal btn-block" type="button" onclick="submitAnswer(1)" '+nxtbtn+' id="nxtbutton">\n' +
                    '                                        {{__("app.next")}} <i class="fa fa-arrow-circle-right"></i>\n' +
                    '                                    </button>\n' +
                    '                                </div>\n' +
                    '                                <div class="col-sm-6 col-xs-6" '+submitDisplay+'>\n' +
                    '                                    <button class="btn btn-teal btn-block" type="button" onclick="submitAnswer(0)" id="nxtbutton">\n' +
                    '                                        {{__("app.submit")}} <i class="fa fa-arrow-circle-right"></i>\n' +
                    '                                    </button>\n' +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                        </form>\n' +
                    '                    </div>\n'

                $('#modal_body_content').html(surveyHtml)
                // $('#responsive').modal()
            }
        });

    }

    loadNextQuestion = (pageChange,page)=>{
        if(pageChange!=0){
            loadSurveyQuestion(page)
        }
        else{
            $('#responsive').modal('toggle');
        }

    }

    submitAnswer = (pageChange) =>{
        page = pageNo+pageChange;

        type = $('#type').val()
        if(type==1 || type==2){
            answer = $('#answer').val()
            if(answer==answerText){
                loadNextQuestion(pageChange,page)
                return false;
                //alert('matched')
            }
        }else if(type==3){
            answer = $('input[name="answer"]:checked').val();
            if(answer==answerText){
                loadNextQuestion(pageChange,page)
                return false;
                //alert('matched')
            }
        }else if(type==4){
            var val = [];
            $(':checkbox:checked').each(function(i){
                val.push(parseInt($(this).val()));
            });
            is_match=0
            //console.log(val, answerList)
            if(val.length==answerList.length){
                //alert('length')
                $.each(val, function (key,value) {
                    if(!answerList.includes(value)){
                        is_match=1;
                    }
                })
                $.each(answerList, function (key,value) {
                    if(!val.includes(value)){
                        is_match=1;
                    }
                })
                if(is_match==0){
                    loadNextQuestion(pageChange,page)
                    return false;
                }
            }
        }


        var formData = new FormData($('#question_answer')[0]);
        //alert(1)
        //return false;
        //alert(pageNo +'=='+ LastpageNo)
        if(pageNo == LastpageNo){
            formData.append('is_completed',1)
        }
        formData.append('survey_id',surveyId)

        $.ajax({
            url: "{{ url('app/')}}/survey_answer",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //console.log(data)
                if(data==1){
                    loadNextQuestion(pageChange,page)
                }
            }
        });
    }

    surveyResult = (survey_id) =>{
        surveyTitle(survey_id)

        // seeSurveyDetails(survey_id,0)
        //return false;
        // alert(survey_id)
        $.ajax({
            url: "{{ url('app/')}}/survey-result/"+survey_id ,

            success: function (response) {
                var data = JSON.parse(response);
                //alert(1)
                console.log(data)
                // return false;

                var description = ' <h2>'+data['survey']['survey_name']+'</h2></br>'

                $.each(data['question'], function (key, value) {
                    //alert(2)
                    //console.log(value)

                    description+='<div class="col-md-12" style="margin-bottom: 10px">\n'


                    description+=' <h6>'+value['serial']+'. '+value['question_details']+'</h6>\n'


                    if(value['question_type']==1 || value['question_type']==2){
                        description+= '<p>:'+data['answer'][value['id']]['answer']+'</p>'
                    }
                    else {
                        var sl = 'A'
                        if(value['display_option']==1){
                            $.each(value['answer'],function (key2, answer) {
                                //var answerChoose=''
                                var styleChoose = 'style="margin: 10px"'

                                if(data['answer']['answer_choice'].includes(answer['id'])){
                                    //alert('ok')
                                    styleChoose='style="margin: 10px; color:green"';
                                }

                                description+='<span '+styleChoose+'>('+sl+'): '+answer['answer_option']+'</span>\n';
                                sl = String.fromCharCode(sl.charCodeAt() + 1) // Returns B
                            })
                        }
                        else if(value['display_option']==2){
                            $.each(value['answer'],function (key2, answer) {

                                var styleChoose = 'style="margin: 10px"'

                                if(data['answer']['answer_choice'].includes(answer['id'])){
                                    //alert('ok')
                                    styleChoose='style="margin: 10px; color:green"';
                                }
                                description+='<p '+styleChoose+'>('+sl+'): '+answer['answer_option']+'</p>\n';
                                sl = String.fromCharCode(sl.charCodeAt() + 1) // Returns B
                            })
                        }
                        else if(value['display_option']==3){

                            $.each(value['answer'],function (key2, answer) {
                                //alert(data['answer']['answer_choice'])
                                var styleChoose = 'style="margin: 10px"'

                                if(data['answer']['answer_choice'].includes(toString(answer['id']))){
                                    //alert('ok')
                                    styleChoose='style="margin: 10px; color:green"';
                                }


                                description+='<div class="col-md-5" '+styleChoose+'>('+sl+'): '+answer['answer_option']+'</div>\n';
                                sl = String.fromCharCode(sl.charCodeAt() + 1) // Returns B
                            })
                        }
                    }
                    //alert('ok')

                    description+='</div>'
                })

                console.log(description)
                $('#modal_body_content').html(description)
                $('#responsive').modal()
                //$("#survey_participant_body_view").html(description);

            }
        })

    }

    seeSurveyDetails = (id,type) =>{
        surveyId = id
        //surveyTitle(surveyId)

        $('#responsive').modal()
        if(type==0) loadSurveyQuestion(0)

        //e.preventDefault();
        /*
        $.ajax({
            type: "GET",
            url: "{{ url('app/')}}/user_survey_description/"+id,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                response = JSON.parse(data)
                console.log(respons)

                created = new Date(response[0]["created_at"]+ 'Z');
                created = created.toDateString()
                start = new Date(response[0]["start_date"]+ 'Z');
                start = start.toDateString()
                end = new Date(response[0]["end_date"]+ 'Z');
                end = end.toDateString()


                let category_name = (response[0]["category_name"])?"<button class='btn btn-disabled btn-info btn-xs'>"+response[0]["category_name"]+"</button>":"";

                let  p = '<span><p style="text-align:left"><b style="float:right">Duration: '+start+' to '+end+'</b> </p></span><br>'


                html = '<div class="alert alert-block alert-info fade in"><h4>'+response[0]["title"]+'</h4>' + category_name + p +response[0]['details']+'</div>'

                console.log(html)
                $('#course_description_side').html(html)
            }
        })
        */

    }

    loadpageFunctionality = function loadpageFunctionality(){

        Main.init();
        //loadPage();
        $('.hometab').on('click', function (){
            page = $(this).attr('id');
            loadPage(page)
        })

    }
    courseRegistration = (id) =>{
        $.ajax({
            type: "GET",
            url: "{{ url('app/')}}/user_course_registration/"+id,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
            }
        })
    }

    seeCourseDetails = (id) =>{

        //e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{ url('app/')}}/user_course_description/"+id,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                response = JSON.parse(data)

                created = new Date(response[0]["created_at"]+ 'Z');
                created = created.toDateString()
                start = new Date(response[0]["appx_start_time"]+ 'Z');
                start = start.toDateString()
                end = new Date(response[0]["appx_end_time"]+ 'Z');
                end = end.toDateString()
                register = '';

                //alert(response[0]['course_status']+'--'+response[0]['is_interested'])

                if((response[0]['course_status']==2 || response[0]['course_status']==4) && response[0]['is_interested']==1){
                    register = "<button class='btn btn-disabled btn-blue btn-xs' onclick='courseRegistration("+response[0]['cp_id']+")'>Register Now</button>"
                }
                c_status = "<button class='btn btn-disabled btn-orange btn-xs' disabled style='float: right'>"+response[0]['status']+"</button>"


                let category_name = (response[0]["category_name"])?"<button class='btn btn-disabled btn-info btn-xs'>"+response[0]["category_name"]+"</button>":"";

                let  p = '<span><p style="text-align:left"> Teacher: '+response[0]['name']+'<b style="float:right">Duration: '+start+' to '+end+'</b> </p></span><br>'

                let attachment = '';
                //alert(register)

                if(response[0]['attachment']){
                    //attachment = attachment_url+'/'+response[0]['attachment'];
                    attachment = "<br>"+publication+ '<br><a class="btn btn-disabled btn-warning" href="'+attachment_url+'/'+response[0]["attachment"]+'" download><i class="clip-attachment"></i></a>'
                }
                html = '<div class="alert alert-block alert-info fade in">'+c_status+'<h4>'+response[0]["title"]+'</h4>' + category_name + '  '+register + p +'<hr>'+response[0]['details']+'</div>'

                $('#course_description_side').html(html)
            }
        })
    }

    loadCourseSideBar = () => {
        $.ajax({
            type: "GET",
            url: "{{ url('app/')}}/user_course" ,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                respons = JSON.parse(data)
                is_interested = 0
                is_registered = 0
                is_completed = 0
                interested = '<h5 class="media-heading padding-10">Interested Course</h5>'
                registered = '<h5 class="media-heading padding-10">Registered Course</h5>'
                completed = '<h5 class="media-heading padding-10">Completed Course</h5>'


                $.each(respons, function (key, course) {
                    if(course.is_interested==1){
                        is_interested = 1
                        interested += '<li onclick="seeCourseDetails('+course.id+')" class="media">\n' +
                            '              <a class="activity" href="javascript:void(0)">\n' +
                            '                <span class="desc">'+course.title+'</span>\n' +
                            '              </a>\n' +
                            '           </li>'
                    }
                    if(course.is_interested==2){
                        is_registered =1
                        registered += '<li onclick="seeCourseDetails('+course.id+')" class="media">\n' +
                            '              <a class="activity" href="javascript:void(0)">\n' +
                            '                <span class="desc">'+course.title+'</span>\n' +
                            '              </a>\n' +
                            '           </li>'
                    }
                    if(course.is_interested==4){
                        is_completed = 1
                        completed += '<li onclick="seeCourseDetails('+course.id+')" class="media">\n' +
                            '              <a class="activity" href="javascript:void(0)">\n' +
                            '                <span class="desc">'+course.title+'</span>\n' +
                            '              </a>\n' +
                            '           </li>'
                    }
                })

                html = ''
                html += is_interested==1? interested: '';
                html += is_registered==1? registered: '';
                html += is_completed==1? completed: '';

                $('#user_course_list').html(html)

                $("#page-sidebar .media a").on("click", function(e) {
                    $(this).closest(".tab-pane").css({
                        right: $("#page-sidebar").outerWidth()
                    });
                    e.preventDefault();
                });


            }
        })
    }

    loadCourseSideBar()

    loadSurveySideBar = () => {
        $.ajax({
            type: "GET",
            url: "{{ url('app/')}}/user_survey" ,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                respons = JSON.parse(data)
                is_interested = 0
                is_completed = 0
                interested = '<h5 class="media-heading padding-10">Incomplete Survey</h5>'
                completed = '<h5 class="media-heading padding-10">Completed Survey</h5>'

                $.each(respons, function (key, course) {
                    if(course.survey_completed==0){
                        is_interested = 1
                        interested += '<li onclick="seeSurveyDetails('+course.id+',0)" class="media">\n' +
                            '              <a class="activity" href="javascript:void(0)">\n' +
                            '                <span class="desc">'+course.title+'</span>\n' +
                            '              </a>\n' +
                            '           </li>'
                    }
                    if(course.survey_completed==1){
                        is_completed =1
                        completed += '<li onclick="surveyResult('+course.id+')" class="media">\n' +
                            '              <a class="activity" href="javascript:void(0)">\n' +
                            '                <span class="desc">'+course.title+'</span>\n' +
                            '              </a>\n' +
                            '           </li>'
                    }

                })

                html = ''
                html += is_interested==1? interested: '';
                html += is_completed==1? completed: '';


                $('#user_survey_list').html(html)

                $("#page-sidebar .media a").on("click", function(e) {
                    $(this).closest(".tab-pane").css({
                        right: $("#page-sidebar").outerWidth()
                    });
                    e.preventDefault();
                });


            }
        })
    }

    loadSurveySideBar()

    // page name: message notice course survey publication notification
    loadPage = function loadPage(pageName) {
        //alert(pageName)
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
                    $('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+65));
                    $('.chat-form').show();
                }
                else{
                    $('.chat-form').hide();
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
        changePage(page)
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
                changePage('notification')
            }
        })
    }
    messageView = (id, group_id) =>{
        //alert('ok')
        $.ajax({
            url: "{{ url('app/')}}/message_view/"+id,
            type: 'GET',
            async: true,
            success: function (response) {
                //alert('ok')
                localStorage.setItem('is_group_message',group_id)
                changePage('message')
            }
        })
    }

    newMessages =  (response) => {
        html = '';
        count = 0;
        lastMessageNotificationId = 0;
        $.each(response, function (key, value) {
            lastMessageNotificationId = lastMessageNotificationId < value.id ? value.id :lastMessageNotificationId;
            count = value.is_seen==0 ? count+1 :count;
            if(value.is_seen==0){
                style = 'class = "alert-warning"'
            }else style = ''

            date = new Date(value["msg_date"]+ 'Z');
            messageDate 	= date.toLocaleString ();

            group_name = ''
            if(value.group_id>0){
                group_name = '('+value.group_name+') '
            }


            html +='<li onclick="messageView('+value.id+','+value.group_id+')" '+style+'> ' +
                '       <a href="#">' +
                '           <div class="clearfix">' +
                '               <div class="thread-image">' +
                '                   <img style="width:20px; height:25px" alt="" src="/assets/images/logo.jpg"> ' +
                '               </div> ' +
                '               <div class="thread-content"> ' +
                '                   <span class="time margin-left-5">'+messageDate+'</span>' +
                '                   <span class="preview">'+group_name+' '+value.admin_message+'</span> ' +
                '               </div> ' +
                '           </div>' +
                '        </a>' +
                '   </li>'

        })

        if(localStorage.getItem('lastMessageNotificationId')<lastMessageNotificationId){
            if(!localStorage.getItem('messageMaster')){
               playAudio();
            }

            localStorage.setItem('lastMessageNotificationId',lastMessageNotificationId)
        }else  if(lastMessageNotificationId>0) {
           // alert('message-1')
            if(!localStorage.getItem('lastMessageNotificationId')) {
                if(localStorage.getItem('messageMaster')){
					playAudio();
                }
            }
            localStorage.setItem('lastMessageNotificationId',lastMessageNotificationId)
        }
        $('#app_message_badge').html(count)
        $('.message_badge').html(count)
        $('#app_message_top_unread').html('{{__('app.You_have')}} <span id="total_unseen_message"> '+count+' </span>{{__('app.Unread')}}  {{__('app.messages')}}')
        $('#app_header_new_message').html(html)

    }


    new_notification_reload = () =>{
        setTimeout(function(){
            newNotifications();
            //  new_notification_reload();
        }, 10000);
    }

    newNotifications =  () => {
        //alert(11)
        $.ajax({
            url: "{{ url('app/')}}/new_notifications",
            type:'GET',
            async:true,
            success: function(response){
                response = JSON.parse(response)
                //console.log(response)
                newMessages(response['individualMessage'])
                html = '';
                count = 0;
                notificationId = 0;
                $.each(response['Notifications'], function (key, value) {
                    date = new Date(value["msg_date"]+ 'Z');
                    notificationDate 	= date.toLocaleString ();

                    notificationId = notificationId<value.id ? value.id : notificationId;
                    count = value.status==0 ? count+1 :count;
                    if(value.status==0){
                        style = 'class = "alert-warning"'
                    }else style = ''
                    if(value.module_id==7)		 title = '{{__('app.New_Course')}} : '+value['title'];
                    else if(value.module_id==37) title = '{{__('app.New_Notice')}}: '+value['title'];
                    else if(value.module_id==38) title = '{{__('app.New_Publication')}}: '+value['title'];
                    else title = value.title

                    html +='<li onclick="notificationView('+value.id+')" '+style+'> ' +
                        '<a href="javascript:void(0)"> ' +
                        //  '<span class="label label-primary"><i class="fa fa-user"></i></span> ' +
                        '<span class="time margin-left-5">'+notificationDate+'</span> ' +
                        '<span class="message"> '+title+'</span> ' +
                        '</a> ' +
                        '</li>'
                })

                if(localStorage.getItem('lastNotificationId')<notificationId){
					 playAudio();

                    localStorage.setItem('lastNotificationId',notificationId)
                }else  if(notificationId>0) {
                    if(!localStorage.getItem('lastNotificationId')){
						playAudio();
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
    //localStorage.setItem('content','message')


    if(localStorage.getItem('content')){
        loadPage(localStorage.getItem('content'))
        localStorage.removeItem('content')

    }



</script>






</body>


<!-- end: BODY -->
</html>
