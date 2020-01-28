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
        <h3 class="breadcrumb-header">Add home content</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open('Home_content/addHomeContent', ['id' => 'validate_home_content']); ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Select seller</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['seller_id'])) { ?>
                                        <select name="seller_id" id="seller" class="form-control" onchange="get_state()">
                                            <option selected disabled>Select seller</option>
                                            <?php foreach ($sellers as $seller) {
                                                if ($_POST['seller_id'] == $seller->id) { ?>
                                                    <option selected value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <select name="seller_id" id="seller" class="form-control" onchange="get_state()">
                                            <option selected disabled>Select seller</option>
                                            <?php foreach ($sellers as $seller) { ?>
                                                <option value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Title</label>
                                <div class="">
                                    <input onfocusout="setSEOKeyword()" type="text" value="<?php if (isset($_POST['title'])) echo $_POST['title'];
                                                                                            else echo ''; ?>" name="title" id="title" class="form-control" placeholder="Cms title">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class=" col-form-label">SEO keyword</label>
                                <div class="">
                                    <input type="text" onfocusout="setSEOKeywordFinal()" value="<?php if (isset($_POST['seo_keyword'])) echo $_POST['seo_keyword'];
                                                                                                else echo ''; ?>" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO keyword">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Meta title</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                                else echo ''; ?>" name="meta_title" id="meta_title" class="form-control" placeholder="Meta title">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="col-form-label">Meta keyword</label>
                                <div class="">
                                    <input type=" text" value="<?php if (isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];
                                                                else echo ''; ?>" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Meta keyword">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Status</label>
                                <div class="">
                                    <select name="status" id="status" class="form-control">
                                        <?php
                                        if (isset($_POST['status'])) {
                                            if ($_POST['status'] == 1) { ?>
                                                <option selected value="1">Anable</option>
                                                <option value="">Disable</option>
                                            <?php } else if ($_POST['status'] == 0) { ?>
                                                <option value="1">Anable</option>
                                                <option selected value="0">Disable</option>
                                            <?php }
                                        } else { ?>
                                            <option selected value="1">Anable</option>
                                            <option value="0">Disable</option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Maintenance mode</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['maintenance_mode'])) {
                                        $maintenance_mode = $_POST['maintenance_mode'];
                                        switch ($maintenance_mode) {
                                            case 'on':
                                                $on_selected = 'checked';
                                                $off_selected = '';
                                                break;

                                            case 'off':
                                                $off_selected = 'checked';
                                                $on_selected = '';
                                                break;
                                            default:
                                                $on_selected = '';
                                                $off_selected = 'checked';
                                                break;
                                        }
                                    } else {
                                        $on_selected = '';
                                        $off_selected = 'checked';
                                    }
                                    ?>
                                    <label class="">
                                        <input type="radio" name="maintenance_mode" id="maintenance_mode" value="on" <?= $on_selected ?>> On
                                    </label> &nbsp;&nbsp;
                                    <label class="">
                                        <input type="radio" name="maintenance_mode" id="maintenance_mode" value="off" <?= $off_selected ?>> Off
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Meta description</label>
                                <div class="">
                                    <textarea name="meta_description" id="meta_description" placeholder="Meta description" class="form-control" rows="3"><?php if (isset($_POST['meta_description'])) echo $_POST['meta_description'];
                                                                                                                                                            else echo ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class=" col-form-label">Description</label>
                                <div class="" id="cms_page_desc">
                                    <textarea name="description" id="description" placeholder="Meta description" class="form-control" rows="3"><?php if (isset($_POST['description'])) echo $_POST['description'];
                                                                                                                                                else echo ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="">
                                <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-plus-circle'></i> Add Cms Page</button>
                                <a href="<?= base_url("CmsPage/CmsPageList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
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