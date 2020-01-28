   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Users</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Users</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Update Users</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page header end -->
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Update User -- <small style="text-decoration: underline;"><?php echo $user['username']; ?></small></h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
							 <div class="col-sm-8">
                                 <div class="validation_errors_alert">

                                </div>
                            </div>
                               <?php echo form_open_multipart('users/update_user_data'); ?>
							       <?php if($user['id'])  { ?>
                                     <input type="hidden" name="id" class="form-control" value="<?php echo $user['id']; ?>">
								   <?php } else { ?>
                                      <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>">
								   <?php } ?>									  
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Firstname</label>
                                        <div class="col-sm-10">
										<?php if($user['firstname'])  { ?>
										
                                            <input type="text" name="firstname" class="form-control" value="<?php echo $user['firstname']; ?>" placeholder="Full Name">
											
										<?php } else { ?>
										
										<input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" placeholder="Full Name">
										
										<?php } ?>
											
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Lastname</label>
                                        <div class="col-sm-10">
										<?php if($user['lastname'])  { ?>
										
                                            <input type="text" name="lastname" class="form-control" value="<?php echo $user['lastname']; ?>" placeholder="Full Name">
											
											<?php } else { ?>
											
											<input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="Full Name">
											
											<?php } ?>
                                        </div>
                                    </div>
									
                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
										<?php if($user['username'])  { ?>
										
                                            <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" placeholder="User Name">
											<?php } else { ?>
											
											<input type="text" name="username" class="form-control" value="<?php echo $username ?>" placeholder="User Name">
											
											<?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
										<?php if($user['email'])  { ?>
										
                                            <input type="text"  name="email" class="form-control" value="<?php echo $user['email']; ?>" placeholder="Email">
											
											<?php } else { ?>
											
											<input type="text"  name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
											<?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Mobile No.</label>
                                        <div class="col-sm-10">
										<?php if($user['mobile'])  { ?>
                                            <input type="text" name="contact" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $user['mobile']; ?>" class="form-control" placeholder="Mobile No.">
											<?php } else { ?>
											
											 <input type="text" name="contact" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $contact; ?>" class="form-control" placeholder="Mobile No.">
											<?php } ?>
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password"  name="password" class="form-control" placeholder="password" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Re-type Password</label>
                                        <div class="col-sm-10">
                                          <input type="password" name="confirmPassword" class="form-control" placeholder="Re-type Password" id="confirmPassword">
											<span id='message'></span>
                                        </div>
                                    </div>
                                    
                                    
                                   <div class="form-group row" style="float:center;">
                                    <label class="col-sm-2 col-form-label">Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php if ($user['gender'] == 0) { ?>
                                         <label>
                                            <input value="0" name="gender" checked="" type="radio"><i class="helper"></i> Female
                                        </label>
										 &nbsp;&nbsp;&nbsp;&nbsp;
										<label>
                                            <input value="1" name="gender" type="radio"><i class="helper"></i> Male
                                        </label>
									<?php } else { ?>	
									    <label>
                                            <input value="0" name="gender"  type="radio"><i class="helper"></i> Female
                                        </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label>
                                            <input value="1" name="gender" checked="" type="radio"><i class="helper"></i> Male
                                        </label>
									<?php } ?>	
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">User Image</label>
                                        <div class="col-sm-6">
										  <img src="<?php echo base_url().'assets/images/users/'.$user['image']; ?>" width="70px"> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Update Image</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="userfile" class="form-control">
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Select UserGroup</label>
                                        <div class="col-sm-6">
										<?php if($user['user_group_id']){ ?>
                                            <select class="form-control" name="user_group_id">
											<?php foreach ($usergroups as $usergroup) { ?>
                                             <option value="<?php echo $usergroup['id']; ?>" <?php if($usergroup['id'] == $user['user_group_id']){ echo ' selected="selected"'; }?>><?php echo $usergroup['name']; ?></option>
											 <?php } ?>	  
											 </select>
										<?php } else { ?>	 
											 
											 <select class="form-control" name="user_group_id">
											<?php foreach ($usergroups as $usergroup) { ?>
											  <option value="<?php echo $usergroup['id']; ?>" <?php if($usergroup['id'] == $user_group_id){ echo ' selected="selected"'; }?>><?php echo $usergroup['name']; ?></option>
											  <?php } ?>	  
											  </select>
										<?php  } ?>
                                        </div>
                                    </div>
									
                                    
                                   <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-6">
										<?php if($user['status'])  { ?>
                                            <select class="form-control" name="status">
											  <?php if($user['status'] == 1) { ?>
											  <option value="1" selected>Enabled</option>
											  <option value="0">Disabled</option>
											  <?php } else { ?>
											  <option value="1">Enabled</option>
											  <option value="0" selected>Disabled</option>
											  <?php } ?>
											   </select>
										<?php } else { ?>
										
										<select class="form-control" name="status">
											  <?php if($status == 1) { ?>
											  <option value="1" selected>Enabled</option>
											  <option value="0">Disabled</option>
											  <?php } else { ?>
											  <option value="1">Enabled</option>
											  <option value="0" selected>Disabled</option>
											  <?php } ?>
											   </select>
                                        <?php } ?>										
                                        </div>
                                    </div>
									
									
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
									
                                    <textarea id="description" style="visibility: hidden;"></textarea>
                                </form>
                               </div>
                              </div>
                             </div>
                            </div>
                          </div>
						 </div>
                        <!-- Basic Form Inputs card end -->
                   

     <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/swithces.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.js"></script>

   
    <!-- ck editor -->
    <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
    <!-- echart js -->
  
    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	
	<script>
	 $('#password, #confirmPassword').on('keyup', function () {
  if ($('#password').val() == $('#confirmPassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
  </script>