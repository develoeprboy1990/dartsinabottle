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
// Route::get('/', function () {
//     return view('user.customer.shop');
// });
//Route::get('send-email', 'HomeController@testEmail')->name('testEmail');

Route::get('/','HomeController@index');
Route::get('/shop','HomeController@shop');
Route::get('get-package/{id}','HomeController@getPackage');
Route::get('/home-products','HomeController@homeProducts');
Auth::routes();

Route::get('/myTesting', 'HomeController@myTesting')->name('home');

Route::get('admin/login','AdminManagementController@login');

Route::post('admin/login','AdminManagementController@processLogin');

Route::get('admin/logout', 'AdminManagementController@logout');

Route::get('admin/dashboard', 'AdminManagementController@dashboard');

Route::get('admin/orders/pending-shipment','AdminManagementController@pendingShip');

Route::get('admin/orders/shipped','AdminManagementController@shippedOrders');

Route::get('admin/orders/cancelled','AdminManagementController@cancelledOrders');

Route::get('admin/products','ProductsController@index');

Route::post('admin/add-product','ProductsController@store');

Route::post('admin/delete-product/{id}','ProductsController@destroy');

Route::get('admin/product/{id}/edit','ProductsController@edit');

Route::post('admin/update-product/{id}','ProductsController@update');

Route::resource('admin/badge-discount','BadgeDiscountController');

Route::resource('admin/badge-coupon','BadgeCouponController');

Route::get('admin/check-coupon','BadgeCouponController@check_coupon');

Route::resource('admin/role','RoleManagement');

Route::resource('admin/system-user', 'SystemUser');

Route::get('admin/customers/{status?}','AdminManagementController@viewCustomers');

Route::get('admin/customer/{user_id}/detail','AdminManagementController@viewCustomerDetail');

Route::get('admin/customer/{user_id}/suspend-account','AdminManagementController@suspendedAccount');

Route::get('admin/customer/{user_id}/activate-account','AdminManagementController@activateSuspendedAccount');

Route::get('admin/order/{id}/detail/{type?}','AdminManagementController@orderDetail');

Route::post('admin/approve-badge-design','AdminManagementController@approveBadgeDesign');

Route::post('admin/approve-badge-shipping','AdminManagementController@approveBadgeShipping');

Route::post('admin/confirm-pending-payment','AdminManagementController@confirmPendingPayment');

Route::post('admin/confirm-payment-only','AdminManagementController@confirmPaymentOnly');

Route::resource('admin/courier','CourearController');

Route::get('admin/shipping-management','AdminManagementController@shippingManagement');

Route::post('admin/shipping-management','AdminManagementController@processShippingManagement');

Route::get('admin/get-weight-price','AdminManagementController@getWeightPrice');

Route::post('admin/shipping-management/edit','AdminManagementController@processEditShippingManagement');

Route::get('admin/shipping-management/{id?}/delete','AdminManagementController@deleteShippingManagment');

Route::resource('admin/weight-price','DefaultWeightPriceController');

Route::post('admin/upload-asset','AdminManagementController@uploadAssetProcess');

Route::get('admin/view-order-asset','AdminManagementController@viewOrderAsset');

Route::get('admin/delete-order-asset','AdminManagementController@deleteOrderAsset');

Route::get('admin/customer-order-assets/{user_id}','AdminManagementController@viewCustomerOrderAsset');

Route::post('admin/add-order-note','AdminManagementController@addOrderNote');

Route::get('admin/delete-order-note','AdminManagementController@deleteOrderNote');

Route::post('admin/add-customer-note','AdminManagementController@addCustomerNote');

Route::get('admin/delete-customer-note','AdminManagementController@deleteCustomerNote');

Route::get('admin/custom-badges/{status}','AdminManagementController@customBadges');

Route::get('admin/custom-badge/{id}/detail','AdminManagementController@customBadgeDetail');

Route::post('admin/assign-quote','AdminManagementController@assignQuote');

Route::post('admin/send-message-to-customer','AdminManagementController@sendMessageToCustomer');

Route::post('admin/update-customer-deposit','AdminManagementController@updateDepositToCustomer');

Route::get('admin/inbox','AdminManagementController@inbox');

Route::get('admin/get-chat-content','AdminManagementController@fetchChatContent');

