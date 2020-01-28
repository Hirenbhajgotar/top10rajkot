     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">
     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <style>
         a.fa.fa-trash {
             font-size: 30px;

         }

         a.fa.fa-plus-circle {
             font-size: 30px;
         }
     </style>

     <script type="text/javascript">
         $(document).ready(function() {
             $(".delete").click(function(e) {
                 alert('as');
                 $this = $(this);
                 e.preventDefault();
                 var url = $(this).attr("href");
                 $.get(url, function(r) {
                     if (r.success) {
                         $this.closest("tr").remove();
                     }
                 })
             });
         });
         $(document).ready(function() {
             $(".enable").click(function(e) {
                 alert('as');
                 $this = $(this);
                 e.preventDefault();
                 var url = $(this).attr("href");
                 $.get(url, function(r) {
                     if (r.success) {
                         $this.closest("tr").remove();
                     }
                 })
             });
         });
         $(document).ready(function() {
             $(".desable").click(function(e) {
                 alert('as');
                 $this = $(this);
                 e.preventDefault();
                 var url = $(this).attr("href");
                 $.get(url, function(r) {
                     if (r.success) {
                         $this.closest("tr").remove();
                     }
                 })
             });
         });
     </script>
     <script>
         function checkAll(ele) {
             var checkboxes = document.getElementsByTagName('input');
             if (ele.checked) {
                 for (var i = 0; i < checkboxes.length; i++) {
                     if (checkboxes[i].type == 'checkbox') {
                         checkboxes[i].checked = true;
                     }
                 }
             } else {
                 for (var i = 0; i < checkboxes.length; i++) {
                     console.log(i)
                     if (checkboxes[i].type == 'checkbox') {
                         checkboxes[i].checked = false;
                     }
                 }
             }
         }
     </script>



     <div class="page-header">
         <div class="page-header-title">
             <h4>List Users</h4>
         </div>
         <div class="page-header-breadcrumb">
             <ul class="breadcrumb-title">
                 <li class="breadcrumb-item">
                     <a href="index-2.html">
                         <i class="icofont icofont-home"></i>
                     </a>
                 </li>
                 <li class="breadcrumb-item"><a href="#!">Users</a>
                 </li>
                 <li class="breadcrumb-item"><a href="#!">List Users</a>
                 </li>
             </ul>
         </div>
     </div>

     <!-- Page-header end -->
     <!-- Page-body start -->
     <div class="page-body">
         <!-- DOM/Jquery table start -->

         <div class="card">
             <div class="card-block">
                 <div class="float-right">
                     <a href="<?php echo base_url(); ?>users/add-user" class="fa fa-plus-circle" aria-hidden="true" style="height: 20px;"></a>

                     <a class="fa fa-trash" aria-hidden="true" onclick="myFunction()"></a>

                 </div>
                 <div class="post-search-panel">
                     <input type="text" id="keywords" placeholder="Type keywords to filter posts" />
                     <button type="submit" onclick="searchFilter();">search</button>
                     <select id="sortBy" onchange="searchFilter();">
                         <option value="">Sort by Title</option>
                         <option value="asc">Ascending</option>
                         <option value="desc">Descending</option>
                     </select>
                 </div>
                 <div class="post-list" id="dataList">
                     <div class="table-responsive dt-responsive">
                         <?php echo form_open_multipart('users/delete/', 'id="my_id"'); ?>
                         <table id="" class="table table-striped table-bordered nowrap">
                             <thead>
                                 <tr>
                                     <th><input type="checkbox" onchange="checkAll(this)" name="chk" /></th>
                                     <th>Id</th>
                                     <th>Image</th>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>Contact</th>
                                     <th>date_added</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($users as $post) : ?>
                                     <tr>
                                         <td><input type="checkbox" class="checkbox" name="chk[]" id="chkd" value="<?php echo $post['id']; ?>" /></td>
                                         <td><?php echo $post['id']; ?></td>
                                         <td>
                                             <img width="20px;" src="<?php echo site_url(); ?>assets/images/users/<?php echo $post['image']; ?> ">
                                         </td>
                                         <td><a href="edit-blog.php?id=14"><?php echo $post['username']; ?></a></td>
                                         <td><?php echo $post['email']; ?></td>
                                         <td><?php echo $post['mobile']; ?></td>
                                         <td><?php echo date("M d,Y", strtotime($post['date_added'])); ?></td>
                                         <td>
                                             <?php if ($post['status'] == 1) { ?>
                                                 <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>users/enable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('tr_user'); ?>'>Enabled</a>
                                             <?php } else { ?>
                                                 <a class="label label-inverse-warning desable" href='<?php echo base_url(); ?>users/desable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('tr_user'); ?>'>Desabled</a>
                                             <?php } ?>
                                             <a class="label label-inverse-info" href='<?php echo base_url(); ?>users/update_user_data/<?php echo $post['id']; ?>'>Edit</a>
                                             <!--
                                                 <a class="label label-inverse-danger delete" href='<?php //echo base_url(); 
                                                                                                    ?>administrator/delete/<?php //echo $post['id']; 
                                                                                                                            ?>?table=<?php //echo base64_encode('tr_user'); 
                                                                                                                                                                ?>'>Delete</a> 
                                                -->
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>

                                 <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); 
                                    ?>
                                </div>  -->

                             </tbody>
                         </table>
                         </form>
                         <?php echo $this->ajax_pagination->create_links(); ?>
                     </div>
                 </div>
             </div>
         </div>
         <!-- DOM/Jquery table end -->
     </div>
     <script>
         function myFunction() {
             if ($('.checkbox:checked').length > 0) {
                 var result = confirm("Are you sure to delete selected users?");
                 if (result) {
                     $('#my_id').submit();
                 } else {
                     return false;
                 }
             } else {
                 alert('Select at least 1 record to delete.');
                 return false;
             }
         }
     </script>
     <script>
         function searchFilter(page_num) {
             page_num = page_num ? page_num : 0;
             var keywords = $('#keywords').val();
             var sortBy = $('#sortBy').val();
             $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url('
        users / ajaxPaginationuser / '); ?>' + page_num,
                 data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
                 beforeSend: function() {
                     $('.loading').show();
                 },
                 success: function(html) {
                     $('#dataList').html(html);
                     $('.loading').fadeOut("slow");
                 }
             });
         }
     </script>