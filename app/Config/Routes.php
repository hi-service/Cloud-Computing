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
$routes->setAutoRoute(true);

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/login/login_action', 'Login::login_action');
$routes->get('/login/register', 'Login::register');
$routes->get('/login/submit_register', 'Login::submit_register');
$routes->get('/service', 'Service::index');
$routes->get('/service/auth', 'Service::auth');
$routes->get('/service/dashboard', 'Service::dashboard');
$routes->get('/service/order', 'Service::order');
$routes->get('/service/auth_order', 'Service::auth_order');
$routes->get('/service/auth_order_out', 'Service::auth_order_out');
$routes->get('/service/status', 'Service::status_order');
$routes->get('/service/auth_status', 'Service::auth_status');
$routes->get('/service/conversation', 'Service::conversation');
$routes->get('/service/get_message', 'Service::get_message');
$routes->get('/service/send_message', 'Service::send_message');
$routes->get('/service/order_barang', 'Service::order_barang');
$routes->get('/service/set_invoice', 'Service::set_invoice');
$routes->get('/service/get_invoice', 'Service::getInvoice');
$routes->get('/service/set_invoice_status', 'Service::set_invoice_status');
$routes->get('/service/print_invoice', 'Service::print_invoice');
$routes->get('/service/status_invoice', 'Service::status_invoice');
$routes->get('/service/set_invoice_order_status', 'Service::set_invoice_order_status');
$routes->get('/service/update_order_status', 'Service::update_order_status');

// Admin Routes
$routes->get('/admin/login', 'Admin::login');
$routes->get('/admin/auth_login', 'Admin::auth_login');
$routes->get('/admin/logout', 'Admin::logout');
$routes->get('/admin/', 'Admin::index');
$routes->get('/admin/order', 'Admin::order');
$routes->get('/admin/auth_order', 'Admin::auth_order');
$routes->get('/admin/customer_service', 'Admin::cs_page');
$routes->get('/admin/get_message', 'Admin::get_message');
$routes->get('/admin/send_message', 'Admin::send_message');
$routes->get('/admin/inventory', 'Admin::inventory');
$routes->get('/admin/add_item', 'Admin::add_item');
$routes->get('/admin/update_item', 'Admin::update_item');
$routes->get('/admin/delete_item', 'Admin::delete_item');
$routes->get('/admin/order_item', 'Admin::order_item');
$routes->get('/admin/getOrderMessage', 'Admin::getOrderMessage');
$routes->get('/admin/sendOrderMessage', 'Admin::sendOrderMessage');
$routes->get('/admin/cs_order_page', 'Admin::cs_order_page');
$routes->post('/admin/setNextOrderKM', 'Admin::setNextOrderKM');

/* API Routes */
$routes->post('/api/register', 'api::register');
$routes->post('/api/login', 'api::login');
$routes->get('/api/getUserData', 'api::getUserData');
$routes->get('/api/locbengkel', 'api::getBengkel');
$routes->get('/api/getkeluhan', 'api::getKeluhan');
$routes->get('api/getDescription(:num)', 'api::getBengkelDesc/$1');
$routes->post('/api/setOrder', 'api::setOrder');
$routes->get('/api/getOrderStatus', 'api::getOrderStatus');
$routes->post('/api/setOrderStatusDone', 'api::setOrderStatusDone');
$routes->post('/api/setOrderRating', 'api::setOrderRating');
$routes->post('/api/setOrderChat', 'api::setOrderChat');
$routes->get('/api/getOrderChat(:num)', 'api::getOrderChat/$1');
$routes->get('/api/getOrderHistory', 'api::getOrderHistory');//getBengkelShop

$routes->get('/api/getBengkelShop', 'api::getBengkelShop');//getBengkelShop
$routes->get('api/getItemsData(:num)', 'api::getItemsData/$1');
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
