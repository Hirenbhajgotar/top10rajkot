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
        <h3 class="breadcrumb-header">Settings</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div id="rootwizard">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#general" data-toggle="tab"><i class="fa fa-user m-r-xs"></i>General</a></li>
                                <li role="presentation"><a href="#mail" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Mail</a></li>
                                <li role="presentation"><a href="#other" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Other</a></li>
                            </ul>
                            <!-- <div class="progress progress-sm m-t-sm">
                                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                </div>
                            </div> -->
                            <!-- <form id="wizardForm"> -->
                            <?= form_open_multipart("Settings/editSettings", ['id' => 'settings_validation']) ?>
                            <div class="tab-content">
                                <?php if ($settings) {
                                    // echo '<pre>';
                                    // print_r($settings);
                                    // echo '</pre>';
                                ?>
                                    <div class="tab-pane active fade in" id="general">
                                        <div class="row m-b-lg">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="store_owner">Store Name</label>
                                                            <input type="text" value="<?php if (isset($_POST['store_name'])) echo $_POST['store_name'];
                                                                                        else if ($settings[0]->key) echo $settings[0]->value; ?>" class="form-control" name="store_name" id="store_name" placeholder="Store Name">
                                                        </div>
                                                        <div class="form-group  col-md-6">
                                                            <label for="exampleInputName2">Store Owner</label>
                                                            <input type="text" value="<?php if (isset($_POST['store_owner'])) echo $_POST['store_owner'];
                                                                                        else if ($settings[1]->key) echo $settings[1]->value; ?>" class="form-control col-md-6" name="store_owner" id="store_owner" placeholder="Store Owner">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email address</label>
                                                            <input type="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];
                                                                                        else if ($settings[2]->key) echo $settings[2]->value; ?>" class="form-control" name="email" id="email" placeholder="Enter email">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="telephone">Telephone</label>
                                                            <input type="text" value="<?php if (isset($_POST['telephone'])) echo $_POST['telephone'];
                                                                                        else if ($settings[3]->key) echo $settings[3]->value; ?>" class="form-control" name="telephone" id="telephone" placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="logo">Logo</label>
                                                            <input type="file" class="form-control" name="logo" id="logo" placeholder="Logo">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="icon">Icon</label>
                                                            <input type="file" class="form-control" name="icon" id="icon" placeholder="Icon">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="meta_key_word">Meta Tag Keywords</label>
                                                            <input type="text" value="<?php if (isset($_POST['meta_key_word'])) echo $_POST['meta_key_word'];
                                                                                        else if ($settings[6]->key) echo $settings[6]->value; ?>" class="form-control" name="meta_key_word" id="meta_key_word" placeholder="Meta Tag Keywords">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="meta_title">Meta Title</label>
                                                            <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                                                        else if ($settings[7]->key) echo $settings[7]->value; ?>" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="geocode">Geocode</label>
                                                            <input type="text" value="<?php if (isset($_POST['geocode'])) echo $_POST['geocode'];
                                                                                        else if ($settings[8]->key) echo $settings[8]->value; ?>" class="form-control" name="geocode" id="geocode" placeholder="Geocode">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="col-form-label">Maintenance mode</label>
                                                            <div class="">
                                                                <?php
                                                                if (isset($_POST['maintenance_mode'])) {
                                                                    $maintenance_mode = $_POST['maintenance_mode'];
                                                                    switch ($maintenance_mode) {
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
                                                                } else if (isset($settings[9]->key)) {
                                                                    $maintenance_mode = $settings[9]->value;
                                                                    switch ($maintenance_mode) {
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
                                                                }
                                                                ?>
                                                                <label class="">
                                                                    <input type="radio" name="maintenance_mode" id="maintenance_mode" value="1" <?= $on_selected ?>> On
                                                                </label> &nbsp;&nbsp;
                                                                <label class="">
                                                                    <input type="radio" name="maintenance_mode" id="maintenance_mode" value="0" <?= $off_selected ?>> Off
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="address">Address</label>
                                                            <textarea type="file" rows="4" class="form-control" name="address" id="address" placeholder="Address"><?php if (isset($_POST['address'])) echo $_POST['address'];
                                                                                                                                                                    else if ($settings[10]->key) echo $settings[10]->value; ?></textarea>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="meta_tag_description">Meta Tag Description</label>
                                                            <textarea type="file" rows="4" class="form-control" name="meta_tag_description" id="meta_tag_description" placeholder="Meta Tag Description"><?php if (isset($_POST['address'])) echo $_POST['address'];
                                                                                                                                                                                                            else if ($settings[11]->key) echo $settings[11]->value; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="mail">
                                        <div class="row">
                                            <div class="">
                                                <div class="form-group col-md-12">
                                                    <label for="mail_protocol">Mail Protocol</label>
                                                    <input type="text" value="<?php if (isset($_POST['mail_protocol'])) echo $_POST['mail_protocol'];
                                                                                else if ($settings[12]->key) echo $settings[12]->value; ?>" class="form-control" name="mail_protocol" id="mail_protocol" placeholder="Mail Protocol">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="mail_perameter">Mail Parameters</label>
                                                    <input type="text" value="<?php if (isset($_POST['mail_perameter'])) echo $_POST['mail_perameter'];
                                                                                else if ($settings[13]->key) echo $settings[13]->value; ?>" class="form-control" name="mail_perameter" id="mail_perameter" placeholder="Mail Parameters">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="smtp_hostname">Smtp Hostname</label>
                                                    <input type="text" value="<?php if (isset($_POST['smtp_hostname'])) echo $_POST['smtp_hostname'];
                                                                                else if ($settings[14]->key) echo $settings[14]->value; ?>" class="form-control" name="smtp_hostname" id="smtp_hostname" placeholder="Smtp Hostname">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="smtp_username">Smtp Username</label>
                                                    <input type="text" value="<?php if (isset($_POST['smtp_username'])) echo $_POST['smtp_username'];
                                                                                else if ($settings[15]->key) echo $settings[15]->value; ?>" class="form-control" name="smtp_username" id="smtp_username" placeholder="Smtp Username">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="smtp_password">Smtp Password</label>
                                                    <input type="text" value="<?php if (isset($_POST['smtp_password'])) echo $_POST['smtp_password'];
                                                                                else if ($settings[16]->key) echo $settings[16]->value; ?>" class="form-control" name="smtp_password" id="smtp_password" placeholder="Smtp Password">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="smtp_port">Smtp Port</label>
                                                    <input type="text" value="<?php if (isset($_POST['smtp_port'])) echo $_POST['smtp_port'];
                                                                                else if ($settings[17]->key) echo $settings[17]->value; ?>" class="form-control" name="smtp_port" id="smtp_port" placeholder="Smtp Port">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="smtp_timeout">Smtp timeout</label>
                                                    <input type="text" value="<?php if (isset($_POST['smtp_timeout'])) echo $_POST['smtp_timeout'];
                                                                                else if ($settings[18]->key) echo $settings[18]->value; ?>" class="form-control" name="smtp_timeout" id="smtp_timeout" placeholder="Smtp timeout">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="other">
                                        <div class="row">
                                            <div class="">
                                                <div class="form-group col-md-12">
                                                    <label for="per_page_limit">Per page limit</label>
                                                    <input type="text" value="<?php if (isset($_POST['per_page_limit'])) echo $_POST['per_page_limit'];
                                                                                else if ($settings[19]->key) echo $settings[19]->value; ?>" class="form-control" name="per_page_limit" id="per_page_limit" placeholder="Per page limit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-save'></i>&nbsp; Save settings</button>

                                <?php } ?>

                            </div>
                            <!-- </form> -->
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function setSEOKeyword() {
        // *get product name value
        let product_name_value = document.getElementById("title").value;
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