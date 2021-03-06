<div class="page-bread mb70">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Search products</h3>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb60">
                <h4 class="left-title mb20">Search Filter</h4>
                <div class="mb40">
                    <!-- <form> -->
                    <?= form_open("search", ['method' => 'get']) ?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Keywords...">
                    </div>
                    <div class="form-group mb15">
                        <select class="form-control" title="Location">
                            <option>Paris</option>
                            <option>London</option>
                            <option>New York</option>
                            <option>Tokyo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="category" class="form-control" title="Category">
                            <?php foreach ($products as $item) { ?>
                                <option><?= $item->category_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Min Price...">
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block" value="Search">
                    <!-- </form> -->
                    <input type="hidden" name="product" value="<?= $search_key ?>">
                    <?= form_close() ?>
                </div>
                <h4 class="left-title mb20">Recent Listings</h4>
                <ul class="list-unstyled recent-item-card mb40">
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="images/img1.jpg" alt="" class="img-responsive" width="90">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4><a href="#">Doloremque laudantium, totam rem aperiam</a></h4>
                            <em>New York / Coffee</em>
                            <span class="text-primary">$140/Person</span>
                        </div>
                    </li>
                    <!--/li-->
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="images/img2.jpg" alt="" class="img-responsive" width="90">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4><a href="#">Doloremque laudantium, totam rem aperiam</a></h4>
                            <em>New York / Coffee</em>
                            <span class="text-primary">$140/Person</span>
                        </div>
                    </li>
                    <!--/li-->
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="images/img3.jpg" alt="" class="img-responsive" width="90">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4><a href="#">Doloremque laudantium, totam rem aperiam</a></h4>
                            <em>New York / Coffee</em>
                            <span class="text-primary">$140/Person</span>
                        </div>
                    </li>
                    <!--/li-->
                </ul>
                <!--/ul-->
                <h4 class="left-title mb20">Popular Tags</h4>
                <ul class="list-inline tags-list">
                    <li><a href="#"><i class="fa fa-tag"></i> Shop</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Beer</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Beach</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Cinemas</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Hotel</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Dinner</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Lunch</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Taxi</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Bar & pubs</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Games</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> Tickets</a></li>
                </ul>
            </div>

            <div class="col-md-9 mb40">
                <div class="clearfix mb30">

                    <div class="pull-right">
                        <div class="form-group">
                            <select class="form-control" title="Sorting">
                                <option>Popular</option>
                                <option>Low Price</option>
                                <option>Best Rating</option>
                                <option>High price</option>
                            </select>
                        </div>
                    </div>
                    <!-- <h3 class="font300">45 Results Found</h3> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        foreach ($products as $item) {
                            //     echo '<pre>';
                            // print_r($item);
                            // echo '</pre>';
                        ?>
                            <div class="row listing-row">
                                <div class="col-sm-3">
                                    <?php
                                    if ($item->p_product_image) { ?>
                                        <a href="#"><img src="<?php echo base_url("assets/images/products/{$item->p_product_image}") ?>" alt="" class="img-responsive"></a>
                                    <?php } else { ?>
                                        <a href="#"><img src="<?php echo base_url("assets/images/no-image-available-icon-6.png") ?>" alt="" class="img-responsive"></a>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-5">
                                    <h4><a href="#"><?php echo $item->p_product_name ?></a></h4>
                                    <p>
                                        <?php echo $item->p_product_description ?>
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <a href="<?= base_url("seller/{$item->seller_id}") ?>">
                                        <h4><?php echo $item->seller_firstname . ' ' . $item->seller_lastname ?></h4>
                                    </a>
                                    <?php if ($item->seller_email_verify == 1) { ?>
                                        <span>Eamil verified | </span>
                                    <?php } ?>
                                    <?php if ($item->seller_mobile_verify == 1) { ?>
                                        <span> Mobile verified</span>
                                    <?php } ?>
                                    <button class="btn btn-primary" onclick="call_inquiry('<?php echo $item->seller_id ?>', '<?php echo $item->category_id ?>', '<?php echo $item->product_id ?>')">Enquiry</button>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
                <div class="text-right mb30">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--/col-->

        </div>
    </div>
</div>