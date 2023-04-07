<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Backend\Dashboard;
use App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\AdminRole;
use App\Http\Controllers\Backend\AdminLog;
use App\Http\Controllers\Auth\AuthController;

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

Route::redirect('/cms', '/cms/dashboard.vsp');
//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('login', [AuthController::class, 'showLogin'])->name('show-login');
Route::post('login', [AuthController::class, 'login'])->name('login');


Route::middleware([
    'auth',
])->group(function () {

    Route::get('/cms/dashboard.vsp', [Dashboard::class, 'index']);
    Route::match(['GET','POST'],'/cms/quan-tri/danh-sach.vsp', [Admin::class, 'index']);
    Route::match(['GET','POST'],'/cms/quan-tri/danh-sach-da-xoa.vsp', [Admin::class, 'deletedList']);
    Route::match(['GET','POST'],'/cms/quan-tri/them-quan-tri-vien.vsp', [Admin::class, 'create']);
    Route::match(['GET','POST'],'/cms/quan-tri/sua-quan-tri-vien.vsp/{slug}-{id}', [Admin::class, 'update']);
    Route::post('/cms/quan-tri/xoa-quan-tri-vien.vsp/{id}', [Admin::class, 'delete']);
    Route::post('/cms/quan-tri/huy-quan-tri-vien.vsp/{id}', [Admin::class, 'remove']);
    Route::post('/cms/quan-tri/khoi-phuc-quan-tri-vien.vsp/{id}', [Admin::class, 'restore']);
    Route::post('/cms/quan-tri/logout.vsp', [Admin::class, 'logout']);

    Route::match(['GET','POST'],'/cms/quan-tri/chuc-danh.vsp', [AdminRole::class, 'index']);
    Route::match(['GET','POST'],'/cms/quan-tri/chuc-danh-da-xoa.vsp', [AdminRole::class, 'deletedList']);
    Route::match(['GET','POST'],'/cms/quan-tri/them-chuc-danh.vsp', [AdminRole::class, 'create']);
    Route::match(['GET','POST'],'/cms/quan-tri/sua-chuc-danh.vsp', [AdminRole::class, 'update']);
    Route::post('/cms/quan-tri/xoa-chuc-danh.vsp', [AdminRole::class, 'delete']);
    Route::post('/cms/quan-tri/huy-chuc-danh.vsp', [AdminRole::class, 'remove']);
    Route::post('/cms/quan-tri/khoi-phuc-chuc-danh.vsp', [AdminRole::class, 'restore']);

    Route::match(['GET','POST'],'/cms/quan-tri/lich-su-quan-tri.vsp', [AdminLog::class, 'index']);
    Route::match(['GET','POST'],'/cms/quan-tri/lich-su-da-xoa.vsp', [AdminLog::class, 'deletedList']);
    Route::post('/cms/quan-tri/xoa-lich-su-quan-tri.vsp', [AdminLog::class, 'delete']);
    Route::post('/cms/quan-tri/huy-lich-su-quan-tri.vsp', [AdminLog::class, 'remove']);
    Route::post('/cms/quan-tri/khoi-phuc-lich-su-quan-tri.vsp', [AdminLog::class, 'restore']);
});

