<div class="main-navigation navbar-collapse collapse">
    <div class="navigation-toggler">
        <i class="clip-chevron-left"></i>
        <i class="clip-chevron-right"></i>
    </div>
    <!-- end: MAIN MENU TOGGLER BUTTON -->
    <!-- start: MAIN NAVIGATION MENU -->
    <ul class="main-navigation-menu">

		<li class="{{isset($module_name) && ($module_name=='Dashboard') ? 'active' : ''}} ">
			<a href="{{url('dashboard')}}"><i class="clip-home-3"></i>
				<span class="title"> Dashboard </span>
				<span class="selected"></span>
			</a>
		</li>
		
		<li class="{{isset($module_name) && ($module_name=='Message') ? 'active' : ''}} ">
			<a href=""><i class="clip-bubbles-3"></i>
				<span class="title"> Messages </span>
			</a>
		</li>
		<li class="{{isset($module_name) && ($module_name=='Notice') ? 'active' : ''}} ">
			<a href=""><i class="clip-notification"></i>
				<span class="title"> Notices </span>
			</a>
		</li>
				

    </ul>
    <!-- end: MAIN NAVIGATION MENU -->
</div>
