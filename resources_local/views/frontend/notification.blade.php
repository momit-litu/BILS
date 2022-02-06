@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" clip-notification-2 "></i>
		{{__('app.Notifications')}}
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="javascript:void(0)">
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
				if($('#notification_'+id).hasClass('alert-warning-important'))
				$('#notification_'+id).removeClass('alert-warning-important');
				$('#notification_'+id).addClass('alert-success-important');
            }
        })
    }

    loadAllNotifications = (type) =>{
        $.ajax({
            url: "{{ url('app/')}}/all_notifications/"+page,
            type:'GET',
            async:true,
            beforeSend: function( xhr ) {
                ajaxPreLoad()
                //$("#load-content").fadeOut('slow');
            },
            success: function(response){
                $('#load-content').unblock();

                response = JSON.parse(response)
                //console.log(response)
                //loadMore = '<button onclick="loadAllNotifications(2);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>';
                count = 0;
                html = ''
                $.each(response, function (key, value) {
                    count++;
                    date = new Date(value["msg_date"]+ 'Z');
                    notificationDate 	= date.toLocaleString ();

					if(value.status==0){
						unseen = 'alert-warning-important';
					}else unseen = 'alert-success-important';

					if(value.module_id==7) title = '{{__('app.New_Course')}} : '+value['title'];
					else if(value.module_id==37) title = '{{__('app.New_Notice')}}: '+value['title'];
					else if(value.module_id==38) title = '{{__('app.New_Publication')}}: '+value['title'];
					else title = value.title

                    //alert(app_user_id+'>>'+group_id+'>>'+category_id)
                    details = value.details==null ? "" : value.details
                    html +='<div class="panel panel-default" > ' +
                        '       <div class="panel-heading"> ' +
                        '           <h4 class="panel-title"> ' +
                        '               <a href="#faq_1_4'+value.id+'" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed '+unseen+'" id="notification_'+value.id+'" onclick="notificationView('+value.id+')"> ' +
                        '                   <i class="icon-arrow"></i>' +
                                            title +
                        '                </a>' +
                        '           </h4> ' +
                        '       </div> ' +
                        '       <div class="panel-collapse collapse" id="faq_1_4'+value.id+'"> ' +
                        '           <div class="panel-body">'+notificationDate+'<hr>'+details+'</div> ' +
                        '       </div> ' +
                        '   </div>'

                })
                if(html!=''){
                    if(type==2){
                        $('#allNotificationGrid').append(html)
                    }
                    else{
                        $('#allNotificationGrid').html(html)
                    }
                    page++;
                }


            }

        })
       // all_notification_reload(1)
    }
    loadAllNotifications(1)

    // load more when scroll reachs to bottom of the scrolling div
    $('.fixed-panel').on('scroll', function() {
        if ($(this).scrollTop() + $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            loadAllNotifications(2)
        }
    });
    //------------------------------------------------end------------------------------------------

    // refreash button
    $('.panel-tools .panel-refresh').on('click', function(e) {
        var el = $(this).parents(".panel");
        el.block({
            overlayCSS: {
                backgroundColor: '#fff'
            },
            message: '<img src={{ asset('assets/images/loading.gif') }} /> Loading...',
            css: {
                border: 'none',
                color: '#333',
                background: 'none'
            }
        });
        window.setTimeout(function() {
            page =1;
            loadAllNotifications(1)
            el.unblock();
        }, 1000);
        e.preventDefault();
    });
</script>




