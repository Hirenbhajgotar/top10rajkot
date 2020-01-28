   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
   <!-- Date-range picker css  -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
   <!-- Date-Dropper css -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />

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

   <div class="page-header">
       <div class="page-header-title">
           <h4><?= $title ?></h4>
       </div>
       <div class="page-header-breadcrumb">
           <ul class="breadcrumb-title">
               <li class="breadcrumb-item">
                   <a href="index-2.html">
                       <i class="icofont icofont-home"></i>
                   </a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Buyer</a>
               </li>
               <li class="breadcrumb-item"><a href="#!"><?= $title ?></a>
               </li>
           </ul>
       </div>
   </div>
   <!-- Page header end -->
   <!-- Page body start -->
   <div class="page-body">
       <div class="row">
           <div class="col-sm-12">
               <!-- Basic Form Inputs card start -->
               <div class="card">
                   <div class="card-header">
                       <h5><?= $title ?></h5>
                       <div class="card-header-right">
                           <i class="icofont icofont-rounded-down"></i>
                           <i class="icofont icofont-refresh"></i>
                           <i class="icofont icofont-close-circled"></i>
                       </div>
                   </div>
                   <div class="card-block">
                       <div class="col-sm-8">
                           <div class="validation_errors_alert"></div>
                       </div>
                       <?php
                        // echo '<pre>';
                        // print_r($address);
                        // // print_r($countries);
                        // echo '</pre>';
                        // exit;
                        ?>
                       <div class="col-sm-8">
                           <?php echo form_open("Buyer/updateBuyerData/{$buyer['id']}"); ?>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Firstname</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name'];
                                                                else if ($buyer['first_name']) echo $buyer['first_name'] ?>" name="first_name" id="first_name" class="form-control" placeholder="Firstname">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Lastname</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name'];
                                                                else if ($buyer['last_name']) echo $buyer['last_name'] ?>" name="last_name" class="form-control" placeholder="Lastname">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Email</label>
                               <div class="col-sm-10">
                                   <input type="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];
                                                                else if ($buyer['email']) echo $buyer['email'] ?>" name="email" class="form-control" placeholder="Email">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Mobile No.</label>
                               <div class="col-sm-10">
                                   <input type=" text" value="<?php if (isset($_POST['mobile_no'])) echo $_POST['mobile_no'];
                                                                else if ($buyer['mobile_no']) echo  $buyer['mobile_no'] ?>" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile no.">
                               </div>
                           </div>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Gender</label>
                               <div class="col-sm-6">
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
                                                $m_selected = 'checked';
                                                $f_selected = '';
                                                break;
                                        }
                                    } else {
                                        $gender = $buyer['gender'];
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
                                                $m_selected = 'checked';
                                                $f_selected = '';
                                                break;
                                        }
                                    }
                                    ?>
                                   <label class="radio-inline">
                                       <input type="radio" name="gender" value="male" <?= $m_selected ?>> Male
                                   </label>
                                   <label class="radio-inline">
                                       <input type="radio" name="gender" value="female" <?= $f_selected ?>> Female
                                   </label>


                               </div>
                           </div>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Company Name</label>
                               <div class="col-sm-10">
                                   <input type="text" name="company" value="<?php if (isset($_POST['company'])) echo $_POST['company'];
                                                                            else if (isset($address[0]['company'])) echo $address[0]['company']  ?>" class="form-control" placeholder="Company Name">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Address 1</label>
                               <div class="col-sm-10">
                                   <input type="text" name="address_1" value="<?php if (isset($_POST['address_1'])) echo $_POST['address_1'];
                                                                                else if (isset($address[0]['address_1'])) echo $address[0]['address_1']  ?>" class="form-control" placeholder="Address 1">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Address 2</label>
                               <div class="col-sm-10">
                                   <input type="text" name="address_2" value="<?php if (isset($_POST['address_2'])) echo $_POST['address_2'];
                                                                                else if (isset($address[0]['address_2'])) echo $address[0]['address_2']  ?>" class="form-control" placeholder="Address 2">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Country</label>
                               <div class="col-sm-10">
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
                                   <?php } else if ($address[0]['country_id']) { ?>
                                       <select name="country_id" id="country" class="form-control" onchange="get_state()">
                                           <option selected disabled>Select country</option>
                                           <?php foreach ($countries as $country) {
                                                if ($address[0]['country_id'] == $country->country_id) { ?>
                                                   <option selected value="<?= $country->country_id ?>"><?= $country->name ?></option>
                                               <?php } else { ?>
                                                   <option value="<?= $country->country_id ?>"><?= $country->name ?></option>
                                               <?php } ?>
                                           <?php } ?>
                                       </select>
                                   <?php } ?>


                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">State</label>
                               <div class="col-sm-10">
                                   <?php
                                    if (isset($_POST['state_id'])) { ?>
                                       <select name="state_id" id="state" class="form-control">
                                           <?php foreach ($selected_states as $selected_state) {
                                                if ($_POST['state_id'] == $selected_state->state_id) { ?>
                                                   <option selected value="<?= $selected_state->state_id ?>"><?= $selected_state->name ?></option>

                                               <?php } ?>
                                               <option value="<?= $selected_state->state_id ?>"><?= $selected_state->name ?></option>
                                           <?php } ?>
                                       </select>
                                   <?php } else { ?>
                                       <select name="state_id" id="state" class="form-control">
                                           <?php foreach ($selected_states as $selected_state) {
                                                if ($address[0]['state_id'] == $selected_state->state_id) { ?>
                                                   <option selected value="<?= $selected_state->state_id ?>"><?= $selected_state->name ?></option>

                                               <?php } else { ?>
                                                   <option value="<?= $selected_state->state_id ?>"><?= $selected_state->name ?></option>
                                               <?php } ?>
                                           <?php } ?>
                                       </select>
                                   <?php } ?>

                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">City</label>
                               <div class="col-sm-10">
                                   <input type="text" name="city" value="<?php if (isset($_POST['city'])) echo $_POST['city'];
                                                                            else if (isset($address[0]['city'])) echo $address[0]['city']  ?>" class="form-control" placeholder="City">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Postcode</label>
                               <div class="col-sm-10">
                                   <input type="text" name="postcode" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode'];
                                                                                else if (isset($address[0]['postcode'])) echo $address[0]['postcode']  ?>" class="form-control" placeholder="Postcode">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Password</label>
                               <div class="col-sm-10">
                                   <input type="password" value="<?php if (isset($_POST['password'])) echo $_POST['password'];
                                                                    else if ($buyer['password']) echo $buyer['password'] ?>" name="password" class="form-control" placeholder="Password">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Confirm Password</label>
                               <div class="col-sm-10">
                                   <input type="password" value="<?php if (isset($_POST['confirm_password'])) echo $_POST['confirm_password'];
                                                                    else if ($buyer['password']) echo $buyer['password'] ?>" name="confirm_password" class="form-control" placeholder="Password">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Status</label>
                               <div class="col-sm-10">
                                   <select name="status" class="form-control">
                                       <?php
                                        if ($buyer['status'] == 0) { ?>
                                           <option selected value="0">disable</option>
                                           <option value="1">anable</option>

                                       <?php } else { ?>
                                           <option selected value="1">Anable</option>
                                           <option value="0">Disable</option>
                                       <?php } ?>
                                   </select>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class=" col-sm-10">
                                   <div class="checkbox">
                                       <label>
                                           <?php
                                            if (isset($_POST['newsletter'])) {
                                                if ($_POST['newsletter'] == "on") { ?>
                                                   <input checked name="newsletter" type="checkbox"> Remember me
                                               <?php } else { ?>
                                                   <input name="newsletter" type="checkbox"> Remember me
                                                <?php } 
                                            } else { ?>
                                                <input <?php if (isset($newsletter->buyer_id)) echo "checked"  ?> name="newsletter" type="checkbox"> Remember me
                                            <?php } ?>
                                       </label>
                                   </div>
                               </div>
                           </div>

                           <input type="hidden" name="date_addedd" value="<?php if (isset($buyer['date_addedd'])) echo $buyer['date_addedd'];
                                                                            ?>">
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class="col-sm-10">
                                   <button type="submit" class="btn btn-primary">Update buyer</button>
                               </div>
                           </div>

                           </form>
                       </div>

                   </div>
               </div>
           </div>
           <!-- Basic Form Inputs card end -->


           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.js"></script>
           <!-- Custom js -->
           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/swithces.js"></script>
           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/moment-with-locales.min.js"></script>
           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
           <!-- Date-range picker js -->
           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
           <!-- Date-dropper js -->
           <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.js"></script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

           <!-- ck editor -->
           <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
           <!-- echart js -->

           <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>
           <script>
               $('#password, #confirmPassword').on('keyup', function() {
                   if ($('#password').val() == $('#confirmPassword').val()) {
                       $('#message').html('Matching').css('color', 'green');
                   } else
                       $('#message').html('Not Matching').css('color', 'red');
               });
           </script>
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