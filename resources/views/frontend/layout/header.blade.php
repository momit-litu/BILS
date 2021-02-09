<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">

        <div class="navbar-tools">
            <!-- start: TOP NAVIGATION MENU -->
			<a class="navbar-brand" href="{{url('app/dashboard')}}" {{--onCLick="loadPage('dashboard-content')"--}}  style="padding-top: 0px;position: fixed;margin-top: 10px; float:none !important">
				<span class="text-shadow" style="color: #fff">BILS</span>
			</a>
            <ul class="nav navbar-right">
                <!-- start: NOTIFICATION DROPDOWN -->



				<li class="dropdown">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#" style="font-size:12px; font-weight:bold;">
						<span class="" style="text-transform:uppercase" >{{\Session::get('locale')}}</span>
                        <i class="clip-chevron-down"></i>
					</a>
					<ul class="dropdown-menu" style="min-width:70px">
                       <li>
							<a href="{{url('/app/language/en')}}"  class="showLoading">
								EN
							</a>
						</li>
                        <li>
							<a href="{{url('/app/language/bn')}}"  class="showLoading">
								BN
							</a>
						</li>
					</ul>
				</li>
                <li class="dropdown">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                        <i class="clip-notification-2"></i>
                        <span class="badge notificationCounter" notificationCount="0" id="app_notification_badge">0</span>
                    </a>
                    <ul class="dropdown-menu notifications">
                        <li>
                            <span class="dropdown-menu-title notificationCountertext"> </span>
                        </li>
                        <li>
                            <div class="drop-down-wrapper notificationList">
                                <ul id="app_header_new_notification">
                                </ul>
                            </div>
                        </li>
                        <li class="view-all">
                            <a onclick="changePage('notification')"   href="javascript:void(0)">
                                {{__('app.See_all_notifications')}} <i class="fa fa-arrow-circle-o-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
				<!-- start: MESSAGE DROPDOWN -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
						<i class="clip-bubble-3"></i>
						<span class="badge" id="app_message_badge"> 0</span>
					</a>
					<ul class="dropdown-menu posts">
						<li>
							<span class="dropdown-menu-title" id="app_message_top_unread">   </span>
						</li>
						<li>
							<div class="drop-down-wrapper">
								<ul id="app_header_new_message">
								</ul>
							</div>
						</li>
						<li class="view-all">
							<a onclick="changePage('message')"   href="javascript:void(0)">
								{{__('app.See_all_messages')}}   <i class="fa fa-arrow-circle-o-right"></i>
							</a>
						</li>
					</ul>
                </li>

                <!-- end: USER DROPDOWN -->
				<!--<li>
					<a class="sb-toggle" href="#"><i class="fa fa-outdent"></i></a>
				</li>-->
				<li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">

                        @if(\Auth::guard('appUser')->check())
                            @if((\Auth::guard('appUser')->user()->user_profile_image != ''))
                                <img width="30px" height="30px;" src="{{ asset('assets/images/user/app_user') }}/{{ \Auth::guard('appUser')->user()->user_profile_image }}" class="circle-img" >
                            @else
                                <img width="30px" height="30px;" src="{{asset('assets/images/user/admin/small/profile.png')}}" class="circle-img" >
                            @endif
                            <span class="username">{{isset(\Auth::guard('appUser')->user()->name) ? \Auth::guard('appUser')->user()->name : ''}}</span>
                            <i class="clip-chevron-down"></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            @if(\Auth::guard('appUser')->check())

                                   <a class="profile" href="javascript:void(0)" onClick="changePage('profile')">
                                        <i class="clip-user-2"></i>
                                        &nbsp;   {{__('app.My_Profile')}}
                                    </a>
                            @endif

                        </li>
                        <li class="divider"></li>
						<li>
                            @if(\Auth::guard('appUser')->check())
								<a class="profile" href="javascript:void(0)" onClick="changePage('profile','tab=edit_profile')">
                                    <i class="fa fa-lock"></i>
                                    &nbsp; {{__('app.Edit_Profile')}}
                                </a>
                            @endif
                        </li>
                        <li>
                            @if(\Auth::guard('appUser')->check())
								<a class="profile" href="javascript:void(0)" onClick="changePage('profile','tab=change_password')">
                                    <i class="fa fa-lock"></i>
                                    &nbsp;{{__('app.Change_Password')}}
                                </a>
                            @endif
                        </li>
                        <li>
                            @if(\Auth::guard('appUser')->check())
                                <a href="{{url('app/auth/logout',isset(\Auth::guard('appUser')->user()->email) ? \Auth::guard('appUser')->user()->email : '')}}">
                                    <i class="clip-exit"></i>
                                    &nbsp;{{__('app.Log_Out')}}
                                </a>
                            @endif
                        </li>
                    </ul>
                </li>

            </ul>
			<!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>
<script>


</script>
