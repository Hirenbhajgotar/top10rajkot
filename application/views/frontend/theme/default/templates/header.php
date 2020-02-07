<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Top10Rajkot">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="<?= $metaData['description'] ?>">
    <meta name="keywords" content="<?= $metaData['keyword'] ?>">
    <title><?= $metaData['title'] ?></title>
    <link rel="icon" href="<?php echo base_url("assets/images/fevicon_icon/{$metaData['icon']}"); ?>" type="image/x-icon">


    <!-- plugins -->
    <link href="<?= base_url("application/views/frontend/theme/default/assets/css/bundle.css") ?>" rel="stylesheet">
    <link href="<?= base_url("application/views/frontend/theme/default/assets/css/style.css") ?>" rel="stylesheet">
    <link href="<?= base_url("application/views/frontend/theme/default/assets/css/flexslider.css") ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>

    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url("/") ?>"><img class="siteLogo" src="<?= base_url("assets/images/site_logo/{$metaData['logo']}") ?>" alt=""></a>
                <!-- <a class="navbar-brand" href="<?= base_url("/") ?>"><img src="<?= base_url("application/views/frontend/theme/default/assets/images/logo.png") ?>" alt=""></a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo base_url("/") ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                            Help <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-phone-square" aria-hidden="true"></i>
                                    Call Us on 098 xx xxxx
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    Helpdesk & Information
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    Complaints/Feedback
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php if ($this->session->userdata('authenticated_buyer_mobile')) { ?>
                        <li>
                            <a href="<?php echo base_url("message") ?>" class="dropdown-toggle">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Messages</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="modal" data-target="#auth_buyer_mobile_model">
                                <i class="fa fa-envelope" aria-hidden="true"></i>Messages
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($this->session->userdata('authenticated_buyer_mobile')) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>

                            <ul class="dropdown-menu" style="width:250px;">
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>My Profile</a></li>
                                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Messages</a></li>
                                <li><a href="#"><i class="fa fa-tasks" aria-hidden="true"></i>Recent Activity</a></li>
                                <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
                                <li><a href="<?php echo site_url(); ?>edit_buyer/<?php echo $this->session->userdata('authenticated_buyer_id'); ?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit Account</a></li>
                                <li><a href="<?php echo site_url(); ?>change_password/<?php echo $this->session->userdata('authenticated_buyer_id'); ?>"><i class="fa fa-cog" aria-hidden="true"></i>Change Password</a></li>
                                <li><a href="<?= base_url("logout") ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign In <span class="caret"></span></a>

                            <ul class="dropdown-menu" style="width:250px;">
                                <li>
                                    <!-- <input href="hiren" type="submit" value="Sign In" class="btn btn-primary btn-lg btn-block btnSignin"> -->
                                    <a href="#" type="button" data-toggle="modal" data-target="#auth_buyer_mobile_model" class="btn btn-primary btn-lg btn-block btnSignin">Sign In</a>
                                    <span>New to Top10Rajkot ? <a href="#" data-toggle="modal" data-target="#auth_buyer_mobile_model">Register Now</a></span>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                                <li>
                                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Messages</a>
                                </li>
                                <li><a href="#"><i class="fa fa-tasks" aria-hidden="true"></i>Recent Activity</a></li>
                                <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
                                <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>

                            </ul>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>

    <div class="modal fade auth_buyer_mobile_model" id="auth_buyer_mobile_model" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="return  window.location.reload();" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Join Top10Rajkot</h4>
                </div>
                <div class="modal-body">
                    <!-- mobile verify -->
                    <form id="check_mobile_verify">
                        <div class="form-group" id="check_mobile">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_no" id="mobile_no" maxlength="10" minlength="10" value="<?= set_value("mobile_no") ?>" class="form-control" placeholder="01-394-4932">
                        </div>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </form>
                    <!-- buyer info -->
                    <form id="buyer_info_form" style="display: none">
                        <div class="form-group" id="check_mobile">
                            <label>Name</label>
                            <input type="text" name="name" id="name" value="<?= set_value("name") ?>" class="form-control" placeholder="jon doe">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" id="email" value="<?= set_value("email") ?>" class="form-control" placeholder="jondoe@email.com">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" id="city" value="<?= set_value("city") ?>" class="form-control" placeholder="jondoe@email.com">
                        </div>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </form>
                    <!-- otp -->
                    <form id="buyer_otp_form" style="display: none">
                        <div class="form-group" id="check_mobile">
                            <label>Otp</label>
                            <input type="text" name="otp" id="otp" value="<?= set_value("otp") ?>" class="form-control" placeholder="1-2-3-5-4">
                            <span><small id="otp_error" style="color: #c64c40"></small></span>
                        </div>
                        <a style="cursor: pointer" onclick="resend_otp()">Resend otp</a><br>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </form>
                    <!-- thsnks msg -->
                    <div id="buyer_thanks_popup" class='' style="display: none">
                        <h4>Thank You for Registration</h4>
                        <br>
                        <button type="button" class="btn btn-default" onclick="return  window.location.reload();" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- buyer_inquiry_model -->
    <div class="modal fade" id="buyer_inquiry_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Join Top10Rajkot</h4>
                </div>
                <form id="buyer_inquiry_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea name="buyer_inquiry" class="form-control" rows="4" id="message-text"></textarea>
                        </div>
                        <input type="hidden" id="seller_id_input_create" name="seller_id_input">
                        <input type="hidden" id="category_id_input_create" name="category_id_input">
                        <input type="hidden" id="product_id_input_create" name="product_id_input">
                        <input type="hidden" id="buyer_id_input_create" name="buyer_id_input">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </form>

                <div id="inquiry_thankyou_popup" style="display: none">
                    <div class="modal-body">
                        <h4>Thank You for Inquiry</h4>
                        <br>
                        <button type="button" class="btn btn-default" onclick="return  window.location.reload();" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
