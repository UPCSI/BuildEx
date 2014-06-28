<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

$route['faculty'] = 'faculty/index';
$route['faculty/'.'('.$RESTFUL_ROUTES.')'] = 'faculty/$1';
$route['faculty/([0-9]+)/laboratory'] = 'faculty/laboratory/$1';
$route['faculty/logout'] = 'faculty/logout';
$route['faculty/([a-zA-Z0-9]+)'] = 'faculty/view/$1';
$route['faculty/([a-zA-Z0-9]+)/([a-z]+)'] = 'faculty/$2/$1';

$route['graduate'] = 'graduates/index';
$route['graduate/'.'('.$RESTFUL_ROUTES.')'] = 'graduates/$1';
$route['graduate/([0-9]+)/laboratory'] = 'graduates/laboratory/$1';
$route['graduate/logout'] = 'graduates/logout';
$route['graduate/([a-zA-Z0-9]+)'] = 'graduates/view/$1';
$route['graduate/([a-zA-Z0-9]+)/([a-z]+)'] = 'graduates/$2/$1';

// Laboratories
$route['laboratory/([0-9]+)'] = 'laboratories/view/$1';
$route['laboratory/([0-9]+)/([a-z]+)'] = 'laboratories/$2/$1';
$route['explore'] = 'laboratories/index';

// Experiments
$route['(graduate|faculty)/([0-9]+)/experiment/([0-9]+)'] = 'experiments/view/$1/$2/$3';
$route['(graduate|faculty)/([0-9]+)/experiment/(add|create)'] = 'experiments/$3/$1/$2';
$route['(graduate|faculty)/([0-9]+)/experiment/([0-9]+)/([a-z]+)'] = 'experiments/$4/$1/$2/$3';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
