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
|MBQaI8R5
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 
])->group(function () {

    Route::get('/', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else {
                        if (auth()->user()->role==3){
                        return redirect()->route('dashboard');
                    }  else  {
                        return redirect()->route('requests');
                    }   
                }
})->name('home');

    Route::get('/dashboard', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else {
        if (auth()->user()->role<>3){   return redirect()->route('requests');    } 

        return view('dashboard', ['xcomponent' => "applicant"]);
        }
    })->name('dashboard');

    Route::get('/requests', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else {
        if (auth()->user()->role==3){
            return redirect()->route('dashboard');
        }
        return view('dashboard', ['xcomponent' => 'requests']);
        }
    })->name('requests');

    Route::get('/resource', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else {
        if (auth()->user()->role==3){
            return redirect()->route('dashboard');
        }
        return view('dashboard', ['xcomponent' => 'resources']);
        }
    })->name('resources');
    
    Route::get('/nomenclature', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else {
        if (auth()->user()->role==3){
            return redirect()->route('dashboard');
        }
            return view('dashboard', ['xcomponent' => 'nomenclature']);
        }
    })->name('nomenclature');

    Route::get('/user', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else { 
        if (auth()->user()->role==3){
            return redirect()->route('user');
        }
        return view('dashboard', ['xcomponent' => 'users']);
    }
    })->name('user');

    Route::get('/review', function () {
        if (auth()->user()->active==0){
            return view('Intactive');
        } else { 
                if (auth()->user()->role==3){
                return redirect()->route('review');
            }
                return view('dashboard', ['xcomponent' => 'review']);
        }
    })->name('review');
});

Route::middleware([
    //'signed', 
])->group(function () {

    Route::get('/UploadReference', function () {
        return view('upload-reference');
    })->name('UploadReference');
});