<div class="main-navigation navbar-collapse collapse">
    <div class="navigation-toggler">
        <i class="clip-chevron-left"></i>
        <i class="clip-chevron-right"></i>
    </div>
    <!-- end: MAIN MENU TOGGLER BUTTON -->
    <!-- start: MAIN NAVIGATION MENU -->
    <ul class="main-navigation-menu">
		<li class="{{isset($module_name) && ($module_name=='Dashboard') ? 'active' : ''}} ">
			<a onclick="loadPage('dashboard')"   href="javascript:void(0)" ><i class="clip-home-3"></i>
				<span class="title"> Dashboard </span>
				<span class="selected"></span>
			</a>
		</li>
		
		<li class="{{isset($module_name) && ($module_name=='Message') ? 'active' : ''}} ">
			<a onclick="loadPage('message')"   href="javascript:void(0)"><i class="clip-bubbles-3"></i>
				<span class="title"> Messages </span>
			</a>
		</li>
		<li class="{{isset($module_name) && ($module_name=='Notice') ? 'active' : ''}} ">
			<a onclick="loadPage('notice')"   href="javascript:void(0)"><i class="clip-notification"></i>
				<span class="title"> Notices </span>
			</a>
		</li>
		<li class="{{isset($module_name) && ($module_name=='Publication') ? 'active' : ''}} ">
			<a onclick="loadPage('publication')"   href="javascript:void(0)"><i class="clip-file"></i>
				<span class="title"> Publication </span>
			</a>
		</li>
		<li class="{{isset($module_name) && ($module_name=='Notification') ? 'active' : ''}} ">
			<a onclick="loadPage('notification')"   href="javascript:void(0)"><i class="clip-notification"></i>
				<span class="title"> Notification </span>
			</a>
		</li>
		<li class="{{isset($module_name) && ($module_name=='Course') ? 'active' : ''}} ">
			<a onclick="loadPage('course')"   href="javascript:void(0)"><i class="clip-book"></i>
				<span class="title"> Course </span>
			</a>
		</li>		
		<li class="{{isset($module_name) && ($module_name=='Survey') ? 'active' : ''}} ">
			<a onclick="loadPage('survey')"   href="javascript:void(0)"><i class="clip-users-2"></i>
				<span class="title"> Survey </span>
			</a>
		</li>
    </ul>
    <!-- end: MAIN NAVIGATION MENU -->
</div>