Route::post('admin/send-message-to-customer-from-chat-box','AdminManagementController@sendMessageToCustomerFromChatBox');

Route::get('admin/move-chat-to-archive/{chat_id}','AdminManagementController@moveChatToArchive');

Route::get('admin/archive','AdminManagementController@archive');

Route::resource('admin/payment-types','PaymentTypeController');

Route::post('admin/assign-custom-payment-type-to-customer','AdminManagementController@assignCustomPaymentTypeToCustomers');

Route::post('admin/ship-wire-check-order-with-payment','AdminManagementController@shipWireCheckOrderWithPayment');

Route::post('admin/ship-wire-check-order-with-out-payment','AdminManagementController@shipWireCheckOrderWithOutPayment');

Route::post('admin/ship-wire-check-order-whose-payment-is-done','AdminManagementController@shipWireCheckOrderWhosePaymentIsDone');

Route::post('admin/ship-order-whose-payment-is-done','AdminManagementController@shipOrderWhosePaymentIsDone');

Route::get('admin/filter-product', 'AdminManagementController@filterProduct');

Route::get('admin/confirm-return-darts','AdminManagementController@confirmReturnDarts');

Route::get('admin/cancel-order','AdminManagementController@cancelOrder');

Route::resource('admin/customer-groups','CustomerGroupController');

Route::resource('admin/customer-packages','CustomerPackageController');

Route::post('admin/assign-customer-group','AdminManagementController@assignCustomerGroup');

Route::get('admin/autocomplete-advance-search-for-users','AdminManagementController@autoCompleteAdvanceSearch');

Route::post('admin/advancedsearch/user','AdminManagementController@advanceSearchUser');

Route::post('admin/send-mail-to-users','AdminManagementController@sendMailToAllUsers');

Route::post('admin/send-mail-to-selected-users','AdminManagementController@sendMailToSelectedUsers');

Route::get('admin/change-password','AdminManagementController@changePassword');

Route::post('admin/change-password','AdminManagementController@processChangePassword');

Route::get('admin/home-page-url','AdminManagementController@setHomePageUrl');

Route::post('admin/home-page-url','AdminManagementController@setHomePageUrlProcess');

Route::post('admin/choose-account-type-process','PaymentTypeController@choosePaymentAccountTypeProcess');

// ---------------------------------------------------Customer Routes----------------------------

Route::get('signup', 'HomeController@signup');

Route::post('signup', 'HomeController@processSignup');

Route::get('activate-account/{id}/{activation_code}','HomeController@activateAccount');

Route::get('resend-activation-email','HomeController@resendActivationEmail');

Route::get('login', 'HomeController@login');

Route::get('logout', 'HomeController@logout');

Route::post('login', 'HomeController@processLogin');

Route::get('add-shipping-detail', 'HomeController@addShippingDetail');

Route::post('add-shipping-detail', 'HomeController@addShippingDetailProcess');

Route::get('filter-city', 'CountryStateCity@filterCity');

Route::get('filter-state', 'CountryStateCity@filterState');

Route::get('shop', 'HomeController@shop');

Route::get('browse', 'HomeController@browse');

Route::get('browse/detail/{type?}','HomeController@browseDetail');

Route::get('faq', 'HomeController@getFaq');

Route::get('about-us', 'HomeController@AboutUs');

Route::get('privacy-policy', 'HomeController@PrivayPolicy');

Route::get('terms-and-condition', 'HomeController@TermOfService');

Route::get('contact-us', 'HomeController@ContactUs');

Route::get('cart', 'HomeController@getCart');

Route::post('cart', 'HomeController@cart');

Route::get('product-cart', 'HomeController@productCart');

Route::get('checkout', 'HomeController@checkout');

Route::get('lent-darts','HomeController@getLentDarts');

Route::get('new-lent-darts','HomeController@getNewLentDarts');

Route::post('choose-product-price-type-process','HomeController@choosePriceProductTypeProcess');
Route::post('revert-product-price-type-process','HomeController@revertPriceProductTypeProcess');
Route::get('set-user-paypal','HomeController@setPayPalEmail');

Route::get('current-darts','HomeController@getCurrentDarts')->name('currentDarts');


Route::get('success-transaction', 'HomeController@successTransaction')->name('successTransaction');
Route::get('cancel-transaction', 'HomeController@cancelTransaction')->name('cancelTransaction');


