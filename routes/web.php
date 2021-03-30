<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Brand;
use App\Models\MultiPic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
//    $brands = Brand::all();
    $brands = DB::table('brands')->get();
    $about = DB::table('home_abouts')->first();
    $images = MultiPic::all();

    return view('home', compact('brands', 'about', 'images'));
});

/*Route::get('/home', function () {
    echo "This is Home Page";
});*/

//Route::get('/contact', [ContactController::class, 'index'])->name('contact');

//Route::get('/about', [AboutController::class, 'about'])->name('about');

/* Category routes */
Route::get('/category/all', [CategoryController::class, 'AllCategory'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PDelete']);

/* Brand routes */
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

/* Multi Image routes */
Route::get('/multi/image', [BrandController::class, 'MultiPic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImage'])->name('store.image');


// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

// Home About All Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/about/update/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

// Portfolio Front Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/contact/edit/{id}', [ContactController::class, 'AdminEditContact']);
Route::post('/admin/contact/update/{id}', [ContactController::class, 'AdminUpdateContact']);
Route::get('/admin/contact/delete/{id}', [ContactController::class, 'AdminDeleteContact']);
Route::get('/admin/contact/message', [ContactController::class, 'AdminContactMessages'])->name('admin.contact.message');
Route::get('/admin/contact/messages/delete/{id}', [ContactController::class, 'AdminDeleteContactMessages']);

// Home Contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

//    $users = User::all();

//    $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');
