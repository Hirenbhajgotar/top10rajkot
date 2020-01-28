<div class="mt-4">
    <?php echo validation_errors(); ?>
    <br>
    <!-- <h4><?= $title ?></h4> -->
</div>
<?= form_open("verify-otp") ?>
<div class="form-group col-md-6">
    <label>Otp</label>
    <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter your otp">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?= form_close() ?>