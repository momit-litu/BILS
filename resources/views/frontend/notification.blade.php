<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" clip-notification-2 "></i>
		Notifications
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('notification')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">

			<div id="allNotificationGrid" class="panel-group accordion accordion-custom accordion-teal in" style="display:block !important">

			</div>
	</div>
</div>




<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
	//alert("NOtification");
    page = 1

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


    notificationView = (id) =>{
        //$('#'+id).css('style','color=gray')
        $.ajax({
            url: "{{ url('app/')}}/notification_view/"+id,
            type: 'GET',
            async: true,
            success: function (response) {
            }
        })
    }

    loadAllNotifications = (type) =>{

        $.ajax({
            url: "{{ url('app/')}}/all_notifications/"+page,
            type:'GET',
            async:false,
            success: function(response){

                response = JSON.parse(response)
                //console.log(response)
                loadMore = '<button onclick="loadAllNotifications(2);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>';
                count = 0;
                html = ''
                $.each(response, function (key, value) {
                    count++;

                    if(value.status == 0 ){
                        //style = 'style="background: #F5DED9"'
                        style = 'style = "color:red"'

                    }else{
                        style = ''
                    }
                    // alert(value.admin_message)

                    //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                    details = value.details==null ? "" : value.details
                    html +='<div class="panel panel-default" > ' +
                        '       <div class="panel-heading"> ' +
                        '           <h4 class="panel-title"> ' +
                        '               <a href="#faq_1_4'+value.id+'" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed" id="'+value.id+'" onclick="notificationView('+value.id+')" '+style+'> ' +
                        '                   <i class="icon-arrow"></i>' +
                                            value.title +
                        '                </a>' +
                        '           </h4> ' +
                        '       </div> ' +
                        '       <div class="panel-collapse collapse" id="faq_1_4'+value.id+'"> ' +
                        '           <div class="panel-body">'+value.msg_date+'<hr>'+details+'</div> ' +
                        '       </div> ' +
                        '   </div>'

                })
                if(type==2){
                    $('#allNotificationGrid').append(html)
                }
                else{
                    $('#allNotificationGrid').html(loadMore+' '+html)
                }

            }

        })
        page++;
       // all_notification_reload(1)
    }
    loadAllNotifications()
</script>




