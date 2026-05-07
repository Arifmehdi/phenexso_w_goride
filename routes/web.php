<?php

use App\Http\Controllers\Admin\AmbulanceServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChamberController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\FrontSliderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\WebsiteParameterController;

// Route::get('/',[AuthController::class,'index'])->name('login');

Route::get('image', function () {
    Artisan::call('storage:link');
    return back();
});

Route::get('/run-storage-link', function () {
    try {
        // Remove the existing storage link
        File::deleteDirectory(public_path('storage'));

        // Run the artisan command
        Artisan::call('storage:link');

        return "<pre>Storage link created successfully.\n" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "<pre>Error: " . $e->getMessage() . "</pre>";
    }
});

Route::get('/clear', function () {
   Artisan::call('optimize:clear');
   return back();
})->name('clear_cache');

Route::get('/debug-sentry', function () {
    throw new Exception('Sentry is working!');
});


// // SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

// Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

// Route::post('/success', [SslCommerzPaymentController::class, 'success']);
// Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
// Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
// Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);


// Route::post('order/store', [SslCommerzPaymentController::class, 'orderStore']);
// Route::post('order/success', [SslCommerzPaymentController::class, 'orderSuccess']);
// Route::post('order/fail', [SslCommerzPaymentController::class, 'orderFail']);
// Route::post('order/cancel', [SslCommerzPaymentController::class, 'orderCancel']);

// Route::post('order/ipn', [SslCommerzPaymentController::class, 'orderIpn']);
// //SSLCOMMERZ END

Route::get('/testidcard', [FrontendController::class, 'testidcard'])->name('testidcard');

