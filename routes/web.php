<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KMeansController;

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
    route::post('/simpan-santri', [SantriController::class,'store'])->name('simpan-santri');
    route::get('/edit-santri/{id}', [SantriController::class,'edit'])->name('edit-santri');
    route::post('/update-santri/{id}', [SantriController::class,'update'])->name('update-santri');
    route::get('/delete-santri/{id}', [SantriController::class,'destroy'])->name('delete-santri');

    route::get('/aktiv-santri', [SantriController::class,'indexaktiv'])->name('aktiv-santri');
    route::get('/editaktiv-santri/{id}', [SantriController::class,'editaktiv'])->name('editaktiv-santri');
    route::post('/updateaktiv-santri/{id}', [SantriController::class,'updateaktiv'])->name('updateaktiv-santri');
    route::get('/clearaktiv-santri/{id}', [SantriController::class,'destroyaktiv'])->name('clearaktiv-santri');

    route::get('/data-user', [UserController::class,'index'])->name('data-user');
    route::get('/tambah-user', [UserController::class,'create'])->name('tambah-user');
    route::post('/simpan-user', [UserController::class,'store'])->name('simpan-user');
    route::get('/edit-user/{id}', [UserController::class,'edit'])->name('edit-user');
    route::post('/update-user/{id}', [UserController::class,'update'])->name('update-user');
    route::get('/delete-user/{id}', [UserController::class,'destroy'])->name('delete-user');

    route::get('/atribut', [KMeansController::class,'atribut'])->name('atribut');
    route::get('/preprocessing', [KMeansController::class,'preprocessing'])->name('preprocessing');
    route::get('/iterasi1', [KMeansController::class,'iterasi1'])->name('iterasi1');
});
