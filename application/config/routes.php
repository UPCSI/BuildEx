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
$route['default_controller'] = 'home';
$route['404_override'] = 'errors/errors_404';

$RESTFUL_ROUTES = 'create|update|destroy';

// Externals
$route['signup/(graduate|faculty)'] = 'sign_up/index/$1';
$route['signup/(.+)'] = 'sign_up/$1';
$route['signin'] = 'sign_in/index';
$route['signin/(.+)'] = 'sign_in/$1';

// Internals
$ADMIN_PAGES = 'administrators|laboratories|faculty|graduates|experiments|respondents';
$route['admin'] = 'admins/index';
$route['admin/'.'('.$RESTFUL_ROUTES.')'] = 'admins/$1';
$route['admin/'.'('.$ADMIN_PAGES.')'] = 'admins/$1';
$route['admin/(logout|confirm_faculty)'] = 'admins/$1';
$route['admin/([a-zA-Z0-9]+)'] = 'admins/view/$1';

$route['faculty/([0-9]+)/laboratory'] = 'faculty/laboratory/$1';
$route['faculty/logout'] = 'faculty/logout';
$route['faculty/([a-zA-Z0-9]+)'] = 'faculty/view/$1';
$route['faculty/([a-zA-Z0-9]+)/([a-z]+)'] = 'faculty/$2/$1';

$route['graduate'] = 'graduates/index';
$route['graduate/([0-9]+)/laboratory'] = 'graduates/laboratory/$1';
$route['graduate/logout'] = 'graduates/logout';
$route['graduate/([a-zA-Z0-9]+)'] = 'graduates/view/$1';
$route['graduate/([a-zA-Z0-9]+)/([a-z]+)'] = 'graduates/$2/$1';

// Laboratories
$route['laboratory/([0-9]+)'] = 'laboratories/view/$1';
$route['explore'] = 'laboratories/index';

// Experiments
$route['(graduate|faculty)/([a-zA-Z0-9]+)/experiment/([0-9]+)'] = 'experiments/view/$1/$2/$3';
$route['(graduate|faculty)/([a-zA-Z0-9]+)/experiment/(add|create)'] = 'experiments/$3/$1/$2';
$route['(graduate|faculty)/([a-zA-Z0-9]+)/experiment/([0-9]+)/([a-z]+)'] = 'experiments/$4/$1/$2/$3';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
