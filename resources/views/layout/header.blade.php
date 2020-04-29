<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">
        <div class="navbar-header">
            <!-- start: RESPONSIVE MENU TOGGLER -->
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="clip-list-2"></span>
            </button>
            <!-- end: RESPONSIVE MENU TOGGLER -->
            <!-- start: LOGO -->

            <a class="navbar-brand" href="javascript:void(0)">
                <span class="text-shadow" style="color: #fff"> <i><image src="{{ asset('assets/images/logo.jpg')}}" /></i>  {{$site_settings['short_name']}}</span>
            </a>
            <!-- end: LOGO -->
        </div>
        <div class="navbar-tools">
            <!-- start: TOP NAVIGATION MENU -->
            <ul class="nav navbar-right">
                <!-- start: NOTIFICATION DROPDOWN -->
                <li class="dropdown">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                        <i class="clip-notification-2"></i>
                        <span class="badge notificationCounter" id="notificationCount">0</span>
                    </a>
                    <ul class="dropdown-menu notifications">
                        <li>
                            <span class="dropdown-menu-title notificationCountertext"> </span>
                        </li>
                        <li>
                            <div class="drop-down-wrapper notificationList">
                                <ul id="notification_list">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <span class="label label-primary"><i class="fa fa-user"></i></span>
                                            <span class="message"> New user registration</span>
                                            <span class="time"> 1 min</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="view-all">
                            <a href="{{url('/notification')}}" >
                                See all notifications <i class="fa fa-arrow-circle-o-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
				<!-- start: MESSAGE DROPDOWN -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
						<i class="clip-bubble-3"></i>
						<span class="badge" id="badge"> 0</span>
					</a>
					<ul class="dropdown-menu posts">
						<li>
							<span class="dropdown-menu-title" id="message_top_unread"></span>
						</li>
						<li>
							<div class="drop-down-wrapper" id="message_header">
								<ul>
								</ul>
							</div>
						</li>
						<li class="view-all">
							<a href="pages_messages.html">
								See all messages <i class="fa fa-arrow-circle-o-right"></i>
							</a>
						</li>
					</ul>
				</li>
                <li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                        @if(\Auth::check())
                            @if((\Auth::user()->user_profile_image != ''))
                                <img width="30px" height="30px;" src="{{ asset('assets/images/user/admin') }}/{{ Auth::user()->user_profile_image }}" class="circle-img" >
                            @else
                                <img width="30px" height="30px;" src="{{asset('assets/images/user/admin/small/profile.png')}}" class="circle-img" >
                            @endif
                            <span class="username">{{isset(\Auth::user()->name) ? \Auth::user()->name : ''}}</span>
                            <i class="clip-chevron-down"></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            @if(\Auth::check())

                                    <a href="{{url('/profile/my-profile')}}">
                                        <i class="clip-user-2"></i>
                                        &nbsp;My Profile
                                    </a>
                            @endif

                        </li>
                        <li class="divider"></li>
                        {{-- <li>
                            @if(\Auth::check())
                                <a href="{{ url('my/profile?tab=change_password') }}">
                                    <i class="fa fa-lock"></i>
                                    &nbsp;Change Password
                                </a>
                            @endif
                        </li> --}}
                        <li>
                            @if(\Auth::check())
                                <a href="{{url('auth/logout',isset(\Auth::user()->email) ? \Auth::user()->email : '')}}">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            @endif
                        </li>
                    </ul>
                </li>
                <!-- end: USER DROPDOWN -->


            </ul>
            <!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>


@section('JScript')


    <script src="{{ asset('assets/js/bils/common.js')}}"></script>

@endsection
