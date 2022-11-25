<?php

use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrashController;
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

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::redirect('/home', '/dashboard');
Route::redirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/trash', [TrashController::class, 'index'])->name('trash');

// Route::middleware('auth')->get('/dashboard', function () {
//     return view('pages.dashboard.index', $data = [
//         'page' => 'dashboard'
//     ]);
// })->name('dashboard');


Route::middleware('auth')->get('/folders/test', function () {
    return view('pages.dashboard.inner-folder.index', $data = [
        'page' => 'dashboard'
    ]);
})->name('dashboard.inner');



// Route::middleware('auth')->get('/trash', function () {
//     return view('pages.trash.index', $data = [
//         'page' => 'trash'
//     ]);
// })->name('trash');

Route::middleware('auth')->get('/trash/test', function () {
    return view('pages.trash.inner-folder.index', $data = [
        'page' => 'trash'
    ]);
})->name('trash.inner');


Route::middleware('auth')->get('/shared', function () {
    return view('pages.shared.index', $data = [
        'page' => 'shared'
    ]);
})->name('shared');

Route::middleware('auth')->get('/shared/test', function () {
    return view('pages.shared.inner-folder.index', $data = [
        'page' => 'shared'
    ]);
});


Route::controller(ManageUsersController::class)->prefix('admin/users')->middleware('role:admin', 'auth')->group(function () {
    Route::get('', 'index')->name('manageusers.index');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
