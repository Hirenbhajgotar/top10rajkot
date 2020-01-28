<style>
    /* a.fa.fa-trash {
        font-size: 30px;
    } */
    .right {
        float: right;
    }

    .search {
        box-shadow: none !important;
        border: 1px solid #C1C7CD;
        color: #646464;
        border-radius: 4px;
        padding: 5px 12px;
        height: 32px;
    }

    /* .size {
        font-size: 13px;
    } */
</style>


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


<div class="page-inner">
    <div class="page-title">
        <a href="<?= base_url("MailTemplate/listMailTemplate") ?>" class="btn btn-primary right"><i class="fa fa-arrow-circle-left"></i>&nbsp; Back</a>
        <h3 class="breadcrumb-header">Update mail template</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open_multipart("MailTemplate/updateMailTemplateData/{$mail_template['id']}", ['id' => 'validate_mail_template']); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" control-label">Short codes</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['shortcodes'])) echo $_POST['shortcodes'];
                                                                else echo $mail_template['shortcodes'] ?>" name="shortcodes" id="shortcodes" class="form-control" placeholder="Short codes">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Mail title</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['mail_title'])) echo $_POST['mail_title'];
                                                                else echo $mail_template['mail_title'] ?>" name="mail_title" id="mail_title" class="form-control" placeholder="Mail title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" control-label">Sort order</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['sort_order'])) echo $_POST['sort_order'];
                                                                else echo $mail_template['sort_order'] ?>" name="sort_order" class="form-control" placeholder="Sort order">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Mail attachment</label>
                                <div class="">
                                    <input type="file" name="mail_attachment" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Notify user by sms</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['sms_notify'])) {
                                        $sms_notify = $_POST['sms_notify'];
                                        switch ($sms_notify) {
                                            case 1:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 0:
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;
                                        }
                                    } else {
                                        $sms_notify = $mail_template['sms_notify'];
                                        switch ($sms_notify) {
                                            case 1:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 0:
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;
                                        }
                                    }
                                    ?>

                                    <label class="">
                                        <input type="radio" name="sms_notify" id="sms_notify" value="1" <?= $on_selected ?>> Yes
                                    </label> &nbsp;&nbsp;
                                    <label class="">
                                        <input type="radio" name="sms_notify" id="sms_notify" value="0" <?= $off_selected ?>> No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Notify user by email</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['mail_notify'])) {
                                        $mail_notify = $_POST['mail_notify'];
                                        switch ($mail_notify) {
                                            case 1:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 0:
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;
                                        }
                                    } else {
                                        $mail_notify = $mail_template['mail_notify'];
                                        switch ($mail_notify) {
                                            case 1:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 0:
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;
                                        }
                                    }
                                    ?>

                                    <label class="">
                                        <input type="radio" name="mail_notify" id="mail_notify" value="1" <?= $on_selected ?>> Yes
                                    </label> &nbsp;&nbsp;
                                    <label class="">
                                        <input type="radio" name="mail_notify" id="mail_notify" value="0" <?= $off_selected ?>> No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Status</label>
                                <div class="">
                                    <select name="status" class="form-control">
                                        <?php
                                        if (isset($_POST['status'])) {
                                            if ($_POST['status'] == 1) { ?>
                                                <option selected value="1">Enable</option>
                                                <option value="">Disable</option>
                                            <?php } else if ($_POST['status'] == 0) { ?>
                                                <option value="1">Enable</option>
                                                <option selected value="0">Disable</option>
                                            <?php }
                                        } else { ?>
                                            <option selected value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Sms content</label>
                                <div class="">
                                    <textarea type=" text" name="sms_content" id="sms_content" class="form-control" placeholder="Sms content"><?php if (isset($_POST['sms_content'])) echo $_POST['sms_content'];
                                                                                                                                                else echo $mail_template['sms_content'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Mail content</label>
                                <div class="" id="mail_content_desc">
                                    <textarea type=" text" name="mail_content" id="mail_content" class="form-control" placeholder="Mail content"><?php if (isset($_POST['mail_content'])) echo $_POST['mail_content'];
                                                                                                                                                    else echo $mail_template['mail_content'] ?></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class=" col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary" style="margin-bottom: 8px"><i class='fa fa-edit'></i>&nbsp; Update Mail Template</button>
                                <a href="<?= base_url("MailTemplate/listMailTemplate") ?>" class="btn btn-primary" style="margin-bottom: 8px"><i class="fa fa-arrow-circle-left"></i>&nbsp; Back</a>
                            </div>
                        </div>

                        <?= form_close() ?>
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
            url: '<?php echo base_url('membership/ajaxPaginationmember/'); ?>' + page_num,
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

<script>
    function setSEOKeyword() {
        // *get product name value
        let product_name_value = document.getElementById("product_name").value;
        // * get seo keyword value
        let seo_keyword_value = document.getElementById("seo_keyword").value;

        //* remove special character    
        let remove_special_char = product_name_value.trim().replace(/\s+/g, "-");

        //* if seo keyword id not null 
        if (seo_keyword_value.length == 0) {
            let new_value_of_seo = document.getElementById("seo_keyword").value = remove_special_char.toLowerCase();
        }
    }

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

<script>
    // $(document).ready(function() {
    //     let mail_content = document.getElementById("mail_content").value;
    //     console.log(mail_content);
    // });
</script>