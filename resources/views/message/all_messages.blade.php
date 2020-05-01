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
					<img id="app_user_image" src="" alt="" />
					<a onclick="showProfile()" style="cursor:pointer; text-decoration: none;" id="app_user_name"></a>
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
						<form id="sent_message_to_user" name="sent_message_to_user" enctype="multipart/form-data" class="form form-horizontal form-label-left">
							@csrf
                            <p id="reply_msg"></p>
                            <input type="hidden" id="edit_msg_id" name="edit_msg_id">
                            <div class="input-group">
								<span class="input-group-btn dropup ">
									<button type="button" class="btn btn-warning dropdown-toggle btn-custom-side-padding border-radious-0" data-toggle="dropdown">
										<span class="caret"></span>
									</button>
									<div class="dropdown-menu dropdown-enduring dropdown-checkboxes">
										Category/Topic: &nbsp; <select name="message_category" id="message_category" style="min-width:150px">
											<option disabled="" selected="" value="">Select Category</option>
										</select>
										<!--<div class="form-group">
											<label for="form-field-select-3">
												Select 2
											</label>
											<select id="form-field-select-3" class="form-control search-select">
												<option value="">&nbsp;</option>
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
											</select>
										</div>-->
									</div>
								</span>
								<input type="hidden" name="app_user_id" id="app_user_id">
								<input type="text" name="admin_message" id="admin_message" placeholder="Write your message..." />
								<label for="attachment" class="custom-file-upload btn btn-file btn-blue btn-custom-side-padding border-radious-0">
									<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
								</label>
								<input multiple id="attachment" name="attachment[]" type="file"/>
                                <input type="hidden" id="reply_msg_id" name="reply_msg_id">
								<button class="btn btn-success border-radious-0" type="submit" class="submit" id="message_sent_to_user"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>


			{{-- <label for="file-upload" class="custom-file-upload">
			Custom Upload
			</label>
			<input id="file-upload" type="file"/> --}}


			{{-- <input type="file" id="file" />
			<label for="file" class="btn-3"><span>select</span></label> --}}



			{{-- <div class="input-group">
			<input type="text" class="form-control" aria-label="...">
			<div class="input-group-btn">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
			<li><a href="#">Something else here</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">Separated link</a></li>
			</ul>
			</div>
			</div> --}}


			<div id="sidepanel">
				<div id="profile">
					<div class="wrap">
						<img id="profile-img" src="{{ asset('assets/images/user/admin') }}/{{ Auth::user()->user_profile_image }}" class="online" alt="" />
						<p>{{ Auth::user()->name }}</p>
					</div>
				</div>

				<div id="search">
					<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
					<input type="text" id="search_app_user" name="search_app_user" placeholder="Search App Users...." />
				</div>
				<div id="contacts">
					<ul style="list-style-type: none; padding: 0;">
						<div id="app_user_show">

						</div>
						{{-- <li class="contact active">
						<div class="wrap">
						<span class="contact-status busy"></span>
						<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
						<div class="meta">
						<p class="name">Harvey Specter</p>
						<p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
						</div>
						</div>
						</li> --}}

					</ul>
				</div>
				<div id="bottom-bar">
				{{-- <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
				<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button> --}}
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

		$("select.search-select").select2({
           /* placeholder: "Select a State",*/
            allowClear: true
        });




        $('.msg_auto_load').first().trigger('click');

        loadMessage = function loadMessage(app_user_id, number_of_msg){//
            $("#search_app_user").val("");
            //event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            var app_user_id_load_msg = app_user_id;
            var msg_no = number_of_msg;

            $.ajax({
                url: url+'/message/load-message',
                type:'POST',
                data:{
                    app_user_id_load_msg:app_user_id_load_msg,
                    msg_no:msg_no
                },
                async:false,
                success: function(response){
                    var response = JSON.parse(response);

                    var message = response['message'];
                    var app_user_name = response['app_user_name'];
                    var img_id="";
                    var mc;
                    //Messages

                    var message_body = "";
                    if(!jQuery.isEmptyObject(message)){
                        $.each(message, function(i,message){
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
                                    html += '<p class="right">'+message["admin_message"]+'</p><br><br><br>';
                                }else{
                                    html+="";
                                }
                                if(message["is_attachment"]==1){
                                    html+="<div class='attachment_div'>";
                                    attachements = message["admin_atachment"].split(',');
                                    var old_type = "";
                                    for(var i=0; i<attachements.length; i++){
                                        var att_type 		= (attachements[i].split("*"));
                                        var attachment_type = att_type[1];
                                        var attachment_name	= att_type[0];
                                        line_break = "";
                                        if(old_type !=  attachment_type){
                                            old_type = attachment_type;
                                        }
                                        if(i!=0 && old_type !=  attachment_type){
                                            line_break = "<br>";
                                        }

                                        if(attachment_type==1){
                                            //Image
                                            html += line_break+'<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="'+msg_image_url+'/'+attachment_name+'" alt="">';
                                            //onclick="zoomImg()"
                                        }
                                        else if(attachment_type==2){
                                            //Video
                                            html +='<div class="row pull-right text-right"><video style="float:right;margin-right:10px;" width="280" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="video/mp4"></video></div>';
                                        }
                                        else if(attachment_type==3){
                                            //Audio
                                            html +='<div class="row pull-right text-right"><audio style="float:right;margin-right:10px;" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="audio/mpeg"></audio></div>';
                                        }
                                        else{
                                            //Other Files
                                            html += '<a href="'+msg_image_url+'/'+attachment_name+'" download><p class="right" style="word-wrap: break-word;">'+message["admin_atachment"]+'</p></a>';
                                        }
                                    }
                                    html+="</div>";
                                }
                                html += '</li>';
                                if (message["category_name"]!=null && message["category_name"]!="") {
                                    mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                                }
                                else{
                                    mc = "";
                                }
                                tem_msg = "'"+message['admin_message']+"'";


                                html += '<span class="time_date_sent">'+mc+' '+message["msg_date"]+'<a href="javascript:void(0)" onclick="removeMessage('+message["id"]+','+tem_msg+')" class="margin-left-2 text-danger"><i class="clip-remove"></i></a><a href="javascript:void(0)" onclick="editMessage('+message["id"]+','+tem_msg+')" class="margin-left-2"><i class="fa fa-pencil"></i></a></span>';
                            }
                            else if( (message["app_user_message"]!=null && message["app_user_message"]!="") || ( message["is_attachment_app_user"]!=""&& message["is_attachment_app_user"]!=null ) ){
                                if(message["replied"]){
                                    html+='<li class="sent_msg"><p class="replied_message_p" ">'+message['replied']+'</p></li>  ';
                                }
                                html += '<li class="receive_msg">';

                                if($.trim(message['user_profile_image']) == "null" || $.trim(message['user_profile_image']) == ""  ) appuser_image = "no-user-image.png";
                                else  									 	appuser_image = message['user_profile_image'];
                                html += '<img style="width:25px;height:25px;"  src="'+app_user_profile_url+"/"+appuser_image+'" alt="" />';

                                if (message["app_user_message"]!=null && message["app_user_message"]!="") {
                                    html += '<p class="left">'+message["app_user_message"]+'</p><br>';
                                }
                                if( (message["app_user_message"]!=null && message["app_user_message"]!="")&& (message["is_attachment_app_user"]==1) ){
                                    html+="";
                                }
                                if(message["is_attachment_app_user"]==1){
                                    html+="<div class='attachment_div' style=' display: inline-block;  padding:10px 15px 10px 40px;  max-width: 80%;  line-height: 130%;'>";
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
                                            html +='<div class="row text-left"><video style="float:left; margin-left:10px" width="280" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="video/mp4"></video></div>';
                                        }
                                        else if(message["attachment_type"]==3){
                                            //Audio
                                            html +='<div class="row text-left"><audio style="float:left; margin-left:10px" width="280"  controls><source src="'+msg_image_url+'/'+attachment_name+'" type="audio/mpeg"></audio></div>';
                                        }
                                        else{
                                            //Other Files
                                            html += '<a href="'+msg_image_url+'/'+attachment_name+'" download><p class="left" style="word-wrap: break-word;">'+attachment_name+'</p></a>';
                                        }
                                    }
                                    html+="</div>";
                                }

                                if (message["category_name"]!=null && message["category_name"]!="") {
                                    mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                                }
                                else{
                                    mc = "";
                                }

                                tem_msg = "'"+message['app_user_message']+"'";

                                html += '<span class="time_date">'+'<a href="javascript:void(0)" onclick="replyMessage('+message["id"]+','+tem_msg+')" class="margin-right-2 text-success"><i class="fa fa-mail-reply"></i></a>'+message["msg_date"]+' '+mc+'</span>';



                                html += '</li>';

                                // 11:01 AM    |    June 9

                            }
                            message_body = html+message_body;

                        });

                    }
                    loadAppUser();
                    $(".message_body").html(message_body);
                    $("#app_user_name").html(app_user_name['name']);

                    if (app_user_name['user_profile_image']!=null && app_user_name['user_profile_image']!="") {
                        $("#app_user_image").attr('src', app_user_profile_url+"/"+app_user_name['user_profile_image']);
                    }
                    else{
                        $("#app_user_image").attr('src', app_user_profile_url+"/no-user-image.png");
                    }

                    $("#load_more_message").html('<button onclick="limitIncrease('+app_user_name["id"]+');" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>');
                    $("#app_user_id").val(app_user_name['id']);
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
            //window.setInterval(loadMessage(app_user_id, number_of_msg), 1000);
        }

        replyMessage = (id, msg) =>{

            $('#reply_msg_id').val(id)
            $('#reply_msg').html(msg)
        }

        removeMessage = (id, message)=>{
            $.ajax({
                url: url + '/message/delete-message/'+id,
                type: 'GET',
                async: false,
                success: function (response) {
                    //alert('done')
                    loadMessage($('#app_user_id').val(),number_of_msg);
                    $('#admin_message').val("");
                    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                    loadAppUser();
                }
            })
        }

        editMessage = (id, message) =>{
            $('#edit_msg_id').val(id)
            $('#admin_message').val(message)
        }


        searchAppUsers = function searchAppUsers(){
            //event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            var name = $("#search_app_user").val();
            if(name!=""){
                $.ajax({
                    url: url+"/message/search-app-users",
                    type:'POST',
                    data:{name:name},
                    async:false,
                    success: function(data){
                        var app_users = JSON.parse(data);

                        if(!jQuery.isEmptyObject(app_users)){
                            var html = "";
                            $.each(app_users, function(i,row){
                                html+='<li class="contact">';
                                html+='<div class="wrap">';
                                if($.trim(row['user_profile_image']) == "null" || $.trim(row['user_profile_image']) == ""  ) appuser_image = "no-user-image.png";
                                else  				appuser_image = row['user_profile_image'];
                                html += '<img  src="'+app_user_profile_url+"/"+appuser_image+'" alt="" />';
                                html+='<div class="meta">';
                                html+='<p onclick="loadMessage('+row["id"]+','+number_of_msg+')" class="name">'+row["name"]+'</p>';
                                //html+='<p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>';
                                html+='</div>';
                                html+='</div>';
                                html+='</li>';
                            });
                        }
                        $("#app_user_show").html(html);

                    }
                });


            }
            else {
                loadAppUser();
            }
        }

        $("#search_app_user").keyup(function(){
            searchAppUsers();
        });


        loadAppUser = function loadAppUser(){
            $.ajax({
                url: url+'/message/load-app-user',
                success: function(response){
                    var response = JSON.parse(response);
                    var app_user = response['app_user_info'];
                    //Load App user who are chated
                    if(!jQuery.isEmptyObject(app_user)){
                        var html = '<div class="msg_auto_load">';
                        //var active_chat_class = "active";
                        $.each(app_user, function(i,row){
                            html+='<li onclick="loadMessage('+row["app_user_id"]+','+number_of_msg+')" class="contact ">';
                            html+='<div class="wrap">';

                            if (row["user_profile_image"]!=null && row["user_profile_image"]!="") {
                                html+='<img src="'+app_user_profile_url+'/'+row["user_profile_image"]+'" alt="" />';
                            }
                            else{
                                html+='<img src="'+app_user_profile_url+'/no-user-image.png" alt="" />';
                            }

                            html+='<div class="meta">';
                            html+='<p class="name">'+row["name"]+'</p>';
                            //html+='<p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>';
                            html+='</div>';
                            html+='</div>';
                            html+='</li>';
                            html+='</div>';
                            //active_chat_class = "";

                        });
                    }
                    $("#app_user_show").html(html);
                    //$('.msg_auto_load:first-child').trigger('click');
                    //$('.msg_auto_load').trigger('click');
                    //$('.msg_auto_load').first().addClass('active');
                    if(loaded == 1){
                        $('.contact:first').trigger('click');
                        loaded++;
                    }
                }
            });
        }
        loadAppUser();


        $("#message_sent_to_user").click(function(){
            event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            newMsgSent();
        });

        newMsgSent = function newMsgSent(){


            var formData = new FormData($('#sent_message_to_user')[0]);

            if(( $.trim($('#admin_message').val()) != "" || $.trim($('#attachment').val()) != "" ) && $.trim($('#app_user_id').val()) != ""){

                $.ajax({
                    url: url+"/message/admin-message-sent-to-user",
                    type:'POST',
                    data:formData,
                    async:false,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success: function(data){
                        $("#attachment").val('');
                        $('#reply_msg_id').val(null)
                        $('#reply_msg').html(null)
                        $('#edit_msg_id').val(null)
                        loadMessage($('#app_user_id').val(),number_of_msg);
                        $('#admin_message').val("");
                        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                        loadAppUser();
                    }
                });
            }


        }

        showProfile = function showProfile(){
            id = $("#app_user_id").val();
            //$("#app_user_id_profile").val(id)
            $.ajax({
                url: url+"/message/view-app-user/"+id,
                success: function(response){
                    var response = JSON.parse(response);
                    console.log(response)
                    var data = response['data'];
                    var groups = response['groups'];

                    $("#profile_modal").modal();
                    $("#name_div").html('<h2>'+data['name']+'</h2>');
                    $("#contact_div").html(data['contact_no']);
                    $("#email_div").html(data['email']);
                    $("#nid_div").html(data['nid_no']);
                    $("#address_div").html(data['address']);

                    $("#group_div").html('<b>Groups: </b><span class="badge badge-warning">'+groups[0]["group_name"]+'</span>');

                    if (data['remarks']!=null && data['remarks']!="") {
                        $("#remarks_div").html('<h2>Profile Details</h2>');
                        $("#remarks_details").html(data['remarks']);
                    }

                    if (data["user_profile_image"]!=null && data["user_profile_image"]!="") {
                        $(".profile_image").html('<img src="'+profile_image_url+'/'+data["user_profile_image"]+'" alt="User Image" class="img img-responsive">');
                    }
                    else{
                        $(".profile_image").html('<img src="'+profile_image_url+'/no-user-image.png" alt="User Image" class="img img-responsive">');
                    }

                    $("#status_btn").removeClass('hide');
                    //var class_name = "";
                    if(data['status']==1){
                        $("#status_div").html('<b>Status: </b><span class="badge badge-success">Active</span>');
                        //class_name = "btn-success";
                        $("#status_btn").addClass('btn-success');
                        $("#status_btn").removeClass('btn-danger');
                        $("#status_btn").html('Active');
                    }
                    else{
                        $("#status_div").html('<b>Status: </b><span class="badge badge-danger">In-active</span>');
                        //class_name = "btn-danger";
                        $("#status_btn").addClass('btn-danger');
                        $("#status_btn").removeClass('btn-success');
                        $("#status_btn").html('In-active');
                    }


                    //$("#status_btn").addClass(class_name);

                }
            });
        }

        //From profile status change
        $("#status_btn").click(function(){
            var id = $("#app_user_id").val() ? $("#app_user_id").val() : $("#app_user_id_profile").val()

            $.ajax({
                url: url+"/message/change-app-user-status/"+id,
                success: function(response){
                    showProfile(id);
                }
            });
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
                $("#message_category_group").select2({
                    placeholder: "Categoty/Topic",
                    allowClear: true
                });
                $("#message_category").select2({
                    placeholder: "Categoty/Topic",
                    allowClear: true
                });
            }
        });


    </script>

	<script src="{{ asset('assets/js/bils/message/message_.js')}}"></script>

@endsection


