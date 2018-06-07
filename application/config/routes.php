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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['blog/(:any)'] = 'blog';
$route['blog_post/(:any)'] = 'blog_post';
$route['panel'] = 'panel/home';
$route['panel/page-(:num)'] = 'panel/home';
$route['panel/administrator/(:any)'] = 'panel/administrator';
$route['panel/administrator_entry/(:any)'] = 'panel/administrator_entry';
$route['panel/administrator_role/(:any)'] = 'panel/administrator_role';
$route['panel/administrator_role_entry/(:any)'] = 'panel/administrator_role_entry';
$route['panel/bank/(:any)'] = 'panel/bank';
$route['panel/bank_entry/(:any)'] = 'panel/bank_entry';
$route['panel/bank_account/(:any)'] = 'panel/bank_account';
$route['panel/bank_account_entry/(:any)'] = 'panel/bank_account_entry';
$route['panel/bank_account_transaction/(:any)'] = 'panel/bank_account_transaction';
$route['panel/bank_account_transaction/(:any)/(:any)'] = 'panel/bank_account_transaction';
$route['panel/blog/(:any)'] = 'panel/blog';
$route['panel/blog_entry/(:any)'] = 'panel/blog_entry';
$route['panel/blog_category/(:any)'] = 'panel/blog_category';
$route['panel/blog_category_entry/(:any)'] = 'panel/blog_category_entry';
$route['panel/gallery/(:any)'] = 'panel/gallery';
$route['panel/gallery_entry/(:any)'] = 'panel/gallery_entry';
$route['panel/game/(:any)'] = 'panel/game';
$route['panel/game_entry/(:any)'] = 'panel/game_entry';
$route['panel/player/(:any)'] = 'panel/player';
$route['panel/player_entry/(:any)'] = 'panel/player_entry';
$route['panel/player_transaction/(:any)'] = 'panel/player_transaction';
$route['panel/player_transaction_entry/(:any)'] = 'panel/player_transaction_entry';
$route['panel/promotion/(:any)'] = 'panel/promotion';
$route['panel/promotion_entry/(:any)'] = 'panel/promotion_entry';
$route['panel/setting_slider/(:any)'] = 'panel/setting_slider';
$route['panel/setting_slider_entry/(:any)'] = 'panel/setting_slider_entry';
$route['panel/setting_url/(:any)'] = 'panel/setting_url';
$route['panel/setting_url_entry/(:any)'] = 'panel/setting_url_entry';
$route['panel/transaction/(:any)'] = 'panel/transaction';
$route['panel/transaction_entry/(:any)'] = 'panel/transaction_entry';
$route['panel/transaction_entry/(:any)/(:any)'] = 'panel/transaction_entry';