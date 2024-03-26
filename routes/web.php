<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


route::get('/login', [LoginController::class,'halamanlogin'])->name('login');
route::post('/postlogin', [LoginController::class,'postlogin'])->name('postlogin');
route::get('/logout', [LoginController::class,'logout'])->name('logout');


route::group(['middleware'=>['auth','ceklevel:admin,operator']], function () {
    //route::get('/', [HomeController::class,'index'])->name('home');
    route::get('/home', [HomeController::class,'index'])->name('home');
    route::get('/register', [LoginController::class,'register'])->name('register');
    route::post('/simpanregister', [LoginController::class,'simpanregister'])->name('simpanregister');
    route::get('/data-santri', [SantriController::class,'index'])->name('data-santri');
    route::get('/tambah-santri', [SantriController::class,'create'])->name('tambah-santri');
    route::get('/edit-santri', [SantriController::class,'edit'])->name('edit-santri');
    route::post('/simpan-santri', [SantriController::class,'store'])->name('simpan-santri');
    route::get('/aktiv-santri', [SantriController::class,'indexaktiv'])->name('aktiv-santri');
    route::get('/data-user', [UserController::class,'index'])->name('data-user');
});
