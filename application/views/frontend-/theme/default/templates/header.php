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
        <link rel="icon" href="<?php echo base_url("assets/images/fevicon_icon/{$metaData[5]->value}"); ?>" type="image/x-icon">

        <title><?= $metaData[7]->value ?></title>
    <?php } else { ?>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <title>Top10Rajkotsss</title>
    <?php } ?>


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
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url("/") ?>"><img src="<?= base_url("assets/images/site_logo/{$metaData[4]->value}") ?>" alt=""></a>
                <!-- <a class="navbar-brand" href="<?= base_url("/") ?>"><img src="<?= base_url("application/views/frontend/theme/default/assets/images/logo.png") ?>" alt=""></a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.html">Home 1</a></li>
                            <li><a href="index-2.html">Home 2</a></li>
                            <li><a href="index-3.html">Home 3</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listing <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="add-listing.html">Add Listing</a></li>
                            <li><a href="listing-grid.html">Listing Grid fullwidth</a></li>
                            <li><a href="listing-grid-sidebar.html">Listing Grid + Sidebar</a></li>
                            <li><a href="listing-map.html">With Map</a></li>
                            <li><a href="listing-row.html">Row full width</a></li>
                            <li><a href="listing-row-sidebar.html">Row + Sidebar</a></li>
                            <li><a href="single-listing.html">Listing Detail</a></li>
                            <li><a href="agents.html">Agent Listing</a></li>
                            <li><a href="single-agent.html">Agent Detail</a></li>
                            <li><a href="profile.html">My Profile</a></li>
                        </ul>
                    </li>
                    <li class="dropdown mega-li">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Locations <span class="caret"></span></a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3">
                                            <h5>New York</h5>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Brooklyn</a></li>
                                                <li><a href="#">Manhattan</a></li>
                                                <li><a href="#">Queens</a></li>
                                                <li><a href="#">Bronx</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <h5>London</h5>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Croydon</a></li>
                                                <li><a href="#">Epsom</a></li>
                                                <li><a href="#">Camberley</a></li>
                                                <li><a href="#">Bracknell</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <h5>Paris</h5>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Grenelle</a></li>
                                                <li><a href="#">Luxembourg</a></li>
                                                <li><a href="#">Place De La Bastille</a></li>
                                                <li><a href="#">Grand Palais</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <h5>Madrid</h5>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Centro</a></li>
                                                <li><a href="#">Retiro</a></li>
                                                <li><a href="#">Chamberi</a></li>
                                                <li><a href="#">Dos De Mayo Plaza</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="about.html">About us</a></li>
                            <li><a href="how-work.html">How it work</a></li>
                            <li><a href="pricing.html">Pricing</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="error.html">Error 404</a></li>
                            <li class="divider"></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="grid-system.html">Grid system</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li class="button-navbar"><a href="add-listing.html"><i class="fa fa-plus"></i> Add Listing</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>