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
					<!--img id="app_user_image" src="" alt="" /-->
					<p style="font-weight:bold;	padding-left:5px;" id="msg_group_name"></p> {{-- onclick="showProfile()" style="cursor:pointer; text-decoration: none;" --}}
					<input type="hidden" id="app_user_id_profile">
                    <input type="hidden" id="group_msg_group_id">
                    <div class="pull-right">
						<div class=" padding-5" style="padding:0px  10px">
							Category/Topic
							<select class="" id="message_category_group" style="min-width:150px">
							</select>
						</div>
					</div>
					<div class="social-media pull-right">
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
						<form id="sent_message_to_group" name="sent_message_to_group" enctype="multipart/form-data" class="form form-horizontal form-label-left">
							@csrf
							<div class="input-group">

								<input type="hidden" name="group_id" id="group_id">
								<input type="hidden" id="reply_msg_id" name="reply_msg_id">
								<input type="hidden" id="edit_msg_id" name="edit_msg_id">
								<p id="reply_msg" name="reply_msg"></p>
								<span class="input-group-btn dropup ">
									<button type="button" class="btn btn-warning dropdown-toggle btn-custom-side-padding border-radious-0" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<div class="dropdown-menu dropdown-enduring dropdown-checkboxes"   >
										Category/Topic: &nbsp; <select name="message_category" id="message_category" style="min-width:150px">

										</select>
									</div>
								</span>
								<input type="hidden" name="app_user_id" id="app_user_id">
								<input type="text" name="admin_message" id="admin_message" placeholder="Write your message..." />
								<label for="attachment" class="custom-file-upload btn btn-file btn-blue btn-custom-side-padding border-radious-0">
									<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
								</label>
								<input multiple id="group_msg_attachment" name="group_msg_attachment[]" type="file"/>
								<button class="btn btn-success border-radious-0" type="submit" class="submit" id="message_sent_to_group"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
							</div>

							<!--
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
							</div>-->
						</form>
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
                <div>
                </div>
				<div id="search">

					<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
					<input type="text" id="search_app_user_group" name="search_app_user_group" placeholder="Search Group...." />
				</div>
				<div id="contacts">
					<ul style="list-style-type: none; padding: 0;">
						<div id="app_user_group_show">
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
        var number_of_msg = 10;
        var loaded = 1;

		var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
		var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
		var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
		var admin_image_url = "<?php echo asset('assets/images/user/admin'); ?>";

        loadAppUserGroup = function loadAppUserGroup(){
            //alert('sdfsdf')

            $.ajax({
                url: url+'/message/load-app-user-group',
                success: function(response){
                    var response = JSON.parse(response);
                    var app_user = response['app_user_info'];
                    //Load App user who are chated
                    if(!jQuery.isEmptyObject(app_user)){
                        var html = '<div class="msg_auto_load">';
                        //var active_chat_class = "active";
                        $.each(app_user, function(i,row){
                            if($('#group_msg_group_id').val() == null){
                                $('#group_msg_group_id').val(row["id"])
                            }
                            html+='<li onclick="loadGroupMessage('+row["id"]+','+number_of_msg+')" class="contact border-bottom-message">';
                            html+='<div class="wrap">';
                            html+='<div class="meta">';
                            html+='<p class="name">'+row["group_name"]+'</p>';
                            html+='</div>';
                            html+='</div>';
                            html+='</li>';
                            html+='</div>';
                            //active_chat_class = "";

                        });
                    }
                    $("#app_user_group_show").html(html);
                }
            });
        }
        loadAppUserGroup();

        searchAppUsersGroup = function searchAppUsersGroup(){
            event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            var group_name = $("#search_app_user_group").val();
            if(group_name!=""){
                $.ajax({
                    url: url+"/message/search-app-users-group",
                    type:'POST',
                    data:{group_name:group_name},
                    async:false,
                    success: function(data){
                        var app_users = JSON.parse(data);

                        if(!jQuery.isEmptyObject(app_users)){
                            var html = "";
                            $.each(app_users, function(i,row){
                                html+='<li class="contact border-bottom-message">';
                                html+='<div class="wrap">';
                                //html+='<span class="contact-status busy"></span>';
                                html+='<div class="meta">';
                                html+='<p onclick="loadGroupMessage('+row["id"]+','+number_of_msg+')" class="name">'+row["group_name"]+'</p>';
                                //html+='<p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>';
                                html+='</div>';
                                html+='</div>';
                                html+='</li>';

                            });
                        }
                        $("#app_user_group_show").html(html);

                    }
                });
            }
            else {
                loadAppUserGroup();
            }
        }

        $("#search_app_user_group").keyup(function(){
            searchAppUsersGroup();
        });


        $.ajax({
            url: url+"/message/get-message-category",
            success: function(response){
                var data = JSON.parse(response);
                var option = '<option value="">&nbsp;</option>';
                $.each(data, function(i,data){
                    option += "<option value='"+data['id']+"'>"+data['category_name']+"</option>";
                });
                $("#message_category").append(option)
                $('#message_category_group').html(option)
                /*$("#message_category_group").select2({
                    placeholder: "Categoty/Topic",
                    allowClear: true
                });*/
                $("#message_category").select2({
                    placeholder: "Categoty/Topic",
                    allowClear: true
                });
            }
        });


        //Group Message sent
        newGroupMessageSent = function newGroupMessageSent(){

            var formData = new FormData($('#sent_message_to_group')[0]);
            formData.append('category_id',$('#message_category_group').val())
            if(( $.trim($('#admin_message').val()) != "" || $.trim($('#group_msg_attachment').val()) != "" ) && $.trim($('#group_id').val()) != ""){

                $.ajax({
                    url: url+"/message/admin-message-sent-to-group",
                    type:'POST',
                    data:formData,
                    async:false,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success: function(data){
                        //alert(3)
                        $("#group_msg_attachment").val('');
                        loadGroupMessage($('#group_id').val(),number_of_msg);
                        $('#admin_message').val("");
                        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                        loadAppUserGroup();
                    }
                });
            }
            $('#edit_msg_id').val(null)
        }

        $("#message_sent_to_group").click(function(){
            event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            newGroupMessageSent();
            $('#reply_msg_id').val(null)
            $('#reply_msg').html('')
        });

        $(window).on('keydown', function(e) {
            if (e.which == 13) {
                newGroupMessageSent();
                return false;
            }
        });

        reply_message = (id, msg) =>{

            $('#reply_msg_id').val(id)
            $('#reply_msg').html(msg)
        }

        view_app_user = (id) =>{
            //alert(id)
        }

        edit_message = (id, msg) =>{
            $('#edit_msg_id').val(id)
            $('#admin_message').val(msg)

        }

        set_time_out_fn = function set_time_out_fn(user_group_id, number_of_msg){
            setTimeout(function(){
                loadGroupMessage(user_group_id, number_of_msg);
                set_time_out_fn(user_group_id, number_of_msg);
            }, 100000);
        }

