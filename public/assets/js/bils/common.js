
var number_of_msg = 10;

// className: danger, success, info, primary, default, warning
function success_or_error_msg(div_to_show, class_name, message, field_id){
	$(div_to_show).addClass('alert alert-custom alert-'+class_name).html(message).show("slow");
	//$(window).scrollTop(200);
	var set_interval = setInterval(function(){
		$(div_to_show).removeClass('alert alert-custom alert-'+class_name).html("").hide( "slow" );
		if(field_id!=""){ $(field_id).focus();}
		clearInterval(set_interval);
	}, 2000);
}

function clear_form(){
	$('.form')[0].reset();
}
$(document).ready(function () {
    var url = $('.site_url').val();


    viewMessage = (app_user_id, group_id, category_id) =>{

        if(group_id){
            //alert(group_id)
            $.ajax({
                url: url+"/message/admin-group-message-seen/"+group_id+"/"+category_id,
                type: 'GET',
                async: true,
                success: function (response) {
                    response = JSON.parse(response)
                    newNotifications();
                    //loadPage('notification')
                }
            })
            localStorage.setItem('group_id', group_id);
            localStorage.setItem('category_id', category_id);
            window.location.href =url+'/messages/group-messages-management';
        }else{
            $.ajax({
                url: url+"/message/admin-message-seen/"+app_user_id,
                type: 'GET',
                async: true,
                success: function (response) {
                    response = JSON.parse(response)
                    newNotifications();
                    //loadPage('notification')
                }
            })
            localStorage.setItem('app_user_id', app_user_id);
            window.location.href =url+'/messages/all-messages-management';

        }

    }

    set_notification_time_out_fn = () =>{
        setTimeout(function(){
            loadNotifications();
        }, 7000);
    }


    set_message_time_out_fn = function set_message_time_out_fn(){
        setTimeout(function(){
            newMessages();
        }, 5000);
    }



    newMessages = () =>{
		//alert(5555555);
        $.ajax({
            url: url+'/message/load-new-message',
            type:'GET',
            async:true,
            success: function(response){
                response = JSON.parse(response)


                html = '';
                count = 0;
                $.each(response, function (key, value) {
                    count++;
                    if(value.group_name && value.category_name) {
                        user = value.group_name + '(' + value.category_name + ')'
                    }
                    else {
                        user = value.app_user_name
                    }
                    //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                    if(value.app_user_message==null){
                        message = 'Attachment'
                    }
                    else message = value.app_user_message

                    html +='<li> ' +
                        '       <a href="#">' +
                        '           <div class="clearfix" onclick="viewMessage('+value.app_user_id+','+ value.group_id+','+value.category_id+')">' +
                        '               <div class="thread-image">' +
                        '                   <img alt="" src="'+url+'/assets/images/avatar-3.jpg"> ' +
                        '               </div> ' +
                        '               <div class="thread-content"> ' +
                        '                   <span class="author">'+user+'</span> ' +
                        '                   <span class="preview">'+message+'</span> ' +
                        '                   <span class="time">'+value.msg_date+'</span>' +
                        '               </div> ' +
                        '           </div>' +
                        '        </a>' +
                        '   </li>'

                })
                $('#badge').html(count)
                $('#message_top_unread').html('You have total '+count+' unread message')
                $('#message_header').html(html)
                //console.log(response)

            }
        })
        set_message_time_out_fn()
    }
    newMessages()

    view_notification = (id) =>{
        $.ajax({
            url: url+"/notification/notification_view/"+id,
            type: 'GET',
            async: true,
            success: function (response) {
                response = JSON.parse(response)
                newNotifications();
                //loadPage('notification')
            }
        })
    }



    loadNotifications = () =>{
        $.ajax({
            url: url+'/notification/load-new-notifications',
            type:'GET',
            async:true,
            success: function(response){
                response = JSON.parse(response)


                html = '';
                count = 0;
                $.each(response, function (key, value) {
                    count++;
                    if(value.group_name && value.category_name) {
                        user = value.group_name + '(' + value.category_name + ')'
                    }
                    else {
                        user = value.app_user_name
                    }
                    //alert(app_user_id+'>>'+group_id+'>>'+category_id)

                    html +=' <li> ' +
                            '<a href="javascript:void(0)" onclick="view_notification('+value.id+')"> ' +
                                '<span class="label label-primary"><i class="fa fa-user"></i></span> ' +
                                '<span class="message"> '+value.notification+'</span> ' +
                                '<span class="time"> '+value.created_at+'</span> ' +
                            '</a> ' +
                            '</li>'

                })
                $('#notificationCount').html(count)
                $('#notification_list').html(html)
                //console.log(response)

            }
        })
        set_notification_time_out_fn()
    }
    loadNotifications()






})

