<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'welcome/home';
$route['home/(:any)'] = 'welcome/home';
$route['images/(:any)'] = 'welcome/image_public';

// authentication
$route['login']['get'] = 'welcome/index';
$route['login']['post'] = 'welcome/login_action';
$route['logout'] = 'welcome/logout_action';

$route['upload']['post'] = 'image/image_store';
$route['upload/(:any)']['get'] = 'image/image_edit';
$route['upload_update']['post'] = 'image/image_update';
$route['upload_remove/(:any)'] = 'image/image_delete';
$route['image_detail/(:any)'] = 'image/image_show';
