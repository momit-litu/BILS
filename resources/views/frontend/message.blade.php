<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class="clip-bubble-4"></i>
		{{__('app.Message')}}
		<div class="panel-tools">
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="loadNewMessaeg()">
				<i class="fa fa-refresh"></i>
			</a>

		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel" >
		<ol class="discussion">
			<li class="other">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-4.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
					<span class="time"> 51 min </span>
				</div>
			</li>
			<li class="self">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-1.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
					<span class="time"> 37 mins </span>
				</div>
			</li>
			<li class="other">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-3.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
				</div>
			</li>
			<li class="self">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-1.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
				</div>
			</li>
			<li class="other">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-4.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
				</div>
			</li>
			<li class="self">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-1.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
				</div>
			</li>
			<li class="other">
				<div class="avatar">
					<img alt="" src="assets/images/avatar-4.jpg">
				</div>
				<div class="messages">
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					</p>
				</div>
			</li>
			
		</ol>
	<div class="ps-scrollbar-x-rail" style="width: 323px; display: none; left: 0px; bottom: -263px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 266px; height: 460px; display: inherit; right: 3px;"><div class="ps-scrollbar-y" style="top: 169px; height: 291px;"></div></div></div>
	<div class="col-sm-12 padding-left-0 padding-right-0">
		<div class="chat-form ">
			<div class="input-group">
				<span class="input-group-btn dropup ">
					<button type="button" class="btn btn-warning dropdown-toggle btn-custom-side-padding border-radious-0" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					
					<div class="dropdown-menu dropdown-enduring dropdown-checkboxes">
						<input type="text" placeholder="Search Category" id="form-field-9" class="form-control">
					</div>
					<!--					
					<ul class="dropdown-menu">
						<li>
							<a href="#">
								Category 1
							</a>
						</li>
						<li>
							<a href="#">
								Category 2
							</a>
						</li>
					</ul>-->
				</span>
				<input type="text" id="message_input" class="form-control input-mask-date" placeholder="Type a message here..."/>
				<span class="input-group-btn ">
					<span class="btn btn-file btn-blue btn-custom-side-padding border-radious-0" >
						<i class="clip-attachment"></i>
						<input multiple="" id="attachment" name="attachment[]" type="file">
					</span>
				</span>
				<span class="input-group-btn ">
					<button class="btn btn-green border-radious-0" id="message_sent_button" type="button">
						<i class="clip-paperplane "></i>
					</button> 
				</span>
			</div>
		</div>
	</div>
</div>



	
<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
$(document).ready(function(){

	$('#message_sent_button').on('click',function(){
		alert("sent")
	});
});
</script>