Route::get('create-transaction','HomeController@createTransaction')->name('createTransaction');


Route::get('buy-darts','HomeController@getBuyDarts');

Route::get('borrowed-darts','HomeController@getBorrowedDarts')->name('borrowedDarts');

Route::get('confirm-buy-darts','HomeController@confirmBuyDarts');

Route::get('edit-cart','HomeController@editCart');

Route::get('edit-product-cart','HomeController@editProductCart');

Route::post('edit-cart','HomeController@editCartProcess');

Route::get('delete-cart-item','HomeController@deleteCartItem');

Route::get('delete-prod-cart-item','HomeController@deleteProductCartItem');

Route::post('add-more-shipping-detail','HomeController@addMoreShippingDetail');

Route::get('user-shipping-information','HomeController@userShippingInformation');

Route::get('get-same-billing-address','HomeController@getSameBillingAddress');

Route::get('get-same-billing-address-on-checkbox','HomeController@getSameBillingAddressOnCheckBox');

Route::get('check-order','HomeController@checkOrder');

Route::post('place-order','HomeController@placeOrder');

Route::get('returnUrl','HomeController@returnUrl');
Route::get('cancelUrl','HomeController@cancelUrl');



Route::get('dashboard','HomeController@dashboard');

Route::get('get-badge-details','HomeController@getBadgeDetail');

Route::get('orders/{status?}','HomeController@orders');

Route::get('order/{id}/detail','HomeController@orderDetail');

Route::get('reorder/{order_number}','HomeController@reOrder');

Route::get('unsubscribe-order','HomeController@UnsubscribeOrder');

Route::post('reorder','HomeController@processReorder');

Route::post('authorize/charge-existing-customer-profile','HomeController@chargeAuthorizeExistingCustomerProfile');

Route::get('create-custom-badge','HomeController@createCustomBadge');

Route::post('create-custom-badge','HomeController@processCreateCustomBadge');

Route::get('custom-badges/{status}','HomeController@customBadges');

Route::get('custom-badge/{id}/detail','HomeController@customBadgeDetail');

Route::post('reject-quote','HomeController@rejectQuote');

Route::get('custom-badge/{identification_number}/checkout','HomeController@customBadgeCheckOut');

Route::get('user-custom-badge-shipping-information','HomeController@userCustomBadgeShippingInformation');

Route::post('place-custom-badge-order','HomeController@placeCustomBadgeOrder');

Route::post('charge-existing-card-custom-badge','HomeController@chargeAuthorizeExistingCustomerProfileCustomBadge');

Route::get('inbox','HomeController@inbox');

Route::get('archive','HomeController@archive');

Route::get('move-chat-to-archive/{chat_id}','HomeController@moveChatToArchive');

Route::get('fetch-chat-content','HomeController@fetchChatContent');

Route::post('send-message-to-admin','HomeController@sendMessageToAdmin');

Route::post('send-message-to-admin-from-chat-box','HomeController@sendMessageToAdminFromChatBox');

Route::get('fetch-sent-message-content','HomeController@fetchSentMessageContent');

Route::post('order-thankyou-page','HomeController@orderThankYouPage');

Route::get('change-password','HomeController@changePassword');

Route::post('change-password','HomeController@processChangePassword');

Route::get('update-paypal-email','HomeController@updatePayPalEmail');

Route::post('update-paypal-email','HomeController@processupdatePayPalEmail');

Route::get('get-shipping-detials-against-address','HomeController@getShippingDetailsAgainstAddress');

Route::get('get-all-details-on-state-change','HomeController@getAllDetailsOnStateChange');

Route::get('get-shipping-detials-against-address-custom-badge','HomeController@getShippingDetailsAgainstAddressCustomBadge');

// Send data to wordpress site

Route::get('get-cart-count-for-wordpress','GeneralFunctionController@getCartCountForWordPress');

Route::get('get-user-status-for-wordpress','GeneralFunctionController@getUserStatusForWordPress');

Route::get('send-forgot-password-link','HomeController@sendForgotPasswordLink');

Route::post('send-forgot-password-link','HomeController@sendForgotPasswordLinkProcess');

Route::get('forgot-password/{user_id}/{password_reset_token}','HomeController@forgotPassword');

Route::post('process-forgot-password','HomeController@processForgotPassword');

Route::resource('admin/content','ContentController');