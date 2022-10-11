<?php

use Illuminate\Support\Facades\Route;

use App\Models\TheLoai;

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminAjaxController;
use App\Http\Controllers\AdminTheLoai;
use App\Http\Controllers\AdminLoaiTin;
use App\Http\Controllers\AdminTinTuc;
use App\Http\Controllers\AdminSlide;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BaiVietController;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AppHomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Comment;

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

// ADMIN PAGES SIDE:
Route::get('admin/login', [AdminUserController::class, 'getLoginCms']);
Route::post('admin/login', [AdminUserController::class, 'postLoginCms']);
Route::get('admin/logout', [AdminUserController::class, 'getLogoutCms']);
// ADMIN PAGES SIDE GROUP:
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

    // Home Zone:
    Route::get('/', [AdminHomeController::class, 'index']);
    Route::get('/trang-chu', [AdminHomeController::class, 'index']);
    Route::get('/index', [AdminHomeController::class, 'index']);
    Route::get('/home', [AdminHomeController::class, 'index']);

    // ajax
    Route::group(['prefix' => 'ajax'], function() {
        Route::get('/loaitin/{idTheLoai}', [AdminAjaxController::class, 'getLoaiTinByIdTheLoai']);
    });

    // user
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [AdminUserController::class, 'getList']);
        Route::get('/list', [AdminUserController::class, 'getList']);
        Route::get('add', [AdminUserController::class, 'getAdd']);
        Route::post('add', [AdminUserController::class, 'postAdd']);
        Route::get('edit/{id}', [AdminUserController::class, 'getEdit']);
        Route::post('edit/{id}', [AdminUserController::class, 'postEdit']);
        Route::get('delete/{id}', [AdminUserController::class, 'getDelete']);
    });

    // theloai
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('/', [AdminTheLoai::class, 'getList']);
        Route::get('list', [AdminTheLoai::class, 'getList']);
        Route::get('add', [AdminTheLoai::class, 'getAdd']);
        Route::post('add', [AdminTheLoai::class, 'postAdd']);
        Route::get('edit/{id}', [AdminTheLoai::class, 'getEdit']);
        Route::post('edit/{id}', [AdminTheLoai::class, 'postEdit']);
        Route::get('delete/{id}', [AdminTheLoai::class, 'getDelete']);
    });

    // loaitin
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('/', [AdminLoaiTin::class, 'getList']);
        Route::get('list', [AdminLoaiTin::class, 'getList']);
        Route::get('add', [AdminLoaiTin::class, 'getAdd']);
        Route::post('add', [AdminLoaiTin::class, 'postAdd']);
        Route::get('edit/{id}', [AdminLoaiTin::class, 'getEdit']);
        Route::post('edit/{id}', [AdminLoaiTin::class, 'postEdit']);
        Route::get('delete/{id}', [AdminLoaiTin::class, 'getDelete']);
    });

    // tintuc
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('/', [AdminTinTuc::class, 'getList']);
        Route::get('/list', [AdminTinTuc::class, 'getList']);
        Route::get('add', [AdminTinTuc::class, 'getAdd']);
        Route::post('add', [AdminTinTuc::class, 'postAdd']);
        Route::get('edit/{id}', [AdminTinTuc::class, 'getEdit']);
        Route::post('edit/{id}', [AdminTinTuc::class, 'postEdit']);
        Route::get('delete/{id}', [AdminTinTuc::class, 'getDelete']);
    });

    // comment
    Route::group(['prefix' => 'comment'], function () {
        Route::get('delete/{id}/{idTinTuc}', [Comment::class, 'getDelete']);
    });

    // slide
    Route::group(['prefix' => 'slide'], function () {
        Route::get('/', [AdminSlide::class, 'getList']);
        Route::get('/list', [AdminSlide::class, 'getList']);
        Route::get('add', [AdminSlide::class, 'getAdd']);
        Route::post('add', [AdminSlide::class, 'postAdd']);
        Route::get('edit/{id}', [AdminSlide::class, 'getEdit']);
        Route::post('edit/{id}', [AdminSlide::class, 'postEdit']);
        Route::get('delete/{id}', [AdminSlide::class, 'getDelete']);
    });
});

// FORM EXAMPLE:
// Route::get('/form', function () {
//     return view('user.form');
// });
// Route::post('/form', ['uses' => 'MyController@postForm'])
// ->name('postForm');

// LIBS PAGES EXAMPLE:
// Route::get('threejs/{name}', function ($name) {
//     return view('libs.threejs.pages.'.$name);
// });

// REDIRECT - CALLBACK SOCIALITE PAGES EXAMPLE:
// Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
// Route::get('/callback/{provider}', 'SocialController@callback');

// AUTH:
// Auth::routes();

// USER PAGES SIDE:
// App Zone:
Route::get('/', [AppController::class, 'index'])->name('app');
Route::get('/trang-chu', [AppController::class, 'index']);
Route::get('/index', [AppController::class, 'index']);
Route::get('/home', [AppController::class, 'index']);

// Bài viết Zone:
Route::get('/bai-viet', [BaiVietController::class, 'index'])->name('bai-viet');
// Home Zone:
// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'app'], function () {
    Route::resource('/', AppHomeController::class);
});

Route::group(['prefix' => 'api'], function () {
    Route::resource('users', UserController::class);
});

// đón tất cả
Route::view('/{any}', 'pages.app')
    ->where('any', '.*');
