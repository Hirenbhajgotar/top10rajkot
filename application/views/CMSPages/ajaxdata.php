<div class="table-responsive dataTables_wrapper " style="width: 100%;">
    <?php echo form_open_multipart('CmsPage/deleteCms/', 'id="my_id"'); ?>
    <table id="" class="display table">
        <thead>
            <tr>
                <th>
                    <div class="checkbox">
                        <label>
                            <div class="checker">
                                <span>
                                    <input type="checkbox" onchange="checkAll(this)" name="chk" />
                                </span>
                            </div>
                        </label>
                    </div>
                </th>
                <th>No</th>
                <th>Title</th>
                <th>Seller</th>
                <th>Status</th>
                <th class="right">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cmsData)) {
                $i = $start + 1;
                foreach ($cmsData as $data) { ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <div class="checker">
                                        <span>
                                            <input type="checkbox" onclick="check_checkbox(this)" class="checkbox" name="chk[]" id="chkd" value="<?php echo $data['id']; ?>" />
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td><?= $i ?></td>
                        <td><a href="#"><?php echo $data['title'] ?></a></td>
                        <!-- <td><a href="#"><?php echo $data['description'] ?></a></td> -->
                        <td><?php echo $data['seller_name'] ?></td>
                        <td>
                            <?php if ($data['status'] == 1) { ?>
                                <h5>Enable</h5>
                            <?php } else { ?>
                                <h5>Disable</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <a class="btn btn-info btn-rounded right" href='<?php echo base_url("CmsPage/updateCms/{$data['id']}"); ?>'>
                                <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                }
            } else { ?>
                <p>CMS page not found...</p>
            <?php } ?>
        </tbody>
    </table>
    <?= form_close() ?>
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
            url: '<?php echo base_url('CmsPage/ajaxPaginationCms/'); ?>' + page_num,
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