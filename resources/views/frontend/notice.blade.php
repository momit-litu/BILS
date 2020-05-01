<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" clip-notification-2 "></i>
		Notice
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('notice')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
		<div id="timeline" class="demo1">
			<div class="timeline" id="all_notice">
				<!--div class="spine"></div>
				<div class="date_separator">
					<span>NOVEMBER 2014</span>
				</div>
				<ul class="columns">
					<li>
						<div class="timeline_element teal">
							<div class="timeline_title">
								<span class="timeline_label">Event Title</span><span class="timeline_date">03 November 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-info">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline_element green">
							<div class="timeline_title">
								<span class="timeline_label">Event Title</span><span class="timeline_date">11 November 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-bricky">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
				</ul>
				<div class="date_separator">
					<span>DECEMBER 2014</span>
				</div>
				<ul-- class="columns">
					<li>
						<div class="timeline_element bricky">
							<div class="timeline_title">
								<span class="timeline_label">Event Title</span><span class="timeline_date">08 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-warning">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline_element purple">
							<div class="timeline_title">
								<span class="timeline_label">Event Title</span><span class="timeline_date">12 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-dark-grey">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline_element">
							<div class="timeline_title">
								<span class="timeline_label">Event Title</span><span class="timeline_date">16 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-info">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline_element teal">
							<div class="timeline_title">
								<span class="timeline_label">Event Title</span><span class="timeline_date">18 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-dark-beige">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
				</ul-->
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready( function(){
        //alert("NOtice");


    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


    loadNotice = function loadNotice(){//

        $.ajax({
            url: "{{ url('app/')}}/load-notice",
            type:'get',
            async:false,
            success: function(response) {
                var response = JSON.parse(response);
                if(!jQuery.isEmptyObject(response)){
                    html = "";
                    noticeMonth = -1
                    noticeYear = -1

                    $.each(response, function(i,notice){
                        date = new Date(notice['created_at']);
                        year= date.getFullYear();
                        month = date.getMonth();
                        day = date.getDate();
                        noticDate = new Date(year+'-'+month+'-'+day)
                        noticDate = noticDate.toDateString()

                        if(noticeMonth!=month || noticeYear!=year){
                            noticeMonth = month
                            noticeYear = year
                            //newMonth = noticDate.getMonth()
                            //console.log(newMonth)
                            if(html!=''){
                                html+='</ul>'
                            }
                            html+= '<div class="date_separator"> ' +
                                '       <span>'+noticDate+'</span> ' +
                                '   </div>' +
                                '<ul class="columns">\n'
                        }

                        html+='<li>' +
                            '   <div class="timeline_element teal">\n' +
                            '     <div class="timeline_title">\n' +
                            '       <span class="timeline_label">'+notice["title"]+'</span><span class="timeline_date">'+noticDate+'</span>\n' +
                            '     </div>\n' +
                            '     <div class="content">\n' + notice["details"]+
                            '     </div>\n' +
                            '     <div class="readmore">\n' +
                            '       <a href="#" class="btn btn-dark-beige">\n' +
                            '        Read More <i class="fa fa-arrow-circle-right"></i>\n' +
                            '       </a>\n' +
                            '     </div>\n' +
                            '    </div>\n' +
                            '  </li>'

                    });

                    html+='</ul>'

                    $('#all_notice').html(html)
                }
            }
        });

    }

    loadNotice()

});

</script>




