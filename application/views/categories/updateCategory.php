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
               <li class="breadcrumb-item"><a href="#!">Category</a>
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
               <?php
                // echo '<pre>';
                // print_r($category);
                // echo '</pre>';
                // exit;
                ?>
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
                        // print_r($category);
                        // print_r($parent_category);
                        // echo '</pre>';
                        // exit;
                        ?>
                       <div class="col-sm-8">
                           <?php echo form_open_multipart("Category/updateCategoryData/{$category['id']}"); ?>

                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Parent category name</label>
                               <div class="col-sm-10">
                                   <?php
                                    if (isset($_POST['parent_id'])) { ?>
                                       <select name="parent_id" class="form-control">
                                           <!-- <option value="0">Select category</option> -->
                                           <?php
                                            foreach ($parent_category as $cat) {
                                                if ($_POST['parent_id'] == $cat['id']) { ?>
                                                   <option selected value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                               <?php } else { ?>
                                                   <option value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                               <?php } ?>
                                           <?php } ?>
                                       </select>
                                   <?php } else { ?>
                                       <select name="parent_id" class="form-control">
                                           <option selected disabled>Select category</option>
                                           <?php
                                            foreach ($parent_category as $cat) {
                                            ?>
                                               <!-- <option <?php if ($category['parent_id'] == $cat['id']) echo "selected" ?> value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option> -->
                                               <option <?php if ($category['parent_id'] == $cat['id']) echo "selected" ?> value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                           <?php
                                            }
                                            ?>
                                       </select>
                                   <?php } ?>

                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Category name</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['category_name'])) echo $_POST['category_name'];
                                                                else echo $category['category_name'] ?>" name="category_name" class="form-control" placeholder="Category name">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">SEO keyword</label>
                               <div class="col-sm-10">
                                   <input onfocusout="setSEOKeywordFinal()" type="text" value="<?php if (isset($_POST['seo_keyword'])) echo $_POST['seo_keyword'];
                                                                                                else echo $category['seo_keyword'] ?>" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO keyword">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta title</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                                else echo $category['meta_title'] ?>" name="meta_title" class="form-control" placeholder="Meta title">
                               </div>
                           </div>
                           <!-- <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Keyword</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($category->keyword)) echo $category->keyword;
                                                                else $_POST['keyword'] ?>" name="keyword" class="form-control" placeholder="keyword">
                               </div>
                           </div> -->
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta keyword</label>
                               <div class="col-sm-10">
                                   <input type="text" value="<?php if (isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];
                                                                else echo $category['meta_keyword'] ?>" name="meta_keyword" class="form-control" placeholder="Meta keyword">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Category image</label>
                               <div class="col-sm-6">
                                   <input type="file" name="category_image" class="form-control">
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Description</label>
                               <div class="col-sm-10">
                                   <textarea name="category_description" class="form-control" rows="3"><?php if (isset($_POST['category_description'])) echo $_POST['category_description'];
                                                                                                        else echo $category['category_description'] ?></textarea>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label">Meta description</label>
                               <div class="col-sm-10">
                                   <textarea name="meta_description" id='meta_description' class="form-control" rows="3"><?php if (isset($_POST['meta_description'])) echo $_POST['meta_description'];
                                                                                                                            else echo $category['meta_description'] ?></textarea>
                               </div>
                           </div>

                           <input type="hidden" name="date_added" value="<?php if (isset($category['date_added'])) echo $category['date_added'];
                                                                            ?>">
                           <div class="form-group row">
                               <label class="col-sm-2 col-form-label"></label>
                               <div class="col-sm-10">
                                   <button type="submit" class="btn btn-primary">Update</button>
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