@extends('layout.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bils/messages.css') }}">


    <style>

        h4 { font-family: 'Open Sans'; margin: 0;}

        .modal,body.modal-open {
            padding-right: 0!important
        }

        body.modal-open {
            overflow: auto
        }

        body.scrollable {
            overflow-y: auto
        }

        .modal-footer {
            display: flex;
            justify-content: flex-start;
        .btn {
            position: absolute;
            right: 10px;
        }
        }

        .modal {
            /*height:500px;*/
            left: 35%;
            bottom: auto;
            right: auto;
            padding: 0;
            width: 62%;
            margin-left: -250px;
            background-color: #ffffff;
            border: 1px solid #999999;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 6px;
            -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
            box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
            background-clip: padding-box;
        }
        .replied_message_p {
            margin:0px;
            padding:1px;
            color:gray;
        }

    </style>


@endsection

@section('content')

    <div class="col-md-12" style="padding: 0;">
        <div id="frame">
            <div class="content">
                <div class="contact-profile">
                    <img id="admin_image" src="" alt="">
                    <a href="#" class="text-capitalize" id="msg_category_name"></a> {{-- onclick="showProfile()" style="cursor:pointer; text-decoration: none;" --}}
                    <input type="hidden" id="app_user_id_profile">
                    <input type="hidden" id="group_msg_group_id">
                    <div class="social-media">
                        <div id="load_more_message">

                        </div>
                    </div>
                </div>
                <div class="messages">
                    <ul style="padding-left: 0;">
                        <div class="message_body">

                        </div>


                    </ul>
                </div>
                <div class="message-input">
                    <div class="wrap">
                        <!--form id="sent_message_to_group" name="sent_message_to_group" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                            @csrf
                            <div style="width: 90%; float: left;">
                                <input type="hidden" name="group_id" id="group_id">
                                <div >
                                    <p id="reply_msg" name="reply_msg"></p>
                                    <input type="hidden" id="reply_msg_id" name="reply_msg_id">
                                    <input type="hidden" id="edit_msg_id" name="edit_msg_id">
                                    <input style="width: 100%" type="text" name="admin_message" id="admin_message" placeholder="Write your message..." />
                                </div>
                            </div>
                            <div style="width: 10%; float: left;">
                                <label for="group_msg_attachment" class="custom-file-upload">
                                    <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                </label>
                                <input type="hidden" name="category_id" id="category_id">
                                <input multiple id="group_msg_attachment" name="group_msg_attachment[]" type="file"/>
                                <button type="submit" class="submit" id="message_sent_to_group"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </form-->
                            <input type="hidden" name="category_id" id="category_id">

                    </div>
                </div>
            </div>



            <div id="sidepanel">
                <div id="profile">
                    <div class="wrap">
                        <img id="profile-img" src="{{ asset('assets/images/user/admin') }}/{{ Auth::user()->user_profile_image }}" class="online" alt="" />
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div id="search">

                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="text" id="search_message_category" name="search_message_category" placeholder="Search Group...." />
                </div>
                <div id="contacts">
                    <ul style="list-style-type: none; padding: 0;">
                        <div id="category_show">

                        </div>


                    </ul>
                </div>
                <div id="bottom-bar">

                </div>
            </div>
        </div>
    </div>



@endsection


