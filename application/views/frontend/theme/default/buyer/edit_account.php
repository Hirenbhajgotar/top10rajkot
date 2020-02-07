

        <div class="page-bread mb70">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Account</h3>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb70">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="border-card">
                        <h3 class="font300 mb0 text-center">Edit an account.</h3> <hr>
						<?php if (validation_errors() != null) : ?>
     <?php echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>' . validation_errors() . '</p></div>'; ?>
     <?php endif; ?>
                 <?php echo form_open_multipart(base_url('edit_buyer/'.$buyer['id'])); ?>
                            <div class="form-group mb15" for="firstname">
                               <label>Firstname</label>
                                <input type="text" name="firstname" value="<?php echo set_value('firstname',$buyer['first_name']);?>" id="firstname" class="form-control" placeholder="Firstname">
                            </div>
							<div class="form-group mb15" for="lastname">
                                 <label>Lastname</label>
                                <input type="text" name="lastname" value="<?php echo set_value('lastname',$buyer['last_name']);?>" id="lastname" class='form-control' placeholder="Lastname">
                            </div>
                            <div class="form-group mb15" for="a_1">
                                 <label>Address 1</label>
                                <input type="text" name="a_1" id="a_1" value="<?php echo set_value('a_1',$address_buyer['address_1']);?>"class='form-control' placeholder="Address 1">
                            </div>
							<div class="form-group mb15" for="a_2">
                                 <label>Address 2</label>
                                <input type="text" name="a_2" id="a_2" value="<?php echo set_value('a_2',$address_buyer['address_2']);?>" class='form-control' placeholder="Address 2">
                            </div>
							
							<div class="form-group mb15" for="city">
                                 <label>City</label>
                                <input type="text" name="city" id="city" value="<?php echo set_value('city',$address_buyer['city']);?>" class='form-control' placeholder="City">
                            </div>
							
							<div class="form-group mb15" for="postcode">
                                 <label>Pincode</label>
                                <input type="text" name="postcode" id="postcode" value="<?php echo set_value('postcode',$address_buyer['postcode']);?>"  class='form-control' placeholder="Postcode">
                            </div>
							
				  
									  <div class="form-group mb15">
									       <label>Select Country</label>
										   <?php if($country_id){ ?> 
											   <select name="country_id" id="country" class="form-control" onchange="get_state()">
												   <option selected disabled>Select country</option>
												   <?php foreach ($country as $countrys) { ?>
														   <option value="<?php echo $countrys['country_id']; ?>" <?php if($country_id == $countrys['country_id']
													  ){ echo ' selected="selected"'; }?>><?php echo $countrys['name']; ?></option>
												   <?php } ?>
											   </select>
                                               <?php } else { ?>
											   <select name="country_id" id="country" class="form-control" onchange="get_state()">
												   <?php foreach ($country as $countrys) { ?>
														   <option value="<?php echo  $countrys['country_id'] ?>"><?php echo $countrys['name']; ?></option>
													   <?php } ?>
												   
											   </select>
										    <?php } ?>
									   </div>
									   
									   <div class="form-group mb15">
									       <label>Select State</label>
										       
											   <?php
                                                 if ($state_id){?>
                                                    <select name="state_id" id="state" class="form-control">
                                                       <?php foreach ($state1 as $state) { ?>
                                        
                                                          <option  value="<?php echo $state['state_id'] ?>" <?php if($state_id == $state['state_id']
											              ){ echo ' selected="selected"'; }?>><?php echo $state['name']; ?></option>
                                               
                                                      <?php } ?>
                                           
                                                    </select>
                                                         <?php } else { ?>
                                                             <select name="state_id" id="state" class="form-control">
                                                             <?php foreach ($state as $states) {
                                                             if ($states['state_id']) { ?>
                                                             <option  value="<?php echo $states['state_id']; ?>"><?php echo $states['name']; ?></option>
                                                           <?php } ?>
                                                       <?php } ?>
                                                  </select>
                                              <?php } ?>
									  </div>
							
                           
                            
                            <input type="submit" value="Update" class='btn btn-primary btn-lg btn-block'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.1.0.min.js"></script>
<script>
   function get_state() {
	 
	   let country_id = document.getElementById('country').value;
	   $.ajax({
		   url: "<?php echo site_url('getstate') ?>",
		   method: "post",
		   data: {
			   'country_id': country_id
		   },
	   }).done(function(states) {
		   // console.log(states);
		   states = JSON.parse(states);
		   $('#state').empty();
		   states.forEach(function(state) {
			   $('#state').append('<option value="' + state.state_id + '">' + state.name + '</option>')
		   });
	   });
   }
    
 </script>
 
       
        
		