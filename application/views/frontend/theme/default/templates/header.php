<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php
    $currentURL = current_url();
    if ($currentURL === base_url("/")) { ?>
        <meta name="description" content="<?= $metaData[11]->value ?>">
        <meta name="keywords" content="<?= $metaData[6]->value ?>">
        <meta name="author" content="<?= $metaData[0]->value ?>">
        <title><?= $metaData[7]->value ?></title>
    <?php } else { ?>
        <meta name="description" content="<?php echo $sec_meta_data->meta_description ?>">
        <meta name="keywords" content="<?php echo $sec_meta_data->meta_keyword ?>">
        <meta name="author" content="<?= $metaData[0]->value ?>">
        <title><?php echo $sec_meta_data->meta_title ?> | <?= $metaData[7]->value ?></title>
    <?php } ?>
    <link rel="icon" href="<?php echo base_url("assets/images/fevicon_icon/{$metaData[5]->value}"); ?>" type="image/x-icon">


    <!-- plugins -->
    <link href="<?= base_url("application/views/frontend/theme/default/assets/css/bundle.css") ?>" rel="stylesheet">
    <link href="<?= base_url("application/views/frontend/theme/default/assets/css/style.css") ?>" rel="stylesheet">

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
                <a class="navbar-brand" href="<?= base_url("/") ?>"><img class="siteLogo" src="<?= base_url("assets/images/{$metaData[4]->value}") ?>" alt=""></a>
                <!-- <a class="navbar-brand" href="<?= base_url("/") ?>"><img src="<?= base_url("application/views/frontend/theme/default/assets/images/logo.png") ?>" alt=""></a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="/" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>

                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                            Help <span class="caret"></span></a>
                        <ul class="dropdown-menu"><a href="#">
                                <li><i class="fa fa-phone-square" aria-hidden="true"></i>
                                    Call Us on 098 xx xxxx
                            </a>
                    </li>
                    <li><a href="#"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            Helpdesk & Information</a></li>
                    <li><a href="#">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Complaints/Feedback</a></li>

                </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        Messages</a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign In <span class="caret"></span></a>

                    <ul class="dropdown-menu" style="width:250px;">
                        <li>
                            <input type="submit" value="Sign In" class="btn btn-primary btn-lg btn-block btnSignin">
                            <span>New to Top10Rajkot ? <a href="#">Register Now</a></span>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Messages</a></li>
                        <li><a href="#"><i class="fa fa-tasks" aria-hidden="true"></i>Recent Activity</a></li>
                        <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
                        <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>

                    </ul>
                </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>