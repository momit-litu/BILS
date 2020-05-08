<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" clip-notification-2 "></i>
		Notice
		<form class="sidebar-search">
			<div class="form-group">
				<input type="text" placeholder="Start Searching..." data-default="130" style="width: 130px;">
				<button class="submit">
					<i class="clip-search-3"></i>
				</button>
			</div>
		</form>
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('notice')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
		<div id="timeline" class="demo1">
			<div class="timeline" id="all_notice">
			</div>
		</div>
	</div>
</div>


<script>
    var attachment_url = "<?php echo asset('assets/attachment/notice'); ?>";
    var page =1;

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    noticeDetails = (id) =>{
        $.ajax({
            url: "{{ url('app/')}}/load-notice-details/"+id,
            type: 'get',
            async: false,
            success: function (response) {
                //console.log(response)

                response = JSON.parse(response);
				var notice_date = new Date(response[0]["notice_date"]+ 'Z');
				notice_date 	= notice_date.toDateString()+" "+notice_date.getHours()+":"+notice_date.getMinutes();

                let p = '<p style="text-align:right font-weight-bold"> '+notice_date+'</p> '
                let attachment = '';
                if(response[0]['attachment']){
                    //attachment = attachment_url+'/'+response[0]['attachment'];
                    attachment = '<br><a href="'+attachment_url+'/'+response[0]["attachment"]+'" download><i class="clip-attachment"></i></a>'
                }
                //alert(p)
                $('#modal_title_content').html(response[0]['title']+''+attachment);
                $('#modal_body_content').html(p+' <hr>'+response[0]['details'])
                $('#responsive').modal()
            }
        })

    }


    loadNotice = function loadNotice(type){
        text = 'a'
        if($(search_input).val()!=null && $(search_input).val()!=''  ) {
            //alert(1)
            text = $(search_input).val()
        }        $.ajax({
            url: "{{ url('app/')}}/load-notice/"+page+'/'+text,
            type:'get',
            async:false,
            success: function(response) {
                var response = JSON.parse(response);
                if(!jQuery.isEmptyObject(response)){
                    html = "";
                    noticeMonth = -1
                    noticeYear = -1
                    loadMore = '<button onclick="loadNotice(2);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>';


                    $.each(response, function(i,notice){
                        date = new Date(notice['created_at']);
                        year= date.getFullYear();
                        month = date.getMonth();
                        day = date.getDate();
						hour = date.getHours();
						min  = date.getMinutes();
                        noticDate = new Date(year+'-'+month+'-'+day, )
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
                        var details = notice["details"].replace(/<(?!br\s*\/?)[^>]+>/g, '');
                        var details = details.substring(0, 300)+'. . . . . . . .';

                        html+='<li>' +
                            '   <div class="timeline_element teal">\n' +
                            '     <div class="timeline_title">\n' +
                            '       <span class="timeline_label">'+notice["title"]+'</span><span class="timeline_date">'+noticDate+" "+hour+":"+min+'</span>\n' +
                            '     </div>\n' +
                            '     <div class="content">\n' + details+
                            '     </div>\n' +
                            '     <div class="readmore">\n' +
                            '       <a href="#" class="btn btn-dark-beige" onclick="noticeDetails('+notice["id"]+')">\n' +
                            '        Read More <i class="fa fa-arrow-circle-right"></i>\n' +
                            '       </a>\n' +
                            '     </div>\n' +
                            '    </div>\n' +
                            '  </li>'

                    });

                    html+='</ul>'
					if(html != ""){
						if(type==2){
							$('#all_notice').append(html)
						}
						else{
							$('#all_notice').html(loadMore+' '+html)
						}
						page ++ ;
					}
                    //$('#all_notice').html(html)
                }
            }
        });

    }

    loadNotice(1)

	// not working
	function loadMoreNotice(){
		//alert(1)
		loadNotice(2);
	}
	// not working
	$('.panel-scroll').perfectScrollbar({
		wheelSpeed: 50,
		minScrollbarLength: 20,
		suppressScrollX: true
	},{
		'ps-y-reach-end':loadMoreNotice()
	});

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
			loadNotice(1)
			el.unblock();
		}, 1000);
		e.preventDefault();
	});

	// -----------------------------------SEARCH----------------------------------------

		//alert(11)
		var search_input = $('.sidebar-search input');
		var search_button = $('.sidebar-search button');
		var search_form = $('.sidebar-search');
		search_input.attr('data-default', $(search_input).outerWidth()).focus(function() {
			$(this).animate({
				width: 200
			}, 200);
		}).blur(function() {
			if($(this).val() == "") {
				if($(this).hasClass('open')) {
					$(this).animate({
						width: 0,
						opacity: 0
					}, 200, function() {
						$(this).hide();
					});
				} else {
					$(this).animate({
						width: $(this).attr('data-default')
					}, 200);
				}
			}
		});
		search_button.on('click', function() {
			if($(search_input).is(':hidden')) {
				$(search_input).addClass('open').css({
					width: 0,
					opacity: 0
				}).show().animate({
					width: 200,
					opacity: 1
				}, 200).focus();
			} else if($(search_input).hasClass('open') && $(search_input).val() == '') {
				$(search_input).removeClass('open').animate({
					width: 0,
					opacity: 0
				}, 200, function() {
					$(this).hide();
				});
			} else if($(search_input).val() != '') {
			    page = 1;
                loadNotice (1)
				//alert('call here the loadNotice function page=1 and send the searchString and add that in controller quey')
				return false;
			} else
				$(search_input).focus();
			return false;
		});
	// -----------------------------------SEARCH----------------------------------------


</script>




