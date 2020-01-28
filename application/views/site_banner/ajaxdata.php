<div class="table-responsive dataTables_wrapper " style="width: 100%;">
    <?php echo form_open_multipart('Banner/deleteBanner/', ['id' => 'delete_banner']); ?>
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
                <th>Image</th>
                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
                <th class="right">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($banners)) {
                $i = $start + 1;
                foreach ($banners as $banner) { ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <div class="checker">
                                        <span>
                                            <input type="checkbox" onclick="check_checkbox(this)" class="checkbox" name="chk[]" id="chkd" value="<?php echo $banner['id']; ?>" />
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php if ($banner['image']) { ?>
                                <img width="50px;" src="<?php echo site_url(); ?>assets/images/site_banner/<?php echo $banner['image']; ?> ">
                            <?php } else { ?>
                                <img width="50px;" src="<?php echo site_url("assets/images/no-image-available-icon-6.png"); ?> ?> ">
                            <?php } ?>
                        </td>
                        <td><?php echo $banner['name']; ?></td>
                        <td>
                            <?php if ($banner['position'] == 0) { ?>
                                <h5>Top</h5>
                            <?php } else if ($banner['position'] == 1) { ?>
                                <h5>Right</h5>
                            <?php } else if ($banner['position'] == 2) { ?>
                                <h5>Bottom</h5>
                            <?php } else { ?>
                                <h5>Left</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($banner['status'] == 1) { ?>
                                <h5>Enable</h5>
                            <?php } else { ?>
                                <h5>Disable</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <a class="btn btn-info btn-rounded right" href='<?php echo base_url("Banner/updateBanner/{$banner['id']}"); ?>'>
                                <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                }
            } else { ?>
                <p>Banners not found...</p>
            <?php } ?>
        </tbody>
    </table>
    <?= form_close() ?>
    <?php echo $this->ajax_pagination->create_links();
    ?>
</div>


<script>
    function myFunction() {
        if ($('.checkbox:checked').length > 0) {
            var result = confirm("Are you sure to delete selected users?");
            if (result) {
                $('#delete_banner').submit();
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
            url: '<?php echo base_url('Banner/ajaxPaginationBanner/'); ?>' + page_num,
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