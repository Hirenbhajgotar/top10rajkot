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
        <h3 class="breadcrumb-header">Add Mail Template</h3>

    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open_multipart('MailTemplate/addMailTemplate', ['id' => 'validate_mail_template']); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" control-label">Short codes</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['shortcodes'])) echo $_POST['shortcodes'];
                                                                else echo ''; ?>" name="shortcodes" id="shortcodes" class="form-control" placeholder="Short codes">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Mail title</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['mail_title'])) echo $_POST['mail_title'];
                                                                else echo ''; ?>" name="mail_title" id="mail_title" class="form-control" placeholder="Mail title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" control-label">Sort order</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['sort_order'])) echo $_POST['sort_order'];
                                                                else echo ''; ?>" name="sort_order" class="form-control" placeholder="Sort order">
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
                                                $on_selected = '';
                                                $off_selected = 'checked';
                                                break;
                                        }
                                    } else {
                                        $on_selected = 'checked';
                                        $off_selected = '';
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
                                                $on_selected = '';
                                                $off_selected = 'checked';
                                                break;
                                        }
                                    } else {
                                        $on_selected = 'checked';
                                        $off_selected = '';
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
                                                                                                                                                else echo ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Mail content</label>
                                <div class="test" id="mail_content_desc">
                                    <textarea type=" text" name="mail_content" id="mail_content" class="form-control" placeholder="Mail content"><?php if (isset($_POST['mail_content'])) echo $_POST['mail_content'];
                                                                                                                                                    else echo ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class='fa fa-plus-circle'></i>&nbsp; Add mail template</button>
                                    <a href="<?= base_url("MailTemplate/listMailTemplate") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i>&nbsp; Back</a>
                                </div>
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