<div class="panel panel-default border-none" style='margin-bottom:0 !important'>
	<div class="panel-heading">
		<i class="clip-bubble-4"></i>
		{{__('app.Message')}}
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="loadNewMessaeg()">
				<i class="fa fa-refresh"></i>
			</a>

		</div>
	</div>
		<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel message_div" >
            <ol class="discussion" id="message_body">
            </ol>
        </div>
        <div class="col-sm-12 padding-left-0 padding-right-0">
		    <div class="chat-form ">
			<form id="sent_message" name="sent_message" enctype="multipart/form-data" class="form form-horizontal form-label-left">
			<p id="reply_msg" class="replied_message_p" style="height:15px; overload:hidden;">&nbsp;</p>
            <input type="hidden" id="edit_msg_id" name="edit_msg_id">
			<input type="hidden" id="reply_msg_id"  name="reply_msg_id">
			<div class="input-group">
			<span class="input-group-btn dropup ">
				<button type="button" class="btn btn-warning dropdown-toggle btn-custom-side-padding border-radious-0" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<div class="dropdown-menu dropdown-enduring dropdown-checkboxes">
					Category/Topic: &nbsp; <select name="message_category" id="message_category" style="min-width:150px">
						<option disabled="" selected="" value="">Select Category</option>
					</select>
				</div>
			</span>

				<input type="text" id="message_input" name="message_input" class="form-control input-mask-date" placeholder="Type a message here..."/>
				<span class="input-group-btn ">
					<span class="btn btn-file btn-blue btn-custom-side-padding border-radious-0" >
						<i class="clip-attachment"></i>
						<input multiple="" id="attachment" name="attachment[]" type="file">
					</span>
				</span>
				<span class="input-group-btn ">
					<button class="btn btn-green border-radious-0" id="message_sent_button" type="button">
						<i class="clip-paperplane "></i>
					</button>
				</span>
				</div>
			</div>
			 </form>
	    </div>
    </div>
</div>


