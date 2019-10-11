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



Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');
    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    // 'middleware' => 'auth:api',
], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');

    Route::get('couponSes', 'CartController@couponSes')->name('couponSes');

    Route::get('/', 'HomeController@ecommerce')->name('ecommerce');
    Route::resource('products', 'api\ProductController');
    Route::resource('wish', 'WishController');
    Route::resource('subcategories', 'api\SubCategoryController');
    Route::resource('reviews', 'api\ReviewController');
    Route::resource('brands', 'BrandController');
    Route::resource('categories', 'api\CategoryController');
    Route::resource('sales', 'SaleController');

    Route::get('/ecommerce', 'HomeController@ecommerce')->name('ecommerce')->middleware('verified');
    Route::get('/getReviews/{id}', 'ReviewController@getReviews')->name('getReviews');

    Route::get('/getsP', 'SliderController@getsP')->name('getsP');
    Route::get('/getTP', 'SliderController@getTP')->name('getTP');
    Route::get('/getTPN', 'SliderController@getTPN')->name('getTPN');
    Route::get('/headerPro', 'SliderController@headerPro')->name('headerPro');

    Route::get('/bestSellF', 'SliderController@bestSellF')->name('bestSellF');
    Route::get('/bestSellA', 'SliderController@bestSellA')->name('bestSellA');
    Route::get('/featuredF', 'SliderController@featuredF')->name('featuredF');
    Route::get('/featuredA', 'SliderController@featuredA')->name('featuredA');
    Route::get('/newProF', 'SliderController@newProF')->name('newProF');
    Route::get('/newProA', 'SliderController@newProA')->name('newProA');

    Route::post('/cart/{id}', 'CartController@addToCart')->name('addToCart');
    Route::get('/getCart', 'CartController@getCart')->name('getCart');
    Route::post('/subToCart/{id}', 'CartController@subToCart')->name('subToCart');
    Route::post('/cartAdd/{id}', 'CartController@cartAdd')->name('cartAdd');
    Route::post('/flashCart/{id}', 'CartController@flashCart')->name('flashCart');
    Route::get('/getCartProduct', 'CartController@getCartProduct')->name('getCartProduct');

    Route::get('/getProducts', 'ProductController@getProducts')->name('getProducts');
    Route::post('/proImg/{id}', 'ProductController@proImg')->name('proImg');
    Route::get('/featured', 'ProductController@featured')->name('featured');
    Route::get('/bestSell', 'ProductController@bestSell')->name('bestSell');
    Route::get('/newProduct', 'ProductController@newProduct')->name('newProduct');
    Route::get('/related/{id}', 'ProductController@related')->name('related');
    Route::post('/search', 'ProductController@search')->name('search');
    Route::post('/searchProduct', 'ProductController@searchProduct')->name('searchProduct');

    Route::post('/searchItems/{search}', 'ProductController@searchItems')->name('searchItems');

    Route::post('/filterProduct/{id}', 'FilterController@filterProduct')->name('filterProduct');
    Route::post('/FilterShop', 'FilterController@FilterShop')->name('FilterShop');
    Route::post('/filterItem', 'FilterController@filterItem')->name('filterItem');

    Route::post('/preImg/{id}', 'PrescriptionController@preImg')->name('preImg');

    Route::post('/NotyOrder/{id}', 'NotificationController@NotyOrder')->name('NotyOrder');
    Route::post('/read', 'NotificationController@read')->name('read');
    Route::get('/Chattynoty', 'NotificationController@Chattynoty')->name('Chattynoty');
    Route::get('/notifications', 'NotificationController@notifications')->name('notifications');


    Route::get('ratings/{id}', 'ReviewController@ratings')->name('ratings');
    Route::post('rate/{id}', 'ReviewController@rate')->name('rate');
    Route::get('bestRated', 'ReviewController@bestRated')->name('bestRated');

    Route::get('category/{id}', 'CategoryController@category')->name('category');
    Route::get('catLimit', 'CategoryController@catLimit')->name('catLimit');

    Route::get('subcategory/{id}', 'SupCategoryController@subcategory')->name('subcategory');

