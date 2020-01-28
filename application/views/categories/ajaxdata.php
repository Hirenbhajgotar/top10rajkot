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
<div class="table-responsive dataTables_wrapper">
    <?php echo form_open_multipart('Category/delete_categories/', ['id' => 'my_id']); ?>
    <table class="display table" style="width: 100%;">
        <thead>
            <tr>
                <th>
                    <div class="checkbox">
                        <label>
                            <div class="checker">
                                <span>
                                    <input type="checkbox" class="checkbox" onchange="checkAll(this)" name="chk" />
                                </span>
                            </div>
                        </label>
                    </div>
                </th>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Date added</th>
                <th>Status</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)) {
                // echo '<pre>';
                // print_r($start);
                // echo '<br>';
                // print_r($limit);
                // echo '</pre>';
                // exit;
                $i = $start + 1;
                foreach ($categories as $category) { ?><tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <div class="checker">
                                        <span>
                                            <input type="checkbox" class="checkbox" onclick="check_checkbox(this)" name="chk[]" id="chkd" value="<?php echo $category['id']; ?>" />
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php if ($category['category_image']) { ?>
                                <img width="50px;" src="<?php echo site_url(); ?>assets/images/category/<?php echo $category['category_image']; ?> ">
                            <?php } else { ?>
                                <img width="50px;" src="<?php echo site_url("assets/images/no-image-available-icon-6.png"); ?> ?> ">
                            <?php } ?>
                        </td>
                        <td><?php echo $category['category_name']; ?></td>
                        <td><?php echo date("M d,Y", strtotime($category['date_added'])); ?></td>
                        <td>
                            <?php if ($category['status'] == 1) { ?>
                                <h5>Enabled</h5>
                            <?php } else { ?>
                                <h5>Desabled</h5>
                            <?php } ?>
                        </td>
                        <td>
                            <!-- <a class="label label-inverse-info" href='<?php echo base_url(); ?>Category/updateCategory/<?php echo $category['id']; ?>'>Edit</a> -->
                            <a class="btn btn-info btn-rounded right" href='<?php echo base_url(); ?>Category/updateCategory/<?php echo $category['id']; ?>'>
                                <li class="fa fa-edit" aria-controls="example"> </li> &nbsp Edit
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                }
            } else { ?>
                <p>Category not found...</p>
            <?php } ?>
        </tbody>
    </table>
    <?= form_close() ?>
    <?php echo $this->ajax_pagination->create_links(); ?>

</div>

<script>
    function myFunction() {
        // alert("kdkd")
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

<!-- search filter -->
<script>
    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Category/ajaxPaginationCategory/'); ?>' + page_num,
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(html) {
                console.log(html);
                $('#dataList').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }
</script>

<!-- delte / enable-disable -->
<script type="text/javascript">
    $(document).ready(function() {
        // alert("eroror");
        $(".delete").click(function(e) {
            // alert('as');
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
            // alert('as');
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

<!-- check all checkbox -->
<script>
    function checkAll(ele) {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    let ch = checkboxes[i].checked = true;
                    checkboxes[i].parentNode.classList.add("checked");
                }
            }
            // console.log("checked");
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    let ch = checkboxes[i].checked = false;
                    checkboxes[i].parentNode.classList.remove("checked");
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