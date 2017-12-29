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

    // Route to profile from logged in user (slug only visible auth:id used to get profile)
    Route::get('/my-profile', 'Profile\ProfileController@index')->name('profile');

    Route::post('/my-profile/save', 'Profile\ProfileController@save');
    Route::post('/my-profile/uploadpicture', 'Profile\ProfileController@uploadPicture');

    //Routes to messages from logged in user
    Route::get('/my-messages/inbox', 'Messages\MessageController@inboxList')->name('my-messages.inboxList');
    Route::get('/my-messages/sentbox', 'Messages\MessageController@sentBoxList')->name('my-messages.sentBoxList');
    Route::get('/my-messages/details/{id}/{sentBox}', 'Messages\MessageController@view')->name('my-messages.view');
    Route::get('/my-messages/conversation/{chainId}', 'Messages\MessageController@conversationList')->name('my-messages.conversationList');
    Route::get('/message/create/{receiverId}/{productId}/{chainId}', 'Messages\MessageController@create')->name('message.create');
    Route::post('message/send/{id}/{chainId}', 'Messages\MessageController@send')->name('message.send');
    Route::get('message/delete/{id}/{sentBox}', 'Messages\MessageController@delete')->name('message.delete');

    // PRODUCT Routes to products from logged in user (slug only visible auth:id used to get profile)
    Route::get('/my-products', 'Products\ProductController@list')->name('my-products.list');
    Route::get('/my-products/create', 'Products\ProductController@create')->name('my-products.create');
    Route::get('/my-products/edit/{id}', 'Products\ProductController@edit')->name('my-products.edit');
    Route::get('/my-products/delete/{id}', 'Products\ProductController@delete')->name('my-products.delete');
    Route::post('/my-products/save/{id}', 'Products\ProductController@save')->name('my-products.save');

    //RENTIT Routes
    Route::get('/rentit/step-1/{idProduct}', 'Rentit\RentitController@step1')->name('rentit.step1');

    // AJAX ROUTES
    //PRODUCT AJAX Routes
    Route::get('/my-products/get-group/{id}', 'Products\ProductController@ajaxGetGroup');
});