Route::get('/test-email', function () {
    try {
        Mail::raw('Test email content', function ($message) {
            $message->to('mehediarif.du@gmail.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});


Route::middleware(['web', 'auth'])->group(function() {
    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
   
});



Route::get('/language/change', [FrontendController::class, 'languageChange'])->name('welcome.changeLanguage');
Route::get('page/{slug?}',[FrontendController::class, 'page'])->name('page');
Route::get('/website/compliance',[FrontendController::class, 'websiteCompliance'])->name('websiteCompliance');
Route::get('hospital-details/{id}',[FrontendController::class,'HospitalDetails'])->name('hospital-details');

// HUBLI  website 
Route::get('/',[FrontendController::class, 'index'])->name('home');
Route::get('/md-message',[FrontendController::class,'mdMessage'])->name('mdMessage');
Route::get('/testimonial',[FrontendController::class,'testimonial'])->name('testimonial');
Route::get('/about',[FrontendController::class,'about'])->name('about');
Route::get('/shop',[FrontendController::class,'shop'])->name('shop');
Route::get('/quick-view', [FrontendController::class, 'quickView'])->name('quick.view');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/service',[FrontendController::class,'service'])->name('service');
Route::get('/fleet',[FrontendController::class,'fleet'])->name('fleet');
Route::get('/tours',[FrontendController::class,'tours'])->name('tours');
// Route::get('/product',[HomeController::class,'product'])->name('product');

Route::get('agent/dashboard',[FrontendController::class, 'memberDashboard'])->name('agent.dashboard');
Route::get('patient/dashboard',[FrontendController::class, 'patientDashboard'])->name('patient.dashboard');
Route::get('doctor/dashboard',[FrontendController::class, 'doctorDashboard'])->name('doctor.dashboard');

Route::get('category/{category}/posts',[FrontendController::class,'categoryPosts'])->name('categoryPosts');

Route::get('member/payment',[FrontendController::class, 'memberPayment'])->name('member.payment');

Route::get('change/profile',[FrontendController::class, 'profile'])->name('change.profile');
Route::post('agent/old-pwd',[FrontendController::class, 'oldPassword'])->name('member.old_password');
Route::post('agent/update-pwd',[FrontendController::class, 'updatePassword'])->name('member.update_password');
Route::post('agent/update-profile',[FrontendController::class, 'updateProfile'])->name('member.update_profile');

Route::get('/file/download/{id}',[FrontendController::class,'fileDownload'])->name('files.download');

Route::get('/search',[FrontendController::class,'search'])->name('search');

// Route::get('doctor/list',[FrontendController::class,'doctorList'])->name('doctorList');
Route::get('qurbani/occation',[FrontendController::class,'qurbaniOccation'])->name('qurbani.occation');
Route::get('qurbani/regular',[FrontendController::class,'qurbaniRegular'])->name('qurbani.regular');
Route::get('doctor/details/{id}',[FrontendController::class,'doctorDetails'])->name('doctorDetails');

Route::get('doctor/appointment',[FrontendController::class,'doctorAppointment'])->name('doctorAppointment');

Route::get('hospital/list',[FrontendController::class,'hospitalList'])->name('hospitalList');
Route::get('diagnostic',[FrontendController::class,'diagnostic'])->name('diagnostic');
Route::get('hopital/details/{id}',[FrontendController::class,'hospitalDetails'])->name('hospitalDetails');

Route::get('checkout',[FrontendController::class, 'new_checkout'])->name('new.checkout');
Route::post('cod/order/store',[FrontendController::class, 'codOrderStore'])->name('codOrderStore');
Route::post('order/store', [SslCommerzPaymentController::class, 'orderStore']);

Route::get('department/list',[FrontendController::class,'departmentList'])->name('departmentList');

Route::get('ambulance/provider/list',[FrontendController::class,'ambulanceProviderList'])->name('ambulanceProviderList');
Route::get('charity',[FrontendController::class,'charity'])->name('charity');

// Route::post('store/appointment',[FrontendController::class, 'storeAppointment'])->name('storeAppointment');

Route::get('/nb/products', [FrontendController::class, 'shasthoseba'])->name('shop.shasthoseba');
Route::get('product-category/{slug?}', [FrontendController::class, 'productCategory'])->name('productCategory');

Route::get('product/details/{slug}',[FrontendController::class, 'productDetails'])->name('productDetails');


Route::get('cart',[FrontendController::class, 'cart'])->name('cart');
Route::get('checkouts',[FrontendController::class, 'checkouts'])->name('frontend.checkout');
Route::post('add-to-cart',[FrontendController::class, 'addToCart'])->name('addToCart');
Route::get('/cart/quick-add', [FrontendController::class, 'quickAdd'])->name('cart.quick.add');

Route::get('/cart/remove/{id}', [FrontendController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [FrontendController::class, 'update'])->name('cart.update');
Route::post('/cart/update-quantity/{cartId}', [FrontendController::class, 'updateQuantity'])->name('cart.update.quantity');



// Route::post('add-to-cart/two',[FrontendController::class, 'addToCart2'])->name('addToCart2');

Route::post('cart/update/qty',[FrontendController::class, 'cartUpdateQty'])->name('cartUpdateQty');
Route::post('cart/remove/item/{cart}',[FrontendController::class, 'cartRemoveItem'])->name('cartRemoveItem');


Route::get('galleries/image',[FrontendController::class,'imageGalleries'])->name('image.galleries');
Route::get('galleries/video',[FrontendController::class,'videoGalleries'])->name('video.galleries');


// Authentication and Dashboard
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.user');
Route::get('/registration',[AuthController::class,'registration'])->name('registration');
Route::get('/registration/driver',[AuthController::class,'registrationDriver'])->name('registration.driver');
Route::get('/registration/corporate',[AuthController::class,'registrationCorporate'])->name('registration.corporate');
Route::get('/health-card',[AuthController::class,'healthCard'])->name('health.registration');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/main-register',[AuthController::class,'mainRegister'])->name('main.register');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    
    // Corporate Dashboard Routes
    Route::prefix('dashboard/corporate')->name('corporate.')->group(function() {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'corporateDashboard'])->name('dashboard');
        Route::get('/fleet', [App\Http\Controllers\DashboardController::class, 'corporateFleet'])->name('fleet');
        Route::get('/billing', [App\Http\Controllers\DashboardController::class, 'corporateBilling'])->name('billing');
        Route::get('/new-request', [App\Http\Controllers\DashboardController::class, 'corporateNewRequest'])->name('new-request');
        Route::get('/history', [App\Http\Controllers\DashboardController::class, 'corporateHistory'])->name('history');
        Route::get('/settings', [App\Http\Controllers\DashboardController::class, 'corporateSettings'])->name('settings');
    });

    // Owner Dashboard Routes
    Route::prefix('dashboard/owner')->name('owner.')->group(function() {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'ownerDashboard'])->name('dashboard');
        Route::get('/cars', [App\Http\Controllers\DashboardController::class, 'ownerCars'])->name('cars');
        Route::get('/history', [App\Http\Controllers\DashboardController::class, 'ownerHistory'])->name('history');
        Route::get('/earnings', [App\Http\Controllers\DashboardController::class, 'ownerEarnings'])->name('earnings');
        Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'ownerProfile'])->name('profile');
        Route::get('/documents', [App\Http\Controllers\DashboardController::class, 'ownerDocuments'])->name('documents');
    });

    // User (Solo) Specific Routes
    Route::prefix('dashboard/user')->name('user.')->group(function() {
        Route::get('/trips', [App\Http\Controllers\DashboardController::class, 'userTrips'])->name('trips');
        Route::get('/saved-places', [App\Http\Controllers\DashboardController::class, 'userSavedPlaces'])->name('saved-places');
    });

    Route::get('/dashboard/driver', [App\Http\Controllers\DashboardController::class, 'driverDashboard'])->name('driver.dashboard');
});

