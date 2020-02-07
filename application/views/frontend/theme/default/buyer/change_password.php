

        <div class="page-bread mb70">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Change Password</h3>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb70">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="border-card">
                        <h3 class="font300 mb0 text-center">Change Password</h3> <hr>
						<?php if (validation_errors() != null) : ?>
     <?php echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>' . validation_errors() . '</p></div>'; ?>
     <?php endif; ?>
	 <?php if (isset($error)) { ?>
     <div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong><?php echo $error; ?></p></div>
     <?php } ?>
                 <?php echo form_open_multipart(base_url('change_password/'.$id)); ?>
                            <div class="form-group mb15" for="firstname">
                               <label>Old Password</label>
                                <input type="password" name="old_p"  id="old_p" class="form-control" placeholder="Old Password">
                            </div>
							<div class="form-group mb15" for="lastname">
                                 <label>New Password</label>
                                <input type="password" name="new_p" id="new_p" class='form-control' placeholder="New Password">
                            </div>
                            <div class="form-group mb15" for="a_1">
                                 <label>Confirm New Password</label>
                                <input type="password" name="confirm_p" id="confirm_p" class='form-control' placeholder="Confirm New Password">
                            </div>
							
							
                            <input type="submit" value="Update" class='btn btn-primary btn-lg btn-block'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.1.0.min.js"></script>

 
       
        
		