/*
	    set_message_time_out_fn = () =>{
			setTimeout(function(){
				newMessages();
				set_time_out_fn(user_group_id, number_of_msg);
			}, 100000);
		}

		// Load notifications in admin header
		set_notification_time_out_fn = () =>{
			setTimeout(function(){
				loadNotifications();
				set_time_out_fn(user_group_id, number_of_msg);
			}, 100000);
		}

*/

        loadGroupMessage = function loadGroupMessage(user_group_id, number_of_msg, user_category_id){


            $('#reply_msg_id').val(null)
            $('#reply_msg').html('')
            $("#search_app_user_group").val("");
            //event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            let group_id = user_group_id;
            var msg_no = number_of_msg;
            if(user_category_id){
                var msg_cat = user_category_id;
            }
            else {
                var msg_cat = $('#message_category_group').val();
            }

            //alert(msg_cat)


            $.ajax({
                url: url+'/message/load-group-message',
                type:'POST',
                data:{
                    group_id:group_id,
                    msg_no:msg_no,
                    category:msg_cat
                },
                async:false,
                success: function(response){

                    $('#category_id').val(msg_cat)
                    $('#group_id').val(group_id)

                    var response = JSON.parse(response);

                    var message = response['message'];
                    var app_user_name = response['app_user_name'];
                    var img_id="";
                    var mc;
                    //Messages
                    var message_body = "";
                    if(!jQuery.isEmptyObject(message)){
                        $.each(message, function(i,message){
                            $('#msg_group_name').html(message['category_name'])

                            html = "";

                            if( (message["admin_id"] != null && message["admin_id"] != "" ) && ((message["admin_message"]!=null && message["admin_message"]!="") || ( message["is_attachment"]!=""&& message["is_attachment"]!=null )) ){
                                if(message["replied"]){
                                    html+='<li class="sent_msg"><p class="replied_message_p" ">'+message['replied']+'</p></li>  ';
                                }
                                html += '<li class="sent_msg">';

                                if($.trim(message['admin_image']) == "null" || $.trim(message['admin_image']) == ""  ) admin_image = "no-user-image.png";
                                else  									 	admin_image = message['admin_image'];

                                html += '<img style="width:25px;height:25px; cursor:pointer" title="'+message['admin_name']+'" src="'+admin_image_url+"/"+admin_image+'" alt="" />';

                                if (message["admin_message"]!=null && message["admin_message"]!="") {
                                    tem_msg = "'"+message['admin_message']+"'";

                                    html += '<p onclick="edit_message('+message["id"]+','+tem_msg+')"> '+message["admin_message"]+'    <i onclick="reply_message('+message["id"]+','+tem_msg+')" style="font-size:16px" class="fa">&#xf112;</i></p><br><br><br>';

                                }else{
                                    html+="<br><br>";
                                }

                                if(message["is_attachment"]==1){
                                    attachements = message["admin_atachment"].split(',');
                                    for(var i=0; i<attachements.length; i++){
                                        var att_type 		= (attachements[i].split("*"));
                                        var attachment_type = att_type[1];
                                        var attachment_name	= att_type[0];
                                        if(attachment_type==1){
                                            //Image
                                            html += '<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="'+msg_image_url+'/'+attachment_name+'" alt="">';
                                            //onclick="zoomImg()"
                                        }
                                        else if(attachment_type==2){
                                            //Video
                                            html +='<div class="row pull-right text-right"><video style="float:right" width="280" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="video/mp4"></video></div>';
                                        }
                                        else if(attachment_type==3){
                                            //Audio
                                            html +='<div class="row pull-right text-right"><audio controls><source src="'+msg_image_url+'/'+attachment_name+'" type="audio/mpeg"></audio></div>';
                                        }
                                        else{
                                            //Other Files
                                            html += '<a href="'+msg_image_url+'/'+attachment_name+'" download><p style="word-wrap: break-word;">'+message["admin_atachment"]+'</p></a>';
                                        }
                                    }
                                }

                                html += '</li>';
                                if (message["category_name"]!=null && message["category_name"]!="") {
                                    mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                                }
                                else{
                                    mc = "";
                                }
                                html += '<span class="time_date_sent"> '+message["msg_date"]+' '+mc+'</span>';


                            }
                            else if( (message["app_user_message"]!=null && message["app_user_message"]!="") || ( message["is_attachment_app_user"]!=""&& message["is_attachment_app_user"]!=null ) ){

                                if(message["replied"]){
                                    html+='<li class="sent_msg"><p class="replied_message_p" ">'+message['replied']+'</p></li>  ';
                                }
                                html += '<li class="receive_msg">';
                                html += '<img src="http://emilcarlsson.se/assets/mikeross.png" onclick = "showProfile('+message["app_user_id"]+')"  alt="" />';

                                if (message["app_user_message"]!=null && message["app_user_message"]!="") {
                                    //tem_msg = "'"+message['app_user_message']+"'";
                                    tem_msg = "'"+message['app_user_message']+"'";

                                    html += '<p> '+message["app_user_message"]+'    <i onclick="reply_message('+message["id"]+','+tem_msg+')" style="font-size:16px" class="fa">&#xf112;</i></p>';

                                    //html += "<p>"+message['app_user_message']+"    <i onclick='reply_message("+message['id']+","+tem_msg+")' style='font-size:16px' class='fa'>&#xf112;</i></p>";
                                }
                                if( (message["app_user_message"]!=null && message["app_user_message"]!="")&& (message["is_attachment_app_user"]==1) ){
                                    html+="<br>";
                                }

                                if(message["is_attachment_app_user"]==1){
                                    attachements = message["app_user_attachment"].split(',');
                                    for(var i=0; i<attachements.length; i++){
                                        var att_type 		= (attachements[i].split("*"));
                                        var attachment_type = att_type[1];
                                        var attachment_name	= att_type[0];

                                        if(message["attachment_type"]==1){
                                            //Image
                                            html += '<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="'+msg_image_url+'/'+attachment_name+'" alt="">';
                                            //onclick="zoomImg()"
                                        }
                                        else if(message["attachment_type"]==2){
                                            //Video
                                            html +='<div class="row text-left"><video style="float:left" width="280" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="video/mp4"></video></div>';
                                        }
                                        else if(message["attachment_type"]==3){
                                            //Audio
                                            html +='<div class="row text-left"><audio style="float:left" width="280"  controls><source src="'+msg_image_url+'/'+attachment_name+'" type="audio/mpeg"></audio></div>';
                                        }
                                        else{
                                            //Other Files
                                            html += '<a href="'+msg_image_url+'/'+attachment_name+'" download><p style="word-wrap: break-word;">'+attachment_name+'</p></a>';
                                        }
                                    }
                                }
                                html += '<span class="time_date">'+message["msg_date"]+'</span><br><br><br>';
                                html += '</li>';

                                // 11:01 AM    |    June 9
                            }
                            message_body = html+message_body;

                        });

                    }
                    loadAppUserGroup();
                    $(".message_body").html(message_body);
                    $("#app_user_name").html(app_user_name['category_name']);

                    if (app_user_name['user_profile_image']!=null && app_user_name['user_profile_image']!="") {
                        $("#app_user_image").attr('src', app_user_profile_url+"/"+app_user_name['user_profile_image']);
                    }
                    else{
                        $("#app_user_image").attr('src', app_user_profile_url+"/no-user-image.png");
                    }

                    $("#load_more_message").html('<button onclick="limitIncrease('+app_user_name["id"]+');" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>');
                    if (number_of_msg==10) {
                        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                    }
                }
            });

            $(".zoomImg").click(function(){
                var image_src = $(this).attr('src');
                $("#modalIMG").modal();
                $("#load_zoom_img").attr('src',image_src);
            });

            set_time_out_fn(user_group_id, number_of_msg);

        }

        $('#admin_message').click(function () {
            group_id =$('#group_id').val()
            category_id = $('#category_id').val()

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            if(category_id>0 && group_id>0){
                $.ajax({
                    url: url+"/message/admin-group-message-seen/"+group_id+"/"+category_id,
                    type:'GET',
                    async:false,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success: function(data){

                    }
                });
            }else if($('#app_user_id').val()>0){
                $.ajax({
                    url: url+"/message/admin-message-seen/"+$('#app_user_id').val(),
                    type:'GET',
                    async:false,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success: function(data){
                        // alert(3)

                    }
                });
            }
            newMessages()
        })


	</script>

	<script src="{{ asset('assets/js/bils/message/message.js')}}"></script>

@endsection


