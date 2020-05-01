<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class="clip-bubble-4"></i>
		{{__('app.Message')}}
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="loadNewMessaeg()">
				<i class="fa fa-refresh"></i>
			</a>

		</div>
	</div>
    <div class="content">

        <div class="panel-body panel-scroll ps-container ps-active-y fixed-panel message_div" >
            <ol class="discussion" id="message_body">
                <!--li class="other">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-4.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                        <span class="time"> 51 min </span>
                    </div>
                </li>
                <li class="self">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-1.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                        <span class="time"> 37 mins </span>
                    </div>
                </li>
                <li class="other">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-3.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                    </div>
                </li>
                <li class="self">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-1.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                    </div>
                </li>
                <li class="other">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-4.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                    </div>
                </li>




                <li class="self">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-1.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                    </div>
                </li>


                <li class="other" id="receive_message_id_109">
                    <div class="avatar">
                        <img style="width:25px;height:25px;"  src="http://bils.test/assets/images/user/admin/1585081916.jpg" alt="" />
                    </div>
                    <div class="messages">
                        <p class="left">saaskljdf</p>
                    </div>
                    <span class="time_date">
                        <a href="javascript:void(0)" onclick="replyMessage(109,'saaskljdf')" class="margin-right-2 text-success">
                            <i class="fa fa-mail-reply"></i>
                         </a>2020-05-01 07:07:59
                    </span>
                </li>
                <li class="other">
                    <div class="avatar">
                        <img alt="" src="assets/images/avatar-4.jpg">
                    </div>
                    <div class="messages">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>
                    </div>

                </li-->

            </ol>
            <div class="ps-scrollbar-x-rail" style="width: 323px; display: none; left: 0px; bottom: -263px;">
                <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
            </div><div class="ps-scrollbar-y-rail" style="top: 266px; height: 460px; display: inherit; right: 3px;">
                <div class="ps-scrollbar-y" style="top: 169px; height: 291px;"></div>
            </div>
        </div>
        <div class="col-sm-12 padding-left-0 padding-right-0">
		    <div class="chat-form ">
			<div class="input-group">
				<span class="input-group-btn dropup ">
					<button type="button" class="btn btn-warning dropdown-toggle btn-custom-side-padding border-radious-0" data-toggle="dropdown">
						<span class="caret"></span>
					</button>

					<div class="dropdown-menu dropdown-enduring dropdown-checkboxes">
						<input type="text" placeholder="Search Category" id="form-field-9" class="form-control">
					</div>

					<ul class="dropdown-menu">
						<li>
							<a href="#">
								Category 1
							</a>
						</li>
						<li>
							<a href="#">
								Category 2
							</a>
						</li>
					</ul>
				</span>
                <form id="sent_message" name="sent_message" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                    <input type="hidden" id="reply_msg_id">
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
                </form>

			</div>
		</div>
	    </div>
    </div>
</div>




