<br><br><br><br>
<div class="container mb30">
    <div class="row">
        <div class="col-sm-3 mb40">
            <img src="<?= base_url("assets/images/no-image-available-icon-6.png") ?>" alt="" class="img-responsive mb15">
            <a href="#" class="link-underline">Change Profile</a>
        </div>
        <div class="col-sm-8 col-sm-offset-1 mb40">
            <?php echo validation_errors(); ?>
            <?php echo form_open_multipart('register'); ?>
            <div class="form-group">
                <label>First Name</label>
                <input type="email" name="first_name" id="first_name" value="<?= set_value("first_name") ?>" class="form-control" placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="email" name="last_name" id="last_name" value="<?= set_value("last_name") ?>" class="form-control" placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" id="email" value="<?= set_value("email") ?>" class="form-control" placeholder="john@gmail.com">
            </div>
            <div class="form-group">
                <label>Phone number</label>
                <input type="text" name="mobile_no" id="mobile_no" value="<?= set_value("mobile_no") ?>" class="form-control" placeholder="01-394-4932">
            </div>
            <div class="">
                <label class=" col-form-label">Gender</label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" <?= set_radio("male") ?>> Male
                </label> &nbsp;&nbsp;
                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" <?= set_radio("male") ?>> Female
                </label>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" id="password" value="<?= set_value("password") ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" value="<?= set_value("confirm_password") ?>" class="form-control">
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-lg">Sign up</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>