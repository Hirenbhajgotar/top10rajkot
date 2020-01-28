<style>
    /* a.fa.fa-trash {
        font-size: 30px;
    } */
    .right {
        float: right;
    }

    .search {
        box-shadow: none !important;
        border: 1px solid #C1C7CD;
        color: #646464;
        border-radius: 4px;
        padding: 5px 12px;
        height: 32px;
    }

    /* .size {
        font-size: 13px;
    } */
</style>


<?php
if (isset($img_error)) {
?>
    <div class="alert alert-warning icons-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        <p><strong>Error! &nbsp;&nbsp;</strong><?= $img_error ?> </p>
    </div>

<?php
}
?>


<div class="page-inner">
    <div class="page-title">
        <a href="<?= base_url("Banner/bannerList") ?>" class="btn btn-primary right"><i class="fa fa-arrow-circle-left"></i> Back</a>
        <h3 class="breadcrumb-header"><?= $title ?></h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open_multipart('Banner/addBanner', ['id' => 'banner_validation']); ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Name</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['name'])) echo $_POST['name'];
                                                                else echo ''; ?>" name="name" id="name" class="form-control" placeholder="Banner name">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Position</label>
                                <div class="">
                                    <select name="position" id="position" class="form-control">
                                        <?php
                                        if (isset($_POST['position'])) {
                                            if ($_POST['position'] == 0) { ?>
                                                <option selected value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($_POST['position'] == 1) { ?>
                                                <option value="0">Top</option>
                                                <option selected value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($_POST['position'] == 2) { ?>
                                                <option value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option selected value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($_POST['position'] == 3) { ?>
                                                <option value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option selected value="3">Left</option>
                                            <?php }
                                        } else { ?>
                                            <option selected value="0">Top</option>
                                            <option value="1">Right</option>
                                            <option value="2">Bottom</option>
                                            <option value="3">Left</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Link</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['link'])) echo $_POST['link'];
                                                                else echo ''; ?>" name="link" id="link" class="form-control" placeholder="Banner link">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Image</label>
                                <div class="">
                                    <input type="file" name="image" id="image" class="form-control" placeholder="image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Short order</label>
                                <div class="">
                                    <input type="text" name="short_order" id="short_order" value="<?php if (isset($_POST['short_order'])) echo $_POST['short_order'];
                                                                                                    else echo ''; ?>" class="form-control" placeholder="Short order">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Status</label>
                                <div class="">
                                    <select name="status" class="form-control">
                                        <?php
                                        if (isset($_POST['status'])) {
                                            if ($_POST['status'] == 1) { ?>
                                                <option selected value="1">enable</option>
                                                <option value="">Disable</option>
                                            <?php } else if ($_POST['status'] == 0) { ?>
                                                <option value="1">Enable</option>
                                                <option selected value="0">Disable</option>
                                            <?php }
                                        } else { ?>
                                            <option selected value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-plus-circle'></i> Add Product</button>
                                    <a href="<?= base_url("Banner/bannerList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                </div>
                            </div>
                        </div>


                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function get_state() {
        let country_id = document.getElementById('country').value;

        $.ajax({
            url: "<?php echo site_url('Buyer/get_states') ?>",
            method: "post",
            data: {
                'country_id': country_id
            },
        }).done(function(states) {
            // console.log(states);
            states = JSON.parse(states);
            $('#state').empty();
            states.forEach(function(state) {
                $('#state').append('<option value="' + state.state_id + '">' + state.name + '</option>')
            });
        });
    }
</script>