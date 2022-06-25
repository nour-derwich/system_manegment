<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['404_override']       = 'Login/_404_page';
$route['translate_uri_dashes'] = FALSE;


//Custom Link Frontend
$route['index.html'] = 'Frontend/index';



//$route['product.html'] = 'Frontend/product';
$route['login.html'] = 'Frontend/login';
$route['register.html'] = 'Frontend/register';
$route['register_submit.html'] = 'Frontend/register_submit';
$route['login_submit.html'] = 'Frontend/login_submit';
$route['forgot_password.html'] = 'Frontend/forgot_password';
$route['forgot_password_submit.html'] = 'Frontend/forgot_password_submit';
$route['reset_password_submit.html'] = 'Frontend/reset_password_submit';
$route['reset_password/(:any).html'] = 'Frontend/reset_password/$1';



$route['seller_login.html'] = 'Frontend/seller_login';
$route['seller_register.html'] = 'Frontend/seller_register';
$route['seller_register_submit.html'] = 'Frontend/seller_register_submit';
$route['seller_login_submit.html'] = 'Frontend/seller_login_submit';
$route['seller_forgot_password.html'] = 'Frontend/seller_forgot_password';
$route['seller_forgot_password_submit.html'] = 'Frontend/seller_forgot_password_submit';
$route['seller_reset_password_submit.html'] = 'Frontend/seller_reset_password_submit';
$route['seller_reset_password/(:any).html'] = 'Frontend/seller_reset_password/$1';





$route['logout.html'] = 'Frontend/logout_user';

$route['_404_page.html'] = 'Frontend/_404_page';
$route['about_us.html'] = 'Frontend/about_us';
$route['ultimate_sign.html'] = 'Frontend/ultimate_sign';
$route['ultimate_solution.html'] = 'Frontend/ultimate_solution';
$route['gallery.html'] = 'Frontend/gallery';
$route['cart.html'] = 'Frontend/cart';
$route['checkout.html'] = 'Frontend/checkout';
$route['checkout_submit.html'] = 'Frontend/checkout_submit';
$route['checkout_login_submit.html'] = 'Frontend/login_submit_checkout';
$route['success.html'] = 'Frontend/success';
$route['account.html'] = 'Frontend/account';
$route['personal_information_submit.html'] = 'Frontend/personal_information_submit';
$route['address_information_submit.html'] = 'Frontend/address_information_submit';


$route['compare.html'] = 'Frontend/compare';
$route['contact_us.html'] = 'Frontend/contact_us';
$route['contactus_submit.html'] = 'Frontend/contactus_submit';
$route['elements.html'] = 'Frontend/elements';
$route['faq.html'] = 'Frontend/faq';
$route['search.html'] = 'Frontend/search';
$route['search.html/(:num)'] = 'Frontend/search/$1';
$route['wishlist.html'] = 'Frontend/wishlist';
$route['sitemap.html'] = 'Frontend/sitemap';
$route['privacy_policy.html'] = 'Frontend/privacy_policy';

/* 
$route['ultimate_sign/(:any).html'] = 'Frontend/ultimate_sign_category/$1';
$route['ultimate_solution/(:any).html'] = 'Frontend/ultimate_solution_category/$1';
$route['product/(:any).html'] = 'Frontend/single_product/$1';
$route['(:any)/(:any).html'] = 'Frontend/all_product/$1/$2';
$route['(:any)/(:any).html/(:num)'] = 'Frontend/all_product/$1/$2/$3'; */

//Admin Builder Management
$route['admin'] = 'Login';
$route['admin/login'] = 'Login';


$route['staff.html'] = 'Staff';


