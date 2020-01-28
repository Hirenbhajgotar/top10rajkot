<div class="table-responsive dataTables_wrapper " style="width: 100%;">
    <?php echo form_open_multipart('Products/delete_product/', 'id="my_id"'); ?>
    <table class="display table" style="width: 100%;">
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
                <th>Notify by sms</th>
                <th>Notify by mail</th>
                <th>Status</th>
                <th class="right">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mailTemplates)) {
                // echo base_url();
                $i = $start + 1;
                foreach ($mailTemplates as $mailTemplate) { ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <div class="checker">
                                        <span>
                                            <input type="checkbox" onclick="check_checkbox(this)" class="checkbox" name="chk[]" id="chkd" value="<?php echo $mailTemplate['id']; ?>" />
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $mailTemplate['mail_title']; ?></td>
                        <td>
                            <?php if ($mailTemplate['sms_notify'] == 1) { ?>
                                <h5>Yes</h5>
                            <?php } else { ?>
                                <h5>No</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($mailTemplate['mail_notify'] == 1) { ?>
                                <h5>Yes</h5>
                            <?php } else { ?>
                                <h5>No</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($mailTemplate['status'] == 1) { ?>
                                <h5>Enable</h5>
                            <?php } else { ?>
                                <h5>Disable</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <a class="btn btn-info btn-rounded right" href='<?php echo base_url("MailTemplate/updateMailTemplate/{$mailTemplate['id']}"); ?>'>
                                <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                }
            } else { ?>
                <p>Mail template not found...</p>
            <?php } ?>
        </tbody>
    </table>
    <?= form_close() ?>
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
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
            url: '<?php echo base_url('MailTemplate/ajaxPaginationMailTemplate/'); ?>' + page_num,
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


<!-- check all checkbox -->
<script>
    function checkAll(ele) {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    let ch = checkboxes[i].checked = true;
                    checkboxes[i].parentNode.classList.add("checked");
                    console.log(ch);
                }
            }
            // console.log("checked");
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    let ch = checkboxes[i].checked = false;
                    checkboxes[i].parentNode.classList.remove("checked");
                    console.log(ch);
                }
            }
            // console.log("unchecked");
        }
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