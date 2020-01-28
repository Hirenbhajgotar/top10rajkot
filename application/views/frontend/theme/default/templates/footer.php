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
   $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });


</script>




</body>

</html>