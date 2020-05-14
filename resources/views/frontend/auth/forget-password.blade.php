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
        <form class="form-forgot" action="{{url('app/auth/forget/password')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @if($errors->count() > 0 )
                <div class="alert alert-danger btn-squared">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h6>Error!!!</h6>
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

            <fieldset>
                <div class="form-group">
                    <span class="input-icon">
                        <input type="email" class="form-control" name="email" placeholder="Email">
								<i class="fa fa-envelope"></i> </span>
                </div>
                <div class="form-actions">
                    <a href="{{url('app/')}}" class="btn btn-light-grey go-back">
                        <i class="fa fa-circle-arrow-left"></i>  {{__('auth.Back')}} 
                    </a>
                    <button type="submit" class="btn btn-bricky pull-right">
                         {{__('auth.Submit')}}  <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
            </fieldset>
        </form>

    <!-- end: FORGOT BOX -->
@endsection