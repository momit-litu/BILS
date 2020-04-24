@extends('frontend.layout.master')
@section('content')
	<!--MESSAGE-->
	<div class="row ">
		<div class="col-md-10 col-md-offset-1" id="master_message_div">
		</div>
	</div>
	<!--END MESSAGE-->

    <!--PAGE CONTENT -->
    <div class="row ">
        						<a class="btn btn-teal" id="pullUpBtn" href="#">
									Pull Up ↑
								</a>
															<div class="animation-container center">
								<div id="object">
									<i class="clip-clip"></i>
								</div>
							</div>
    </div>
    </div>
    <!--END PAGE CONTENT-->

@endsection


@section('JScript')

	
	<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
	
	<script>
	// save the state of the page in local storage
	</script>



@endsection


