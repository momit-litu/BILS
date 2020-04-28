@extends('frontend.layout.master')
@section('content')	
<div  id="load-content" >
	<div class="panel panel-default border-none">
		<div class="panel-heading which_page">
			<i class="clip-home"></i>
			{{__('app.Dashboard')}} 
			<div class="panel-tools">
				<a class="btn btn-xs btn-link panel-refresh" href="#">
					<i class="fa fa-refresh"></i>
				</a>

			</div>
		</div>
		<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel" >
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab" id="message" onclcik="loadPage('message')">
					<i class="fa fa-envelope"></i>
					{{__('app.Messages')}} <span class="badge badge-primary"> 4 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab"  id="notice" onclcik="loadPage('notice')"> 
					<i class="fa fa-info-circle"></i>
					{{__('app.Notices')}} <span class="badge badge-default"> 4 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block   hometab"   id="course" onclcik="loadPage('course')">
					<i class="fa fa-book"></i>
					{{__('app.Courses')}} <span class="badge badge-danger"> 4 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block   hometab"  id="survey" onclcik="loadPage('survey')">
					<i class="fa fa-group"></i>
					{{__('app.Surveys')}} <span class="badge badge-primary"> 4 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab"  id="publication" onclcik="loadPage('publication')">
					<i class="fa fa-file-text"></i>
					{{__('app.Publications')}} <span class="badge badge-warning"> 4 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab"  id="notification" onclcik="loadPage('notification')">
					<i class="fa fa-bell"></i>
					{{__('app.Notifications')}} <span class="badge badge-primary"> 4 </span>
				</button>
			</div>
		</div>
	</div>
</div>



@section('JScript')
<script>
$('.fixed-panel').css('height', $(window).height() - ($('.footer').outerHeight()+$('.navbar-tools').outerHeight()+90));
</script>
	
<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>

@endsection




@endsection


@section('JScript')

	
	<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>

@endsection


