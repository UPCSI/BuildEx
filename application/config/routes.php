<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'errors/errors_404';

$RESTFUL_ROUTES = 'create|update|destroy';

// Externals
$route['signup/(graduate|faculty)'] = 'sign_up/index/$1';
$route['signup/(.+)'] = 'sign_up/$1';
$route['signin'] = 'sign_in/index';
$route['signin/(.+)'] = 'sign_in/$1';
$route['errors/faculty/waiting'] = 'sign_in/waiting';

// Internals
$ADMIN_PAGES = 'administrators|laboratories|faculty|graduates|experiments|respondents';

$route['admin'] = 'admins/index';
$route['admin/'."({$RESTFUL_ROUTES})"] = 'admins/$1';
$route['admin/'.'('.$ADMIN_PAGES.')'] = 'admins/$1';
$route['admin/(logout|confirm_faculty)'] = 'admins/$1';
$route['admin/([a-zA-Z0-9]+)'] = 'admins/view/$1';

$route['faculty/'."({$RESTFUL_ROUTES})"] = 'faculty/$1';
$route['faculty/([a-zA-Z0-9]+)/laboratory'] = 'faculty/laboratory/$1';
$route['faculty/logout'] = 'faculty/logout';
$route['faculty/([a-zA-Z0-9]+)'] = 'faculty/view/$1';
$route['faculty/([a-zA-Z0-9]+)/([a-z]+)'] = 'faculty/$2/$1';

$route['graduate'] = 'graduates/index';
$route['graduate/([a-zA-Z0-9]+)/laboratory'] = 'graduates/laboratory/$1';
$route['graduate/logout'] = 'graduates/logout';
$route['graduate/([a-zA-Z0-9]+)'] = 'graduates/view/$1';
$route['graduate/([a-zA-Z0-9]+)/([a-z]+)'] = 'graduates/$2/$1';

// Laboratories
$route['laboratory/([0-9]+)'] = 'laboratories/view/$1';
$route['explore'] = 'laboratories/index';

// Experiments
$EXPERIMENT_PATH = '(graduate|faculty)/([a-zA-Z0-9]+)/experiment';

$route["{$EXPERIMENT_PATH}/([0-9]+)"] = 'experiments/view/$1/$2/$3';
$route["{$EXPERIMENT_PATH}/(add|create)"] = 'experiments/$3/$1/$2';
$route["{$EXPERIMENT_PATH}/([0-9]+)/builder"] = 'builder/edit/$1/$2/$3';
$route["{$EXPERIMENT_PATH}/([0-9]+)/([a-z]+)"] = 'experiments/$4/$1/$2/$3';

// Respondents
$RESPOND_PATH = 'respond/([0-9]+)/([a-zA-Z0-9/-]+)';
$RESPOND_PAGES = 'terms|agree|debrief|submit|complete';

$route["{$EXPERIMENT_PATH}/([0-9]+)/respondent/([0-9]+)/"."({$RESTFUL_ROUTES})"] = 'respondents/$5/$1/$2/$3/$4';
$route["{$RESPOND_PATH}/(add|create)"] = 'respondents/$3/$1/$2';
$route["{$RESPOND_PATH}/({$RESPOND_PAGES})"] = 'respondents/$3/$1/$2';
$route['respond/leave'] = 'respondents/leave';

// Builder
$route[$RESPOND_PATH] = 'builder/view/$1/$2';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
