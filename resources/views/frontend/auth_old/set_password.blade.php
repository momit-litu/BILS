@extends('frontend.auth.layout.login-master')
@section('login-content')
@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

	<h4><strong>{{__('auth.set_new_password')}}</strong></h4>
	<p>
		{{__('auth.provide_verification_code')}}
	</p>
	<form method="POST" action="{{ url('app/auth/forget/password/'.$return_data["id"].'/verify') }}">
		@csrf
		<div class="errorHandler alert alert-danger no-display btn-squared">
			<i class="fa fa-remove-sign"></i>{{__('auth.provide_correct_information')}}
		</div>
		<fieldset>
			<div class="form-group">
				<span class="input-icon">
					<input id="id" type="hidden" class="form-control @error('name') is-invalid @enderror" name="id" value="{{ $return_data['id'] }}">
				</span>
			</div>
            <div class="form-group">
				<span class="input-icon">
					<input id="verification_code" type="number"  placeholder="{{ __('auth.verification_code') }}" class="form-control @error('name') is-invalid @enderror" name="verification_code" value="{{ $return_data['varificaiton_token'] }}" required autofocus>
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
				<button type="submit" class="btn btn-primary pull-right btn-squared setNewPasswordButton">
					{{ __('auth.set_password') }} <i class="fa fa-arrow-circle-right"></i>
				</button>
            </div>
			<div class="new-account">
				{{__('auth.not_code')}}
				<a href="{{url('app/auth/password/reset/'.$return_data['contact_number'])}}" class="register">
					{{__('auth.send_code')}}
				</a>
			</div>
		</fieldset>
	</form>
@endsection

