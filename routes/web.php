<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['xcomponent' => "applicant"]);
    })->name('dashboard');

    Route::get('/requests', function () {
        return view('dashboard', ['xcomponent' => 'requests']);
    })->name('requests');

    Route::get('/resource', function () {
        return view('dashboard', ['xcomponent' => 'resources']);
    })->name('resources');
    
    Route::get('/nomenclature', function () {
        return view('dashboard', ['xcomponent' => 'nomenclature']);
    })->name('nomenclature');
});