

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
            <a href="#responsive" data-toggle="modal" class="demo btn btn-blue">
                View Demo
            </a>
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('publication')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
		<div id="timeline" class="demo1">
			<div class="timeline" id="all_publication">
				<ul class="columns" id="all_publications">
					<!--li>
						<div class="timeline_element">
							<div class="timeline_title">
								<span class="timeline_label">Publication Title 1</span><span class="timeline_date">16 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-info">
									Details <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
										<li>
						<div class="timeline_element">
							<div class="timeline_title">
								<span class="timeline_label">Publication Title 1</span><span class="timeline_date">16 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-info">
									Details <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
										<li>
						<div class="timeline_element">
							<div class="timeline_title">
								<span class="timeline_label">Publication Title 1</span><span class="timeline_date">16 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-info">
									Details <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li>
                    <li>
						<div class="timeline_element">
							<div class="timeline_title">
								<span class="timeline_label">Publication Title 1</span><span class="timeline_date">16 December 2014</span>
							</div>
							<div class="content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-info">
									Details <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</li-->

				</ul>
			</div>
		</div>
	</div>
</div>




<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
$(document).ready( function(){
        //alert("NOtice");


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
                $(' #modal_title_content').html(response[0]['title']);
                $('#modal_body_content').html(response[0]['details'])
                $('#responsive').modal()
            }
        })

    }



    loadPublication = function loadPublication(){//

        $.ajax({
            url: "{{ url('app/')}}/load-publications",
            type:'get',
            async:false,
            success: function(response) {
                var response = JSON.parse(response);
                if(!jQuery.isEmptyObject(response)){
                    html = "";
                    noticeMonth = -1
                    noticeYear = -1

                    $.each(response, function(i,publication){
                        date = new Date(publication['created_at']);
                        year= date.getFullYear();
                        month = date.getMonth();
                        day = date.getDate();
                        noticDate = new Date(year+'-'+month+'-'+day)
                        noticDate = noticDate.toDateString()

                        var details = publication["details"];
                        var details = details.substring(0, 300)+'. . . . . . . .';


                        html+='<li> ' +
                            '   <div class="timeline_element"> ' +
                            '       <div class="timeline_title">' +
                            '           <span class="timeline_label">'+publication["title"]+'</span><span class="timeline_date">'+noticDate+'</span> ' +
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

                    $('#all_publications').html(html)
                }
            }
        });

    }

    loadPublication()

});

</script>




