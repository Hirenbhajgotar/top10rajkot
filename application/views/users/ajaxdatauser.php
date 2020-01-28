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
                                <?php foreach($users as $post) : ?>
                                 <tr>
								        <td><input type="checkbox"  class="checkbox" name="chk[]" id="chkd" value="<?php echo $post['id']; ?>"  /></td> 
                                        <td><?php echo $post['id']; ?></td>
                                        <td>
                                            <img width="20px;" src="<?php echo site_url();?>assets/images/users/<?php echo $post['image']; ?> ">                                           
                                        </td>
                                        <td><a href="edit-blog.php?id=14"><?php echo $post['username']; ?></a></td>
                                        <td><?php echo $post['email']; ?></td>
                                        <td><?php echo $post['mobile']; ?></td>
                                         <td><?php echo date("M d,Y", strtotime($post['date_added'])); ?></td>
                                        <td>
                                                <?php if($post['status'] == 1){ ?>
                                               <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>users/enable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('tr_user'); ?>'>Enabled</a>
                                                <?php }else{ ?> 
                                                <a class="label label-inverse-warning desable" href='<?php echo base_url(); ?>users/desable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('tr_user'); ?>'>Desabled</a>
                                                <?php } ?>
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>users/update_user_data/<?php echo $post['id']; ?>'>Edit</a>
												<!--
                                                 <a class="label label-inverse-danger delete" href='<?php //echo base_url(); ?>administrator/delete/<?php //echo $post['id']; ?>?table=<?php //echo base64_encode('tr_user'); ?>'>Delete</a> 
                                                -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                 </tbody>
                            </table>
						  </form>
						  <?php echo $this->ajax_pagination->create_links(); ?>
                        </div>
					   
					  <script>
function myFunction(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Are you sure to delete selected users?");
        if(result){
            $('#my_id').submit();
        }else{
            return false;
        }
    }else{
        alert('Select at least 1 record to delete.');
        return false;
    }
}
</script>	
<script>
function searchFilter(page_num){
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('users/ajaxPaginationuser/'); ?>'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(html){
            $('#dataList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}
</script>
  
  