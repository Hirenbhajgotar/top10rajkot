<style type="text/css">
    .flex-caption {
        width: 100%;
        padding: 2%;
        left: 0;
        bottom: 0;
        background: #262b81;
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, .3);
        font-size: 20px;
        line-height: 22px;
    }
</style>


<div class="page-bread mb70">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Agent Detail</h3>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb40">
                <div class="row mb30">
                    <div class="col-sm-4 mb40">
                        <?php if ($products['product_image']) { ?>

                            <img src="<?php echo site_url(); ?>assets/images/products/<?php echo $products['product_image']; ?>" alt="" class="img-responsive img-thumbnail" style="height:300px;">
                        <?php } else { ?>
                            <img src="<?php echo site_url(); ?>assets/images/no_image.PNG" alt="" class="img-responsive img-thumbnail" style="height:300px;">
                        <?php } ?>
                    </div>
                    <div class="col-sm-8 mb40">
                        <h2 class="font300"><?php echo $products['product_name']; ?></h2>
                        <p><strong>Model:</strong> <?php echo $products['product_model']; ?></p>
                        <p>
                            <?php echo $products['product_description']; ?>
                        </p>



                    </div>
                </div>

                <h2 class="left-title">Related Product</h2>

                <div class="row">
                    <?php foreach ($re_products as $pre) {  ?>
                        <div class="col-sm-3 mb30">
                            <div class="card-overlay">
                                <?php if ($pre['product_image']) { ?>
                                    <a href="<?php echo  site_url(); ?>product_details/<?php echo $pre['product_seo_keyword']; ?>">
                                        <img src="<?php echo site_url(); ?>assets/images/products/<?php echo $pre['product_image']; ?>" class="img-responsive" alt="" style="height: 150px; width: 1000px;">
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo  site_url(); ?>product_details/<?php echo $pre['product_seo_keyword']; ?>">
                                        <img src="<?php echo site_url(); ?>assets/images/no_image.PNG" class="img-responsive" alt="" style="height: 150px; width: 1000px;">
                                    </a>
                                <?php } ?>
                                <div class="card-hover">
                                    <div class="card-content">
                                        <!--
                                    <a class="label label-primary" href="#">Drinks</a>-->
                                        <h3><a href="<?php echo  site_url(); ?>product_details/<?php echo $pre['product_seo_keyword']; ?>"><?php echo $pre['product_name']; ?></a></h3>
                                        <!--
                                    <ul class="list-inline mb0 rating-list">
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star-half-empty text-warning"></i></li>
                                    </ul>-->
                                    </div>
                                    <!--/card-content-->
                                    <!--
                                 <div class="card-icons">
                                    <a href="#" title="Add to Wishlist"><i class="fa fa-heart-o"></i></a>
                                    <a href="#" title="View Detail"><i class="fa fa-search"></i></a>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>