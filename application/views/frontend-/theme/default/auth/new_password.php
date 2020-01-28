<div class="mt-4">
    <?php echo validation_errors(); ?>
    <br>
    <h4><?= $title ?></h4>
</div>
<?= form_open("new-password") ?>
<div class="form-group col-md-6">
    <label>Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
</div>
<div class="form-group col-md-6">
    <label>Comfirm password</label>
    <input type="password" class="form-control" name="comfirm_password" id="comfirm_password" placeholder="Enter your comfirmation password">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?= form_close() ?>