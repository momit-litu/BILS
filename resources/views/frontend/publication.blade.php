
<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" fa fa-file-text "></i>
		Publication
		<form class="sidebar-search">
			<div class="form-group">
				<input type="text" placeholder="Start Searching..." data-default="130" style="width: 130px;">
				<button class="submit">
					<i class="clip-search-3"></i>
				</button>
			</div>
		</form>
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('publication')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
		<div id="timeline" class="demo1">
			<div class="timeline" id="all_publication">
				<ul class="columns" id="all_publications">

				</ul>
			</div>
		</div>
	</div>
</div>


<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
    page =1;
	$('.sidebar-search input').val('');
        //alert("NOtice");
    var attachment_url = "<?php echo asset('assets/attachment/publications'); ?>";


    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


    publicationDetails = (id) =>{
        $.ajax({
            url: "{{ url('app/')}}/load-publications-details/"+id,
            type: 'get',
            async: false,
            success: function (response) {
                //console.log(response)

                response = JSON.parse(response)
                date = new Date(response[0]["created_at"]+ 'Z');
				publication = (response[0]["publication_type"])?"<button class='btn btn-disabled btn-info btn-xs'>"+response[0]["publication_type"]+"</button>":"";
                publicationDate = date.toDateString()+" "+date.getHours()+":"+date.getMinutes();
                let  p = '<span><p style="text-align:left">'+response[0]['authors']+'<b style="float:right"><br>'+publicationDate+'</b> </p></span>'

                let attachment = '';

                if(response[0]['attachment']){
                    //attachment = attachment_url+'/'+response[0]['attachment'];
                    attachment = "<br>"+publication+ '<br><a class="btn btn-disabled btn-warning" href="'+attachment_url+'/'+response[0]["attachment"]+'" download><i class="clip-attachment"></i></a>'
                }

                $('#modal_title_content').html(response[0]['title'] +''+attachment);
                $('#modal_body_content').html(p+'<hr> '+response[0]['details'])
                $('#responsive').modal()
            }
        })

    }



    loadPublication = function loadPublication(type){
        text = 'a'
        if($(search_input).val()!=null && $(search_input).val()!=''  ) {
            //alert(1)
            text = $(search_input).val()
        }


        $.ajax({
            url: "{{ url('app/')}}/load-publications/"+page+'/'+text,
            type:'get',
            async:false,
            success: function(response) {
                var response = JSON.parse(response);
                if(!jQuery.isEmptyObject(response)){
                    html = "";
                    noticeMonth = -1
                    noticeYear = -1
                   // loadMore = '<button onclick="loadPublication(2);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>';


                    $.each(response, function(i,publication){
                        date = new Date(publication["created_at"]+ 'Z');
                        year= date.getFullYear();
                        month = date.getMonth();
                        day = date.getDate();
                        publicationDate = date.toLocaleString();


                        var details = publication["details"].replace(/<(?!br\s*\/?)[^>]+>/g, '');
                        var details = details.substring(0, 300)+'. . . . . . . .';
						
                       // alert(publication['title'])

                        html+='<li> ' +
                            '   <div class="timeline_element"> ' +
                            '       <div class="timeline_title" >' +
                            '           <span class="timeline_label" style="color:gray">'+publication["title"]+'</span><span class="timeline_date " style="color:gray">'+publicationDate+'</span> ' +
                            '       </div> ' +
                            '       <div class="content"> '+details+'</div> ' +
                            '       <div class="readmore"> ' +
                            '           <a href="#" class="btn btn-info" onclick="publicationDetails('+publication["id"]+')">' +
                            '               Details <i class="fa fa-arrow-circle-right"></i> ' +
                            '           </a> ' +
                            '       </div> ' +
                            '   </div> ' +
                            '</li>'
                    });

                    //console.log(html)
                    if(type==2){
                        $('#all_publications').append(html);
						 page ++ ;
                    }
                    else{
                        $('#all_publications').html(html)
                    }
                    //$('#all_publications').html(html)
                }
            }
        });

    }

    loadPublication(1)


    // load more when scroll reachs to bottom of the scrolling div
    $('.fixed-panel').on('scroll', function() {
        if ($(this).scrollTop() + $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            loadPublication(2)
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
            loadPublication(1)
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
			//alert('fff')
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
			    page =1;
                loadPublication(1)
				//return;
			} else
				$(search_input).focus();
			return false;
		});
	// -----------------------------------SEARCH----------------------------------------

</script>




