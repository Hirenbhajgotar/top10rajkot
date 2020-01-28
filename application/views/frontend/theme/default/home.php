<!--fullscreen image-->
<div class="fullscreen-parallax bg-parallax" data-jarallax='{"speed": 0.2}' style='background-image: url(<?= base_url("application/views/frontend/theme/default/assets/images/bg1.jpg") ?>)'>
    <div class="fullscreen-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="text-center">
                        <h3>Search for products & find verified sellers near you</h3>
                        <form role="form">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control " placeholder="What are you looking for... ">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-lg" type="button">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Slideshow -->
<div class="fullscreen-inner">
    <div class="container">

        <div class="row">
            <div class="col-sm-8 slider">
                <h1>We connect <b>Buyers & Sellers</b></h1>
                <p>Top1oRajkot is Rajkot's online B2B marketplace, connecting buyers with suppliers.</p>
            </div>
        </div>

        <div class="row">

            <!-- Place somewhere in the <body> of your page -->
            <div class="flexslider">
                <ul class="slides">
                    <?php
                    foreach ($banner as $value) { ?>
                        <li>
                            <img src="<?php echo base_url("application/views/frontend/theme/default/assets/images/banner/{$value->image}"); ?>" style="width:100%">
                            <p class="flex-caption"><?php echo $value->name  ?></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


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

<link href="<?= base_url("application/views/frontend/theme/default/assets/css/flexslider.css") ?>" rel="stylesheet">


<!-- category -->
<div class="gray-bg pt40 pb40">
    <div class="container featuredCategory">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center center-heading mb10">
                <h2>Feature Categories</h2>

            </div>
        </div>
        <!--/row-->
        <?php
       
        ?>
        <?php if ($categories) { ?>
            <div class="row">

                <?php foreach ($categories as $item) { ?>
                    <div class="col-sm-6 col-md-3 mb20">
                        <div class="card-overlay">
                            <a href="<?= base_url("category/{$item->keyword}") ?>">
                                <?php if ($item->category_image) { ?>
                                    <img src="<?= base_url("assets/images/category/$item->category_image") ?>" class="img-responsive" alt="">
                                <?php } else { ?>
                                    <img src="<?= base_url("assets/images/no-image-available-icon-6.png") ?>" class="img-responsive" alt="">
                                <?php } ?>
                                <div class="card-hover">
                                    <div class="card-content">
                                        <h3><a href="<?= base_url("category/{$item->keyword}") ?>"><?= $item->category_name ?></a>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <?php /*<div class="row">
                <div class="text-center mb30">
                    <a href="#" class="btn btn-lg btn-rounded btn-primary">View All Categories</a>
                </div>
            </div>*/ ?>
        <?php } ?>
    </div>
</div>
<!-- end category -->

<div class="bg-faded pt80 pb40 mb70 ">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 mb30">
                <div class="icon-center-card">
                    <i class="fa fa-envelope-o"></i>
                    <h3>Full support</h3>
                    <p>
                        Doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto beatae vitae dicta sunt explicabo.
                    </p>
                    <a href="#">Read More</a>
                </div>
            </div>
            <!--/col-->
            <div class="col-sm-4 mb30">
                <div class="icon-center-card">
                    <i class="fa fa-map-marker"></i>
                    <h3>More than 1000 places</h3>
                    <p>
                        Doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto beatae vitae dicta sunt explicabo.
                    </p>
                    <a href="#">Read More</a>
                </div>
            </div>
            <!--/col-->
            <div class="col-sm-4 mb30">
                <div class="icon-center-card">
                    <i class="fa fa-code"></i>
                    <h3>Free updated</h3>
                    <p>
                        Doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto beatae vitae dicta sunt explicabo.
                    </p>
                    <a href="#">Read More</a>
                </div>
            </div>
            <!--/col-->
        </div>
    </div>
</div>

<!-- testimonials -->
<div class="gray-bg pt80 pb80">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center center-heading mb40">
                <h2>What our customers say</h2>
                <p>
                    It is a long established fact that a reader will be distracted by the readable content of a page
                    when looking at its layout.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-sm-offset-0">
                <div class="owl-carousel owl-theme testimonial-slider mb40">
                    <div class="item">
                        <div class="testimonial-card">
                            <div class="content">
                                " There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable. "
                            </div>
                            <div class="testimonial-author clearfix">
                                <img src='<?= base_url("application/views/frontend/theme/default/assets/images/av1.jpg") ?>' alt="" class="img-responsive img-circle pull-left" width="90">
                                <div class="author-meta">
                                    <h5 class="mb0">John Doe</h5>
                                    <em>Finder Customer</em>
                                    <ul class="list-inline mb0 rating-list">
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star-half-empty text-warning"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/item-->
                    <div class="item">
                        <div class="testimonial-card">
                            <div class="content">
                                " There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable. "
                            </div>
                            <div class="testimonial-author clearfix">
                                <img src='<?= base_url("application/views/frontend/theme/default/assets/images/av2.jpg") ?>' alt="" class="img-responsive img-circle pull-left" width="90">
                                <div class="author-meta">
                                    <h5 class="mb0">John Doe</h5>
                                    <em>Finder Customer</em>
                                    <ul class="list-inline mb0 rating-list">
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star-half-empty text-warning"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/item-->
                    <div class="item">
                        <div class="testimonial-card">
                            <div class="content">
                                " There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable. "
                            </div>
                            <div class="testimonial-author clearfix">
                                <img src='<?= base_url("application/views/frontend/theme/default/assets/images/av3.jpg") ?>' alt="" class="img-responsive img-circle pull-left" width="90">
                                <div class="author-meta">
                                    <h5 class="mb0">John Doe</h5>
                                    <em>Finder Customer</em>
                                    <ul class="list-inline mb0 rating-list">
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star-half-empty text-warning"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/item-->
                </div>
                <!--/slider-->
            </div>
        </div>
    </div>
</div>

<!-- blogs -->
<div class="container pt40 mb40">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center center-heading mb40">
            <h2>Latest from blog</h2>
            <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 mb40">
            <div class="post-card">
                <a href="#"><img src='<?= base_url("application/views/frontend/theme/default/assets/images/img2.jpg") ?>' alt="" class="img-responsive mb15"></a>
                <div class="post-content">
                    <h4><a href="#">Standard post with image</a></h4>
                    <p>
                        It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout...
                    </p>
                </div>
            </div>
        </div>
        <!--/col-->
        <div class="col-sm-4 mb40">
            <div class="post-card">
                <a href="#"><img src='<?= base_url("application/views/frontend/theme/default/assets/images/img3.jpg") ?>' alt="" class="img-responsive mb15"></a>
                <div class="post-content">
                    <h4><a href="#">Standard post with image</a></h4>
                    <p>
                        It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout...
                    </p>
                </div>
            </div>
        </div>
        <!--/col-->
        <div class="col-sm-4 mb40">
            <div class="post-card">
                <a href="#"><img src='<?= base_url("application/views/frontend/theme/default/assets/images/img4.jpg") ?>' alt="" class="img-responsive mb15"></a>
                <div class="post-content">
                    <h4><a href="#">Standard post with image</a></h4>
                    <p>
                        It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout...
                    </p>
                </div>
            </div>
        </div>
        <!--/col-->
    </div>
</div>

<!-- newslaatter -->
<div class="gray-bg pt40 pb40 newsletter-form">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>
                    Subscribe and be notified about new locations</h2>
            </div>
            <div class="col-sm-6">
                <div class="newsletter-card">
                    <form>
                        <input type="text" class="form-control" placeholder="Enter your Email...">
                        <input type="submit" value="Subscribe" class="newsletter-submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- category listning -->