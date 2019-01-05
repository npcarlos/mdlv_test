<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('user_devices', 'UserDeviceAPIController');

Route::resource('document_types', 'DocumentTypeAPIController');

Route::resource('measurement_units', 'MeasurementUnitAPIController');

Route::resource('payment_statuses', 'PaymentStatusAPIController');

Route::resource('supply_categories', 'SupplyCategoryAPIController');

Route::resource('delivery_statuses', 'DeliveryStatusAPIController');

Route::resource('prelot_statuses', 'PrelotStatusAPIController');

Route::resource('discounts', 'DiscountAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('providers', 'ProviderAPIController');

Route::resource('customers', 'CustomerAPIController');

Route::resource('people', 'PersonAPIController');

Route::resource('packagers', 'PackagerAPIController');

Route::resource('sellers', 'SellerAPIController');

Route::resource('administrators', 'AdministratorAPIController');

Route::resource('deliverers', 'DelivererAPIController');

Route::resource('supplies', 'SupplyAPIController');

Route::resource('supply_orders', 'SupplyOrderAPIController');

Route::resource('supply_order_items', 'SupplyOrderItemAPIController');

Route::resource('presentations', 'PresentationAPIController');

Route::resource('lots', 'LotAPIController');

Route::post('prelot_orders/group', 'PrelotOrderAPIController@storeGroup');
Route::resource('prelot_orders', 'PrelotOrderAPIController');

Route::resource('presentation_supplies', 'PresentationSuppliesAPIController');

Route::resource('damaged_supplies', 'DamagedSupplyAPIController');

Route::resource('delivery_addresses', 'DeliveryAddressAPIController');

Route::resource('orders', 'OrderAPIController');

Route::resource('order_items', 'OrderItemAPIController');