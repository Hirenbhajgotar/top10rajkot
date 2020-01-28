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
        <h3 class="breadcrumb-header">Add Buyer</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open('Buyer/addBuyer', ['id' => 'buyer_validation']); ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Firstname</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name'];
                                                                else echo ''; ?>" name="first_name" id="first_name" class="form-control" placeholder="Firstname">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Lastname</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name'];
                                                                else echo ''; ?>" name="last_name" class="form-control" placeholder="Lastname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Email</label>
                                <div class="">
                                    <input type="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];
                                                                else echo ''; ?>" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Mobile No.</label>
                                <div class="">
                                    <input type=" text" value="<?php if (isset($_POST['mobile_no'])) echo $_POST['mobile_no'];
                                                                else echo ''; ?>" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile no.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                <label class="col-form-label">Company Name</label>
                                <div class="">
                                    <input type="text" name="company" value="<?php if (isset($_POST['company'])) echo $_POST['company'];
                                                                                else echo ''; ?>" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Address 1</label>
                                <div class="">
                                    <input type="text" name="address_1" id="address_1" value="<?php if (isset($_POST['address_1'])) echo $_POST['address_1'];
                                                                                                else echo ''; ?>" class="form-control" placeholder="Address 1">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Address 2</label>
                                <div class="">
                                    <input type="text" name="address_2" value="<?php if (isset($_POST['address_2'])) echo $_POST['address_2'];
                                                                                else echo ''; ?>" class="form-control" placeholder="Address 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">City</label>
                                <div class="">
                                    <input type="text" name="city" value="<?php if (isset($_POST['city'])) echo $_POST['city'];
                                                                            else echo ''; ?>" class="form-control" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Postcode</label>
                                <div class="">
                                    <input type="text" name="postcode" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode'];
                                                                                else echo ''; ?>" class="form-control" placeholder="Postcode">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Country</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['country_id'])) { ?>
                                        <select name="country_id" id="country" class="form-control" onchange="get_state()">
                                            <option selected disabled>Select country</option>
                                            <?php foreach ($countries as $country) {
                                                if ($_POST['country_id'] == $country->country_id) { ?>
                                                    <option selected value="<?= $country->country_id ?>"><?= $country->name ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $country->country_id ?>"><?= $country->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <select name="country_id" id="country" class="form-control" onchange="get_state()">
                                            <!-- <option selected disabled>Select country</option> -->
                                            <?php foreach ($countries as $country) {
                                                if ($country->country_id == 1) { ?>
                                                    <option selected value="<?= $country->country_id ?>"><?= $country->name ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $country->country_id ?>"><?= $country->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">State</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['state_id'])) { ?>
                                        <select name="state_id" id="state" class="form-control">
                                            <?php foreach ($states as $state) {
                                                if ($_POST['state_id'] == $state->state_id and $_POST['country_id']) { ?>
                                                    <option selected value="<?= $state->state_id ?>"><?= $state->name ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $state->state_id ?>"><?= $state->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <select name="state_id" id="state" class="form-control">
                                            <?php foreach ($india_states as $india_state) {
                                                if ($india_state->state_id == 1) { ?>
                                                    <option selected value="<?= $india_state->state_id ?>"><?= $india_state->name ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $india_state->state_id ?>"><?= $india_state->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Password</label>
                                <div class="">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Confirm Password</label>
                                <div class="">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="form-group col-md-12">
                                <label class="col-form-label"></label>
                                <div class="">
                                    <div class="checkbox">
                                        <label>
                                            <input <?php if (isset($_POST['newsletter'])) echo 'checked';
                                                    else echo ''; ?> name="newsletter" value="1" type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-plus-circle'></i> Add Product</button>
                                    <a href="<?= base_url("Products/productList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
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