// Password Reset Frontend Bridge
Route::get('/reset-password', function (Illuminate\Http\Request $request) {
    $token = $request->input('token');
    $email = $request->input('email');
    $frontendUrl = env('FRONTEND_URL');

    if (!$frontendUrl) {
        return "FRONTEND_URL is not configured in .env file. Please set it to your frontend application's base URL.";
    }

    return redirect()->to($frontendUrl . '/reset-password?token=' . $token . '&email=' . $email);
})->name('password.reset.web');



Route::get('/news', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@news',
    'as' => 'news'
]);

Route::get('/news/{id}', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@singleNews',
    'as' => 'singleNews'
]);

Route::get('/support-policy', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@supportpolicy',
    'as'   => 'supportpolicy',
]);

// Route::get('/privacy-policy', [
//     'uses' => 'App\Http\Controllers\Frontend\FrontendController@privacypolicy',
//     'as'   => 'privacypolicy',
// ]);

Route::get('/terms', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@terms',
    'as'   => 'terms',
]);

Route::get('/help/center', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@helpcenter',
    'as'   => 'helpcenter',
]);

Route::get('/aboutus', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@aboutus',
    'as'   => 'aboutus',
]);

Route::get('/contactus', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@contactus',
    'as'   => 'contactus',
]);

Route::get('/terms', function () {
    return view('frontend.home.terms');
})->name('terms');

Route::get('/return-policy', function () {
    return view('frontend.home.return_policy');
})->name('return-policy');

// Route::get('/privacy-policy', function () {
//     return view('frontend.home.privacy_policy');
// })->name('privacy-policy');

Route::get('/about-us', function () {
    return view('frontend.home.about');
})->name('about-us');


Route::get('/get-upazilas/{district_id}', function ($district_id) {
    $upazilas = App\Models\Upazila::where('district_id', $district_id)->get();
    return response()->json($upazilas);
});

Route::get('/get-shipping-methods/{upazila_id}', [FrontendController::class, 'getShippingMethods']);

