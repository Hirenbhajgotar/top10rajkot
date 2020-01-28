<style>
    a.fa.fa-trash {
        font-size: 30px;
    }

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

    .next {
        color: red;
    }

    .num {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 1em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        border-radius: 100%;
        border: none;
        box-shadow: none;
        background: #0070E0;
        color: #fff !important;
    }

    .pagination {
        float: right;
    }

    .size {
        font-size: 13px;
    }
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
        <h3 class="breadcrumb-header">Update category</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <?php
            // echo uri_string();
            // echo base_url() . "Category/updateCategoryData/" . $this->uri->segment('3') . "<br>";
            // echo base_url(uri_string());
            // echo current_url();
            ?>
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?= form_open_multipart("Category/updateCategoryData/{$category['id']}", ['id' => 'validate_category']) ?>
                        <div class="form-group col-md-6">
                            <label class="control-label">Parent category name</label>
                            <div class="">
                                <?php
                                if (isset($_POST['parent_id'])) { ?>
                                    <select name="parent_id" class="form-control">
                                        <!-- <option value="0">Select category</option> -->
                                        <?php
                                        foreach ($parent_category as $cat) {
                                            if ($_POST['parent_id'] == $cat['id']) { ?>
                                                <option selected value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select name="parent_id" class="form-control">
                                        <option selected value="0">Select category</option>
                                        <?php
                                        foreach ($parent_category as $cat) {
                                        ?>
                                            <option <?php if ($category['parent_id'] == $cat['id']) echo "selected" ?> value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Category name</label>
                            <div class="">
                                <input type="text" value="<?php if (isset($_POST['category_name'])) echo $_POST['category_name'];
                                                            else echo $category['category_name'] ?>" name="category_name" class="form-control" placeholder="Category name">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Meta keyword</label>
                            <div class="">
                                <input type="text" value="<?php if (isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];
                                                            else echo $category['meta_keyword'] ?>" name="meta_keyword" class="form-control" placeholder="Meta keyword">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" control-label">Seo keyword</label>
                            <div class="">
                                <input onfocusout="setSEOKeywordFinal()" type="text" value="<?php if (isset($_POST['seo_keyword'])) echo $_POST['seo_keyword'];
                                                                                            else echo $category['seo_keyword'] ?>" name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO keyword">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" control-label">Meta title</label>
                            <div class="">
                                <input type="text" value="<?php if (isset($_POST['meta_title'])) echo $_POST['meta_title'];
                                                            else echo $category['meta_title'] ?>" name="meta_title" class="form-control" placeholder="Meta title">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Category image</label>
                            <div class="">
                                <input type="file" name="category_image" class="form-control">
                            </div>
                        </div>
                        <!-- status -->
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
                                    } else if (isset($category['status'])) {
                                        if ($category['status'] == 1) { ?>
                                            <option selected value="1">Anable</option>
                                            <option value="0">Disable</option>
                                        <?php } else if ($category['status'] == 0) { ?>
                                            <option value="1">Anable</option>
                                            <option selected value="0">Disable</option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Feature category</label>
                            <div class="">
                                <?php
                                if (isset($_POST['feature_category'])) {

                                    $feature_category = $_POST['feature_category'];
                                    switch ($feature_category) {
                                        case 1:
                                            $m_selected = 'checked';
                                            $f_selected = '';
                                            break;

                                        case 0:
                                            $f_selected = 'checked';
                                            $m_selected = '';
                                            break;
                                        default:
                                            $m_selected = 'checked';
                                            $f_selected = '';
                                            break;
                                    }
                                } else {
                                    $feature_category = $category['feature_category'];
                                    switch ($feature_category) {
                                        case 1:
                                            $m_selected = 'checked';
                                            $f_selected = '';
                                            break;

                                        case 0:
                                            $f_selected = 'checked';
                                            $m_selected = '';
                                            break;
                                        default:
                                            $m_selected = 'checked';
                                            $f_selected = '';
                                            break;
                                    }
                                }
                                ?>
                                <label class="">
                                    <input type="radio" name="feature_category" value="1" <?= $m_selected ?>> Yes
                                </label>
                                <label class="">
                                    <input type="radio" name="feature_category" value="0" <?= $f_selected ?>> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Meta description</label>
                            <div class="">
                                <textarea name="meta_description" id='meta_description' class="form-control" rows="3"><?php if (isset($_POST['meta_description'])) echo $_POST['meta_description'];
                                                                                                                        else echo $category['meta_description'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Description</label>
                            <div class="" id="category_desc">
                                <textarea name="category_description" id="category_description" class="form-control" rows="3"><?php if (isset($_POST['category_description'])) echo $_POST['category_description'];
                                                                                                                                else echo $category['category_description'] ?></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="date_added" value="<?php if (isset($category['date_added'])) echo $category['date_added'];
                                                                        ?>">
                        <div class="form-group">
                            <div class=" col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update category</button>
                                <a href="<?= base_url("Category/categoryList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
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