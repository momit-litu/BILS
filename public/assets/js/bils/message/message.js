// All the user related js functions will be here
$(document).ready(function () {

	// for get site url
	var url = $('.site_url').val();
	var number_of_msg = 10;
	var loaded = 1;


	//load message categories
        $.ajax({
            url: url+"/message/get-message-category",
            success: function(response){
                var data = JSON.parse(response);
                var option = '<option value="">&nbsp;</option>';
                $.each(data, function(i,data){
                    option += "<option value='"+data['id']+"'>"+data['category_name']+"</option>";
                });
                $("#message_category").html(option)
                $("#message_category").select2({
                    placeholder: "Categoty/Topic",
                    allowClear: true
                });
            }
        });


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
		if($.trim( $("#admin_message").val()) == ""){
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
                        //location.reload();

						clear_form();
					}
					else{
						success_or_error_msg('#master_message_div',"success","Save Successfully");
                        $('#message_form').trigger("reset");
						message_table.ajax.reload();
                        location.reload();
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
	// need the edit message

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
		$('.summernote').summernote('code',"");
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



});




