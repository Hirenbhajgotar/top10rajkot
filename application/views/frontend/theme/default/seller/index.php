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

<?php $url = current_url(); ?>
        <div class="page-bread mb70">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Agent Detail</h3>
						
                    </div>
                    <div class="col-sm-6">
						 <ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="<?php echo $url; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Home</a>

							</li>
							
							<li class="dropdown">
								<a href="<?php echo site_url(); ?>product/<?php echo $seo; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Product</a>

							</li>
							
							<li class="dropdown">
								<a href="<?php echo site_url(); ?>contact/<?php echo $seo; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Contact</a>

							</li>
						 </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 mb40">
                        <div class="row mb30">
                            <div class="col-sm-4 mb40">
							<?php if($seller['logo_image']){ ?>
                               
								<img src="<?php echo site_url(); ?>assets/images/seller_home_content/<?php echo $seller['logo_image']; ?>" alt="" class="img-responsive img-thumbnail" style="height: 250px;">
							<?php } else { ?>
							  <img src="<?php echo site_url(); ?>assets/images/no_image.PNG" alt="" class="img-responsive img-thumbnail" style="height: 250px;">
							<?php } ?>
                            </div>
                            <div class="col-sm-8 mb40">
                                <h2 class="font300"><?php echo $seller['firstname']; ?></h2>
								<p>
                                    <strong>GST:</strong> <?php echo $seller['gst_number']; ?>
                                </p>
								<p>
                                    <strong>Location:</strong> <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $state['name']; ?> , <?php echo $country['name']; ?>
                                </p>
                                <p>
                                    <strong>Description:</strong> <?php echo $seller['description']; ?>
                                </p>
                                <p><strong>Email:</strong> <?php echo $seller['email']; ?></p>
                                <p><strong>Phone:</strong> <?php echo $seller['mobile']; ?></p>
                                <p class="social-inline"><strong>Social:</strong>
                                <a href="#"><i class="fa fa-facebook-square"></i></a>
                                <a href="#"><i class="fa fa-twitter-square"></i></a>
                                <a href="#"><i class="fa fa-linkedin-square"></i></a>
                                </p>
                            </div>
                        </div>
						
							<div class="flexslider">
								<ul class="slides">
									<?php
									foreach ($banner as $value) { ?>
									
										<li>
										<?php if($value['image']) { ?>
											<img src="<?php echo site_url(); ?>assets/images/seller_banner/<?php echo $value['image']; ?>" style="width:100%; height:400px;">
										<?php } else { ?>
										<img src="<?php echo site_url(); ?>assets/images/no_image.PNG" style="width:100%; height:400px;">
										<?php } ?>
											<p class="flex-caption"><?php echo $value['name'];  ?></p>
										</li>
									<?php } ?>
								</ul>
							</div>
							
				
                    <h3 class="left-title mb25">About Listing</h3>
                    <p>
                         <?php echo character_limiter($about['description'], 485); ?><a href="<?php echo base_url("seller/about"); ?>">Read More</a>
                    </p>
                   
                    <br>
                    
                
            
        
                         
                        <h2 class="left-title">Popular Listing</h2>
                       
                           <div class="row">
						   <?php foreach ($product as $pre) {  ?>
						   <div class="col-sm-4 mb30">
                        <div class="card-overlay">
						<?php if($pre['product_image']) { ?>
                            <img src="<?php echo site_url(); ?>assets/images/products/<?php echo $pre['product_image']; ?>" class="img-responsive" alt="" style="height: 150px; width: 1000px;">
						<?php } else { ?>
						 <img src="<?php echo site_url(); ?>assets/images/no_image.PNG" class="img-responsive" alt="" style="height: 150px; width: 1000px;">
						<?php } ?>
                            <div class="card-hover">
                                <div class="card-content">
								   <!--
                                    <a class="label label-primary" href="#">Drinks</a>-->
                                    <h3><a href="#"><?php echo $pre['product_name']; ?></a></h3>
									<!--
                                    <ul class="list-inline mb0 rating-list">
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star text-warning"></i></li>
                                        <li><i class="fa fa-star-half-empty text-warning"></i></li>
                                    </ul>-->
                                </div><!--/card-content-->
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
                    </div><!--/col-->
                    <div class="col-md-3 mb60">
                        <h4 class="left-title mb20">Search Filter</h4>
                        <div class="mb40">
                            <form>
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
                                    <select class="form-control" title="Category">                                       
                                        <option>Restaurants</option>
                                        <option>Jobs</option>
                                        <option>Property</option>
                                        <option>Automotive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Min Price...">
                                </div>
                                <input type="submit" class="btn btn-dark btn-lg btn-block" value="Search">
                            </form>
                        </div>
                        <h4 class="left-title mb20">Recent Listings</h4>
                        <ul  class="list-unstyled recent-item-card mb40">
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
                            </li><!--/li-->
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
                            </li><!--/li-->
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
                            </li><!--/li-->
                        </ul><!--/ul-->
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
                </div>
            </div>
        </div>
    