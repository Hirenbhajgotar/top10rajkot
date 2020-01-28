<div class="mt-4">
    <?php echo validation_errors(); ?>
    <br>
    <h4><?= $title ?></h4>
</div>

<?= form_open("forgot-password") ?>
<div class="form-group col-md-6">
    <label>Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your authenticated email">
</div>

<button type="submit" class="btn btn-primary">Submit</button>
<?= form_close() ?>