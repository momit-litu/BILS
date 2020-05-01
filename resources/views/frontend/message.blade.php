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
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel" >
		<ol class="discussion" id="message_body">
			<li class="other">
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
		</ol>
	<div class="ps-scrollbar-x-rail" style="width: 323px; display: none; left: 0px; bottom: -263px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 266px; height: 460px; display: inherit; right: 3px;"><div class="ps-scrollbar-y" style="top: 169px; height: 291px;"></div></div></div>
	<div class="col-sm-12 padding-left-0 padding-right-0">
		<div class="chat-form ">
		<form id="sent_message" name="sent_message" enctype="multipart/form-data">
			<div class="input-group">
				<span class="input-group-btn dropup ">
					<button type="button" class="btn btn-warning dropdown-toggle btn-custom-side-padding border-radious-0" data-toggle="dropdown">
						<span class="caret"></span>
					</button>

					<div class="dropdown-menu dropdown-enduring dropdown-checkboxes">
						<input type="text" placeholder="Search Category" id="form-field-9" class="form-control">
					</div>
					<!--
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
					</ul>-->
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
			 </form>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){

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
                    //$('#reply_msg_id').val(null)
                    //$('#reply_msg').html(null)
                    //$('#edit_msg_id').val(null)
                    loadMessage();
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


    loadMessage = function loadMessage(){//
        //$("#search_app_user").val("");
        //event.preventDefault();
        //alert('ok');

        $.ajax({
            url: "{{ url('app/')}}/load-message",
            type:'get',
            async:false,
            success: function(response) {
                var response = JSON.parse(response);

                var message = response['message'];
                var app_user_name = response['app_user_name'];
                var img_id="";
                var mc;
                //Messages

                var message_body = "";
                if(!jQuery.isEmptyObject(message)){
                    message_body = "";

                    $.each(message, function(i,message){
                        html = "";

                        if( (message["admin_id"] != null && message["admin_id"] != "" ) && ((message["admin_message"]!=null && message["admin_message"]!="") || ( message["is_attachment"]!=""&& message["is_attachment"]!=null )) ){
                            html+='<li class="other"> ' +
                                '   <div class="avatar"> ' +
                                '       <img alt="" src="assets/images/avatar-4.jpg"> ' +
                                '   </div> ' +
                                '   <div class="messages"> ' +
                                '       <p>'+message['admin_message']+' </p> ' +
                                '   </div> ' +
                                '  </li>'
                        }
                        else if( (message["app_user_message"]!=null && message["app_user_message"]!="") || ( message["is_attachment_app_user"]!=""&& message["is_attachment_app_user"]!=null ) ){
                            //alert(message['app_user_message'])

                            html+='<li class="self"> ' +
                                '   <div class="avatar"> ' +
                                '       <img alt="" src="assets/images/avatar-4.jpg"> ' +
                                '   </div> ' +
                                '   <div class="messages"> ' +
                                '       <p>'+message['app_user_message']+' </p> ' +
                                '   </div> ' +
                                '  </li>'
                           // alert(1)
                        }
                        message_body = html+message_body;

                    });

                    //console.log(html)

                    $('#message_body').html(message_body)

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

  //  loadMessage()




});
</script>