// Sitemap
Route::get('/sitemap.xml', [
    'uses' => 'App\Http\Controllers\Frontend\FrontendController@sitemap',
    'as'   => 'sitemap',
]);

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'mypanel'], function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('user.dashboard');
    Route::get('edit/my/information',[AuthController::class,'editMyInformation'])->name('user.editMyInformation');
    Route::get('idcard',[AuthController::class,'idcard'])->name('user.idcard');
    Route::get('idcard/pdf', [AuthController::class, 'idcardPdf'])->name('user.idcard.pdf');
    Route::post('change/my/information',[AuthController::class,'changeMyInformation'])->name('user.changeMyInformation');
    Route::post('profile-image/upload',[AuthController::class,'uploadProfileImage'])->name('user.uploadProfileImage');
    Route::get('orders/type/{type}',[AuthController::class,'orders'])->name('user.orders');
    
    Route::get('checkout',[FrontendController::class, 'checkout'])->name('checkout');
    // Route::get('new/checkout',[FrontendController::class, 'new_checkout'])->name('new.checkout');
    // Route::post('cod/order/store',[FrontendController::class, 'codOrderStore'])->name('codOrderStore');
    Route::post('delivery/location/save',[FrontendController::class, 'storeDeliveryLocation'])->name('storeDeliveryLocation');

    Route::post('reviews/store',[FrontendController::class, 'reviewsStore'])->name('reviewsStore');
    Route::get('invoice/print/{order}', [FrontendController::class, 'orderPrint'])->name('user.orderPrint');

    Route::get('chalan/print/{order}', [FrontendController::class, 'orderChalan'])->name('user.orderChalan');

    Route::get('feature-products', [AuthController::class, 'featureProducts'])->name('user.feature_products');

    // Product Stock Requests
    Route::get('stock-requests', [\App\Http\Controllers\AuthController::class, 'stockRequests'])->name('user.stock_requests.index');
    Route::get('stock-requests/create', [\App\Http\Controllers\AuthController::class, 'createStockRequestForm'])->name('user.stock_requests.create');
    Route::post('stock-requests', [\App\Http\Controllers\ProductStockRequestController::class, 'store'])->name('user.stock_requests.store');
});

// Route::middleware(['web'])->prefix('order')->group(function() {
//     Route::post('store', [SslCommerzPaymentController::class, 'orderStore']);
// });


Route::get('/logout',[AuthController::class,'logOut'])->name('logout');



