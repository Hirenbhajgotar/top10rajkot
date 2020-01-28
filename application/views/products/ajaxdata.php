<div class="table-responsive dataTables_wrapper ">
    <?php echo form_open_multipart('Products/delete_product/', 'id="my_id"'); ?>
    <table id="" class="display table" style="width: 100%;">
        <thead>
            <tr>
                <th>
                    <div class="checkbox">
                        <label>
                            <div class="checker">
                                <span>
                                    <input type="checkbox" class="checkbox" onchange="checkAll(this)" name="chk" />
                                </span>
                            </div>
                        </label>
                    </div>
                </th>
                <th>No</th>
                <th>Image</th>
                <th>Product name</th>
                <th>Product model</th>
                <th>Status</th>
                <th class="right">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)) {
                $i = $start + 1;
                foreach ($products as $product) { ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <div class="checker">
                                        <span>
                                            <input type="checkbox" class="checkbox" onclick="check_checkbox(this)" name="chk[]" id="chkd" value="<?php echo $product['id']; ?>" />
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php if ($product['product_image']) { ?>
                                <img width="50px;" src="<?php echo site_url(); ?>assets/images/products/<?php echo $product['product_image']; ?> ">
                            <?php } else { ?>
                                <img width="50px;" src="<?php echo site_url("assets/images/no-image-available-icon-6.png"); ?> ?> ">
                            <?php } ?>
                        </td>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo $product['product_model']; ?></td>
                        <td>
                            <?php if ($product['status'] == 1) { ?>
                                <h5>Enabled</h5>
                            <?php } else { ?>
                                <h5>Desabled</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <a class="btn btn-info btn-rounded right" href='<?php echo base_url("Products/updateProduct/{$product['id']}"); ?>'>
                                <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                }
            } else { ?>
                <p>Product not found...</p>
            <?php } ?>

        </tbody>
    </table>
    </form>
    <?php echo $this->ajax_pagination->create_links(); ?>

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
            url: '<?php echo base_url('Products/ajaxPaginationProduct/'); ?>' + page_num,
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

<!-- check checkbox -->
<script>
    function check_checkbox(e) {
        // console.log("work");
        if (e.checked) {
            // let check = e.checked = true;
            let a = e.parentNode.classList.add("checked");

        } else {
            // let check = e.checked = false;
            let a = e.parentNode.classList.remove("checked");
        }
    }
</script>