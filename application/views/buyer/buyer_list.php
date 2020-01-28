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
        <h3 class="breadcrumb-header">Buyers</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix" style="margin-bottom: 20px">
                        <div class="right">
                            <a href="<?php echo base_url("Buyer/addBuyer"); ?>" class="btn btn-success size" aria-hidden="true"><i class="fa fa-plus"></i> &nbsp Add Buyer</a>
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
                            <?php echo form_open_multipart('Buyer/delete_buyer/', ['id' => 'my_id']); ?>
                            <table id="" class="display table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onchange="checkAll(this)" name="chk" /></th>
                                        <th>No</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($buyers)) {
                                        $i = 1;
                                        foreach ($buyers as $buyer) { ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkbox" name="chk[]" id="chkd" value="<?php echo $buyer['id']; ?>" /></td>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $buyer['first_name'] . ' ' . $buyer['last_name'] ?></td>
                                                <td><?php echo $buyer['email'] ?></td>
                                                <td>
                                                    <?php if ($buyer['status'] == 1) { ?>
                                                        <h5>Enabled</h5>
                                                    <?php } else { ?>
                                                        <h5>Disable</h5>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <a class="label label-inverse-info" href='<?php //echo base_url(); 
                                                                                                    ?>Buyer/updateBuyer/<?php echo $buyer['id']; ?>'>Edit</a> -->
                                                    <a class="btn btn-info btn-rounded right" href='<?php echo base_url("Buyer/updateBuyer/{$buyer['id']}"); ?>'>
                                                        <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        }
                                    } else { ?>
                                        <p>Buyers not found...</p>
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
            url: '<?php echo base_url('Buyer/ajaxPaginationBuyer/'); ?>' + page_num,
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