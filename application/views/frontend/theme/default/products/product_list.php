<?php $url = current_url(); ?>
   <div class="page-bread mb70">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Products</h3>
						
                    </div>
					<div class="col-sm-6">
                        <ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="<?php echo site_url(); ?>seller/<?php echo $seo; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Home</a>

							</li>
							
							<li class="dropdown">
								<a href="<?php echo $url; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Product</a>

							</li>
							
							<li class="dropdown">
								<a href="<?php echo site_url(); ?>contact/<?php echo $seo; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Contact</a>

							</li>
                    </div>
                </div>
            </div>
        </div>
   <div class="container">
               <div class="row">  
				  <?php foreach ($products as $pre) {  ?>
				     <div class="col-sm-4 mb30">
                        <div class="card-overlay">
							<?php if($pre->product_image) { ?>
								<img src="<?php echo site_url(); ?>assets/images/products/<?php echo $pre->product_image; ?>" class="img-responsive" alt="" style="height: 150px; width: 1000px;">
							<?php } else { ?>
							    <img src="<?php echo site_url(); ?>assets/images/no_image.PNG" class="img-responsive" alt="" style="height: 150px; width: 1000px;">
							<?php } ?>
                            <div class="card-hover">
                                <div class="card-content">
								  
                                    <h3><a href="#"><?php echo $pre->product_name; ?></a></h3>
									
                                </div><!--/card-content-->
								
                            </div>
                        </div>
                    </div>
				<?php } ?>
            </div>
	   </div>