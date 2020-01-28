
<div class="mt-4">
    <?php echo validation_errors(); ?>
    <br>
    <h4><?= $title ?></h4>
</div>
    
<div class="mt-3">
    <?= form_open("change-password/{$id}") ?>
    <div class="form-group col-md-6">
        <label>New password</label>
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
    <button type="submit" class="btn btn-primary">Submit</button>
    <?= form_close() ?>
</div>