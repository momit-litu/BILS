<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">

        <div class="navbar-tools">
			
            <!-- start: TOP NAVIGATION MENU -->
            <ul class="nav navbar-right">
                <!-- start: NOTIFICATION DROPDOWN -->
				<li class="">
					<a class="" href="javascript:void(0)">			
					<span class="text-shadow" style="color: #fff"> <i><!--<image src="{{ asset('assets/images/logo.jpg')}}" />--></i>  BILS</span>
					</a>
				</li>
				<li class="dropdown">
					<a data-toggle="dropdown" data-hover="dropdown" onCLick="loadPage('dashboard-content')" class="dropdown-toggle" data-close-others="true" href="#">
                        <i class="clip-home"></i>                      
                    </a>
					
				</li>
				<!--
				<li class="dropdown">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<span class="">EN</span>
                        <i class="clip-chevron-down"></i>
					</a>
					<ul class="dropdown-menu">
                       <li>
							<a href="{{url('/app/language/en')}}">
								EN
							</a>
						</li>
                        <li>
							<a href="{{url('/app/language/bn')}}">
								BN
							</a>
						</li>
					</ul>
				</li>-->
                <li class="dropdown">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                        <i class="clip-notification-2"></i>
                        <span class="badge notificationCounter" notificationCount="0">0</span>
                    </a>
                    <ul class="dropdown-menu notifications">
                        <li>
                            <span class="dropdown-menu-title notificationCountertext"> </span>
                        </li>
                        <li>
                            <div class="drop-down-wrapper notificationList">
                                <ul>
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
                            <a onclick="loadPage('notification')"   href="javascript:void(0)">
                                {{__('app.See_all_notifications')}} <i class="fa fa-arrow-circle-o-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
				<!-- start: MESSAGE DROPDOWN -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
						<i class="clip-bubble-3"></i>
						<span class="badge"> 9</span>
					</a>
					<ul class="dropdown-menu posts">
						<li>
							<span class="dropdown-menu-title">   {{__('app.You_have')}} <span id="total_unseen_message"> 9 </span> {{__('app.messages')}}</span>
						</li>
						<li>
							<div class="drop-down-wrapper">
								<ul>
									<li>
										<a href="javascript:;">
											<div class="clearfix">
												<div class="thread-image">
													<img alt="" src="assets/images/avatar-2.jpg">
												</div>
												<div class="thread-content">
													<span class="author">Nicole Bell</span>
													<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
													<span class="time"> Just Now</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<div class="clearfix">
												<div class="thread-image">
													<img alt="" src="assets/images/avatar-1.jpg">
												</div>
												<div class="thread-content">
													<span class="author">Peter Clark</span>
													<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
													<span class="time">2 mins</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<div class="clearfix">
												<div class="thread-image">
													<img alt="" src="assets/images/avatar-3.jpg">
												</div>
												<div class="thread-content">
													<span class="author">Steven Thompson</span>
													<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
													<span class="time">8 hrs</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<div class="clearfix">
												<div class="thread-image">
													<img alt="" src="assets/images/avatar-1.jpg">
												</div>
												<div class="thread-content">
													<span class="author">Peter Clark</span>
													<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
													<span class="time">9 hrs</span>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<div class="clearfix">
												<div class="thread-image">
													<img alt="" src="assets/images/avatar-5.jpg">
												</div>
												<div class="thread-content">
													<span class="author">Kenneth Ross</span>
													<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
													<span class="time">14 hrs</span>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="view-all">
							<a onclick="loadPage('message')"   href="javascript:void(0)">
								{{__('app.See_all_messages')}}   <i class="fa fa-arrow-circle-o-right"></i>
							</a>
						</li>
					</ul>
				</li>
               
                <!-- end: USER DROPDOWN -->
				<li>
					<a class="sb-toggle" href="#"><i class="fa fa-outdent"></i></a>
				</li>
				<li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">

                        @if(\Auth::guard('appUser')->check())
                            @if((\Auth::guard('appUser')->user()->user_profile_image != ''))
                                <img width="30px" height="30px;" src="{{ asset('assets/images/user/admin') }}/{{ \Auth::guard('appUser')->user()->user_profile_image }}" class="circle-img" >
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

                                   <a class="profile" href="javascript:void(0)" onClick="loadPage('profile')">
                                        <i class="clip-user-2"></i>
                                        &nbsp;   {{__('app.My_Profile')}} 
                                    </a>
                            @endif

                        </li>
                        <li class="divider"></li>
						<li>
                            @if(\Auth::guard('appUser')->check())
								<a class="profile" href="javascript:void(0)" onClick="loadPage('profile','tab=edit_profile')">
                                    <i class="fa fa-lock"></i>
                                    &nbsp; {{__('app.Edit_Profile')}}
                                </a>
                            @endif
                        </li>
                        <li>
                            @if(\Auth::guard('appUser')->check())
								<a class="profile" href="javascript:void(0)" onClick="loadPage('profile','tab=change_password')">
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
