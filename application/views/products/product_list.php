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
</style>
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Products</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix" style="margin-bottom: 20px">
                        <div class="right">
                            <a href="<?php echo base_url("Products/addProducts"); ?>" class="btn btn-success size" aria-hidden="true"><i class="fa fa-plus"></i> &nbsp Add Product</a>
                            <a class="btn btn-danger size" aria-hidden="true" onclick="myFunction()"><i class="fa fa-remove" aria-controls="example"></i> &nbsp Remove</a>
                        </div>
                        <input type="text" class="search" id="keywords" class="" placeholder="" aria-controls="example">
                        <button type="button" class="btn btn-success" aria-controls="example" onclick="searchFilter();"> <i class="menu-icon icon-search"></i>&nbsp Search</button>
                    </div>
                    <!-- <select id="sortBy" class="search" onchange="searchFilter();">
                        <option class="search">Sort by Title</option>
                        <option class="search" value="asc">Ascending</option>
                        <option class="search" value="desc">Descending</option>
                    </select> -->

                    <div class="panel-body" id="dataList">
                        <!-- <h3>&nbsp;</h3> -->
                        <div class="table-responsive dataTables_wrapper " style="width: 100%;">
                            <?php echo form_open_multipart('Products/delete_product/', 'id="my_id"'); ?>
                            <table class="display table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onchange="checkAll(this)" name="chk" /></th>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Status</th>
                                        <th class="right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($products)) {
                                        // echo base_url();
                                        $i = 1;
                                        foreach ($products as $product) { ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkbox" name="chk[]" id="chkd" value="<?php echo $product['id']; ?>" /></td>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php if ($product['product_image']) { ?>
                                                        <img width="50px;" src="<?php echo site_url(); ?>assets/images/products/<?php echo $product['product_image']; ?> ">
                                                    <?php } else { ?>
                                                        <img width="50px;" src="<?php echo site_url("assets/images/no-image-available-icon-6.png"); ?> ?> ">
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $product['product_name']; ?></td>
                                                <td><?php echo $product['product_model']; ?></td>
                                                <!-- <td><?php echo date("M d,Y", strtotime($product['date_added'])); ?></td> -->
                                                <td>
                                                    <?php if ($product['status'] == 1) { ?>
                                                        <h5>Enabled</h5>
                                                    <?php } else { ?>
                                                        <h5>Disabled</h5>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-rounded right" href='<?php echo base_url("Products/updateProduct/{$product['id']}"); ?>'>
                                                        <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        }
                                    } else { ?>
                                        <p>Product not found...</p>
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
            url: '<?php echo base_url('Products/ajaxPaginationProduct/'); ?>' + page_num,
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