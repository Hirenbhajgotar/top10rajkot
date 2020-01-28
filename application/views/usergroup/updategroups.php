   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Groups</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Groups</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Groups</a>
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
                                <h5>Edit Groups</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
                                 <div class="validation_errors_alert">

                                </div>
                            </div>
                             <div class="col-sm-8">
                               <?php echo form_open_multipart('usersgroup/update_groups'); ?>
							   
							   <?php if($groups['id']){ ?>
							   
							   <input type="hidden" name="id" class="form-control" value="<?php echo $groups['id']; ?>">
							   
							   <?php } else { ?>	
							   
							   <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>">
							   
                                 <?php } ?>	  
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">User Group Name</label>
                                        <div class="col-sm-10">
										<?php if($groups['name']){ ?>
                                            <input type="text" name="name" value="<?php echo $groups['name']; ?>"class="form-control" placeholder="User Group Name">
										<?php } else { ?>	
											<input type="text" name="name" value="<?php echo $name; ?>"class="form-control" placeholder="User Group Name">
										<?php } ?>	
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">User Group Permission</label>
                                        <div class="col-sm-10">
										<?php if($groups['permission']){ ?>
                                      <textarea name="permission" class="form-control" rows="4" cols="50"><?php echo $groups['permission']; ?></textarea>
									  <?php } else { ?>	
									     <textarea name="permission" class="form-control" rows="4" cols="50"><?php echo $permission; ?></textarea>
									   <?php } ?>	
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="status">
											  <?php if($groups['status'] == 1) { ?>
											  <option value="1" selected>Enabled</option>
											  <option value="0">Disabled</option>
											  <?php } else { ?>
											  <option value="1">Enabled</option>
											  <option value="0" selected>Disabled</option>
											  <?php } ?>
											   </select>
                                        </div>
                                    </div>
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">update</button>
                                        </div>
                                    </div>
                                    <textarea id="description" style="visibility: hidden;"></textarea>
                                    
                                </form>
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