Route::middleware(['userRole:admin','auth'])->prefix('admin')->group(function(){

    //admin
    Route::get('dashboard',[HomeController::class,'index'])->name('admin.dashboard');
    Route::get('select/tags/',[HomeController::class,'selectTagsOrAddNew'])->name('admin.tags');
    Route::get('select/authors/',[HomeController::class,'selectAuthorsOrAddNew'])->name('admin.authors');
   
    Route::get('websiteparam',[WebsiteParameterController::class,'websiteparam'])->name('websiteparam');
    Route::post('websiteparam/update/{id}',[WebsiteParameterController::class,'update'])->name('websiteparam.update');

    Route::resource('page_contents', PageContentController::class)->names([
        'index' => 'admin.page_contents.index',
        'create' => 'admin.page_contents.create',
        'store' => 'admin.page_contents.store',
        'show' => 'admin.page_contents.show',
        'edit' => 'admin.page_contents.edit',
        'update' => 'admin.page_contents.update',
        'destroy' => 'admin.page_contents.destroy',
    ]);
    
    
    //role assign
    Route::get('all/users',[UserRoleController::class,'allUser'])->name('admin.all_user');
    Route::get('assign/role',[UserRoleController::class,'userRole'])->name('admin.assign-role');
    Route::post('assign/role',[UserRoleController::class,'assignRole'])->name('admin.assign-role');
    Route::get('manage/role',[UserRoleController::class,'manageRole'])->name('admin.manage-role');
    Route::get('edit/role/{id}',[UserRoleController::class,'editRole'])->name('admin.edit-role');
    Route::post('update/role/{id}',[UserRoleController::class,'updateRole'])->name('admin.update-role');
    Route::get('delete/role/{id}',[UserRoleController::class,'deleteRole'])->name('admin.delete-role');

    //user
    Route::get('users',[UserController::class,'index'])->name('admin.user');
    Route::get('user/create',[UserController::class,'create'])->name('admin.create-user');
    Route::post('user/create',[UserController::class,'store'])->name('admin.create-user');
    Route::get('user/show/{id}',[UserController::class,'show'])->name('admin.show-user');
    Route::get('user/edit/{id}',[UserController::class,'edit'])->name('admin.edit-user');
    Route::post('user/update/{id}',[UserController::class,'update'])->name('admin.update-user');
    Route::get('user/delete/{id}',[UserController::class,'delete'])->name('admin.delete-user');
    Route::post('user/change-password/{id}',[UserController::class,'changePassword'])->name('admin.user.change-password');
    Route::put('user/{user}/toggle-approval', [UserController::class, 'toggleApproval'])->name('admin.user.toggle-approval');


    //search alllllllllllllllllllllll
    Route::get('global-search-ajax/type/{type}/parameter/{parameter?}',[SearchController::class,'globalSearchAjax'])->name('admin.global-search-ajax');



    //FrontSlider
    Route::resource('sliders', FrontSliderController::class);

    //galleries
    Route::resource('galleries', GalleryController::class);
    Route::get('image-item-delete/{ImageItemDelete}', [GalleryController::class,'imageItemDelete'])->name('imageItemDelete');
    Route::get('image-item-description/update/{ImageItemUpdate}', [GalleryController::class,'itemDescriptionUpdate'])->name('itemDescriptionUpdate');

   
    Route::resource('shipping', ShippingMethodController::class);



  /*
    |--------------------------------------------------------------------------
    | Menu Routes
    |--------------------------------------------------------------------------
    */

    // View all menus
    Route::get('menus/all', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menusAll',
        'as' => 'admin.menusAll'
    ]);

    // Store a new menu
    Route::post('menu/store', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menuStore',
        'as' => 'admin.menuStore'
    ]);

    // Edit an existing menu
    Route::get('menu/edit/menu/{menu}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menuEdit',
        'as' => 'admin.menuEdit'
    ]);

    // Update a specific menu
    Route::post('menu/update/menu/{menu}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menuUpdate',
        'as' => 'admin.menuUpdate'
    ]);

    // View a specific menu
    Route::get('menu/show/menu/{menu}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menuShow',
        'as' => 'admin.menuShow'
    ]);

    // Delete a menu
    Route::post('menu/delete/menu/{menu}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menuDelete',
        'as' => 'admin.menuDelete'
    ]);

    // Sort menus
    Route::get('menu/sort', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menuSort',
        'as' => 'admin.menuSort'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Page Routes
    |--------------------------------------------------------------------------
    */

    // View all pages
    Route::get('pages/all', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pagesAll',
        'as' => 'admin.pagesAll'
    ]);

    // Store a new page
    Route::post('page/store', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageStore',
        'as' => 'admin.pageStore'
    ]);

    // Edit an existing page
    Route::get('page/edit/page/{page}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageEdit',
        'as' => 'admin.pageEdit'
    ]);

    // Update a specific page
    Route::post('page/update/page/{page}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageUpdate',
        'as' => 'admin.pageUpdate'
    ]);

    // Delete a specific page
    Route::get('page/delete/page/{page}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageDelete',
        'as' => 'admin.pageDelete'
    ]);

    // Sort pages
    Route::get('page/sort', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageSort',
        'as' => 'admin.pageSort'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Page Item Routes
    |--------------------------------------------------------------------------
    */

    // Show form to create a new page item for a specific page
    Route::get('page/{page}/pageItem/create', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageItemCreate',
        'as' => 'admin.pageItemCreate'
    ]);

    // Store a new page item
    Route::post('pageItem/store', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageItemStore',
        'as' => 'admin.pageItemStore'
    ]);

    // Edit a specific page item
    Route::get('pageItem/edit/pageItem/{pageItem}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageItemEdit',
        'as' => 'admin.pageItemEdit'
    ]);

    // Update a specific page item
    Route::post('pageItem/update/pageItem/{pageItem}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageItemUpdate',
        'as' => 'admin.pageItemUpdate'
    ]);

    // Delete a specific page item
    Route::get('pageItem/delete/pageItem/{pageItem}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@pageItemDelete',
        'as' => 'admin.pageItemDelete'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Menu/Page Search Route
    |--------------------------------------------------------------------------
    */

     // Search for menu/pages by type
    Route::get('menupage/search/type/{type}', [
        'uses' => 'App\Http\Controllers\Admin\MenuPageController@menupageSearch',
        'as' => 'admin.menupageSearch'
    ]);




    // Route::resource('categories',CategoryController::class);
    // Route::post('category/active',[CategoryController::class,'categoryActive'])->name('category.active');

 
    //BlogPost
    Route::resource('news',PostController::class);
    Route::post('news/active',[PostController::class,'newsActive'])->name('news.active');
    Route::get('medias-ajax',[MediaController::class,'getMediasAjax'])->name('medias.getMediasAjax');

    //BisesoggoCategory
    Route::resource('departments',DepartmentController::class);
    Route::post('/departments/active',[DepartmentController::class,'departmentActive'])->name('departments.active');
    Route::resource('services',ServiceController::class);
    Route::get('get/division',[ServiceController::class,'getDivision'])->name('get.division');
    Route::get('get/district',[ServiceController::class,'getDistrict'])->name('get.district');
    Route::post('/hospital/active',[ServiceController::class,'hospitalActive'])->name('hospital.active');
    Route::get('hospital/allvisits/{id}',[ServiceController::class,'hospitalAllVisits'])->name('hospital.allvisits');
    Route::get('hospital/alldoctors/{id}',[ServiceController::class,'hospitalAllDoctors'])->name('hospital.alldoctors');

    // blog category
    Route::resource('categories',CategoryController::class);
    Route::post('category/active',[CategoryController::class,'categoryActive'])->name('category.active');
    
    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class);
    
    Route::post('/categories/active',[CategoriesController::class,'DoctorActive'])->name('doctor.active');
   

    Route::resource('chambers',ChamberController::class);
    Route::get('/doctor/{doctor}/chambers', [ChamberController::class, 'doctorChambers'])->name('doctor.chambers');

    Route::resource('ambulances',AmbulanceServiceController::class);
    Route::post('/ambulance/active',[AmbulanceServiceController::class,'ambulanceActive'])->name('ambulanceActive');
   
   
    Route::get('medias',[MediaController::class,'index'])->name('medias.index');
    Route::post('medias/store',[MediaController::class,'store'])->name('medias.store');
    Route::get('medias/destroy/{id}',[MediaController::class,'destroy'])->name('medias.destroy');

    Route::get('all/appointments',[HomeController::class,'allAppointments'])->name('allAppointments');
    Route::delete('delete/appointment/{id}',[HomeController::class,'deleteAppointment'])->name('deleteAppointment');

       // Category Routes
    Route::get('product/categories/all', [ProductController::class, 'productCategoriesAll'])->name('admin.productCategoriesAll');
    Route::get('product/category/create', [ProductController::class, 'productCategoryCreate'])->name('admin.productCategoryCreate');
    Route::post('product/category/store', [ProductController::class, 'productCategoryStore'])->name('admin.productCategoryStore');
    Route::get('product/category/edit/{category}', [ProductController::class, 'productCategoryEdit'])->name('admin.productCategoryEdit');
    Route::post('product/category/update/{category}', [ProductController::class, 'productCategoryUpdate'])->name('admin.productCategoryUpdate');
    Route::post('product/category/delete/{category}', [ProductController::class, 'productCategoryDelete'])->name('admin.productCategoryDelete');
    Route::get('category/status/{category}', [ProductController::class, 'categoryStatus'])->name('admin.categoryStatus');

    // Unit Routes
    Route::get('units/all', [UnitController::class, 'unitsAll'])->name('admin.unitsAll');
    Route::get('unit/create', [UnitController::class, 'unitCreate'])->name('admin.unitCreate');
    Route::post('unit/store', [UnitController::class, 'unitStore'])->name('admin.unitStore');
    Route::get('unit/edit/{unit}', [UnitController::class, 'unitEdit'])->name('admin.unitEdit');
    Route::post('unit/update/{unit}', [UnitController::class, 'unitUpdate'])->name('admin.unitUpdate');
    Route::post('unit/delete/{unit}', [UnitController::class, 'unitDelete'])->name('admin.unitDelete');
    Route::get('unit/status/{unit}', [UnitController::class, 'unitStatus'])->name('admin.unitStatus');
    Route::get('unit/search/type/{type}', [UnitController::class, 'unitSearch'])->name('admin.unitSearch');

   
    //  Product Routes
    Route::get('products/all', [ProductController::class, 'productsAll'])->name('admin.productsAll');
    Route::get('product/create', [ProductController::class, 'productCreate'])->name('admin.productCreate');
    Route::post('product/store', [ProductController::class, 'productStore'])->name('admin.productStore');
    Route::get('product/edit/{product}', [ProductController::class, 'productEdit'])->name('admin.productEdit');
    Route::post('product/update/{product}', [ProductController::class, 'productUpdate'])->name('admin.productUpdate');
    Route::post('product/delete/{product}', [ProductController::class, 'productDelete'])->name('admin.productDelete');
    Route::get('product/image/delete/{media}', [ProductController::class, 'deleteImage'])->name('admin.product.image.delete');
    Route::get('product/status/{product}', [ProductController::class, 'productStatus'])->name('admin.productStatus');
    Route::put('product/{product}/toggle-approval', [ProductController::class, 'toggleApproval'])->name('admin.product.toggle-approval');
    Route::get('product/tags', [ProductController::class, 'productTags'])->name('admin.productTags');
    Route::get('product/search/type/{type}', [ProductController::class, 'productSearch'])->name('admin.productSearch');
    Route::get('product/add/stock/{product}', [ProductController::class, 'productAddStock'])->name('admin.productAddStock');


    Route::get('order/list', [ProductController::class, 'orderList'])->name('admin.orderList');
    Route::get('order/details/{order}', [ProductController::class, 'orderDeatils'])->name('admin.orderDeatils');
    Route::post('order/assign-driver/{order}', [ProductController::class, 'assignDriver'])->name('admin.assignDriver');
    Route::post('order/status/{order}', [ProductController::class, 'orderStatus'])->name('admin.orderStatus');
    Route::post('order/payment/{order}', [ProductController::class, 'orderPayment'])->name('admin.orderPayment');
    Route::post('order/item/delete/{orderItem}', [ProductController::class, 'orderItemDelete'])->name('admin.orderItemDelete');
    Route::post('update/qty/{item}', [ProductController::class, 'updateQty'])->name('updateQty');
    Route::get('invoice/print/{order}', [ProductController::class, 'orderPrint'])->name('admin.orderPrint');

    // Contacts
    Route::get('contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('admin.contacts.show');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

    // Product Stock Request Admin Routes
    Route::resource('stock-requests', \App\Http\Controllers\Admin\ProductStockRequestController::class)->names('admin.stock_requests');

    // Vehicle Admin Routes
    Route::resource('vehicles', \App\Http\Controllers\Admin\VehicleController::class)->names('admin.vehicles');

    // Driver Admin Routes
    Route::resource('drivers', \App\Http\Controllers\Admin\DriverController::class)->names('admin.drivers');

    // Vehicle Assignment Admin Routes
    Route::resource('vehicle-assignments', \App\Http\Controllers\Admin\VehicleAssignmentController::class)->names('admin.vehicle_assignments');

});

Route::middleware(['auth', 'retailer'])->prefix('retailer')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Retailer\RetailerController::class, 'index'])->name('retailer.dashboard');
});
