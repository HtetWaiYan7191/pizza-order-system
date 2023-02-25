<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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



Route::middleware(['auth'])->group(function () {

//dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');


 //admin
    Route::middleware(['admin_auth',])->group(function(){
    //admin//category
    Route::group(['prefix' => 'category'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#create');
        Route::post('create/post',[CategoryController::class,'createPost'])->name('category#createPost');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });
    //admin//account
        Route::prefix('admin')->group(function(){

            //password
            Route::get('account/changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //details
            Route::get('details',[AdminController::class,'details'])->name('admin#details');

            //edit
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');

            //update
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');

            //delete
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');

            //changeRolePage
            Route::get('changeRolePage/{id}',[AdminController::class,'changeRolePage'])->name('admin#changeRolePage');

            //changeRole
            Route::post('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');

        });

    //admin//products
        Route::prefix('products')->group(function(){
            Route::get('pizzaList',[ProductController::class,'list'])->name('products#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('products#createPage');
            Route::post('create',[ProductController::class,'create'])->name('products#create');
            //delete
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('products#delete');
            //edit
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('products#edit');

            //update
            Route::post('update',[ProductController::class,'update'])->name('products#update');
            //view
            Route::get('view/{id}',[ProductController::class,'view'])->name('products#view');

            //
        });

});


//admin// passwordChange


//user//home

Route::group(['prefix' => 'user' , 'middleware' => 'user_auth'],function(){
        //USER MAIN HOME
        Route::get('/homePage',[UserController::class,'homePage'])->name('user#homePage');
        Route::get('/filter,{id}',[UserController::class,'filter'])->name('user#filter');


        //PIZZA
        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('pizza#details');

        });

        //CART
        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        });

        //USER PASSWORD PAGE
        Route::prefix('password')->group(function(){
        Route::get('changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');

            });

        //USER ACCOUNT VIEW PAGE
        Route::prefix('account')->group(function(){
            Route::get('viewPage',[UserController::class,'viewPage'])->name('user#viewPage');
            Route::get('editPage',[UserController::class,'editPage'])->name('user#editPage');
            Route::post('update/{id}',[UserController::class,'update'])->name('user#update');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
        });

    });

  });




//login,register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});




