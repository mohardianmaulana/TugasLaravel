<?php
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('home_page');
// });
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home_page');
Route::get('/user', [HomeController::class, 'index2'])->name('flowers.homeuser');
Route::post('/flowers/{id}/beli', [HomeController::class, 'beli'])->name('flowers.beli');
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index1'])->name('flowers.home');
    Route::post('/admin', [HomeController::class, 'store']) ->name("flowers.store");
    Route::get('/admin/create', [HomeController::class, 'create'])->name('flowers.create');
    Route::get('/admin/{flowers}/edit', [HomeController::class, 'edit']) ->name("flowers.edit");
    Route::post('/admin/{flowers}', [HomeController::class, 'update']) ->name("flowers.update");
    Route::delete('/admin/{flowers}', [HomeController::class, 'destroy']) ->name("flowers.destroy");
});