// Auth::routes();
    // Route::group(['middleware' => ['verified']], function () {
    Route::get('/paypal', function () {
        return view('paypal.createPay');
    });
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'api\UserController');
    Route::resource('companies', 'CompanyController');
    Route::resource('coupons', 'CouponController');
    Route::resource('sizes', 'SizeController');

    Route::get('/logoutOther', 'UserController@logoutOther')->name('logoutOther');
    Route::post('/logOtherDevices', 'UserController@logOtherDevices')->name('logOtherDevices');

    Route::get('/getUsersCount', 'UserController@getUsersCount')->name('getUsersCount');

    Route::post('permisions/{id}', 'UserController@permisions')->name('permisions');
    Route::get('getUsers', 'UserController@getUsers')->name('getUsers');
    Route::get('getDrivers', 'UserController@getDrivers')->name('getDrivers');
    Route::get('getCustomer', 'UserController@getCustomer')->name('getCustomer');
    Route::get('getLogedinUsers', 'UserController@getLogedinUsers')->name('getLogedinUsers');
    Route::post('profile/{id}', 'UserController@profile')->name('profile');
    Route::post('getSorted', 'UserController@getSorted')->name('getSorted');
    Route::post('getUserPro/{id}', 'UserController@getUserPro')->name('getUserPro');
    Route::post('getUserPerm/{id}', 'UserController@getUserPerm')->name('getUserPerm');
    Route::post('password', 'UserController@password')->name('password');
    Route::patch('AuthUserUp/{id}', 'UserController@AuthUserUp')->name('AuthUserUp');

    Route::get('execute-payment', 'PaymentController@execute')->name('execute');
    Route::post('createpayment', 'PaymentController@create')->name('create');
    Route::resource('orders', 'OrderController');
    Route::resource('aboutus', 'AboutController');

    Route::post('/StatusItem/{id}', 'ProductController@StatusItem')->name('StatusItem');

    Route::get('/admin', 'HomeController@admin')->name('admin');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/filterItems', 'FilterController@filterItems')->name('filterItems');

    Route::get('/pay', 'OrderController@pay')->name('pay');

    Route::get('getChartOrders', 'DashboardController@getChartOrders')->name('getChartOrders');
    Route::get('getBrands', 'DashboardController@getBrands')->name('getBrands');
    Route::get('getChartData', 'DashboardController@getChartData')->name('getChartData');
    Route::get('getCategories', 'DashboardController@getCategories')->name('getCategories');
    Route::get('getOrders', 'DashboardController@getOrders')->name('getOrders');

    Route::get('getCountCount', 'DashboardController@getCountCount')->name('getCountCount');

    Route::get('countDelivered', 'DashboardController@countDelivered')->name('countDelivered');
    Route::get('countPending', 'DashboardController@countPending')->name('countPending');
    Route::get('countOrders', 'DashboardController@countOrders')->name('countOrders');

    Route::get('getUsersRole', 'RoleController@getUsersRole')->name('getUsersRole');
    Route::get('getRoles', 'RoleController@getRoles')->name('getRoles');
    Route::get('getPermissions', 'RoleController@getPermissions')->name('getPermissions');
    Route::post('getRolesPerm/{id}', 'RoleController@getRolesPerm')->name('getRolesPerm');
    Route::get('getRoles', 'RoleController@getRoles')->name('getRoles');

    Route::post('assignR', 'RoleController@assignR')->name('assignR');

    Route::any('invoiceOrder', 'InvoiceController@invoiceOrder')->name('invoiceOrder');
    Route::any('invoice/{id}', 'InvoiceController@invoice')->name('invoice');

    Route::post('logo/{id}', 'CompanyController@logo')->name('logo');

});