@section('JScript')
    <script>
        var url = $('.site_url').val();
        var number_of_msg = 20;
        var current_page_no = 1;
        var loaded = 1;
        var last_appuser_message_id = 0;

        var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
        var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
        var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
        var admin_image_url = "<?php echo asset('assets/images/user/admin'); ?>";

       loadCategory= ()=>{
           $.ajax({
               url: url+"/message/get-message-category",
               success: function(response){
                   var response = JSON.parse(response);
                   if(!jQuery.isEmptyObject(response)){
                       var html = '<div class="msg_auto_load">';
                       $.each(response, function(i,row){

                           //html+='<li onclick="loadCategoryMessage(1,'+row["id"]+')" class="contact ">';
                           html+='<li onclick="loadCategoryMessage(1,'+row["id"]+')" class="contact border-bottom-message">';
                           html+='<div class="wrap">';
                           html+='<div class="meta">';
                           html+='<p class="name">'+row["category_name"]+'</p>';
                           html+='</div>';
                           html+='</div>';
                           html+='</li>';
                           html+='</div>';

                       });
                   }
                   $("#category_show").html(html);
               }
           });

       }
        loadCategory ()



        $("#search_message_category").keyup(function(){
            if($("#search_message_category").val()=='' ){
                loadCategory ()
                return false;
            }

            key = $('#search_message_category').val()
            $.ajax({
                url: url+"/message/search-message_category/"+key,
                success: function(response){
                    var response = JSON.parse(response);
                    if(!jQuery.isEmptyObject(response)){
                        var html = '<div class="msg_auto_load">';
                        $.each(response, function(i,row){

                            html+='<li onclick="loadCategoryMessage(1,'+row["id"]+')" class="contact ">';
                            html+='<div class="wrap">';


                            html+='<img src="'+app_user_profile_url+'/no-user-image.png" alt="" />';

                            html+='<div class="meta">';
                            html+='<p class="name">'+row["category_name"]+','+number_of_msg+'</p>';
                            //html+='<p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>';
                            html+='</div>';
                            html+='</div>';
                            html+='</li>';
                            html+='</div>';

                        });
                    }
                    $("#category_show").html(html);
                }
            });
        });

        loadCategoryMessage = (message_load_type, category_id) => {

            $("#load_more_message").html('<button onclick="loadCategoryMessage(3,'+category_id+');" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>');


            $("#search_app_user").val("");
            $('#category_id').val(category_id)
            // event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var app_user_id = $("#app_user_id").val();
            // new appuser loaded
            if (message_load_type == 1) {
                current_page_no = 1;
            }

            $.ajax({
                url: url + '/message/load-category-message',
                type: 'POST',
                data: {
                    category_id: category_id,
                    limit: number_of_msg,
                    page_no: current_page_no,
                    message_load_type: message_load_type,
                    last_appuser_message_id: last_appuser_message_id
                },
                async: true,
                beforeSend: function (xhr) {
                    //ajaxPreLoad()
                    //$("#load-content").fadeOut('slow');
                },
                success: function (response) {
                    // alert(1)
                    var response = JSON.parse(response);
                    var message = response['message'];
                    var img_id = "";
                    var mc;
                    //Messages


                    var message_body = "";
                    if (!jQuery.isEmptyObject(message)) {
                        $.each(message, function (i, message) {

                            var app_user_message 		= message["app_user_message"];
                            var is_attachment_app_user 	= message["is_attachment_app_user"];
                            var admin_message 			= message["admin_message"];
                            var is_attachment 			= message["is_attachment"];

                            category_name_ = message['category_name']
                            date = new Date(message["msg_date"]+ 'Z');
                            msg_date = date.toLocaleString ()

                            html = "";
                            if((admin_message!==null || is_attachment>0) && ( is_attachment!=='')){
                                if (message["reply_message"]) {
                                    html += '<li class="sent_msg reply" style="margin-bottom: -15px;padding-right: 30px;"><div class="replied_message_p p_div" ">' + message['reply_message'] + '</div></li>  ';
                                }
                                html += '<li class="sent_msg " id="sent_message_id_' + message['id'] + '">';

                                if ($.trim(message['admin_image']) == "null" || $.trim(message['admin_image']) == "") admin_image = "no-user-image.png";
                                else admin_image = message['admin_image'];
                                html += '<img style="width:25px;height:25px; cursor:pointer" title="' + message['admin_name'] + '" src="' + admin_image_url + '/' + admin_image + '" alt="" />';

                                if (message["admin_message"] != null && message["admin_message"] != "") {
                                    html += '<div class="right p_div">' + message["admin_message"] + '</div><br><br><br>';
                                } else {
                                    html += "";
                                }
                                if (message["is_attachment"] == 1) {
                                    html += "<div class='attachment_div'>";
                                    attachements = message["admin_atachment"].split(',');
                                    var old_type = "";
                                    for (var i = 0; i < attachements.length; i++) {
                                        var att_type = (attachements[i].split("*"));
                                        var attachment_type = att_type[1];
                                        var attachment_name = att_type[0];
                                        line_break = "";
                                        if (old_type != attachment_type) {
                                            old_type = attachment_type;
                                        }
                                        if (i != 0 && old_type != attachment_type) {
                                            line_break = "<br>";
                                        }

                                        if (attachment_type == 1) {
                                            //Image
                                            html += line_break + '<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="' + msg_image_url + '/' + attachment_name + '" alt="">';
                                            //onclick="zoomImg()"
                                        } else if (attachment_type == 2) {
                                            //Video
                                            html += '<div class="row pull-right text-right"><video style="float:right;margin-right:10px;" width="280" controls><source src="' + msg_image_url + '/' + attachment_name + '" type="video/mp4"></video></div>';
                                        } else if (attachment_type == 3) {
                                            //Audio
                                            html += '<div class="row pull-right text-right"><audio style="float:right;margin-right:10px;" controls><source src="' + msg_image_url + '/' + attachment_name + '" type="audio/mpeg"></audio></div>';
                                        } else {
                                            //Other Files
                                            html += '<a href="' + msg_image_url + '/' + attachment_name + '" download><div class="right p_div"  style="text-decoration:underline">' + attachment_name + '</div></a>';
                                        }
                                    }
                                    html += "</div>";
                                }
                                html += '</li>';
                                if (message["category_name"] != null && message["category_name"] != "") {
                                    mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">' + message["category_name"] + '</div>';
                                } else {
                                    mc = "";
                                }

                                if (message["admin_message"] != null && message["admin_message"] != "") tem_msg = "'" + message['admin_message'].replace(/<(?!br\s*\/?)[^>]+>/g, '') + "'";
                                else tem_msg = "";
                                html += '<span class="time_date_sent">' + mc + ' ' + msg_date + '<a href="javascript:void(0)" onclick="removeMessage(' + message["id"] + ',' + tem_msg + ')" class="margin-left-2 text-danger"><i class="clip-remove"></i></a><a href="javascript:void(0)" onclick="editMessage(' + message["id"] + ',' + tem_msg + ')" class="margin-left-2"><i class="fa fa-pencil"></i></a></span>';
                            } else if ((message["app_user_message"] != null && message["app_user_message"] != "") || (message["is_attachment_app_user"] != "" && message["is_attachment_app_user"] != null)) {
                                if (message["replied"]) {
                                    html += '<li class="receive_msg reply" style="margin-bottom: -15px;padding-left: 30px;"><div class="replied_message_p p_div" ">' + message['reply_message'] + '</div></li>  ';
                                }
                                html += '<li class="receive_msg" id="receive_message_id_' + message['id'] + '">';
                                if ($.trim(message['user_profile_image']) == "null" || $.trim(message['user_profile_image']) == "") appuser_image = "no-user-image.png";
                                else appuser_image = message['user_profile_image'];
                                html += '<img style="width:25px;height:25px;"  src="' + app_user_profile_url + "/" + appuser_image + '" alt="" title="' + message["app_user_name"] + '" onclick="showProfile(' + message["app_user_id"] + ')"/>';

                                if (message["app_user_message"] != null && message["app_user_message"] != "") {
                                    html += '<div class="left p_div">' + message["app_user_message"] + '</div><br>';
                                }
                                if ((message["app_user_message"] != null && message["app_user_message"] != "") && (message["is_attachment_app_user"] == 1)) {
                                    html += "";
                                }
                                if (message["is_attachment_app_user"] == 1) {
                                    html += "<div class='attachment_div' style=' display: inline-block;  padding:10px 15px 10px 0px;  max-width: 80%;  line-height: 130%;'>";
                                    attachements = message["app_user_attachment"].split(',');
                                    for (var i = 0; i < attachements.length; i++) {
                                        var att_type = (attachements[i].split("*"));
                                        var attachment_type = att_type[1];
                                        var attachment_name = att_type[0];

                                        if (message["attachment_type"] == 1) {
                                            //Image
                                            html += '<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="' + msg_image_url + '/' + attachment_name + '" alt="">';
                                            //onclick="zoomImg()"
                                        } else if (message["attachment_type"] == 2) {
                                            //Video
                                            html += '<div class="row text-left"><video style="float:left; margin-left:10px" width="280" controls><source src="' + msg_image_url + '/' + attachment_name + '" type="video/mp4"></video></div>';
                                        } else if (message["attachment_type"] == 3) {
                                            //Audio
                                            html += '<div class="row text-left"><audio style="float:left; margin-left:10px" width="280"  controls><source src="' + msg_image_url + '/' + attachment_name + '" type="audio/mpeg"></audio></div>';
                                        } else {
                                            //Other Files
                                            html += '<a href="' + msg_image_url + '/' + attachment_name + '" download><div class="left p_div" style="text-decoration:underline">' + attachment_name + '</div></a>';
                                        }
                                    }
                                    html += "</div>";
                                }
                                if (message["category_name"] != null && message["category_name"] != "") {
                                    mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">' + message["category_name"] + '</div>';
                                } else {
                                    mc = "";
                                }

                                if (message["app_user_message"] != null && message["app_user_message"] != "") tem_msg = "'" + message['app_user_message'].replace(/<(?!br\s*\/?)[^>]+>/g, '') + "'";
                                else tem_msg = "";
                                html += '<span class="time_date">' + '<a href="javascript:void(0)" onclick="replyMessage(' + message["id"] + ',' + tem_msg + ')" class="margin-right-2 text-success"><i class="fa fa-mail-reply"></i></a>' + msg_date + ' ' + mc + '</span>';
                                html += '</li>';
                            }
                            message_body = html + message_body;
                        });
                    }

                    $('#msg_category_name').html(category_name_)
                    $('#admin_image').attr('src',admin_image_url+'/'+admin_image)

                    //console.log(message_body)
                    if (message_body != "") {
                        if (message_load_type == 1) { // 1: all message dump
                            //alert('1:change all message')
                            $(".message_body").html(message_body);
                            $(".messages").animate({scrollTop: 180000/*$(document).height()*/}, "fast");
                            current_page_no = 2;
                        }
                        // 2: get last message which just entered by admin
                        // load appuser last message
                        else if (message_load_type == 2 || message_load_type == 4) {
                            //alert('1:add last mesage')
                            var html_tag = $(".message_body");
                            html_tag.append(message_body);
                            $(".messages").animate({scrollTop: 180000/*$(document).height()*/}, "fast");

                        } else if (message_load_type == 3) { // 3: get load more messages
                            //alert('1:add more all message')
                            // need to specify the las message <li> and make the slide animation accoring to that li
                            $(".messages").animate({scrollTop: $(document).height()}, "fast");
                            var html_tag = $(".message_body");
                            html_tag.prepend(message_body);
                            current_page_no++;
                        }
                        //alert($('.receive_msg:last').length)
                        if ($('.receive_msg:last').length > 0) {
                            last_app_user_message = $('.receive_msg:last').attr('id').split('_');
                            last_appuser_message_id = last_app_user_message[3];
                        }

                        //this code should be after the ajax call but there it is not wording
                        $(".zoomImg").click(function(){
                            alert(1)
                            var image_src = $(this).attr('src');
                            $("#modalIMG").modal();
                            $("#load_zoom_img").attr('src',image_src);
                        });
                        //

                    } else {
                        if (message_load_type == 1) {
                            // NO message yet,
                            $(".message_body").html("");
                        }
                    }
                    // $('.content').unblock();
                }
            })



        }




    </script>

    <script src="{{ asset('assets/js/bils/message/message.js')}}"></script>

@endsection


