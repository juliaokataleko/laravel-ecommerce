<?php

use App\models\SubCategory;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\Console\Input\Input as InputInput;

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


Auth::routes();
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::any('recover', 'HomeController@recover');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', function() {
    return view('pages.about');
})->name('about');
Route::get('/termos-e-condicoes', 'HomeController@termos')->name('termos');
Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');

// Route::get('/questionnaires/create', 'QuestionaireController@create');
// Route::post('/questionnaires', 'QuestionaireController@store');
// Route::get('/questionnaires/{questionnaire}', 'QuestionaireController@show');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/profile/edit', 'UserController@edit')->name('edit-profile');
Route::post('/profile/edit', 'UserController@update')->name('update-profile');

Route::post('/profile/change-password', 'UserController@changePassword')->name('password_update');

Route::get('/profile/photo', 'UserController@photoEdit')->name('edit-profile-photo');
Route::post('/profile/photo', 'UserController@updatePhoto')->name('update-profile-photo');

// Route::get('/questionnaires/{questionnaire}/questions/create', 'QuestionController@create');
// Route::post('/questionnaires/{questionnaire}/questions', 'QuestionController@store');
// Route::delete('/questionnaires/{questionnaire}/questions/{question}', 'QuestionController@destroy');

// Route::get('/surveys/{questionnaire}-{slug}', 'SurveyController@show');
// Route::post('/surveys/{questionnaire}-{slug}', 'SurveyController@store');

//Admin Group&NameSpace
Route::group(['prefix' => 'admin/', 'middleware' => ['auth', 'admin', 'verified']], function(){
    
    Route::get('/', 'AdminController@index');
    Route::any('/config', 'AdminController@config');

    Route::get('/users', function() {
        return view('admin.users.index');
    });

    Route::get('/user/delete/{user}', 'UserController@destroy');

    Route::get('/ratings', function() {
        return view('admin.rate');
    });

    Route::get('/category', 'CategoryController@index');
    Route::post('/category', 'CategoryController@store');
    Route::get('/category/edit/{category}', 'CategoryController@edit');
    Route::post('/category/edit/{category}', 'CategoryController@update');

    Route::get('/category/delete/{category}', 'CategoryController@destroy');
    
    Route::get('/subcategory', 'SubCategoryController@index');
    Route::post('/subcategory', 'SubCategoryController@store');
    Route::get('/subcategory/edit/{subcategory}', 'SubCategoryController@edit');
    Route::post('/subcategory/edit/{subcategory}', 'SubCategoryController@update');
    Route::get('/subcategory/delete/{subcategory}', 'SubCategoryController@destroy');
    
    Route::get('/product', 'ProductController@index');
    Route::get('/product/create', 'ProductController@create');
    Route::post('/product/store', 'ProductController@store');

    

    Route::get('/product/edit/{product}', 'ProductController@edit');
    Route::post('/product/update/{product}', 'ProductController@update');
    Route::get('/product/delete/{product}', 'ProductController@destroy');
    Route::get('/product/deleteimage/{image}', 'ProductController@imageGelete');
    

    # Pegando as subcategorias de uma categoria
    Route::get('/subcat', function(Request $request){
        $category_id = $request->get('category_id');
        $subcateories = SubCategory::where('category_id', '=', $category_id)->get();
        return response()->json($subcateories);
    });

    Route::get('/toadmin/{user}', 'UserController@changeToAdmin');

    Route::get('/purchases', 'CartController@purchases');
    Route::get('/purchase/finish/{purchase}', 'CartController@finish');

    Route::get('/active-toggle/{user}', 'UserController@activeToggle');

    Route::get('/rating/delete/{id}', 'RatingController@destroyAdmin');
    
});

// pegando produtos pelo vue
Route::any('/product/get-products', 'ProductController@getProducts');

Route::any('/product/get-product/{slug}', 'ProductController@getProduct');
Route::any('/product/{slug}', 'HomeController@product');


Route::any('/product/get-more-products/{count}/{next}', 'ProductController@getMoreProducts');

Route::any('/product/search/{count}/{next}', 'ProductController@search');


Route::any('/category/{slug}', 'HomeController@getByCategory');
Route::any('/subcategory/{subcategory}', 'HomeController@getBySubCategory');

Route::get('/cart/add/{product}', 'CartController@add');
Route::get('/cart/add-more/{product}', 'CartController@addMore');
Route::get('/cart/remove/{product}', 'CartController@remove');
Route::get('/cart/remove-all', 'CartController@removeAll');
Route::get('/cart/remove-product/{product}', 'CartController@removeProduct');
Route::get('/cart/finish', 'CartController@finishPurchase');

Route::get('/cart', 'CartController@index');

Route::get('/my-purchases', 'CartController@myPurchases');


Route::get('/rating/{product}/{stars}', 'RatingController@add');
Route::post('/rating/comment/{rate}', 'RatingController@update');
Route::any('/rating/{rate}', 'RatingController@destroy');

# Pegando as subcategorias de uma categoria
Route::get('/subcat', function(Request $request){
    $category_id = $request->get('category_id');
    $subcateories = SubCategory::where('category_id', '=', $category_id)->get();
    return response()->json($subcateories);
});

Route::get('/account_confirm', 'HomeController@account_confirm');
Route::any('/mail_resend', 'HomeController@resend_verification');
Route::post('/user/register', 'HomeController@register');
