<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//* user routes
$route['signin'] = 'frontend/Auth/register';
$route['login'] = 'frontend/Auth/login';
$route['logout'] = 'frontend/Auth/logout';
$route['My-profile/(:any)'] = 'frontend/Auth/profile/$1';
$route['change-password/(:any)'] = 'frontend/Auth/change_password/$1';
$route['forgot-password'] = 'frontend/Auth/forgot_password';
// $route['verify-otp'] = 'frontend/Auth/verify_otp';
$route['verify-otp'] = 'frontend/Auth/otp_verification';
$route['new-password'] = 'frontend/Auth/new_password';
$route['new-password'] = 'frontend/Auth/new_password';
// $route['signin'] = 'frontend/frontend/Auth/register';

$route['mobileverify'] = 'frontend/Auth/check_mobile_exist';
$route['buyer_info'] = 'frontend/Auth/store_buyer_info';
$route['update-profile/(:any)'] = 'frontend/Auth/update_profile/$1';
$route['category/(:any)'] = 'frontend/Category/index/$1';

// * buyer inquiry
$route['inquiry'] = 'frontend/Auth/buyer_inquiry';
// * resend otp
$route['resend_otp'] = 'frontend/Auth/resend_otp';
// * Search products
$route['search'] = 'frontend/Search/index';



// $route['seller/(:any)'] = 'Seller/seller_list/$1';
$route['products/(:any)'] = 'frontend/Products/product_list/$1';

// $route['seller/(:any)'] = 'Seller/index/$1';
// $route['users/dashboard'] = 'users/dashboard';
// $route['comments/create/(:any)'] = 'comments/create/$1';
// $route['categories'] = 'category/index';

// $route['categories/create'] = 'category/create';
// $route['categories/posts/(:any)'] = 'category/posts/$1';
// $route['categories/delete/(:any)'] = 'category/delete/$1';
// $route['posts/index'] = 'posts/index';
// $route['posts/update'] = 'posts/update';
// $route['posts/delete/(:any)'] = 'posts/delete/$1';
// $route['posts/create'] = 'posts/create';
// $route['posts/(:any)'] = 'posts/view/$1';
// $route['posts'] = 'posts/index';

$route['default_controller'] = "Home";



// $this->set_directory("backend");

//! admin routs

$route['Setting'] = 'Settings/index'; //* genter settings
$route['Admin/index'] = 'Admin/index'; //* genter settings



$route['administrator'] = 'administrator/view';
$route['administrator/home'] = 'administrator/home';
$route['administrator/index'] = 'administrator/view';
$route['administrator/forget-password'] = 'administrator/forget_password';

$route['administrator/dashboard'] = 'administrator/dashboard';

$route['administrator/change-password'] = 'administrator/get_admin_data';
$route['administrator/update-profile'] = 'administrator/update_admin_profile';

$route['users/add-user'] = 'users/add_user';
$route['users/users'] = 'Users/users';
$route['users/update_user_data/(:any)'] = 'users/update_user_data/$1';

$route['usersgroup/usersgroup'] = 'usersgroup/usergroup';
$route['usersgroup/addgroup'] = 'usersgroup/addgroup';
$route['usersgroup/updategroups/(:any)'] = 'usersgroup/update_groups/$1';

$route['administrator/seller'] = 'administrator/seller';
$route['administrator/add_seller/add_seller'] = 'administrator/add_seller';
$route['administrator/seller/updateseller/(:any)'] = 'administrator/updateseller/$1';

$route['administrator/blogs/add-blog'] = 'administrator/add_blog';
$route['administrator/blogs/list-blog'] = 'administrator/list_blog';
$route['administrator/blogs/update-blog'] = 'administrator/update_blog';


//$route['administrator/delete/deletegroups/'] = 'administrator/deletegroups';





$route['administrator/product-categories/create'] = 'administrator/create_product_category';
$route['administrator/product-categories/update/(:any)'] = 'administrator/update_product_category/$1';
$route['administrator/product-categories'] = 'administrator/product_categories';
//$route['administrator/product-categories/(:any)'] = 'administrator/update_product_category/$1';

$route['administrator/products/create'] = 'administrator/create_product';
$route['administrator/products'] = 'administrator/get_products';
$route['administrator/products/update/(:any)'] = 'administrator/update_products/$1';

$route['administrator/faq-categories/create'] = 'administrator/create_faq_category';
$route['administrator/faq-categories/update/(:any)'] = 'administrator/update_faq_category/$1';
$route['administrator/faq-categories'] = 'administrator/faq_categories';

$route['administrator/faq/create'] = 'administrator/create_faq';
$route['administrator/faqs'] = 'administrator/get_faqs';
$route['administrator/faqs/update/(:any)'] = 'administrator/update_faqs/$1';

$route['administrator/scopages'] = 'administrator/get_scopages';
$route['administrator/sco-pages/update/(:any)'] = 'administrator/update_scopages/$1';

$route['administrator/sociallinks'] = 'administrator/get_sociallinks';
$route['administrator/sociallinks/update/(:any)'] = 'administrator/update_sociallinks/$1';

$route['administrator/sliders/create'] = 'administrator/create_slider';
$route['administrator/sliders'] = 'administrator/get_sliders';
$route['administrator/sliders/update/(:any)'] = 'administrator/update_slider/$1';

$route['administrator/site-configuration'] = 'administrator/get_siteconfiguration';
$route['administrator/site-configuration/update/(:any)'] = 'administrator/update_siteconfiguration/$1';

$route['administrator/page-contents'] = 'administrator/get_pagecontents';
$route['administrator/page-contents/update/(:any)'] = 'administrator/update_pagecontents/$1';

$route['administrator/galleries/add'] = 'galleries/galleriesLoad';
$route['administrator/galleries'] = 'galleries/get_gallery_images';

$route['administrator/blogs/blog-comments'] = 'administrator/list_blog_comments';
$route['administrator/blogs/view-comment/(:any)'] = 'administrator/view_blog_comments/$1';

$route['administrator/team/add'] = 'administrator/add_team';
$route['administrator/team/list'] = 'administrator/list_team';
$route['administrator/team/update/(:any)'] = 'administrator/update_team/(:any)';

$route['administrator/testimonials/add'] = 'administrator/add_testimonial';
$route['administrator/testimonials/list'] = 'administrator/list_testimonial';
$route['administrator/testimonials/update/(:any)'] = 'administrator/update_testimonial/(:any)';

$route['(:any)'] = 'pages/view/$1';
$route['admin/(:any)'] = 'admin/(:any)/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;










