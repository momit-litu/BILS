@extends('layout.master')
@section('style')

@endsection
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
            <div class="tabbable">
                <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                    <li class="active">
                        <a id="message_list" data-toggle="tab" href="#message_list_div">
                           <b> Message List</b>
                        </a>
                    </li>
                    @if($actions['add_permisiion']>0)
	                    <li class="">
	                        <a data-toggle="tab" href="#entry_form_div" id="message_entry">
	                           <b> Add Message</b>
	                        </a>
	                    </li>
	                @endif
                </ul>
                <div class="tab-content">
                    <!-- PANEL FOR OVERVIEW-->
                    <div id="message_list_div" class="tab-pane in active">
						<div class="row no-margin-row">
                           <!-- List of Categories -->
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
									<table class="table table-bordered table-hover message_table" id="message_table" style="width:100% !important">
										<thead>
											<tr>
												<th>Admin Message </th>
												<th>Category</th>
												<th>App User Name </th>
												<th>Seen Status </th>
												<th class="hidden-xs">Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END Categoreis -->
                        </div>
                    </div>
                    <!--END PANEL FOR OVERVIEW -->

                    <!-- PANEL FOR CHANGE PASSWORD -->
                    <div id="entry_form_div" class="tab-pane in">
                        <div class="row no-margin-row">
							<form id="message_form" name="message_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
								@csrf
								<div class="row">
								<div class="col-md-12">
									<input type="hidden" name="message_edit_id" id="message_edit_id">
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-6">Megssage<span class="required">*</span></label>
										<div class="col-md-10 col-sm-10 col-xs-12">
											<textarea class=" form-control summernote"  id="admin_message" name="admin_message" cols="10" rows="4"></textarea>
										</div>
									</div>


									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-6" >Attachment</label>
										<div class="col-md-4 col-sm-4 col-xs-6">
                                            <input multiple id="attachment" name="attachment[]" type="file"/>
                                            <p id="file"></p>
										</div>
										<label class="control-label col-md-2 col-sm-2 col-xs-6" >Message Category</label>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<select name="message_category" id="message_category" class="form-control">
												<option disabled="" selected="" value="">Select Message Category</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-6" >Is Active</label>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<input type="checkbox" id="is_active" name="is_active" checked="checked" class="form-control col-lg-12"/>
										</div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-6" >Send to All App Users</label>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <input type="checkbox" id="all_users" name="all_users" checked="checked" class="form-control col-lg-12"/>
                                        </div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-6" >App User Name</label>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<input type="text" id="app_user_name" name="app_user_name" class="form-control col-lg-12"/>
										</div>
										<input type="hidden" name="app_user_id" id="app_user_id">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-6" >App User Group</label>
										<div class="col-md-10 col-sm-10 col-xs-6">
											<div id="app_user_group">

											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-6" >&nbsp;</label>
										<div class="col-md-10 col-sm-10 col-xs-6">
											<button id="load_app_user_from_group" type="submit" class="btn btn-sm btn-primary">Load App User</button>
											<div id="app_user_group_members">

											</div>
										</div>
									</div>

								</div>

								</div>
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6"></label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<button type="submit" id="save_message" class="btn btn-success save">Save</button>
									<button type="button" id="clear_button" class="btn btn-warning">Clear</button>
								</div>
								 <div class="col-md-7 col-sm-7 col-xs-12">
									<div id="form_submit_error" class="text-center" style="display:none"></div>
								 </div>
							</div>
							</form>
                        </div>
                    </div>
                    <!-- END PANEL FOR CHANGE PASSWORD -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--END PAGE CONTENT-->

@endsection


@section('JScript')

	<script>
		var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
		var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
		var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
	</script>

	<script src="{{ asset('assets/js/bils/message/message.js')}}"></script>

{{-- <script src=" {{ asset('ckeditor/ckeditor.js') }} "></script>
	<script>
    	CKEDITOR.replace( 'details' );
	</script> --}}

@endsection


