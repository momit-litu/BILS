
	<div class="panel panel-default border-none">
		<div class="panel-heading which_page">
			<i class="clip-home"></i>
			Dashboard
			<div class="panel-tools">
				<a class="btn btn-xs btn-link panel-refresh" href="#">
					<i class="fa fa-refresh"></i>
				</a>

			</div>
		</div>
		<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel" >
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab" id="message" onclcik="loadPage('message')">
					<i class="fa fa-envelope fa-home"></i>
					{{__('app.Messages')}} <span class="badge badge-primary" id="message_badge"> 0 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab"  id="notice" onclcik="loadPage('notice')">
					<i class="fa fa-info-circle fa-home"></i>
					{{__('app.Notices')}} <span class="badge badge-default" id="notice_badge"> 0 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block   hometab"   id="course" onclcik="loadPage('course')">
					<i class="fa fa-book fa-home"></i>
					{{__('app.Courses')}} <span class="badge badge-danger" id="course_badge"> 0 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block   hometab"  id="survey" onclcik="loadPage('survey')">
					<i class="fa fa-group fa-home"></i>
					{{__('app.Surveys')}} <span class="badge badge-primary" id="survey_badge"> 0 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab"  id="publication" onclcik="loadPage('publication')">
					<i class="fa fa-file-text fa-home"></i>
					{{__('app.Publications')}} <span class="badge badge-warning" id="publication_badge"> 0 </span>
				</button>
			</div>
			<div class="col-sm-2 col-xs-6">
				<button class="btn btn-icon btn-block  hometab"  id="notification" onclcik="loadPage('notification')">
					<i class="fa fa-bell fa-home"></i>
					{{__('app.Notifications')}} <span class="badge badge-primary" id="notification_badge"> 0 </span>
				</button>
			</div>
		</div>
	</div>
</div>

    <script>
        alert($('#message_badge').html())
    </script>

