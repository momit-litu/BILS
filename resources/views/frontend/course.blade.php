@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

<style>
.swiper-container {
  width: 100%;
  height: auto;
}
.swiper-slide {
  background: #fff;

  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
</style>
<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" fa fa-file-text "></i>
		{{__('app.Course')}}
        <form class="sidebar-search">
            <div class="form-group">
                <input type="text" placeholder="Start Searching..." data-default="130" style="width: 130px;">
                <button class="submit">
                    <i class="clip-search-3"></i>
                </button>
            </div>
        </form>
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('course')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
    <div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
        <div id="timeline" class="demo1">
            <div class="timeline" id="all_course">
                <ul class="columns" id="all_courses">

                </ul>
            </div>
        </div>


    </div>
</div>

<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
    page =1;

    $(document).ready(function(){
	var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
});


loadCourse = function loadCourse(type){
    text = 'a'
    if($(search_input).val()!=null && $(search_input).val()!=''  ) {
        text = $(search_input).val()
    }

    $.ajax({
        url: "{{ url('app/')}}/load-course/"+page+'/'+text,
        type:'get',
        async:true,
        contentType: false,
        processData: false,
        beforeSend: function( xhr ) {
            ajaxPreLoad()
            //$("#load-content").fadeOut('slow');
        },
        success: function(response) {
            $('#load-content').unblock();

            var response = JSON.parse(response);
            if(!jQuery.isEmptyObject(response)){
                html = "";
                noticeMonth = -1
                noticeYear = -1
                // loadMore = '<button onclick="loadPublication(2);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>';


                $.each(response, function(i,course){
                    date = new Date(course["created_at"]+ 'Z');
                    year= date.getFullYear();
                    month = date.getMonth();
                    day = date.getDate();
                    publicationDate = date.toLocaleString();


                    if(course["details"] && course["details"]!=null){
                        var details = course["details"].replace(/<(?!br\s*\/?)[^>]+>/g, '');
                        var details = details.substring(0, 300)+'. . . . . . . .';
                    }else{
                        var details = '';
                    }




                    // alert(publication['title'])

                    html+='<li> ' +
                        '   <div class="timeline_element"> ' +
                        '       <div class="timeline_title" >' +
                        '           <span class="timeline_label" style="color:gray">'+course["title"]+'</span><span class="timeline_date " style="color:gray">'+publicationDate+'</span> ' +
                        '       </div> ' +
                        '       <div class="content"> '+details+'</div> ' +
                        '       <div class="readmore"> ' +
                        '           <a href="#" class="btn btn-info" onclick="courseDetails('+course["id"]+')">' +
                        '               Details <i class="fa fa-arrow-circle-right"></i> ' +
                        '           </a> ' +
                        '       </div> ' +
                        '   </div> ' +
                        '</li>'
                });

                //console.log(html)
                if(type==2){
                    $('#all_courses').append(html);
                    page ++ ;
                }
                else{
                    $('#all_courses').html(html)
                }
                //$('#all_publications').html(html)
            }
        }
    });

}

loadCourse(1)

courseInterest =(id) =>{
    $.ajax({
        url: "{{ url('app/')}}/course-interest/" + id,
        type: 'get',
        async: true,
        contentType: false,
        processData: false,
        success: function (response) {
           // $('#responsive').modal().hide();
            //$('#responsive').modal('toggle')
            //$("#responsive .close").click()
            loadCourseSideBar()

        }
    })

}


courseDetails  = (id) =>{
        $.ajax({
            url: "{{ url('app/')}}/load-course-details/"+id,
            type: 'get',
            async: true,
            contentType: false,
            processData: false,
            beforeSend: function( xhr ) {
                ajaxPreLoad()
                //$("#load-content").fadeOut('slow');
            },
            success: function (response) {
                $('#load-content').unblock();

                response = JSON.parse(response)

                //console.log(response)

                created = new Date(response[0]["created_at"]+ 'Z');
                created = created.toDateString()
                start = new Date(response[0]["appx_start_time"]+ 'Z');
                start = start.toDateString()
                end = new Date(response[0]["appx_end_time"]+ 'Z');
                end = end.toDateString()


                let interested = '<button data-dismiss="alert" class="btn btn-success btn-sm" onclick="courseInterest('+response[0]["id"]+')" type="button">\n' +
                    'Interested?\n' +
                    '</button>\n' +
                    '<button data-dismiss="alert" class="btn btn-danger btn-sm" onclick="" type="button">\n' +
                    'No?\n' +
                    '</button>'
                let category_name = (response[0]["category_name"])?"<button class='btn btn-disabled btn-info btn-xs'>"+response[0]["category_name"]+"</button>":"";

                let  p = '<span><p style="text-align:left"> Teacher: '+response[0]['name']+'<b style="float:right">Duration: '+start+' to '+end+'</b> </p></span><br>'

                let attachment = '';

                if(response[0]['attachment']){
                    //attachment = attachment_url+'/'+response[0]['attachment'];
                    attachment = "<br>"+publication+ '<br><a class="btn btn-disabled btn-warning" href="'+attachment_url+'/'+response[0]["attachment"]+'" download><i class="clip-attachment">{{__("app.download_file")}}</i></a>'
                }
                html = '<div class="alert alert-block alert-info fade in">'+interested+ '<h4>'+response[0]["title"]+'</h4>' + category_name + p +response[0]['details']+'</div>'

                //$('#modal_title_content').html(response[0]['title'] +''+attachment);
                $('#modal_body_content').html(html)
                $('#responsive').modal()
            }
        })

    }




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


