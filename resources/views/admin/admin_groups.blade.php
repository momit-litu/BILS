@extends('layout.master')
@section('content')
	<!--MESSAGE-->
	<div class="row ">
		<div class="col-md-10 col-md-offset-1" id="master_message_div">
		</div>
	</div>
	<!--END MESSAGE-->

    <!--PAGE CONTENT -->
    <div class="row ">
        <div class="col-sm-12">
            <div class="col-md-6 col-sm-6 col-xs-12">
            	<h4 class="text-info">Admin Group Management</h4><hr>
            	<div class="row no-margin-row">
					<form id="save_group_form" name="admin_user_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="edit_id" id="edit_id">
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-6">Group Name<span class="required">*</span></label>
									<div class="col-md-10 col-sm-10 col-xs-6">
										<input type="text" id="group_name" name="group_name" required class="form-control col-lg-12"/>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-6">Type<span class="required">*</span></label>
									<div class="col-md-10 col-sm-10 col-xs-6">
										<select name="type" id="type" class="form-control">
											<option value="">Select Type</option>
											<option value="1">Admin Uaer</option>
											<option value="2">App Uaer</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-6" >Is Active</label>
									<div class="col-md-4 col-sm-4 col-xs-6">
										<input type="checkbox" name="is_active" id="is_active" value="1" checked="checked">
									</div>
								</div>
								<div class="ln_solid"></div>
							</div>
						</div>
						<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-6"></label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<button type="submit" id="save_group" class="btn btn-success">Save</button>                    
							<button type="button" id="clear_button" class="btn btn-warning">Clear</button>                         
						</div>
						 <div class="col-md-7 col-sm-7 col-xs-12">
							<div id="form_submit_error" class="text-center" style="display:none"></div>
						 </div>
						</div>
					</form>		
                </div>
            </div>


			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="row no-margin-row">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-external-link-square"></i>

							<div class="panel-tools">
								<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
								</a>
								<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i>
								</a>
								<a class="btn btn-xs btn-link panel-refresh" href="#">
									<i class="fa fa-refresh"></i>
								</a>
								<a class="btn btn-xs btn-link panel-expand" href="#">
									<i class="fa fa-resize-full"></i>
								</a>
								<a class="btn btn-xs btn-link panel-close" href="#">
									<i class="fa fa-times"></i>
								</a>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-hover" id="admin_group" style="width:100% !important"> 
								<thead>
									<tr>
										<th>ID</th>
										<th>Group Name</th>
										<th>Type</th>
										<th class="hidden-xs">Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
			    </div>
			</div>
        </div>
    </div>

@endsection


@section('JScript')

	<script src="{{ asset('assets/js/bils/admin/user.js')}}"></script>

@endsection