<script>
    //var url = $('.site_url').val();
    var number_of_msg = 50;
    var current_page_no = 1;
    var loaded = 1;
    var last_admin_message_id = "0";

    var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
    var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var image_url = "<?php echo asset('assets/images'); ?>";
	$('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+103));
	const container = document.querySelector('.fixed-panel');


	$.ajax({
		url: "{{ url('app/')}}/message/get-message-category",
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

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    removeMessage = function removeMessage(id, message){
       $.ajax({
            url: "{{ url('app/')}}/delete-message/"+id,
            type: 'GET',
            async: false,
            success: function (response) {
                alert(2)
                if($('#sent_message_id_'+id).prev().hasClass('reply')){
                    $('#sent_message_id_'+id).prev().remove();
                }
                $('#sent_message_id_'+id).remove();

                $('#message_input').val("");
            }
        })
    }


    loadMessages = function loadMessages(message_load_type){
       // alert('1')
        $("#search_app_user").val("");
        // event.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        // new appuser loaded
        if(message_load_type == 1){
            current_page_no =1;
        }

        $.ajax({
            url: "{{ url('app/')}}/load-message",
            type:'POST',
            data:{
                limit:number_of_msg,
                page_no:current_page_no,
                message_load_type:message_load_type,
                last_admin_message_id:last_admin_message_id
            },
            async:false,
            beforeSend: function( xhr ) {
               // ajaxPreLoad()
                //$("#load-content").fadeOut('slow');
            },
            success: function(response){
                var response = JSON.parse(response);
                var message = response['message'];
                var img_id="";
                var mc;
                //Messages

                var message_body = "";
                if(!jQuery.isEmptyObject(message)){
                    $.each(message, function(i,message){
                        html = "";
                        //alert(message['id'])


                        if( (message["app_user_message"]!=null && message["app_user_message"]!="") || ( message["is_attachment_app_user"]!=""&& message["is_attachment_app_user"]!=null )  ){
                            //alert(message['id']+'user')
                            //html+='<li class="self">'
                            html += '<li class="self" id="sent_message_id_'+message['id']+'">';
							 if(message["reply_message"]){
                                html+='<div class="reply replied_message_p background-gray text-right" ">'+message['reply_message']+'</div> ';
                            }
                            if($.trim(message['app_user_image']) == null || $.trim(message['app_user_image']) == ""  ) app_user_image = "no-user-image.png";
                            else  									 	app_user_image = message['app_user_image'];
                            html += '<div class="avatar"><img style="width:25px;height:25px; cursor:pointer" title="" src="'+app_user_profile_url+'/{{ \Auth::guard('appUser')->user()->user_profile_image }}" alt="" /></div>';
							html += '<div class="messages">';
                            if (message["app_user_message"]!=null && message["app_user_message"]!="") {
                                html += '<p class="text-right ">'+message["app_user_message"]+'</p>';
                            }else{
                                html+="";
                            }
                            if(message["is_attachment_app_user"]==1){
                                html+="<div class='attachment_div text-right'>";
                                attachements = message["app_user_attachment"].split(',');
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
                                        html += line_break+'<img  class="zoomImg" style="height:60px !important; width:auto !important;  border-radius:0; cursor:pointer" src="'+msg_image_url+'/'+attachment_name+'" alt="">';
                                        //onclick="zoomImg()"
                                    }
                                    else if(attachment_type==2){
                                        //Video
                                        html +='<div class="row pull-right text-right"><video style="float:right;margin-right:10px;" width="180" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="video/mp4"></video></div>';
                                    }
                                    else if(attachment_type==3){
                                        //Audio
                                        html +='<div class="row pull-right text-right"><audio style="float:right;margin-right:10px;" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="audio/mpeg"></audio></div>';
                                    }
                                    else{
                                        //Other Files
                                        html += '<a href="'+msg_image_url+'/'+attachment_name+'" download><p class="right" style="word-wrap: break-word;">'+message["app_user_atachment"]+'</p></a>';
                                    }
                                }
                                html+="</div>";
                            }
							 html+='</div>'
                            if (message["category_name"]!=null && message["category_name"]!="") {
                                mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                            }
                            else{
                                mc = "";
                            }
                            if (message["app_user_message"]!=null && message["app_user_message"]!="") 	tem_msg = "'"+message['app_user_message'].replace(/<(?!br\s*\/?)[^>]+>/g, '')+"'";
							else      tem_msg = "";

                            html += '<span class="time_date_sent pull-left">'+message["msg_date"]+'<a href="javascript:void(0)" onclick="removeMessage('+message["id"]+','+tem_msg+')" class="margin-left-5 margin-right-5 text-danger"><i class="clip-remove"></i></a><a href="javascript:void(0)" onclick="editMessage('+message["id"]+','+tem_msg+')" class="margin-left-5 margin-right-5"><i class="fa fa-pencil"></i></a>'+mc+'</span>';
							html+='</div>'
						}
                        else if( (message["admin_id"] != null && message["admin_id"] != "" ) && ((message["admin_message"]!=null && message["admin_message"]!="") || ( message["is_attachment"]!=""&& message["is_attachment"]!=null )) ){
                            //alert(message['id']+'admin')

                            //html+='<li class="other">'

                            if(message["replied"]){
                                html+='<p class="receive_msg reply" style="margin-bottom: -15px;padding-left: 30px;"><p class="replied_message_p" ">'+message['reply_message']+'</p></p>  ';
                            }
                            html += '<li class="other receive_msg" id="receive_message_id_'+message['id']+'">';

                            html += '<div class="avatar"><img style="width:25px;height:35px;"  src="'+image_url+'/logo.jpg" alt="" /></div>';
							html += '<div class="messages">';
                            if (message["admin_message"]!=null && message["admin_message"]!="") {
                                html += '<div class="left">'+message["admin_message"]+'</div>';
                            }
                            if( (message["admin_message"]!=null && message["admin_message"]!="")&& (message["is_attachment"]==1) ){
                                html+="";
                            }
                            if(message["is_attachment"]==1){
                                html+="<div class='attachment_div' style=' display: inline-block;  padding:5px'>";
                                attachements = message["admin_atachment"].split(',');
                                for(var i=0; i<attachements.length; i++){
                                    var att_type 		= (attachements[i].split("*"));
                                    var attachment_type = att_type[1];
                                    var attachment_name	= att_type[0];

                                    if(message["attachment_type"]==1){
                                        //Image
                                        html += '<img  class="zoomImg" style="height:60px !important; width:auto !important;  border-radius:0; cursor:pointer" src="'+msg_image_url+'/'+attachment_name+'" alt="">';
                                        //onclick="zoomImg()"
                                    }
                                    else if(message["attachment_type"]==2){
                                        //Video
                                        html +='<div class="row text-left"><video style="float:left; margin-left:10px" width="180" controls><source src="'+msg_image_url+'/'+attachment_name+'" type="video/mp4"></video></div>';
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
                            html+="</div>";

                            if (message["category_name"]!=null && message["category_name"]!="") {
                                mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                            }
                            else{
                                mc = "";
                            }
                            if (message["admin_message"]!=null && message["admin_message"]!="") 	tem_msg = "'"+message['admin_message'].replace(/<(?!br\s*\/?)[^>]+>/g, '')+"'";
						    else      tem_msg = "";
                            html += '<span class="time_date pull-right">'+mc+'<a href="javascript:void(0)" onclick="replyMessage('+message["id"]+','+tem_msg+')" class="margin-right-5 margin-left-5 text-success"><i class="fa fa-mail-reply"></i></a>'+message["msg_date"]+'</span>';
							html += '</li>';
						}

                        //console.log(html)
                        message_body = html+message_body;
                    });
                }

                if(message_body != ""){
                    if(message_load_type == 1){ // 1: all message dump
                        //alert('1:change all message')
                        $("#message_body").html(message_body);
						//container.scrollTop = 200000;
                        //$(".message_div").animate({ scrollTop: 180000/*$(document).height()*/ }, "fast");
                        current_page_no=2;
                    }
                    // 2: get last message which just entered by admin
                    // load appuser last message
                    else if(message_load_type == 2 || message_load_type == 4){
                        //alert('1:add last mesage')
                        var html_tag = $("#message_body");
                        html_tag.append(message_body);
                        container.scrollTop = 200000;

                    }
                    else if(message_load_type == 3){ // 3: get load more messages
                        //alert('3:add more all message');
                        // need to specify the las message <li> and make the slide animation accoring to that li
						//container.scrollTop = $(document).height();
                        //$(".message_div").animate({ scrollTop: $(document).height() }, "fast");
                        var html_tag = $("#message_body");
                        html_tag.prepend(message_body);
                        current_page_no++;

							$('.panel-scroll').perfectScrollbar({
								wheelSpeed: 50,
								minScrollbarLength: 20,
								suppressScrollX: true
							},{
								'ps-y-reach-end':loadMoreMessages()
							});

                    }

					if($('.receive_msg:last').length>0){
						last_admin_user_message = $('.receive_msg:last').attr('id').split('_');
						last_admin_message_id = last_admin_user_message[3];
					}
                }
                //$('.content').unblock();
            }
        });

        $(".zoomImg").click(function(){
            var image_src = $(this).attr('src');
          //  $("#modalIMG").modal();
          //  $("#load_zoom_img").attr('src',image_src);
        });

    }
    loadMessages(1);

	$('#message_sent_button').on('click',function(){
        var formData = new FormData($('#sent_message')[0]);
        if(( $.trim($('#message_input').val()) != "" || $.trim($('#attachment').val()) != "" )){
		   $.ajax({
                url: "{{ url('app/')}}/send-message",
                type:'POST',
                data:formData,
                async:false,
                cache:false,
                contentType:false,
                processData:false,
                success: function(data){
					// need to confirmation
					if($('#edit_msg_id').val() != ""){
						if(data == 1){
							$('#sent_message_id_'+$('#edit_msg_id').val()+'>p').html($.trim($('#message_input').val()));
						}
					}
					else{
						 loadMessages(2); // 2: last message only
					}

                    $("#attachment").val('');
                    $('#reply_msg_id').val('')
                    $('#reply_msg').html('')
                    $('#edit_msg_id').val('')
                    $('#message_input').val("");
					container.scrollTop = 20000;
                   // $(".message_div").animate({ scrollTop: 20000 }, "fast");
                }
            });
        }
    });

	editMessage = function editMessage(id, message){
		$('#edit_msg_id').val(id)
		$('#message_input').val(message)
	}



    replyMessage = function replyMessage(id, msg){
        $('#reply_msg_id').val(id)
		$('#reply_msg').html(msg)
    }

	$('#message_input').on('keydown', function(e) {
		//alert(e.which);
		if (e.which == 13) {
			$('#message_sent_button').trigger('click');
			return false;
		}
	});

	set_adminmessage_time_out_fn = function set_adminmessage_time_out_fn(){
		//alert('timeout');
		setTimeout(function(){
				newAdminMessages();
			}, 15000);
	}

	newAdminMessages = function newAdminMessages(){
		//alert('newAdminMessages')
		if($('.receive_msg:last').length>0){
			last_admin_user_message = $('.receive_msg:last').attr('id').split('_');
			last_admin_message_id = last_admin_user_message[3];
		}
		loadMessages(4);
		set_adminmessage_time_out_fn();
	}
	newAdminMessages();



	function loadMoreMessages(){
		//alert(1)
		loadMessages(3);
	}

	$('.panel-scroll').perfectScrollbar({
		wheelSpeed: 50,
		minScrollbarLength: 20,
		suppressScrollX: true
	},{
		'ps-y-reach-end':loadMoreMessages()
	});


</script>




