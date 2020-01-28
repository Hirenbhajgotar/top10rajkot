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
 $(document).ready(function(){
        $(".delete").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });
$(document).ready(function(){
        $(".enable").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });
$(document).ready(function(){
        $(".desable").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
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
            
			   
			   
			   <div class="table-responsive dt-responsive">
						<?php echo form_open_multipart('usersgroup/deletegroups', 'id="my_id"'); ?>
						
                            <table  class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
									    <th><input type="checkbox" onchange="checkAll(this)" name="chk" /></th>
                                        <th>Name</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                <?php foreach($groups as $group) : ?>
							 	
                                 <tr> 
                                    <td><input type="checkbox" class="checkbox" name="chk[]" id="chkd" value="<?php echo $group['id']; ?>"  /></td> 
								 
                                    <td><a href="edit-blog.php?id=14"><?php echo $group['name']; ?></a></td>
									
									
                                     <td><?php echo $group['permission']; ?>
                                        
								     <td><a class="label label-inverse-info" href='<?php echo base_url(); ?>usersgroup/updategroups/<?php echo $group['id']; ?>'>Edit</a>
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
        url: '<?php echo base_url('usersgroup/ajaxPaginationData/'); ?>'+page_num,
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