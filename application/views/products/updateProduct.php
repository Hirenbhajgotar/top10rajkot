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
               <li class="breadcrumb-item"><a href="#!">Product</a>
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
                        // print_r($product);
                        // print_r($sellers);
                        // echo '</pre>';
                        // exit;
                        ?>
                       <div class="col-sm-8">
                           <?php echo form_open_multipart("Products/updateProductData/{$product['id']}"); ?>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Seller name</label>
                               <div class="col-sm-10">
                                   <?php
                                    if (isset($_POST['seller_id'])) { ?>
                                       <select name="seller_id" class="form-control">
                                           <option selected disabled>Select seller</option>
                                           <?php foreach ($sellers as $seller) {
                                                if ($_POST['seller_id'] == $seller->id) { ?>
                                                   <option selected value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                               <?php } else { ?>
                                                <option  value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                               <?php } ?>
                                           <?php } ?>
                                       </select>
                                   <?php } else { ?>
                                       <select name="seller_id" class="form-control">
                                           <option selected disabled>Select seller</option>
                                           <?php foreach ($sellers as $seller) { ?>
                                               <option <?php if ($product['seller_id'] == $seller->id) echo "selected" ?> value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                           <?php } ?>
                                       </select>
                                   <?php } ?>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Parent category name</label>
                               <div class="col-sm-10">
                                   <?php
                                    if (isset($_POST['category_id'])) { ?>
                                       <select name="category_id" class="form-control">
                                           <option value="0">Select category</option>
                                           <?php
                                            foreach ($categories as $cat) {
                                                if ($_POST['category_id'] == $cat['id']) { ?>
                                                   <option selected value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                               <?php } else { ?>
                                                   <option value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                               <?php } ?>
                                           <?php
                                            }
                                            ?>
                                       </select>
                                   <?php } else { ?>
                                       <select name="category_id" class="form-control">
                                           <option selected disabled>Select category</option>
                                           <?php foreach ($categories as $cat) { ?>
                                               <option <?php if ($product['category_id'] == $cat['id']) echo "selected" ?> value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                           <?php } ?>
                                       </select>
                                   <?php } ?>

                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Product name</label>

                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['product_name'])) echo $_POST['product_name'];
                                                                else echo $product['product_name'] ?>" name="product_name" class="form-control" placeholder="Category name">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Sort order</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['sort_order'])) echo $_POST['sort_order'];
                                                                else echo $product['sort_order'] ?>" name="sort_order" class="form-control" placeholder="Sort order">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Product model</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['product_model'])) echo $_POST['product_model'];
                                                                else echo $product['product_model'] ?>" name="product_model" class="form-control" placeholder="Product model">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">SEO keyword</label>
                               <div class="col-sm-10">
                                   <input onfocusout="setSEOKeywordFinal()" type=" text" value="<?php if (isset($_POST['seo_keyword'])) echo $_POST['seo_keyword'];
                                                                                                else echo $product['seo_keyword'] ?>" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO keyword">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta title</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                                else echo $product['meta_title'] ?>" name="meta_title" class="form-control" placeholder="Meta title">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta keyword</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];
                                                                else echo $product['meta_keyword'] ?>" name="meta_keyword" class="form-control" placeholder="Meta keyword">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Product image</label>
                               <div class="col-sm-6">
                                   <input type="file" name="product_image" class="form-control">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Description</label>
                               <div class="col-sm-10">
                                   <textarea name="product_description" class="form-control" rows="3"><?php if (isset($_POST['product_description'])) echo $_POST['product_description'];
                                                                                                        else echo $product['product_description'] ?></textarea>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta description</label>
                               <div class="col-sm-10">
                                   <textarea name="meta_description" id='meta_description' class="form-control" rows="3"><?php if (isset($_POST['meta_description'])) echo $_POST['meta_description'];
                                                                                                                            else echo $product['meta_description'] ?></textarea>
                               </div>
                           </div>

                           <input type="hidden" name="date_added" value="<?php if (isset($product['date_added'])) echo $product['date_added'];
                                                                            ?>">
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class="col-sm-10">
                                   <button type="submit" class="btn btn-primary">Update</button>
                               </div>
                           </div>
                           <!-- date modifide -->
                           <?php $currentDate = date('d/m/Y h:i:s') ?>
                           
                           <!-- status -->
                           <!-- <input type="hidden" name="status" value="0"> -->
                           <?= form_close() ?>
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