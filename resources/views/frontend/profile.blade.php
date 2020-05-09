<div class="panel panel-default border-none">
    <div class="panel-heading">
        <i class=" fa fa-file-user "></i>
        Profile
        <div class="panel-tools">

        </div>
    </div>
    <div class="panel-body panel-scroll ps-container ps-active-y fixed-panel" style="margin:0">

        <div class="tabbable">
            <ul class="nav nav-tabs tab-padding tab-space-3" id="myTab4">
                <li class="active">
                    <a data-toggle="tab" href="#panel_overview">
                        {{__('app.Overview')}}
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_edit_account">
                        {{__('app.Edit_Profile')}}
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_pass_change">
                        {{__('app.Change_Password')}}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="panel_overview" class="tab-pane in active">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="user-left">
                                <div class="center">
                                    <h4 id="profile_name">Momit</h4>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="user-image">
                                            <div class="fileupload-new thumbnail"><img src="assets/images/avatar-1-xl.jpg" id="profile_image" alt="">
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div class="user-image-buttons">
												<span class="btn btn-teal btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
													<input type="file">
												</span>
                                                <a href="#" class="btn fileupload-exists btn-bricky btn-sm" data-dismiss="fileupload">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>
                                        <a class="btn btn-twitter btn-sm btn-squared">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a class="btn btn-linkedin btn-sm btn-squared">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                        <a class="btn btn-google-plus btn-sm btn-squared">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                        <a class="btn btn-github btn-sm btn-squared">
                                            <i class="fa fa-github"></i>
                                        </a>
                                    </p>
                                    <hr>
                                </div>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="3">{{__('app.Contact_information')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>{{__('app.Email')}}:</td>
                                        <td>
                                            <a href="#" id="profile_email">
                                            </a></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('app.Phone')}}:</td>
                                        <td id="profile_phone"></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('app.Address')}}:</td>
                                        <td id="profile_address"></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">General information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Position</td>
                                            <td id="profile_position">UI Designer</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Last Logged In</td>
                                            <td id="profile_last_logIn">56 min</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>Senior Marketing Manager</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Supervisor</td>
                                            <td>
                                            <a href="#">
                                                Kenneth Ross
                                            </a></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td><span class="label label-sm label-info">Administrator</span></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table-->
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="3">{{__('app.Additional_information')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{__('app.Nid')}}</td>
                                        <td id="profile_nid"></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('app.Groups')}}</td>
                                        <td id="profile_groups"></td>
                                        <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="panel_edit_account" class="tab-pane">
                    <form action="#" role="form" id="update_profile_form" name="update_profile_form">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{__('app.Update_profile')}}</h3>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{__('app.Name')}}
                                    </label>
                                    <input type="text" placeholder="Peter" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        {{__('app.Email')}}
                                    </label>
                                    <input type="email" placeholder="peter@example.com" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        {{__('app.Phone')}}
                                    </label>
                                    <input type="text" placeholder="(641)-734-4763" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--div class="form-group connected-group">
                                    <label class="control-label">
                                        Date of Birth
                                    </label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="dd" id="dd" class="form-control" >
                                                <option value="">DD</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21" selected="selected">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="mm" id="mm" class="form-control" >
                                                <option value="">MM</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10" selected="selected">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" placeholder="1982" id="yyyy" name="yyyy" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Gender
                                    </label>
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" class="grey" value="" name="gender" id="gender_female">
                                            Female
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" class="grey" value="" name="gender"  id="gender_male" checked="checked">
                                            Male
                                        </label>
                                    </div>
                                </div-->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{__('app.Nid')}}
                                            </label>
                                            <input class="form-control tooltips" placeholder="" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="nid" id="nid">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{__('app.Address')}}
                                            </label>
                                            <input class="form-control tooltips" placeholder="" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="address" id="address">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        {{__('app.Profile_image')}}
                                    </label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;"><img src="assets/images/avatar-1-xl.jpg" alt="" id="profile_image_edit">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>
                                        <div class="user-edit-image-buttons">
											<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
												<input type="file" name="profile_image_upload" id="profile_image_upload">
											</span>
                                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    * {{__('app.Required_fields')}}
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p>
                                    {{__('app.Tarms_conditions')}}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-teal btn-block" type="submit" id="update_profile">
                                    {{__('app.Update')}} <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="panel_pass_change" class="tab-pane">
                    <form action="#" role="form" id="password_change_form" name="password_change_form">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{__('app.Update_password')}}</h3>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{__('app.Old_password')}}
                                    </label>
                                    <input type="password" placeholder="********" class="form-control"  name="old_password">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        {{__('app.New_password')}}
                                    </label>
                                    <input type="password" placeholder="********" class="form-control" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        {{__('app.Retype_new_password')}}
                                    </label>
                                    <input type="password" placeholder="********" class="form-control" name="retype_new_password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-teal btn-block" type="submit" id="update_password">
                                    {{__('app.Update')}} <i class="fa fa-arrow-circle-right"></i>
                                </button>
                                <p id="pass_change_message"></p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
        //alert("Profile");



        if($(".show-tab").length) {
            $('.show-tab').on('click', function(e) {
                e.preventDefault();
                var tabToShow = $(this).attr("href");
                if($(tabToShow).length) {
                    $('a[href="' + tabToShow + '"]').tab('show');
                }
            });
        };

        /*
        if(getParameterByName('tabId').length) {
            $('a[href="#' + getParameterByName('tabId') + '"]').tab('show');
        }

         */

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        loadProfile = () =>{
            $.ajax({
                type: "GET",
                url: "{{ url('app/')}}/" + 'profile_info',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function (xhr) {
                    ajaxPreLoad()
                    //$("#load-content").fadeOut('slow');
                },
                success: function (response) {
                    console.log(response)
                    response = JSON.parse(response);

                    $('#profile_name').html(response['name'])
                    $('#profile_email').html(response['email'])
                    $('#profile_phone').html(response['contact_no'])
                    $('#profile_address').html(response['address'])
                    $('#profile_nid').html(response['nid_no'])
                    $('#name').val(response['name'])
                    $('#email').val(response['email'])
                    $('#phone').val(response['contact_no'])
                    $('#address').val(response['address'])
                    $('#nid').val(response['nid_no'])

                    $('#profile_image').attr('src',"/assets/images/user/app_user/"+response['user_profile_image'])
                    $('#profile_image_edit').attr('src',"/assets/images/user/app_user/"+response['user_profile_image'])
                    //$('#profile_groups').html('')

                }
            })

        }

        $('#update_profile').click(function () {
            event.preventDefault()
            var formData = new FormData($('#update_profile_form')[0]);
            $.ajax({
                    url: "{{ url('app/')}}/update_profile",
                    type:'POST',
                    data:formData,
                    async:false,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success: function(data){
                        // need to confirmation
                        loadPage('profile')
                        // $(".message_div").animate({ scrollTop: 20000 }, "fast");
                    }
                });

        })

        loadProfile()

        $('#update_password').click(function () {
            event.preventDefault()


            var formData = new FormData($('#password_change_form')[0]);
            $.ajax({
                url: "{{ url('app/')}}/update_password",
                type:'POST',
                data:formData,
                async:false,
                cache:false,
                contentType:false,
                processData:false,
                success: function(data){
                    // need to confirmation
                    if(data==0){
                        $('#pass_change_message').css("background-color","green");
                        $('#pass_change_message').html('{{__('app.Password_change_successfully')}}');

                    }else if(data==1){
                        $('#pass_change_message').css("background-color","red");
                        $('#pass_change_message').html('{{__('app.Password_did_not_match')}}');

                    }
                    else{
                        $('#pass_change_message').css("background-color","red");
                        $('#pass_change_message').html('{{__('app.Wrong_password')}}');
                    }

                    setTimeout(function() {
                        $('#pass_change_message').fadeOut('fast');
                    }, 5000);                    // $(".message_div").animate({ scrollTop: 20000 }, "fast");
                }
            });

        })

</script>


