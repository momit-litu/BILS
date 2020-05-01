// All the user related js functions will be here
$(document).ready(function () {

	// for get site url
	var url = $('.site_url').val();
	var number_of_msg = 10;
	var loaded = 1;



	//Load App User Group Using Notice Controller
	$.ajax({
		url: url+'/notice/load-app-user-groups',
		success: function(response){
			var data = JSON.parse(response);
			if(!jQuery.isEmptyObject(data)){
				var html = '<table class="table table-bordered"><thead><tr class="headings"><th class="column-title text-left" class="col-md-8 col-sm-8 col-xs-8" >App User Groups</th><th class="col-md-2 col-sm-2 col-xs-12"> <input type="checkbox" id="check-all" class="tableflat">Select All</th></tr></thead>';
					html += '<tr><td colspan="2">';
					$.each(data, function(i,data){
						html += '<div class="col-md-3" style="margin-top:5px;"><input type="checkbox"  name="app_user_group[]"  class="tableflat check_permission"  value="'+data["id"]+'"/> '+data["group_name"]+'</div>';
					});
					html += '</td></tr>';
				html +='</table>';
			}
			$('#app_user_group').html(html);

			$('#message_form').iCheck({
					checkboxClass: 'icheckbox_flat-green',
					radioClass: 'iradio_flat-green'
			});

			$('#message_form input#check-all').on('ifChecked', function () {

				$("#message_form .tableflat").iCheck('check');
			});
			$('#message_form input#check-all').on('ifUnchecked', function () {

				$("#message_form .tableflat").iCheck('uncheck');
			});

		}
	});

	//Message Entry And update
	$('#save_message ').click(function(event){
		event.preventDefault();
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		var formData = new FormData($('#message_form')[0]);
		if($.trim($('#admin_message').val()) == ""){
			success_or_error_msg('#form_submit_error','danger',"Please Insert Message","#admin_message");
		}
		// if( $('#app_user_group').checked==true ){
		// 	success_or_error_msg('#form_submit_error','danger',"Please Select App User Name Or app Urser group");
		// }

		else{
			$.ajax({
				url: url+"/message/message-entry",
				type:'POST',
				data:formData,
				async:false,
				cache:false,
				contentType:false,
				processData:false,
				success: function(data){
					var response = JSON.parse(data);

					if(response['result'] == '0'){
						var errors	= response['errors'];
						resultHtml = '<ul>';
							$.each(errors,function (k,v) {
							resultHtml += '<li>'+ v + '</li>';
						});
						resultHtml += '</ul>';
						success_or_error_msg('#master_message_div',"danger",resultHtml);

						clear_form();
					}
					else{
						success_or_error_msg('#master_message_div',"success","Save Successfully");

						message_table.ajax.reload();
						clear_form();
						$("#message_entry").html(' Add Message');
						$(".save").html('Save');
						$("#message_list").trigger('click');
						$("#message_form .tableflat").iCheck('uncheck');
					}
					$(window).scrollTop();
				 }
			});
		}
	});

	//Publication Data Table
	var message_table = $('#message_table').DataTable({
		destroy: true,
		"processing": true,
		"serverSide": false,
		"ajax": url+"/message/sent-message-list",
		"aoColumns": [
			// { mData: 'id'},
			//{ mData: 'message_id' },
			//{ mData: 'admin_id'},
			{ mData: 'admin_message'},
			{ mData: 'message_category'},
			{ mData: 'app_user_name'},
			{ mData: 'is_seen', className: "text-center"},
			{ mData: 'status', className: "text-center"},
			{ mData: 'actions' , className: "text-center"},
		],
	});

	//Message View
	message_view = function message_view(id){
		var id = id;
		$.ajax({
			url: url+'/message/message-view/'+id,
			success: function(response){
				var data = JSON.parse(response);
				$("#admin_user_view").modal();
				$("#modal_title").html("Message View");
				var message_info = "";

				$("#modal_body").html(message_info);
			}
		});
	}

	//Message Delete
	delete_message = function delete_message(id){
		var delete_id = id;
		swal({
			title: "Are you sure?",
			text: "You wants to delete item parmanently!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: url+'/message/message-delete/'+delete_id,
					cache: false,
					success: function(response){
						var response = JSON.parse(response);
						swal(response['deleteMessage'], {
						icon: "success",
						});
						message_table.ajax.reload();
					}
				});
			}
			else {
				swal("Your Data is safe..!", {
				icon: "warning",
				});
			}
		});
	}

	//Publication Edit
	/*edit_publication = function edit_publication(id){
		var edit_id = id;
		$.ajax({
			url: url+'/publication/publication-edit/'+edit_id,
			success: function(response){
				var data = JSON.parse(response);
				$("#publication_entry").trigger('click');
				$("#publication_entry").html('Publication Update');
				$("#save_publication").html('Update');
				$("#publication_edit_id").val(data['id']);
				$("#publication_title").val(data['publication_title']);
				$("#details").val(data['details']);
				$("#authors").val(data['authors']);
				$("#publication_type").val(data['publication_type']).change();
				(data['status']=='1')?$("#is_active").iCheck('check'):$("#is_active").iCheck('uncheck');
			}
		});
	}*/












