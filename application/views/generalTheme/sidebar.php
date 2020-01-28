 <?php
    $currentURL = current_url();
    ?>

 <!-- Page Sidebar -->
 <div class="page-sidebar">
     <a class="logo-box" href="index.html">
         <span>Top10rajkot</span>
         <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
         <i class="icon-close" id="sidebar-toggle-button-close"></i>
     </a>
     <div class="page-sidebar-inner">
         <div class="page-sidebar-menu">
             <ul class="accordion-menu">

                 <!-- deshbord -->
                 <li class="<?php if ($currentURL == base_url() . 'Admin/index') {
                                echo 'active-page';
                            } ?>">
                     <a href="<?php echo base_url(); ?>admin/index" class="
                        <?php if (base_url(uri_string()) == base_url() . 'Admin/index') {
                            echo 'active';
                        } ?> ">
                         <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                     </a>
                 </li>

                 <!-- catalog -->
                 <li class="<?php if (
                                $currentURL ==  base_url() . 'Category/categoryList' or
                                $currentURL ==  base_url() . 'Category/addCategory' or
                                $currentURL ==  base_url() . 'Category/updateCategory/' . $this->uri->segment('3') or
                                $currentURL ==  base_url() . 'Category/updateCategoryData/' . $this->uri->segment('3') or
                                $currentURL ==  base_url() . 'Products/productList' or
                                $currentURL ==  base_url() . 'Products/addProducts' or
                                $currentURL ==  base_url() . 'Products/updateProduct/' . $this->uri->segment('3') or
                                $currentURL ==  base_url() . 'Products/updateProductData/' . $this->uri->segment('3')
                            ) {
                                echo 'active-page ';
                            } ?>">
                     <a href="javascript:void(0);">
                         <i class="menu-icon icon-format_list_bulleted"></i><span>Catalog</span><i
                             class="accordion-icon fa fa-angle-left"></i>
                     </a>
                     <ul class="sub-menu">
                         <!-- Category active -->
                         <li>
                             <a href="<?= base_url("Category/categoryList") ?>" class="<?php if (
                                                                                            base_url(uri_string()) == base_url() . 'Category/categoryList' or
                                                                                            base_url(uri_string()) == base_url() . 'Category/addCategory' or
                                                                                            base_url(uri_string()) == base_url() . "Category/updateCategory/" . $this->uri->segment('3') or
                                                                                            base_url(uri_string()) == base_url() . "Category/updateCategoryData/" . $this->uri->segment('3')
                                                                                        )  echo 'active' ?>">Categories
                             </a>
                         </li>
                         <!-- Product active -->
                         <li>
                             <a href="<?= base_url("Products/productList") ?>" class="<?php if (
                                                                                            base_url(uri_string()) == base_url() . 'Products/productList' or
                                                                                            base_url(uri_string()) == base_url() . 'Products/addProducts' or
                                                                                            base_url(uri_string()) == base_url() . 'Products/updateProduct/' . $this->uri->segment('3') or
                                                                                            base_url(uri_string()) == base_url() . 'Products/updateProductData/' . $this->uri->segment('3')

                                                                                        ) {
                                                                                            echo "active";
                                                                                        } ?>">Products </a>
                         </li>
                         <!-- Membership active -->
                         <li class="<?php if ($currentURL == 'http://[::1]/Top10rajkot/membership/membership') {
                                        echo 'active';
                                    } ?>"><a href="<?php echo base_url(); ?>membership/membership">Membership </a></li>

                     </ul>
                 </li>

                 <!-- seller -->
                 <li class="
                    <?php if (
                        $currentURL == 'http://[::1]/Top10rajkot/seller/seller' or
                        $currentURL == base_url() . 'CmsPage/CmsPageList' or
                        $currentURL == base_url() . 'CmsPage/addCmsPage' or
                        $currentURL == base_url() . 'CmsPage/updateCms/' .  $this->uri->segment('3') or
                        $currentURL == base_url() . 'CmsPage/updateCmsData/' .  $this->uri->segment('3') or
                        $currentURL == base_url() . 'Seller_banner/banner_list' or
                        $currentURL == base_url() . 'Seller_banner/select_seller'
                    ) {
                        echo 'active-page';
                    } ?>">
                     <a href="javascript:void(0);">
                         <i class="menu-icon icon-cart"></i> <span>Sellers</span><i
                             class="accordion-icon fa fa-angle-left"></i>
                     </a>

                     <ul class="sub-menu">
                         <li><a href="<?php echo base_url(); ?>seller/seller">Sellers</a></li>
                         <li><a href="#">Products </a></li>
                         <li class="<?php if ($currentURL == 'http://[::1]/Top10rajkot/membership/membership') {
                                        echo 'active';
                                    } ?>"><a href="<?php echo base_url(); ?>membership/membership">Membership </a></li>
                         <li>
                            <a href="<?= base_url("Seller_banner/select_seller") ?>" class="
                                <?php if (
                                    base_url(uri_string()) == base_url() . 'Seller_banner/banner_list' or
                                    base_url(uri_string()) == base_url() . 'Seller_banner/select_seller'
                                ) {
                                    echo 'active';
                                } ?>">Banner </a>
                            </li>
                         <!-- Cms page active -->
                         <li>
                             <a href="<?= base_url("CmsPage/CmsPageList") ?>" class="
                                <?php if (
                                    base_url(uri_string()) == base_url() . 'CmsPage/CmsPageList' or
                                    base_url(uri_string()) == base_url() . 'CmsPage/addCmsPage' or
                                    base_url(uri_string()) == base_url() . 'CmsPage/updateCms/' .  $this->uri->segment('3') or
                                    base_url(uri_string()) == base_url() . 'CmsPage/updateCmsData/' .  $this->uri->segment('3')
                                ) {
                                    echo 'active';
                                } ?>">Cms Page </a>
                         </li>
                         <li><a href="#">Home Content </a></li>
                         <li><a href="#">Activities </a></li>

                     </ul>

                 </li>

                 <!-- Buyer -->
                 <li class="<?php if (
                                $currentURL ==  base_url() . 'Buyer/buyerList' or
                                $currentURL ==  base_url() . 'Buyer/addBuyer' or
                                $currentURL ==  base_url() . 'Buyer/updateBuyer/' . $this->uri->segment('3') or
                                $currentURL ==  base_url() . 'Buyer/updateBuyerData/' . $this->uri->segment('3')

                            ) {
                                echo 'active-page';
                            } ?>">
                     <a href="javascript:void(0);">
                         <i class="menu-icon icon-users"></i> <span>Buyers</span><i
                             class="accordion-icon fa fa-angle-left"></i>
                     </a>
                     <ul class="sub-menu">
                         <li>
                             <a href="<?= base_url("Buyer/buyerList") ?>" class="<?php if (
                                                                                        base_url(uri_string()) == base_url() . 'Buyer/buyerList' or
                                                                                        base_url(uri_string()) == base_url() . 'Buyer/addBuyer' or
                                                                                        base_url(uri_string()) == base_url() . 'Buyer/updateBuyer/' . $this->uri->segment('3') or
                                                                                        base_url(uri_string()) == base_url() . 'Buyer/updateBuyerData/' . $this->uri->segment('3')
                                                                                    ) {
                                                                                        echo 'active';
                                                                                    } ?>">Buyers</a>
                         </li>
                         <li><a href="#">Buyer  Leads </a></li>
                         <li><a href="#">Activities </a></li>

                     </ul>
                 </li>

                 <!-- Setting -->
                 <li class='
                    <?php if (
                        $currentURL ==  base_url() . 'MailTemplate/listMailTemplate' or
                        $currentURL ==  base_url() . 'Setting'
                    ) {
                        echo 'active-page';
                    } ?>'>
                     <a href="javascript:void(0);">
                         <i class="menu-icon icon-cog"></i><span> Setting</span><i
                             class="accordion-icon fa fa-angle-left"></i>
                     </a>
                     <ul class="sub-menu">
                         <li><a href="<?= base_url("Setting") ?>" class="
                         <?php if (
                                base_url(uri_string()) == base_url() . 'Setting'
                            ) {
                                echo 'active';
                            } ?>">Setting</a></li>
                         <li>

                         <li>
                             <a href="javascript:void(0);">
                                 <i></i><span>Content</span><i class="accordion-icon fa fa-angle-left"></i>
                             </a>
                             <ul class="sub-menu">
                                 <li><a href="<?= base_url("Banner/bannerList") ?>">Banners</a></li>
                                 <li><a href="#">Cms Page </a></li>
                                 <li><a href="<?= base_url("Home_content/homeContentList") ?>">Home content</a></li>
                             </ul>
                         </li>
                         <li>
                             <a href="javascript:void(0);">
                                 <i></i><span>Users</span><i class="accordion-icon fa fa-angle-left"></i>
                             </a>
                             <ul class="sub-menu">
                                 <li><a href="<?php echo base_url(); ?>user/user">User</a></li>
                                 <li><a href="<?php echo base_url(); ?>usersgroup/usersgroup">User Groups</a></li>
                             </ul>
                         </li>
                         <li class="">
                             <a href="javascript:void(0);">
                                 <i></i><span>Other</span><i class="accordion-icon fa fa-angle-left"></i>
                             </a>
                             <ul class="sub-menu">
                                 <li>
                                     <a href="<?= base_url("MailTemplate/listMailTemplate") ?>" class="
                                        <?php if (base_url(uri_string()) == base_url() . 'Buyer/buyerList') {
                                            echo '';
                                        } ?>">Mail Template</a>
                                 </li>
                             </ul>
                         </li>
                 </li>
             </ul>
             </li>
             <li>
                 <a href="javascript:void(0);">
                     <i class="menu-icon icon-report"></i> <span>Reports</span><i
                         class="accordion-icon fa fa-angle-left"></i>
                 </a>

                 <ul class="sub-menu">
                     <li><a href="<?php echo base_url(); ?>users/users"> Buyer</a></li>
                     <li><a href="<?php echo base_url(); ?>usersgroup/usersgroup">Seller</a></li>
                     <li><a href="<?php echo base_url(); ?>users/users"> Lead</a></li>

                 </ul>

             </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- /Page Sidebar -->



 <!-- Page Content -->
 <div class="page-content">
     <!-- Page Header -->
     <div class="page-header">
         <nav class="navbar navbar-default">
             <div class="container-fluid">
                 <!-- Brand and toggle get grouped for better mobile display -->
                 <div class="navbar-header">
                     <div class="logo-sm">
                         <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                         <a class="logo-box" href="index.html"><span>Top10rajkot</span></a>
                     </div>
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                         data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                         <i class="fa fa-angle-down"></i>
                     </button>
                 </div>

                 <!-- Collect the nav links, forms, and other content for toggling -->

                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav">
                         <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i
                                     class="fa fa-bars"></i></a></li>
                         <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                     </ul>
                     <ul class="nav navbar-nav navbar-right">

                         <li class="dropdown">
                             <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                 aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                             <ul class="dropdown-menu dropdown-lg dropdown-content">
                                 <li class="drop-title">Notifications<a href="#" class="drop-title-link"><i
                                             class="fa fa-angle-right"></i></a></li>
                                 <li class="slimscroll dropdown-notifications">
                                     <ul class="list-unstyled dropdown-oc">
                                         <li>
                                             <a href="#"><span class="notification-badge bg-primary"><i
                                                         class="fa fa-photo"></i></span>
                                                 <span class="notification-info">Finished uploading photos to gallery
                                                     <b>"South Africa"</b>.
                                                     <small class="notification-date">20:00</small>
                                                 </span></a>
                                         </li>
                                         <li>
                                             <a href="#"><span class="notification-badge bg-primary"><i
                                                         class="fa fa-at"></i></span>
                                                 <span class="notification-info"><b>John Doe</b> mentioned you in a post
                                                     "Update v1.5".
                                                     <small class="notification-date">06:07</small>
                                                 </span></a>
                                         </li>
                                         <li>
                                             <a href="#"><span class="notification-badge bg-danger"><i
                                                         class="fa fa-bolt"></i></span>
                                                 <span class="notification-info">4 new special offers from the apps you
                                                     follow!
                                                     <small class="notification-date">Yesterday</small>
                                                 </span></a>
                                         </li>
                                         <li>
                                             <a href="#"><span class="notification-badge bg-success"><i
                                                         class="fa fa-bullhorn"></i></span>
                                                 <span class="notification-info">There is a meeting with <b>Ethan</b> in
                                                     15 minutes!
                                                     <small class="notification-date">Yesterday</small>
                                                 </span></a>
                                         </li>
                                     </ul>
                                 </li>
                             </ul>
                         </li>
                         <li class="dropdown user-dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                 aria-haspopup="true" aria-expanded="false"><img src="http://via.placeholder.com/36x36"
                                     alt="" class="img-circle"></a>
                             <ul class="dropdown-menu">
                                 <li>
                                     <a href="<?php echo base_url(); ?>administrator/update-profile">
                                         <i class="ti-user"></i> Profile
                                     </a>
                                 </li>

                                 <li>
                                     <a href="<?php echo base_url(); ?>administrator/change-password">
                                         <i class="ti-lock"></i> Change Password
                                     </a>
                                 </li>

                                 <li>
                                     <a href="<?php echo base_url(); ?>administrator/logout">
                                         <i class="ti-layout-sidebar-left"></i> Logout
                                     </a>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                 </div><!-- /.navbar-collapse -->
             </div><!-- /.container-fluid -->
         </nav>
     </div><!-- /Page Header -->
     <?php if ($this->session->flashdata('success')) : ?>
     <?php echo '<div class="alert alert-success icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Success! &nbsp;&nbsp;</strong>' . $this->session->flashdata('success') . '</p></div>'; ?>
     <?php endif; ?>
     <?php if ($this->session->flashdata('danger')) : ?>
     <?php echo '<div class="alert alert-danger icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Error! &nbsp;&nbsp;</strong>' . $this->session->flashdata('danger') . '</p></div>'; ?>
     <?php endif; ?>

     <?php if (validation_errors() != null) : ?>
     <?php echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>' . validation_errors() . '</p></div>'; ?>
     <?php endif; ?>

     <?php if ($this->session->flashdata('match_old_password')) : ?>
     <?php echo '<p class="alert alert-success">' . $this->session->flashdata('match_old_password') . '</p>'; ?>
     <?php endif; ?>