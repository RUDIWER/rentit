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

//*******************************************************/
//** UNSECURED ROUTES                                   */
//*******************************************************/

// HOME PAGE ROUTES
Route::get('/', 'HomeController@index')->name('home');
Route::match(['get', 'post'], '/search-results', 'HomeController@searchResults');

//REDIRECT UNAUTHORISED ROUTES UNSECURED
Route::get('/unauthorised', 'Auth\LoginController@index')->name('unauthorised');

// RESULTS PAGE ROUTES
Route::get('/results/group/{id}', 'HomeController@resultGroup')->name('resultGroup');
Route::get('/results/category/{id}', 'HomeController@resultCategory')->name('resultCategory');
Route::get('/results/sub-category/{id}', 'HomeController@resultSubCategory')->name('resultSubCategory');

//PRODUCT VIEW ROUTES
Route::get('/product/{id}', 'Products\ProductController@view')->name('productView');

//(RW) Routes to change locale (language)
Route::get('language/{lang}', function ($lang) {
    /**
      * whenever you change locale
      * by passing language ISO code (like en, pl, pt-BR etc.)
      * add/update passed language to a session value with key 'locale'
      */
    Session::put('locale', $lang);
    /**
     * and now return back to a page
     * on which you changed language
     */
    return back();
    //   return redirect()->back()->withInput();
})->name('langroute');  //this is route name - for ease of using it anywhere

Auth::routes();

//*******************************************************/
//** SECURED ROUTES                                     */
//*******************************************************/

// Routes only accesable after login ! (auth middleware !)
Route::middleware(['auth'])->group(function () {
    // Home logged in User
    Route::get('/home', 'HomeController@index');

    // MESSAGE routes
    Route::get('/message/edit/{id}', 'Messages\MessageController@index')->name('message.index');
    Route::post('/message/send/{id}', 'Messages\MessageController@send')->name('message.send');

    // Route to profile from logged in user (slug only visible auth:id used to get profile)
    Route::get('/my-profile', 'Profile\ProfileController@index')->name('profile');

    Route::post('/my-profile/save', 'Profile\ProfileController@save');
    Route::post('/my-profile/uploadpicture', 'Profile\ProfileController@uploadPicture');

    // PRODUCT Routes to products from logged in user (slug only visible auth:id used to get profile)
    Route::get('/my-products', 'Products\ProductController@list')->name('my-products.list');
    Route::get('/my-products/create', 'Products\ProductController@create')->name('my-products.create');
    Route::get('/my-products/edit/{id}', 'Products\ProductController@edit')->name('my-products.edit');
    Route::get('/my-products/delete/{id}', 'Products\ProductController@delete')->name('my-products.delete');
    Route::post('/my-products/save/{id}', 'Products\ProductController@save')->name('my-products.save');

    // AJAX ROUTES
    //PRODUCT AJAX Routes
    Route::get('/my-products/get-group/{id}', 'Products\ProductController@ajaxGetGroup');
});
