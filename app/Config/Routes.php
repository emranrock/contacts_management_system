<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');

$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');

$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'admin\Login::Index');

$routes->get('admin/login', "admin\Login::Index");
$routes->post('admin/loginMe', "admin\Login::loginMe");
$routes->get('admin', "admin\Users::Index");

/** Groups Routes */
$routes->get('admin/groups/manage','admin\Group::Index');
$routes->match(['get','post'],'admin/groups/add','admin\Group::add');
$routes->match(['get','put'],'admin/groups/edit/(:num)','admin\Group::edit/$1');
$routes->get('admin/groups/show/(:num)','admin\Group::show/$1');
$routes->delete('admin/groups/delete/(:num)','admin\Group::delete/$1');

/** Contacts Routes */
$routes->get('admin/contacts/manage','admin\Contact::Index');
$routes->match(['get','post'],'admin/contacts/add','admin\Contact::add');
$routes->match(['get','put'],'admin/contacts/edit/(:num)','admin\Contact::edit/$1');
$routes->get('admin/contacts/show/(:num)','admin\Contact::show/$1');
$routes->delete('admin/contacts/delete/(:num)','admin\Contact::delete/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
