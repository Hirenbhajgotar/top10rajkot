               <div class="table-responsive dt-responsive">
						<?php echo form_open_multipart('administrator/deleteseller', 'id="my_id"'); ?>
						
                            <table  class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
									    <th><input type="checkbox" onchange="checkAll(this)" name="chk" /></th>
                                        <th>Firstname</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                              
							  <?php foreach($seller as $sel) : ?>
							  
							 	
                                 <tr> 
                                    <td><input type="checkbox" name="chk[]" id="chkd" value="<?php echo $sel['id']; ?>"  /></td> 
								 
                                    <td><a href="edit-blog.php?id=14"><?php echo $sel['firstname']; ?></a></td>
									
									
                                     <td><?php echo $sel['status']; ?>
                                        
								     <td><a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/usergroup/updategroups/<?php echo $group['usergroup_id']; ?>'>Edit</a>
                                     </td>
								 
                                    </tr>
									
                               <?php endforeach; ?>
						
                                 </tbody>
                            </table>  
							
						</form>
					
						<?php echo $this->ajax_pagination->create_links(); ?>
                    
					   </div>
					   
					   <script>
function myFunction() {
	
   if(document.getElementById("chkd").checked){
	confirm('Are You Sure') ? $('#my_id').submit() : false;
	
   }
   else{   
	   alert("Please Select The Row");
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
        url: '<?php echo base_url('administrator/ajaxPaginationseller/'); ?>'+page_num,
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