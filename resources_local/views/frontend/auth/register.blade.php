@extends('frontend.auth.layout.login-master')
@section('login-content')
@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

	<h4><strong>{{__('auth.registration')}}</strong></h4>
	<p>
		{{__('auth.reg_page_details')}}
	</p>
	<form class="form-register"  method="POST" action="{{ url('app/register_verify') }}">
		@csrf
		@if($errors->count() > 0 )
			<div class="alert alert-danger btn-squared">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<ul>
					@foreach( $errors->all() as $message )
						<li>{{ $message }}</li>
					@endforeach
				</ul>
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
					<input id="name" type="text"  placeholder="{{ __('auth.name') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
					<i class="fa fa-user"></i>
				</span>
				@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
            <div class="form-group">
				<span class="input-icon">
					<input id="contact_no" type="mobile" placeholder="{{ __('auth.mobile') }}" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required autocomplete="contact_no">
					<i class="fa fa-envelope"></i>
				</span>
                @error('contact_no')
                <span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
                @enderror
            </div>
			<div class="form-group">
				<span class="input-icon">
					<input id="email" type="email" placeholder="{{ __('auth.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
					<i class="fa fa-envelope"></i>
				</span>
				@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="form-group">
				<span class="input-icon">
					<input id="password" type="password" placeholder="{{ __('auth.password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
					<i class="fa fa-lock"></i>
				</span>
				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="form-group">
				<span class="input-icon">
					<input id="repeat_password" type="password"  placeholder="{{ __('auth.confirm_password') }}" class="form-control" name="repeat_password" required autocomplete="new-password">
					<i class="fa fa-lock"></i>
				</span>
				@error('password-confirm')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary pull-right btn-squared registerButton">
					{{ __('auth.Register') }} <i class="fa fa-arrow-circle-right"></i>
				</button>
            </div>
			<div class="new-account">
				{{__('auth.have_accout')}}
				<a href="{{url('app/login')}}" class="register">
					{{__('auth.Login')}}
				</a>
			</div>
		</fieldset>
	</form>

@endsection

