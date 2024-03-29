<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('not', 'HomeController@sendNotification');

Route::get('generate-pdf','HomeController@generatePDF');
Route::get('view-pdf','HomeController@viewPDF');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('userDevices', 'UserDeviceController');

Route::resource('documentTypes', 'DocumentTypeController');

Route::resource('measurementUnits', 'MeasurementUnitController');

Route::resource('paymentStatuses', 'PaymentStatusController');

Route::resource('supplyCategories', 'SupplyCategoryController');

Route::resource('deliveryStatuses', 'DeliveryStatusController');

Route::resource('prelotStatuses', 'PrelotStatusController');

Route::resource('discounts', 'DiscountController');

Route::resource('products', 'ProductController');

Route::resource('providers', 'ProviderController');

Route::resource('customers', 'CustomerController');

Route::resource('people', 'PersonController');

Route::resource('packagers', 'PackagerController');

Route::resource('sellers', 'SellerController');

Route::resource('administrators', 'AdministratorController');

Route::resource('deliverers', 'DelivererController');

Route::resource('supplies', 'SupplyController');

Route::resource('supplyOrders', 'SupplyOrderController');

Route::resource('supplyOrderItems', 'SupplyOrderItemController');

Route::resource('presentations', 'PresentationController');

Route::resource('lots', 'LotController');

Route::resource('prelotOrders', 'PrelotOrderController');

Route::resource('presentationSupplies', 'PresentationSuppliesController');

Route::resource('damagedSupplies', 'DamagedSupplyController');

Route::resource('deliveryAddresses', 'DeliveryAddressController');

Route::resource('orders', 'OrderController');

Route::resource('orderItems', 'OrderItemController');