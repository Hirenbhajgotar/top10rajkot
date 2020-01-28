<div class="">
    <div class="">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart("update-profile/{$buyer_data->id}"); ?>
        <h3 class=""><?= $title ?></h3>
        <div class="col-md-6">
            <div class="form-group">
                <label>First name</label>
                <input type="text" value="<?php if (isset($_POST['first_name'])) {
                                                echo $_POST['first_name'];
                                            } else if ($buyer_data->first_name) {
                                                echo $buyer_data->first_name;
                                            } ?>" class="form-control" name="first_name" id="first_name" placeholder="First Name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Last name</label>
                <input type="text" value="<?php if (isset($_POST['last_name'])) {
                                                echo $_POST['last_name'];
                                            } else if ($buyer_data->last_name) {
                                                echo $buyer_data->last_name;
                                            } ?>" name="last_name" id="last_name" class="form-control" placeholder="Last name">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="text" value="<?php if (isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        } else if ($buyer_data->email) {
                                            echo $buyer_data->email;
                                        } ?>" name="email" id="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
            <label>Mobile no.</label>
            <input type="text" value="<?php if (isset($_POST['mobile_no'])) {
                                            echo $_POST['mobile_no'];
                                        } else if ($buyer_data->mobile_no) {
                                            echo $buyer_data->mobile_no;
                                        } ?>" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile no">
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
                } else if ($buyer_data->gender) {
                    $gender = $buyer_data->gender;
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
                }  else {
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
            <input type="password" value="<?php if (isset($_POST['password'])) {
                                                echo $_POST['password'];
                                            } else {
                                                echo '';
                                            } ?>" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group col-md-6">
            <label>Confirm Password</label>
            <input type="password" value="<?php if (isset($_POST['confirm_password'])) {
                                                echo $_POST['confirm_password'];
                                            } else {
                                                echo '';
                                            } ?>" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
        </div>

        <input type="hidden" name="date_addedd" value="<?= $buyer_data->date_addedd ?>">
        <input type="hidden" name="status" value="<?= $buyer_data->status ?>">
        <input type="hidden" name="email_verify" value="<?= $buyer_data->email_verify ?>">
        <input type="hidden" name="mobile_verify" value="<?= $buyer_data->mobile_verify ?>">

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">update</button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>