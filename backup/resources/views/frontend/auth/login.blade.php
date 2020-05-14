@extends('frontend.auth.layout.login-master')
@section('login-content')
@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

        <h4><strong>{{__('auth.sign-up')}}</strong></h4>
			<h1>@lang('auth.sign-up')</h1>
			
				{{Lang::locale()}}
				{{\Session::get('locale')}}
				
        <p>
            {{__('auth.signin_details')}}
        </p>
        <form class="form-login" action="{{ url('app/auth/post/login') }}" method="post">
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
                        <input type="email" class="form-control" required  name="email" placeholder="{{__('auth.email')}}">
                        <i class="fa fa-user"></i> </span>
                </div>
                <div class="form-group form-actions">
                    <span class="input-icon">
                        <input type="password" class="form-control password" required name="password"  placeholder="{{__('auth.password')}}">
                        <i class="fa fa-lock"></i>
                        <a class="forgot" href="{{url('app/auth/forget/password')}}">{{__('auth.i_forget_my_password')}} </a>
                    </span>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success pull-right btn-squared">
                        {{__('auth.Login')}}  <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
				<div class="new-account">
				{{__('auth.dont_have_accout')}}
					<a href="{{url('app/register')}}" class="register">
						{{__('auth.create_an_account')}} 
					</a>
				</div>
            </fieldset>
        </form>

@endsection