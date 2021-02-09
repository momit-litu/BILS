@extends('frontend.auth.layout.login-master')
@section('login-content')
@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

        <h5>{{__('auth.forget_password')}}</h5>
        <p>
           {{__('auth.forget_password_detail')}}
        </p>
        <form class="form-forgot" action="{{ url('/app/auth/forget/password')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
             @if($errors->count() > 0 )
				<div class="alert alert-danger btn-squared">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					@foreach( $errors->all() as $message )
						<p>{{ $message }}</p>
					@endforeach
				</div>
			@endif
			@if(Session::has('message'))
				<div class="alert alert-success btn-squared" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('message') }}
				</div>
			@endif
			@if(Session::has('errormessage'))
				<div class="alert alert-danger btn-squared" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('errormessage') }}
				</div>
			@endif
			<div class="errorHandler alert alert-danger no-display btn-squared">
				<i class="fa fa-remove-sign"></i>{{__('auth.provide_correct_information')}}
			</div>

            <fieldset>
                <div class="form-group">
                    <span class="input-icon">
                        <input type="contact_no" class="form-control" name="contact_no" id="contact_no" required placeholder="{{__('auth.mobile')}}">
								<i class="fa fa-envelope"></i> </span>
                </div>
                <div class="form-actions">
                    <a href="{{url('app/')}}" class="btn btn-light-grey go-back">
                        <i class="fa fa-circle-arrow-left"></i>  {{__('auth.Back')}}
                    </a>
                    <button type="submit" class="btn btn-bricky pull-right sendSMSButton">
                         {{__('auth.Submit')}}  <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
            </fieldset>
        </form>
    <!-- end: FORGOT BOX -->
@endsection
