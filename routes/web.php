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

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home', function () {
    return redirect('/dashboard');
});

// Route::get('/{vue_capture?}', function () {
//     return view('home');
// })->where('vue_capture', '[\/\w\.-]*')->middleware('auth');

// Route::any('/{slug?}', [HomeController::class, 'index'])->where('slug', '[\/\w\.-]*')->name('home');

@include_once('admin_web.php');

Route::get('/', function () {
    return redirect()->route('index');
})->name('/');

Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');

Route::prefix('dashboard')->group(function () {
    Route::view('/', 'admin.dashboard.default')->name('index');
    Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
});

Route::view('default-layout', 'multiple.default-layout')->name('default-layout');
Route::view('compact-layout', 'multiple.compact-layout')->name('compact-layout');
Route::view('modern-layout', 'multiple.modern-layout')->name('modern-layout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
