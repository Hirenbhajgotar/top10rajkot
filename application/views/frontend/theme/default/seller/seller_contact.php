<?php $url = current_url(); ?>
   <div class="page-bread mb70">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Contact</h3>
						
                    </div>
					<div class="col-sm-6">
                        <ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="<?php echo site_url(); ?>seller/<?php echo $seo; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Home</a>

							</li>
							
							<li class="dropdown">
								<a href="<?php echo site_url(); ?>product/<?php echo $seo; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Product</a>

							</li>
							
							<li class="dropdown">
								<a href="<?php echo $url; ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Contact</a>

							</li>
                    </div>
                </div>
            </div>
        </div>
   <div class="container mb40">
            <div class="row">
                <div class="col-sm-4 mb30">
                    <div class="contact-details">
                        <h3 class="font300 mb0">Contact Information</h3>
                        <hr>
                        <?php echo $address['address_1']; ?><br><?php echo $address['postcode']; ?>, <?php echo $country['name']; ?> 
                        <br><br>
                        <?php echo $seller['mobile'];?><br> 
                        <br>
                        <?php echo $seller['email']; ?><br>
                        <br><br>
                        <ul class="list-inline">
                             <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus-official"></i></a></li> 
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-2">
                    <h3 class="font300 mb0">Leave a message</h3><hr>
					<?php if (validation_errors() != null) : ?>
     <?php echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>' . validation_errors() . '</p></div>'; ?>
     <?php endif; ?>
                    <?php echo form_open_multipart(base_url('contact_submit/'.$seo)); ?>
					
                        <div class="row">
                            <div class="col-sm-12"> 
                                <div class="row">
                                    <div class="col-sm-6 mb15" for="name">
                                        <input type="text" name="name" id="name"  value="<?php echo set_value('name'); ?>" class="form-control" placeholder="Full Name...." />
                                    </div>
                                    <div class="col-sm-6 mb15" for="email">
                                        <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"class="form-control" placeholder="Email Address...." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb15" for="message">
                                <textarea name="message" id="message"  class="form-control" rows="5" placeholder="Message...."><?php echo set_value('message'); ?></textarea>                                  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>