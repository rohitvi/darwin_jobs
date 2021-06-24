<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Admin Edit Routes
$routes->add('admin/showadmin/(:num)','Admin::editadmin/$1');
// Admin Update Routes
$routes->add('admin/updateadmin/(:num)','Admin::updateadmin/$1');
// Admin Delete Routes
$routes->add('admin/deleteadmin/(:num)','Admin::deleteadmin/$1');
// Employer Edit Routes
$routes->add('admin/employer/(:num)','Admin::editemployer/$1');
// Employer Update Routes
$routes->add('admin/updateemployer/(:num)','Admin::updateemployer/$1');
// Company Update Routes
$routes->add('admin/updatecompany/(:num)','Admin::updatecompany/$1');
// Delete Employer/Company Routes
$routes->add('admin/deleteemployer/(:num)','Admin::deleteemployer/$1');
// Edit Users Routes
$routes->add('admin/edituser/(:num)','Admin::edituser/$1');
// Update Users Routes
$routes->add('admin/updateuser/(:num)','Admin::updateuser/$1');
// Delete Users Routes
$routes->add('admin/deleteuser/(:num)','Admin::deleteuser/$1');
// Edit Job Type Routes
$routes->add('admin/editjob/(:num)','Admin::editjob/$1');
// Update Job Type Routes
$routes->add('admin/updatejob/(:num)','Admin::updatejob/$1');
// Delete Job Type Routes
$routes->add('admin/deletejob/(:num)','Admin::deletejob/$1');
// Edit Education Routes
$routes->add('admin/editeducation/(:num)','Admin::editeducation/$1');
// Update Education Routes
$routes->add('admin/updateeducation/(:num)','Admin::updateeducation/$1');
// Delete Education Routes
$routes->add('admin/deleteeducation/(:num)','Admin::deleteeducation/$1');
// View Mypackages Details Routes
$routes->add('employer/mypackage/(:num)','employer::mypackagedetails/$1');
$routes->get('/Admin::edit_category/(:num)','Admin::edit_category/$1');
$routes->post('/Admin::edit_category/(:num)','Admin::edit_category/$1');

// Job Add
$routes->match(['get', 'post'], 'admin/post', 'Admin::post');


// USER ROUTES
$routes->get('profile', 'Home::profile');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}