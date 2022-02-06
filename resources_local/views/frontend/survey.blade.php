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
        {{__('app.Survey')}}
        <form class="sidebar-search">
            <div class="form-group">
                <input type="text" placeholder="Start Searching..." data-default="130" style="width: 130px;">
                <button class="submit">
                    <i class="clip-search-3"></i>
                </button>
            </div>
        </form>
        <div class="panel-tools">
            <a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('survey')">
                <i class="fa fa-refresh"></i>
            </a>
        </div>
    </div>
    <div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
        <div id="timeline" class="demo1">
            <div class="timeline" id="all_survey">
                <ul class="columns" id="all_surveys">

                </ul>
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


        loadsurvey = function loadsurvey(type){
            text = 'a'
            if($(search_input).val()!=null && $(search_input).val()!=''  ) {
                text = $(search_input).val()
            }

            $.ajax({
                url: "{{ url('app/')}}/load-survey/"+page+'/'+text,
                type:'get',
                async:true,
                beforeSend: function( xhr ) {
                    ajaxPreLoad()
                    //$("#load-content").fadeOut('slow');
                },
                success: function(response) {
                    $('#load-content').unblock();

                    var response = JSON.parse(response);
                    //console.log(response)
                    if(!jQuery.isEmptyObject(response)){
                        html = "";
                        noticeMonth = -1
                        noticeYear = -1
                        // loadMore = '<button onclick="loadPublication(2);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>';


                        $.each(response, function(i,survey){
                            date = new Date(survey["created_at"]+ 'Z');
                            year= date.getFullYear();
                            month = date.getMonth();
                            day = date.getDate();
                            publicationDate = date.toLocaleString();

                            if(survey["details"] && survey["details"]!=null){
                                var details = survey["details"].replace(/<(?!br\s*\/?)[^>]+>/g, '');
                                var details = details.substring(0, 300)+'. . . . . . . .';
                            }else{
                                var details = '';
                            }


                            // alert(publication['title'])

                            html+='<li style="width: 100%"> ' +
                                '   <div class="timeline_element"> ' +
                                '       <div class="timeline_title" >' +
                                '           <span class="timeline_label" style="color:gray">'+survey["title"]+'</span><span class="timeline_date " style="color:gray">'+publicationDate+'</span> ' +
                                '       </div> ' +
                                '       <div class="content"> '+details+'</div> ' +
                                '       <div class="readmore"> ' +
                                '           <a href="#" class="btn btn-info" onclick="surveyDetails('+survey["id"]+')">' +
                                '               Details <i class="fa fa-arrow-circle-right"></i> ' +
                                '           </a> ' +
                                '       </div> ' +
                                '   </div> ' +
                                '</li>'
                        });

                        //console.log(html)
                        if(type==2){
                            $('#all_surveys').append(html);
                        }
                        else{
                            $('#all_surveys').html(html)
                        }
                        page ++ ;

                        //$('#all_publications').html(html)
                    }
                }
            });

        }

        loadsurvey(1)



        surveyInterested =(id) =>{
            $.ajax({
                url: "{{ url('app/')}}/survey-interest/" + id,
                type: 'get',
                async: true,
                contentType: false,
                processData: false,
                success: function (response) {
                    surveyId = id;
                    loadSurveyQuestion(0)
                }
            })
        }

        surveyDetails  = (id) =>{
            //alert(11)
            $.ajax({
                url: "{{ url('app/')}}/load-survey-details/"+id,
                type: 'get',
                async: true,
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
                    start = new Date(response[0]["start_date"]+ 'Z');
                    start = start.toDateString()
                    end = new Date(response[0]["end_date"]+ 'Z');
                    end = end.toDateString()


                    let interested = '<button data-dismiss="alert" class="btn btn-success btn-sm" onclick="surveyInterested('+response[0]["id"]+')" type="button">\n' +
                        'Participate' +
                        '</button>\n'
                    let category_name = (response[0]["category_name"])?"<button class='btn btn-disabled btn-info btn-xs'>"+response[0]["category_name"]+"</button>":"";

                    let  p = '<span><p style="text-align:left"><b style="float:right">Start Date: '+start+' to '+end+'</b> </p></span><br>'


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


