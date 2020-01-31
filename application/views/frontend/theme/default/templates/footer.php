<!--footer-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb30">
                <h3>About Us</h3>
                <p>
                    Doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                </p>
                <ul class="list-inline f-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>

            </div>
            <div class="col-md-4 mb30">
                <h3>Support Information</h3>
                <p>
                    <small>Address:</small><br>
                    124, Lorem Street, New York, USA
                </p>
                <p>
                    <small>Call Us:</small><br>
                    <a href="#">+01 1800-234-45678</a>
                </p>
                <p>
                    <small>Mail Us:</small><br>
                    <a href="#">support@finder.com</a>
                </p>
            </div>
            <div class="col-md-4 mb30">
                <h3>useful links</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="f-links list-unstyled">
                            <li><a href="#">Restaurants</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Deal & Coupons</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Restaurants</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="f-links list-unstyled">
                            <li><a href="#">Shop</a></li>
                            <li><a href="#">Cinemas</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy & policy</a></li>
                            <li><a href="#">T & C</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            &copy; Copyright <?php echo date('Y'); ?>. All Right Reserved.
        </div>
    </div>
</footer>
<!-- jQuery-->
<!-- <script src="js/plugins/all.js"></script> -->
<script src="<?= base_url("application/views/frontend/theme/default/assets/js/plugins/all.js") ?>"></script>
<script src="<?= base_url("application/views/frontend/theme/default/assets/js/finder.custom.js") ?>"></script>
<?php /*<script src="js/finder.custom.js"></script>

*/ ?>


<script src="<?= base_url("application/views/frontend/theme/default/assets/js/jquery.flexslider.js") ?>"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>

<script>
    // !check mobile number is verify
    $(function() {
        $('form#check_mobile_verify').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url("mobileverify") ?>',
                data: $('form').serialize(),
                success: function(data) {
                    if (data == 0) {
                        document.getElementById("check_mobile_verify").style.display = "none";
                        document.getElementById("buyer_info_form").style.display = "block";
                        // console.log("mobile not exist");
                    } else if (data) {
                        document.getElementById("check_mobile_verify").style.display = "none";
                        document.getElementById("buyer_otp_form").style.display = "block";
                        // console.log("mobile exist");
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        });
    });


    // !buyer info
    /**
     * store buyers's information
     */
    $(function() {
        $('form#buyer_info_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url("buyer_info") ?>',
                data: $('form').serialize(),
                success: function(data) {
                    // alert('form was submitted');
                    console.log("success");
                    console.log(data);
                    if (data == 1) {
                        document.getElementById("buyer_info_form").style.display = "none";
                        document.getElementById("buyer_otp_form").style.display = "block";
                        console.log("mobile not exist");
                    } else {
                        document.getElementById("buyer_info_form").style.display = "none";
                        document.getElementById("buyer_otp_form").style.display = "block";
                        console.log("mobile not exist --- else ---");
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        });
    });

    // !otp verification
    /**
     * check otp is verify or not
     */
    $(function() {
        $('form#buyer_otp_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url("verify-otp") ?>',
                data: $('form').serialize(),
                success: function(data) {

                    let verify_res = JSON.parse(data);
                    if (verify_res.verify == 'data_verify') {
                        document.getElementById("buyer_otp_form").style.display = "none";
                        // let unset_session = '<?php $this->session->unset_userdata('req_to_inq') ?>';

                        if ('<?php echo $this->session->userdata('req_to_inq') ?>') {
                            $('#auth_buyer_mobile_model').modal('hide');
                            $('#buyer_inquiry_model').modal('show');

                            let buyer_id_input = document.getElementById('buyer_id_input_create');
                            let buyer_id_value = buyer_id_input.value = oo.buyer_id;

                            let unset_session = '<?php $this->session->unset_userdata('req_to_inq') ?>';
                        } else {
                            // console.log("sess not create");
                            document.getElementById("buyer_thanks_popup").style.display = "block";
                        }

                    } else if (data == 'not_verify') {
                        let otp_error = document.getElementById('otp_error').innerHTML = "Otp does not match";
                    }
                },
                error: function(data) {
                    console.log("error");
                }
            });
        });
    });
</script>


<script>
    // !inquiry popup
    /**
     * when buyer click on inquiry button
     */
    function call_inquiry(seller_id, category_id) {
        console.log(seller_id);
        console.log(category_id);
        let category_id_input = document.getElementById('category_id_input_create');
        let seller_id_input = document.getElementById('seller_id_input_create');
        let buyer_id_input = document.getElementById('buyer_id_input_create');

        category_id_input.value = category_id;
        seller_id_input.value = seller_id;
        buyer_id_input.value = '<?php echo $this->session->userdata('authenticated_buyer_id') ?>';

        console.log(category_id_input.value = category_id);
        console.log(seller_id_input.value = seller_id);
        // console.log(buyer_id_value);

        let authenticated_buyer_mobile = "<?php echo $this->session->userdata('authenticated_buyer_mobile') ?>";
        if (authenticated_buyer_mobile) {
            $('#buyer_inquiry_model').modal('show');
        } else {
            console.log("not logedin");
            let unset_session = "<?php echo $this->session->unset_userdata('req_to_inq') ?>"
            let create_session = "<?php echo $this->session->set_userdata('req_to_inq', true) ?>"
            $('#auth_buyer_mobile_model').modal('show');
        }
    }


    // ! resend otp
    function resend_otp() {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url("resend_otp") ?>',
            data: $('form').serialize(),
            success: function(data) {
                console.log('success data');
            },
            error: function(data) {
                console.log("error");
            }
        });
    }


    // !buyer inquiry
    $(function() {
        $('form#buyer_inquiry_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url("inquiry") ?>',
                data: $('form').serialize(),
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        console.log("success");
                        document.getElementById("buyer_inquiry_form").style.display = "none";
                        document.getElementById("inquiry_thankyou_popup").style.display = "block";
                    } else {
                        console.log("something wrong");
                    }
                },
                error: function(data) {
                    console.log("error");
                }
            });
        });
    });
</script>

</body>

</html>