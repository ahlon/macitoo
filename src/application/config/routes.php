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

$route['default_controller'] = 'home/index';
$route['404_override'] = '';

$route['feedback'] = 'home/feedback';
$route['login'] = 'home/login';
$route['login_auth'] = 'home/login_auth';
$route['login/(:any)'] = 'home/login/$1';
$route['logout'] = 'home/logout';
$route['signup'] = 'home/register';

$route['admin'] = 'admin/index';
$route['admin/categories'] = 'admin/category/index';
$route['admin/category/new'] = 'admin/category/add';
$route['admin/category/(:num)'] = 'admin/category/view/$1';

$route['admin/menus'] = 'admin/menu/index';
$route['admin/menu/(:num)'] = 'admin/menu/view/$1';
$route['admin/menu/(:num)'] = 'admin/menu/view/$1';

$route['admin/mottos'] = 'admin/motto/index';
$route['admin/groups'] = 'admin/group/index';
$route['admin/permissions'] = 'admin/permission/index';
$route['admin/resources'] = 'admin/resource/index';
$route['admin/users'] = 'admin/user/index';

$route['books(\\.data|\\.widgets|\\.layout)?'] = 'book/index';
$route['book/start_reading/(:any)'] = 'book/start_reading/$1';
$route['book/(:any)'] = 'book/view/$1';

$route['calendar'] = 'calendar/index';

$route['comment/save'] = 'comment/save';

$route['goals'] = 'goals/index';
$route['goal/(:any)'] = 'goals/view/$1';

$route['image/(:num)'] = 'image/view/$1';

$route['pages'] = 'webpage/index';
$route['page/(:num)'] = 'webpage/view/$1';
$route['page/save'] = 'webpage/save';

$route['plan/make/(:any)/(:num)'] = 'reading/plan/make/$1/$2';
$route['plan/save'] = 'reading/plan/save';

$route['reading'] = 'reading/index';
$route['reading/status/update'] = 'reading/status/update';
$route['reading/status/in-progress'] = 'reading/status/in_progress';
$route['reading/status/collect'] = 'reading/status/collect';
$route['reading/status/wish'] = 'reading/status/wish';

$route['reading/plans'] = 'reading/plan/index';
$route['reading/plans/in-progress'] = 'reading/plan/in_progress';
$route['reading/plans/not-started'] = 'reading/plan/not_started';
$route['reading/plans/finished'] = 'reading/plan/finished';
$route['reading/tasks'] = 'reading/task/index';
$route['reading/task/new'] = 'reading/task/save';
//$route['reading/task/(:any)'] = 'reading/task/break_down/$1';

$route['writing'] = 'writing/index';

$route['segments'] = 'segments/index';
$route['segments/save'] = 'segments/save';
$route['segments/(:any).json'] = 'segments/view_json/$1';

$route['settings'] = 'settings/index/basic';
$route['settings/basic'] = 'settings/index/basic';
$route['settings/password'] = 'settings/index/password';
$route['settings/third-parties'] = 'settings/index/third_parties';
$route['settings/avatar'] = 'settings/index/avatar';

$route['snippet/(.*)'] = 'snippet/show/$1';

$route['user/(:num)(\\.json|\\.widgets|\\.layout)?'] = 'user/view/$1';

$route['timers'] = 'timer/index';
$route['timer/(:num)(\\.data|\\.widgets|\\.layout)?'] = 'timer/view/$1';

$route['widgets'] = 'widget/index';
$route['widget/(:any)'] = 'widget/view/$1';

// $route['(:any)/index'] = 'common/index';
// $route['(:any)/list'] = 'common/index';
// $route['(:any)/new'] = 'common/add';
// $route['(:any)/save'] = 'common/save';
// $route['(:any)/(:num)'] = 'common/view/$2';
// $route['(:any)/(:num)/edit'] = 'common/edit/$2';
// $route['(:any)/(:num)/update'] = 'common/update/$2';
// $route['(:any)/(:num)/delete'] = 'common/delete/$2';
// $route['(:any)'] = 'common/index/$1';

// $route['(:any)/(:num)'] = 'general/view/$1/$2';
// $route['(:any)/(:num)/edit'] = 'general/edit/$1/$2';
// $route['(:any)/(:num)/update'] = 'general/update/$1/$2';
// $route['(:any)/(:num)/delete'] = 'general/delete/$1/$2';
// $route['(:any)/add'] = 'general/add/$1';
// $route['(:any)/save'] = 'general/save/$1';
// $route['(:any)/list'] = 'general/index/$1';
// $route['(:any)/index'] = 'general/index/$1';
// $route['(:any)'] = 'general/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */