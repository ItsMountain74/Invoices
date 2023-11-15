<?php

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UsersController;
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
    return view('auth.login');
});

Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/makeAdmin/{id}', [UsersController::class, 'makeAdmin'])->name('makeAdmin');
Route::get('/users/makeUser/{id}', [UsersController::class, 'makeUser'])->name('makeUser');
Route::delete('/users/delete', [UsersController::class, 'destroy'])->name('userDelete');
Route::get('/section/{id}', [SectionsController::class, 'getproducts']);
Route::resource('/invoices', InvoicesController::class);
Route::resource('/section', SectionsController::class);
Route::resource('/products', ProductController::class);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/pay_now/{id}', [InvoicesController::class, 'pay_now'])->name('pay_now');
Route::get('/pay/{id}', [InvoicesController::class, 'pay'])->name('pay');
Route::get('paidInvoices' , [InvoicesController::class,'paid'])->name('paid');
Route::get('nonPaidInvoices' , [InvoicesController::class,'nonPaid'])->name('nonPaidInvoices');
Route::get('partialPaidInvoices' , [InvoicesController::class,'partialPaid'])->name('partialPaidInvoices');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Route::get('/{page}', [\App\Http\Controllers\AdminController::class,'index']);
require __DIR__ . '/auth.php';
