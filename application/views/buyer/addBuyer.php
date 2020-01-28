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
                   <?php
                    // echo '<pre>';
                    // print_r($states);
                    // echo '</pre>';
                    // exit;
                    ?>
                   <div class="card-block">
                       <div class="col-sm-8">
                           <div class="validation_errors_alert"></div>
                       </div>
                       <div class="col-sm-8">
                           <?php echo form_open('Buyer/addBuyer'); ?>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Firstname</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name'];
                                                                else echo ''; ?>" name="first_name" id="first_name" class="form-control" placeholder="Firstname">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Lastname</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name'];
                                                                else echo ''; ?>" name="last_name" class="form-control" placeholder="Lastname">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Email</label>
                               <div class="col-sm-10">
                                   <input type="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];
                                                                else echo ''; ?>" name="email" class="form-control" placeholder="Email">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Mobile No.</label>
                               <div class="col-sm-10">
                                   <input type=" text" value="<?php if (isset($_POST['mobile_no'])) echo $_POST['mobile_no'];
                                                                else echo ''; ?>" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile no.">
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
                                                $m_selected = '';
                                                $f_selected = '';
                                                break;
                                        }
                                    } else {
                                        $m_selected = 'checked';
                                        $f_selected = '';
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
                                                                            else echo ''; ?>" class="form-control" placeholder="Company Name">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Address 1</label>
                               <div class="col-sm-10">
                                   <input type="text" name="address_1" value="<?php if (isset($_POST['address_1'])) echo $_POST['address_1'];
                                                                                else echo ''; ?>" class="form-control" placeholder="Address 1">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Address 2</label>
                               <div class="col-sm-10">
                                   <input type="text" name="address_2" value="<?php if (isset($_POST['address_2'])) echo $_POST['address_2'];
                                                                                else echo ''; ?>" class="form-control" placeholder="Address 2">
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
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">State</label>
                               <div class="col-sm-10">
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
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">City</label>
                               <div class="col-sm-10">
                                   <input type="text" name="city" value="<?php if (isset($_POST['city'])) echo $_POST['city'];
                                                                            else echo ''; ?>" class="form-control" placeholder="City">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Postcode</label>
                               <div class="col-sm-10">
                                   <input type="text" name="postcode" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode'];
                                                                                else echo ''; ?>" class="form-control" placeholder="Postcode">
                               </div>
                           </div>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Password</label>
                               <div class="col-sm-10">
                                   <input type="password" name="password" class="form-control" placeholder="Password">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Confirm Password</label>
                               <div class="col-sm-10">
                                   <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class=" col-sm-10">
                                   <div class="checkbox">
                                       <label>
                                           <input <?php if(isset($_POST['newsletter'])) echo 'checked'; else echo ''; ?> name="newsletter" value="1"  type="checkbox"> Remember me
                                       </label>
                                   </div>
                               </div>
                           </div>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class="col-sm-10">
                                   <button type="submit" class="btn btn-primary">Add buyer</button>
                               </div>
                           </div>
                           <!-- date modifide -->
                           <?php $currentDate = date('d/m/Y h:i:s') ?>
                           <!-- <input type="hidden" name="date_added" value="<?= $currentDate ?>">
                           <input type="hidden" name="date_modified" value="<?= $currentDate ?>"> -->
                           <!-- status -->
                           <input type="hidden" name="status" value="0">
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
               function setSEOKeyword() {
                   // *get product name value
                   let product_name_value = document.getElementById("product_name").value;
                   // * get seo keyword value
                   let seo_keyword_value = document.getElementById("seo_keyword").value;

                   //* remove special character    
                   let remove_special_char = product_name_value.trim().replace(/\s+/g, "-");

                   //* if seo keyword id not null 
                   if (seo_keyword_value.length == 0) {
                       let new_value_of_seo = document.getElementById("seo_keyword").value = remove_special_char.toLowerCase();
                   }
               }

               function setSEOKeywordFinal() {
                   //* get seo keyword value
                   let seo_keyword_value = document.getElementById("seo_keyword").value
                   //* remove special character    
                   let remove_special_char = seo_keyword_value.trim().replace(/\s+/g, "-");
                   //* final value of seo keyword 
                   let new_value_of_seo = document.getElementById("seo_keyword").value = remove_special_char.toLowerCase();
                   //    console.log(seo_keyword_value);
               }
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