<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
$(document).ready(function(){
    //var url = $('.site_url').val();
    var number_of_msg = 20;
    var current_page_no = 1;
    var loaded = 1;
    var last_admin_message_id = "";

    var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
    var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var admin_image_url = "<?php echo asset('assets/images/user/admin'); ?>";


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
                    $("#attachment").val('');
                    $('#reply_msg_id').val(null)
                    //$('#reply_msg').html(null)
                    //$('#edit_msg_id').val(null)
                    loadMessages(2); // 2: last message only
                    $('#message_input').val("");
                    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                    //loadAppUser();
                }
            });
        }

    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    removeMessage = (id, message)=>{
        alert(1)
        /*$.ajax({
            url: "{{ url('app/')}}/delete-message/"+id,
            type: 'GET',
            async: false,
            success: function (response) {
                //alert(2)
                if($('#sent_message_id_'+id).prev().hasClass('reply')){
                    $('#sent_message_id_'+id).prev().remove();
                }
                $('#sent_message_id_'+id).next('span').remove();
                $('#sent_message_id_'+id).remove();

                $('#admin_message').val("");
            }
        })*/
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
                ajaxPreLoad()
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
                            if(message["reply_message"]){
                                html+='<p class="reply replied_message_p" ">'+message['reply_message']+'</p> ';
                            }
                            html += '<li class="self" id="sent_message_id_'+message['id']+'">';

                            if($.trim(message['app_user_image']) == "null" || $.trim(message['app_user_image']) == ""  ) app_user_image = "no-user-image.png";
                            else  									 	app_user_image = message['app_user_image'];
                            html += '<div class="avatar"><img style="width:25px;height:25px; cursor:pointer" title="" src="'+app_user_profile_url+'/'+app_user_image+'" alt="" /></div>';

                            if (message["app_user_message"]!=null && message["app_user_message"]!="") {
                                html += '<div class="messages"><p">'+message["app_user_message"]+'</p></div>';
                            }else{
                                html+="";
                            }
                            if(message["is_attachment"]==1){
                                html+="<div class='attachment_div'>";
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
                                        html += '<a href="'+msg_image_url+'/'+attachment_name+'" download><p class="right" style="word-wrap: break-word;">'+message["app_user_atachment"]+'</p></a>';
                                    }
                                }
                                html+="</div>";
                            }
                            html+='</li>'

                            if (message["category_name"]!=null && message["category_name"]!="") {
                                mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                            }
                            else{
                                mc = "";
                            }
                            tem_msg = "'"+message['app_user_message']+"'";

                            html += '<span class="time_date_sent">'+mc+' '+message["msg_date"]+'<a href="javascript:void(0)" onclick="removeMessage('+message["id"]+','+tem_msg+')" class="margin-left-2 text-danger"><i class="clip-remove"></i></a><a href="javascript:void(0)" onclick="editMessage('+message["id"]+','+tem_msg+')" class="margin-left-2"><i class="fa fa-pencil"></i></a></span>';
                        }
                        else if( (message["admin_id"] != null && message["admin_id"] != "" ) && ((message["admin_message"]!=null && message["admin_message"]!="") || ( message["is_attachment"]!=""&& message["is_attachment"]!=null )) ){
                            //alert(message['id']+'admin')

                            //html+='<li class="other">'

                            if(message["replied"]){
                                html+='<p class="receive_msg reply" style="margin-bottom: -15px;padding-left: 30px;"><p class="replied_message_p" ">'+message['reply_message']+'</p></p>  ';
                            }
                            html += '<li class="other" id="receive_message_id_'+message['id']+'">';
                            if($.trim(message['admin_image']) == "null" || $.trim(message['admin_image']) == ""  ) admin_image = "no-user-image.png";
                            else  									 	admin_image = message['admin_image'];
                            html += '<div class="avatar"><img style="width:25px;height:25px;"  src="'+admin_image_url+'/'+admin_image+'" alt="" /></div>';

                            if (message["admin_message"]!=null && message["admin_message"]!="") {
                                html += '<div class="messages"><p class="left">'+message["admin_message"]+'</p></div>';
                            }
                            if( (message["admin_message"]!=null && message["admin_message"]!="")&& (message["is_attachment"]==1) ){
                                html+="";
                            }
                            if(message["is_attachment"]==1){
                                html+="<div class='attachment_div' style=' display: inline-block;  padding:10px 15px 10px 40px;  max-width: 80%;  line-height: 130%;'>";
                                attachements = message["admin_atachment"].split(',');
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
                            html += '</li>';

                            if (message["category_name"]!=null && message["category_name"]!="") {
                                mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">'+message["category_name"]+'</div>';
                            }
                            else{
                                mc = "";
                            }
                            tem_msg = "'"+message['admin_message']+"'";
                            html += '<span class="time_date">'+'<a href="javascript:void(0)" onclick="replyMessage('+message["id"]+','+tem_msg+')" class="margin-right-2 text-success"><i class="fa fa-mail-reply"></i></a>'+message["msg_date"]+' '+mc+'</span>';
                        }

                        //console.log(html)
                        message_body = html+message_body;
                    });
                }
                //loadAppUser();
                if(message_body != ""){
                    if(message_load_type == 1){ // 1: all message dump
                        //alert('1:change all message')
                        $("#message_body").html(message_body);
                        //$(".message_div").animate({ scrollTop: 180000/*$(document).height()*/ }, "fast");
                        current_page_no=2;
                    }
                    // 2: get last message which just entered by admin
                    // load appuser last message
                    else if(message_load_type == 2 || message_load_type == 4){
                        //alert('1:add last mesage')
                        var html_tag = $("#message_body");
                        html_tag.append(message_body);
                        //$(".message_div").animate({ scrollTop: 180000/*$(document).height()*/ }, "fast");

                    }
                    else if(message_load_type == 3){ // 3: get load more messages
                        //alert('1:add more all message')
                        // need to specify the las message <li> and make the slide animation accoring to that li
                        $(".message_div").animate({ scrollTop: $(document).height() }, "fast");
                        var html_tag = $("#message_body");
                        html_tag.prepend(message_body);
                        current_page_no++;
                    }
                }
                $('.content').unblock();
            }
        });

        $(".zoomImg").click(function(){
            var image_src = $(this).attr('src');
            $("#modalIMG").modal();
            $("#load_zoom_img").attr('src',image_src);
        });

        removeMessage()

    }

    loadMessages(1)


    replyMessage = (id, msg) =>{
        //alert('sdf')
        $('#reply_msg_id').val(id)
        $('#message_input').html(msg)
    }






});
</script>




