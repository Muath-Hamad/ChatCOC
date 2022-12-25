<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('adminpage');
// })->middleware(['auth', 'verified'])->name('admin');

// Route::get('/op', function () {
//     return view('operatorpage');
// })->middleware(['auth', 'verified'])->name('operator');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin', [adminpageController::class, 'index'])->name('admin');
    Route::get('/op', [operatorpageController::class, 'index'])->name('operator');
    Route::post('/profile', [UserfileController::class, 'store'])->name('Userfile.store');

});

require __DIR__.'/auth.php';
