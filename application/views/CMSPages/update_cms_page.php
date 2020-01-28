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
        <h3 class="breadcrumb-header">Update cms page</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open("CmsPage/updateCmsData/{$cmsData['id']}", ['id' => 'validate_cms_page']); ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Select seller</label>
                                <div class="">
                                    <?php
                                    if (isset($_POST['seller_id'])) { ?>
                                        <select name="seller_id" id="country" class="form-control" onchange="get_state()">
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
                                        <select name="seller_id" id="country" class="form-control" onchange="get_state()">
                                            <option selected disabled>Select seller</option>
                                            <?php foreach ($allSellers as $singleseller) {
                                                if ($cmsData['seller_id'] == $singleseller->id) { ?>
                                                    <option selected value="<?= $singleseller->id ?>"><?= $singleseller->firstname . ' ' . $singleseller->lastname ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $singleseller->id ?>"><?= $singleseller->firstname . ' ' . $singleseller->lastname ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Title</label>
                                <div class="">
                                    <input onfocusout="setSEOKeyword()" type="text" value="<?php if (isset($_POST['title'])) echo $_POST['title'];
                                                                                            else if ($cmsData['title']) echo $cmsData['title']; ?>" name="title" id="title" class="form-control" placeholder="Cms title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">SEO keyword</label>
                                <div class="">
                                    <input onfocusout="setSEOKeywordFinal()" type="text" value="<?php if (isset($_POST['seo_keyword'])) echo $_POST['seo_keyword'];
                                                                                                else if ($cmsData['seo_keyword']) echo $cmsData['seo_keyword']; ?>" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO keyword">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Meta title</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                                else if ($cmsData['meta_title']) echo $cmsData['meta_title']; ?>" name="meta_title" class="form-control" placeholder="Meta title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Meta keyword</label>
                                <div class="">
                                    <input type=" text" value="<?php if (isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];
                                                                else if ($cmsData['meta_keyword']) echo $cmsData['meta_keyword']; ?>" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Meta keyword">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Status</label>
                                <div class="">
                                    <select name="status" class="form-control">
                                        <?php
                                        if (isset($_POST['status'])) {
                                            if ($_POST['status'] == 1) { ?>
                                                <option selected value="1">Anable</option>
                                                <option value="">Disable</option>
                                            <?php } else if ($_POST['status'] == 0) { ?>
                                                <option value="1">Anable</option>
                                                <option selected value="0">Disable</option>
                                            <?php }
                                        } else if (isset($cmsData['status'])) {
                                            if ($cmsData['status'] == 1) { ?>
                                                <option selected value="1">Anable</option>
                                                <option value="0">Disable</option>
                                            <?php } else if ($cmsData['status'] == 0) { ?>
                                                <option value="1">Anable</option>
                                                <option selected value="0">Disable</option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Maintenance mode</label>
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
                                    } else if (isset($cmsData['maintenance_mode'])) {
                                        $maintenance_mode = $cmsData['maintenance_mode'];
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
                                    }
                                    ?>
                                    <label class="">
                                        <input type="radio" name="maintenance_mode" value="on" <?= $on_selected ?>> On
                                    </label> &nbsp;&nbsp;
                                    <label class="">
                                        <input type="radio" name="maintenance_mode" value="off" <?= $off_selected ?>> Off
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class=" col-form-label">Meta description</label>
                                <div class="">
                                    <textarea name="meta_description" placeholder="Meta description" class="form-control" rows="3"><?php if (isset($_POST['meta_description'])) echo $_POST['meta_description'];
                                                                                                                                    else if ($cmsData['meta_description']) echo $cmsData['meta_description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class=" col-form-label">Description</label>
                                <div class="">
                                    <textarea name="description" placeholder="Meta description" class="form-control" rows="3"><?php if (isset($_POST['description'])) echo $_POST['description'];
                                                                                                                                else if ($cmsData['description']) echo $cmsData['description']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="date_addedd" value="<?php if (isset($cmsData['date_addedd'])) echo $cmsData['date_addedd'];
                                                                        ?>">

                        <div class="row">
                            <div class="form-group">
                                <div class=" col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update cms page</button>
                                    <a href="<?= base_url("CmsPage/CmsPageList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
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