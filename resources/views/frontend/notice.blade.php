@extends('frontend.layout.master')
@section('content')
	<div class="row">
		<div class="col-sm-2 col-xs-6">
			<button class="btn btn-icon btn-block hometab" onclcik="loadPage('message')">
				<i class="fa fa-envelope"></i>
				Message <span class="badge badge-primary"> 4 </span>
			</button>
		</div>
		<div class="col-sm-2 col-xs-6">
			<button class="btn btn-icon btn-block hometab" onclcik="loadPage('notice')"> 
				<i class="fa fa-info-circle"></i>
				Notice <span class="badge badge-default"> 4 </span>
			</button>
		</div>
		<div class="col-sm-2 col-xs-6">
			<button class="btn btn-icon btn-block hometab" onclcik="loadPage('course')">
				<i class="fa fa-book"></i>
				Course <span class="badge badge-danger"> 4 </span>
			</button>
		</div>
		<div class="col-sm-2 col-xs-6">
			<button class="btn btn-icon btn-block hometab" onclcik="loadPage('survey')">
				<i class="fa fa-group"></i>
				Survey <span class="badge badge-primary"> 4 </span>
			</button>
		</div>
		<div class="col-sm-2 col-xs-6">
			<button class="btn btn-icon btn-block hometab" onclcik="loadPage('publication')">
				<i class="fa fa-file-text"></i>
				Publication <span class="badge badge-warning"> 4 </span>
			</button>
		</div>
		<div class="col-sm-2 col-xs-6">
			<button class="btn btn-icon btn-block hometab" onclcik="loadPage('notification')">
				<i class="fa fa-bell"></i>
				Notification <span class="badge badge-primary"> 4 </span>
			</button>
		</div>
		
	</div>

@endsection


@section('JScript')

	
	<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
	




@endsection


