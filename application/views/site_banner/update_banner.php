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
        <a href="<?= base_url("Banner/bannerList") ?>" class="btn btn-primary right"><i class="fa fa-arrow-circle-left"></i> Back</a>
        <h3 class="breadcrumb-header"><?= $title ?></h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open_multipart("Banner/updateBannerData/{$banner->id}", ['id' => 'banner_validation']); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Name</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['name'])) echo $_POST['name'];
                                                                else if ($banner->name) echo $banner->name; ?>" name="name" id="name" class="form-control" placeholder="Banner name">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Position</label>
                                <div class="">
                                    <select name="position" id="position" class="form-control">
                                        <?php
                                        if (isset($_POST['position'])) {
                                            if ($_POST['position'] == 0) { ?>
                                                <option selected value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($_POST['position'] == 1) { ?>
                                                <option value="0">Top</option>
                                                <option selected value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($_POST['position'] == 2) { ?>
                                                <option value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option selected value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($_POST['position'] == 3) { ?>
                                                <option value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option selected value="3">Left</option>
                                            <?php }
                                        } else if ($banner->position) {
                                            if ($banner->position == 0) { ?>
                                                <option selected value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($banner->position == 1) { ?>
                                                <option value="0">Top</option>
                                                <option selected value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($banner->position == 2) { ?>
                                                <option value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option selected value="2">Bottom</option>
                                                <option value="3">Left</option>
                                            <?php } else if ($banner->position == 3) { ?>
                                                <option value="0">Top</option>
                                                <option value="1">Right</option>
                                                <option value="2">Bottom</option>
                                                <option selected value="3">Left</option>
                                            <?php } ?>
                                        <?php }  ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Link</label>
                                <div class="">
                                    <input type="text" value="<?php if (isset($_POST['link'])) echo $_POST['link'];
                                                                else if ($banner->link) echo $banner->link; ?>" name="link" id="link" class="form-control" placeholder="Banner link">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Image</label>
                                <div class="">
                                    <input type="file" name="image" id="image" class="form-control" placeholder="image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Short order</label>
                                <div class="">
                                    <input type="text" name="short_order" id="short_order" value="<?php if (isset($_POST['short_order'])) echo $_POST['short_order'];
                                                                                                    else if ($banner->short_order) {
                                                                                                        echo $banner->short_order;
                                                                                                    } ?>" class="form-control" placeholder="Short order">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Status</label>
                                <div class="">
                                    <select name="status" class="form-control">
                                        <?php
                                        if (isset($_POST['status'])) {
                                            if ($_POST['status'] == 1) { ?>
                                                <option selected value="1">enable</option>
                                                <option value="">Disable</option>
                                            <?php } else if ($_POST['status'] == 0) { ?>
                                                <option value="1">Enable</option>
                                                <option selected value="0">Disable</option>
                                            <?php }
                                        } else if ($banner->status) {
                                            if ($banner->status == 1) { ?>
                                                <option selected value="1">Enable</option>
                                                <option value="0">Disable</option>
                                            <?php } else if ($banner->status == 0) { ?>
                                                <option value="1">Enable</option>
                                                <option selected value="0">Disable</option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="date_added" value="<?= $banner->date_added ?>">
                        <input type="hidden" name="date_modified" value="<?= date("Y-m-d H:i:s") ?>">
                        <div class="form-group">
                            <div class=" col-sm-10">
                                <button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update Banner</button>
                                <a href="<?= base_url("Banner/bannerList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
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