<?php

use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SumaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    route::resource('users', UserController::class)->names('users');
    Route::get('usuario/datatable', [UserController::class, 'datatable'])->name('user.datatable');

    Route::get('profile/{user}', [UserController::class, 'myProfile'])->name('profile');
    Route::put('profile/update/{user}', [UserController::class, 'myProfileUpdate'])->name('profile.update');

    Route::get('user/search', [UserController::class, 'search'])->name('user.search');
    Route::get('search', [UserController::class, 'formSearch'])->name('form.search');

    route::resource('departaments', DepartamentController::class)->names('departaments');
    Route::get('departamento/datatable', [DepartamentController::class, 'datatable'])->name('departament.datatable');

    Route::get('/sumar/{num1}/{num2}', [SumaController::class, 'sumar']);
});

Auth::routes();
