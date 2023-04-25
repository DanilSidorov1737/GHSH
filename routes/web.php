<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/repo/new', [App\Http\Controllers\ReposController::class, 'new'])->name('repos.new');

Route::post('/repo/upload', [App\Http\Controllers\ReposController::class, 'upload'])->name('repos.upload');

Route::post('/repos/upload/add/{repo_name}', [App\Http\Controllers\ReposController::class, 'add'])->name('repos.add');

Route::get('/repo/{name}', [App\Http\Controllers\ReposController::class, 'show'])->name('repos.show');

Route::delete('/files/{id}', [App\Http\Controllers\FilesController::class, 'destroy'])->name('files.destroy');
