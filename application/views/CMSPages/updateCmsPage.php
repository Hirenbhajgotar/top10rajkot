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
               <li class="breadcrumb-item"><a href="#!">Cms</a>
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
                           <?php echo form_open("CmsPage/updateCmsData/{$cmsData['id']}"); ?>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Cms page</label>
                               <div class="col-sm-10">
                                   <?php
                                    if (isset($_POST['seller_id'])) { ?>
                                       <select name="seller_id" id="country" class="form-control" onchange="get_state()">
                                           <option selected disabled>Select seller</option>
                                           <?php foreach ($sellers as $seller) {
                                                if ($_POST['seller_id'] == $seller->id) { ?>
                                                   <option selected value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                               <?php } else { ?>
                                                   <option value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                               <?php } ?>
                                           <?php } ?>
                                       </select>
                                   <?php } else { ?>
                                       <select name="seller_id" id="country" class="form-control" onchange="get_state()">
                                           <option selected disabled>Select seller</option>
                                           <?php foreach ($allSellers as $singleseller) {
                                                if ($cmsData['seller_id'] == $singleseller->id) { ?>
                                                   <option selected value="<?= $singleseller->id ?>"><?= $singleseller->firstname . ' ' . $singleseller->lastname ?></option>
                                               <?php } else { ?>
                                                   <option value="<?= $singleseller->id ?>"><?= $singleseller->firstname . ' ' . $singleseller->lastname ?></option>
                                               <?php } ?>
                                           <?php } ?>
                                       </select>
                                   <?php } ?>

                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Title</label>
                               <div class="col-sm-10">
                                   <input onfocusout="setSEOKeyword()" type="text" value="<?php if (isset($_POST['title'])) echo $_POST['title'];
                                                                                            else if ($cmsData['title']) echo $cmsData['title']; ?>" name="title" id="title" class="form-control" placeholder="Cms title">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">SEO keyword</label>
                               <div class="col-sm-10">
                                   <input onfocusout="setSEOKeywordFinal()" type="text" value="<?php if (isset($_POST['seo_keyword'])) echo $_POST['seo_keyword'];
                                                                                                else if ($cmsData['seo_keyword']) echo $cmsData['seo_keyword']; ?>" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO keyword">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Description</label>
                               <div class="col-sm-10">
                                   <textarea name="description" placeholder="Meta description" class="form-control" rows="3"><?php if (isset($_POST['description'])) echo $_POST['description'];
                                                                                                                                else if ($cmsData['description']) echo $cmsData['description']; ?></textarea>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta title</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                                else if ($cmsData['meta_title']) echo $cmsData['meta_title']; ?>" name="meta_title" class="form-control" placeholder="Meta title">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta keyword</label>
                               <div class="col-sm-10">
                                   <input type=" text" value="<?php if (isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];
                                                                else if ($cmsData['meta_keyword']) echo $cmsData['meta_keyword']; ?>" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Meta keyword">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta description</label>
                               <div class="col-sm-10">
                                   <textarea name="meta_description" placeholder="Meta description" class="form-control" rows="3"><?php if (isset($_POST['meta_description'])) echo $_POST['meta_description'];
                                                                                                                                    else if ($cmsData['meta_description']) echo $cmsData['meta_description']; ?></textarea>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Maintenance mode</label>
                               <div class="col-sm-6">
                                   <?php
                                    if (isset($_POST['maintenance_mode'])) {
                                        $maintenance_mode = $_POST['maintenance_mode'];
                                        switch ($maintenance_mode) {
                                            case 'on':
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 'off':
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = '';
                                                $off_selected = 'checked';
                                                break;
                                        }
                                    } else if (isset($cmsData['maintenance_mode'])) {
                                        $maintenance_mode = $cmsData['maintenance_mode'];
                                        switch ($maintenance_mode) {
                                            case 'on':
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 'off':
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = '';
                                                $off_selected = 'checked';
                                                break;
                                        }
                                    }
                                    ?>
                                   <label class="radio-inline">
                                       <input type="radio" name="maintenance_mode" value="on" <?= $on_selected ?>> On
                                   </label>
                                   <label class="radio-inline">
                                       <input type="radio" name="maintenance_mode" value="off" <?= $off_selected ?>> Off
                                   </label>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Status</label>
                               <div class="col-sm-10">
                                   <select name="status" class="form-control">
                                       <?php
                                        if (isset($_POST['status'])) {
                                            if ($_POST['status'] == 1) { ?>
                                               <option selected value="1">Anable</option>
                                               <option value="">Disable</option>
                                           <?php } else if ($_POST['status'] == 0) { ?>
                                               <option value="1">Anable</option>
                                               <option selected value="0">Disable</option>
                                           <?php }
                                        } else if (isset($cmsData['status'])) {
                                            if ($cmsData['status'] == 1) { ?>
                                               <option selected value="1">Anable</option>
                                               <option value="0">Disable</option>
                                           <?php } else if ($cmsData['status'] == 0) { ?>
                                               <option value="1">Anable</option>
                                               <option selected value="0">Disable</option>
                                           <?php } ?>
                                       <?php } ?>
                                   </select>
                               </div>
                           </div>

                            <input type="hidden" name="date_addedd" value="<?php if (isset($cmsData['date_addedd'])) echo $cmsData['date_addedd'];
                                                                            ?>">

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class="col-sm-10">
                                   <button type="submit" class="btn btn-primary">Add cms</button>
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