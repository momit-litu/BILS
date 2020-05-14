@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

<div class="panel panel-default">
	<div class="panel-heading">
		<i class=" clip-notification-2 "></i>
		{{__('auth.Notice_Details')}}
		<div class="panel-tools">
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">
	
		<div class="alert alert-block fade in justify-text">
			<h4 class="alert-heading"><i class="clip-notification "></i> </h4>
			<p>
				<a href="#" class="btn btn-green">
					{{__('auth.Download_Documnet')}}
				</a>
			</p>
			<hr>
			<p>
							
			</p>
		</div>
	</div>
</div>



	
<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
$(document).ready(function(){
	//alert("NOtice details")
});
</script>




