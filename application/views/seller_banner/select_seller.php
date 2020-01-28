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
        <h3 class="breadcrumb-header"><?= $title ?></h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <!-- <div class="panel-heading clearfix" style="margin-bottom: 20px">
                        <div class="right">
                            <a href="<?php echo base_url("Buyer/addBuyer"); ?>" class="btn btn-success size" aria-hidden="true"><i class="fa fa-plus"></i> &nbsp Add Banner</a>
                            <a class="btn btn-danger size" aria-hidden="true" onclick="myFunction()"><i class="fa fa-remove" aria-controls="example"></i> &nbsp Remove</a>
                        </div>
                        <input type="text" class="search" id="keywords" class="" placeholder="" aria-controls="example">
                        <button type="button" class="btn btn-success" aria-controls="example" onclick="searchFilter();"> <i class="menu-icon icon-search"></i>&nbsp Search</button>
                    </div> -->

                    <div class="panel-body" id="dataList">
                        <!-- <h3>&nbsp;</h3> -->
                        <div class="table-responsive dataTables_wrapper " style="width: 100%;">
                            <?php echo form_open_multipart('seller_banner/banner_list/', ['id' => 'select_seller']); ?>
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Select seller</label>
                                <div class="">
                                    <?php if (isset($_POST['parent_id'])) { ?>
                                        <select name="seller" id="seller" class="form-control">
                                            <option disabled disabled>Select seller</option>
                                            <?php
                                            foreach ($sellers as $seller) {
                                                if ($_POST['parent_id'] == $seller->id) { ?>
                                                    <option selected value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                                <?php } ?>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php } else { ?>
                                        <select name="seller" id="seller" class="form-control">
                                            <option selected disabled>Select seller</option>
                                            <?php
                                            foreach ($sellers as $seller) {
                                            ?>
                                                <option value="<?= $seller->id ?>"><?= $seller->firstname . ' ' . $seller->lastname ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class='fa fa-plus-circle'></i> Next</button>
                                    <!-- <a href="<?= base_url("Category/categoryList") ?>" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a> -->
                                </div>
                            </div>
                            <?= form_close() ?>
                            <?php //echo $this->ajax_pagination->create_links(); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>