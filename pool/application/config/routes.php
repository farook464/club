<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';


$route['home'] = 'home/index';
$route['login'] = 'login/show_login';
$route['royal/login'] = 'royal_phones/check_login/show_login';
$route['royal/logout'] = 'royal_phones/admin_panel/logout';

$route['royal/panel'] = 'royal_phones/admin_panel/index';
//$route['admin_jsessID/panel'] = 'supplier/my_products/index';

//$route['royal_mobiles/home'] = 'supplier/admin_panel/index';
$route['royal/panel/my_products'] = 'royal_phones/my_products/index';
  
$route['royal/panel/add-product'] = 'royal_phones/add_product/product_add';

/* End of file routes.php */
/* Location: ./application/config/routes.php */