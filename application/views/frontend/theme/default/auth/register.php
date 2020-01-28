<div class="">
    <div class="">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('register'); ?>
        <h3 class=""><?= $title ?></h3>
        <div class="col-md-6">
            <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Last name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
            <label>Mobile no.</label>
            <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile no">
        </div>

        <div class="form-group col-md-6">
            <label class=" col-form-label">Gender</label>
            <div class="">
                <?php
                if (isset($_POST['gender'])) {
                    $gender = $_POST['gender'];
                    switch ($gender) {
                        case 'male':
                            $m_selected = 'checked';
                            $f_selected = '';
                            break;

                        case 'female':
                            $f_selected = 'checked';
                            $m_selected = '';
                            break;
                        default:
                            $m_selected = '';
                            $f_selected = '';
                            break;
                    }
                } else {
                    $m_selected = 'checked';
                    $f_selected = '';
                }
                ?>
                <label class="">
                    <input type="radio" name="gender" value="male" <?= $m_selected ?>> Male
                </label> &nbsp;&nbsp;
                <label class="">
                    <input type="radio" name="gender" value="female" <?= $f_selected ?>> Female
                </label>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group col-md-6">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Sign up</button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>