/*
	$(window).on('keydown', function(e) {
		alert('enter')
		if (e.which == 13) {
			newMsgSent();
			return false;
		}
	});
*/





	//autosuggest
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#app_user_name").autocomplete({

		search: function() {
		},
		source: function(request, response) {
			$.ajax({
				url: url+'/notice/app-user-name',
				dataType: "json",
				type: "post",
				async:false,
				data: {
					term: request.term
				},
				success: function(data) {
					response(data);
				}
			});
		},
		minLength: 2,
		select: function(event, ui) {
			var id = ui.item.id;

			$(this).next().val(id);
			$("#app_user_id").val(id);

		}
	});


	showProfile = function showProfile(id){
		$("#app_user_id").val();
        $("#app_user_id_profile").val(id)
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



	//load Message Category


	//App User Group Member
	$('#load_app_user_from_group ').click(function(event){
		event.preventDefault();
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		var formData = new FormData($('#message_form')[0]);


			$.ajax({
				url: url+"/message/load-app-user-from-group",
				type:'POST',
				data:formData,
				async:false,
				cache:false,
				contentType:false,
				processData:false,
				success: function(data){
					var response = JSON.parse(data);
					var html = '<table class="table table-bordered"><thead><tr class="headings"><th class="column-title text-left" class="col-md-8 col-sm-8 col-xs-8" >App Users</th><th class="col-md-2 col-sm-2 col-xs-12"> </th></tr></thead>';
					html += '<tr><td colspan="2">';
					$.each(response, function(i,row){
						$.each(row, function(j,k){
							html += '<div class="col-md-3" style="margin-top:5px;"><input type="checkbox"  name="app_users[]"  class=""  value="'+k["app_user_id"]+'"/> '+k["name"]+'</div>';
						});
					});
					html += '</td></tr>';
					html +='</table>';
					$("#app_user_group_members").html(html);
					$('.form').iCheck({
						checkboxClass: 'icheckbox_flat-green',
						radioClass: 'iradio_flat-green'
					});

					$('.flat_radio').iCheck({
						radioClass: 'iradio_flat-green'
					});
				 }
			});

	});





    //Clear form
	$("#clear_button").on('click',function(){
		clear_form();
	});

	// icheck for the inputs
	$('.form').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});

	$('.flat_radio').iCheck({
		radioClass: 'iradio_flat-green'
	});



    if(localStorage.getItem('app_user_id')){
        loadMessage(localStorage.getItem('app_user_id'), number_of_msg)
        localStorage.removeItem('app_user_id')
    }

    if(localStorage.getItem('group_id')){
        $('#message_category_group').val(localStorage.getItem('category_id'))
        loadGroupMessage(localStorage.getItem('group_id'), number_of_msg, localStorage.getItem('category_id'))
        localStorage.removeItem('group_id')
        localStorage.removeItem('category_id')

    }


    // Javascript for category message


    loadCategoryMessage = (user_category_id, number_of_msg) =>{
        //alert('group')

        $('#reply_msg_id').val(null)
        $('#reply_msg').html('')
        $("#search_app_user_group").val("");
        //event.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url+'/message/load-category-message',
            type:'POST',
            data:{
                category:user_category_id,
                msg_no:number_of_msg,

            },
            async:false,
            success: function(response){

                $('#category_id').val(user_category_id)

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

                            html += '<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />';


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

        //set_time_out_fn(user_group_id, number_of_msg);

    }


    $.ajax({
        url: url+"/message/get-message-category",
        success: function(response){
            var response = JSON.parse(response);
            if(!jQuery.isEmptyObject(response)){
                var html = '<div class="msg_auto_load">';
                $.each(response, function(i,row){

                    html+='<li onclick="loadCategoryMessage('+row["id"]+','+number_of_msg+')" class="contact ">';
                    html+='<div class="wrap">';


                    html+='<img src="'+app_user_profile_url+'/no-user-image.png" alt="" />';

                    html+='<div class="meta">';
                    html+='<p class="name">'+row["category_name"]+'</p>';
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



    $("#search_message_category").keyup(function(){

        key = $('#search_message_category').val()
        $.ajax({
            url: url+"/message/search-message_category/"+key,
            success: function(response){
                var response = JSON.parse(response);
                if(!jQuery.isEmptyObject(response)){
                    var html = '<div class="msg_auto_load">';
                    $.each(response, function(i,row){

                        html+='<li onclick="loadCategoryMessage('+row["id"]+')" class="contact ">';
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








});




