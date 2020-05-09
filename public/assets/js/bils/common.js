var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
var admin_image_url = "<?php echo asset('assets/images/user/admin'); ?>";


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
                url: url+"/message/admin-group-message-seen/"+group_id,
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
                lastMessageNotificationId = 0
                $.each(response, function (key, value) {
                    date = new Date(value["msg_date"]+ 'Z');
                    msg_date = date.toLocaleString ()
                    lastMessageNotificationId = lastMessageNotificationId<value.id ? value.id : lastMessageNotificationId;
                    count++;
                    //alert(value.group_name)
                    if(value.group_name) {
                        //alert(1)
                        user = value.app_user_name+' ('+value.group_name+')'
                    }
                    else {
                        user = value.app_user_name
                    }
                    //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                    if(value.app_user_message==null){
                        message = 'You have a new Attachment'
                    }
                    else {
                        message = (value.app_user_message).substr(0, 40)+'. . .'
                    }

                    html +='<li> ' +
                        '       <a href="#">' +
                        '           <div class="clearfix" onclick="viewMessage('+value.app_user_id+','+ value.group_id+','+value.category_id+')">' +
                        '               <div class="thread-image">' +
                        '                   <img alt="" src="'+url+'/assets/images/user/app_user/'+value.user_profile_image+'" style="height: 50px; width: 40px"> ' +
                        '               </div> ' +
                        '               <div class="thread-content"> ' +
                        '                   <span class="author">'+user+'</span> ' +
                        '                   <span class="preview">'+message+'</span> ' +
                        '                   <span class="time">'+msg_date+'</span>' +
                        '               </div> ' +
                        '           </div>' +
                        '        </a>' +
                        '   </li>'

                })

                if(localStorage.getItem('lastMessageNotificationId')<lastMessageNotificationId){
                    document.getElementById("myAudio").play();
                    localStorage.setItem('lastMessageNotificationId',lastMessageNotificationId)
                }else  if(lastMessageNotificationId>0) {
                    if(!localStorage.getItem('lastMessageNotificationId')) {
                        document.getElementById("myAudio").play();
                    }

                    localStorage.setItem('lastMessageNotificationId',lastMessageNotificationId)
                }

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
                notificationId = 0;
                $.each(response, function (key, value) {
                    date = new Date(value["created_at"]+ 'Z');
                    created_at = date.toLocaleString ()
                    notificationId = notificationId<value.id? value.id : notificationId
                    count++;
                    if(value.group_name && value.category_name) {
                        user = value.group_name + '(' + value.category_name + ')'
                    }
                    else {
                        user = value.app_user_name
                    }
                    //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                    //image = ' <img alt="" src="'+url+'/assets/images/user/app_user/'+value.user_profile_image+'" style="height: 50px; width: 40px"> ' +

                    html +=' <li> ' +
                            '<a href="javascript:void(0)" onclick="view_notification('+value.id+')"> ' +
                                '<span class="label label-primary"><i class="fa fa-user"></i></span> ' +
                                '<span class="message"> '+value.notification+'</span> ' +
                                '<span class="time"> '+created_at+'</span> ' +
                            '</a> ' +
                            '</li>'

                })

                if(localStorage.getItem('lastNotificationId')<notificationId){
                    document.getElementById("lastMessageNotificationId").play();
                    localStorage.setItem('lastNotificationId',notificationId)
                }else  if(notificationId>0) {
                    if(!localStorage.getItem('lastNotificationId')){
                        document.getElementById("lastMessageNotificationId").play();
                    }

                    localStorage.setItem('lastNotificationId',notificationId)
                }

                $('#notificationCount').html(count)
                $('#notification_list').html(html)
                //console.log(response)

            }
        })
        set_notification_time_out_fn()
    }
    loadNotifications()






})

