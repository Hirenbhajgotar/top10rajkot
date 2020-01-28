<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Update profile</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <!-- <div class="panel-heading clearfix">
                        <h3 class="panel-title">Update profile</h3>
                    </div> -->
                    <div class="panel-body">
                        <!-- <form class="form-horizontal"> -->
                        <?= form_open_multipart("Admin/updateAdminProfileData", ['class' => 'form-horizontal']) ?>

                        <input type="hidden" name="id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control" id="Username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" id="inputEmail3" placeholder="Email">
                                <!-- <p class="help-block" style="margin-bottom:0;">Example block-level help text here.</p> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile no.</label>
                            <div class="col-sm-10">
                                <input type="text" name="mobile" value="<?php echo $user['mobile']; ?>" class="form-control" id="Username" placeholder="Mobile no">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label class="col-sm-2 col-form-label">Gender</label> -->
                            <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                            <label class="radio-inline">
                                <input value="Female" <?php if ($user['gender'] == 'Female') {
                                                            echo "checked";
                                                        } ?> name="gender" checked="" type="radio"><i class="helper"></i> Female
                            </label>
                            <label class="radio-inline">
                                <input value="Male" <?php if ($user['gender'] == 'Male') {
                                                        echo "checked";
                                                    } ?> name="gender" type="radio"><i class="helper"></i> Male
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">User Image</label>
                            <div class="col-sm-10">
                                <img src="<?php echo base_url() . 'assets/images/users/' . $user['image']; ?>" width="70px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Update Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="userfile" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $user['status']; ?>" name="status" class="js-single" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Update profile</button>
                            </div>
                        </div>
                        <!-- </form> -->
                        <?= form_close() ?>
                    </div>
                </div>
            </div>

        </div><!-- Row -->
    </div><!-- Main Wrapper -->