<?php

use App\Http\Controllers\ExcelUploadSystemController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
})->name('home');

Route::get('/export-users', [UsersController::class, 'exportUsers'])->name('exportUsers');
Route::post('/upload-users', [UsersController::class, 'importUsers'])->name('uploadUsers');
Route::get('/refresh-database', function () {
    Artisan::call('migrate:fresh');

    return redirect()->route('home');
})->name('refreshDatabase');

Route::prefix('excel-upload-system')->group(function () {
    Route::get('/', [ExcelUploadSystemController::class, 'index'])->name('eus.index');
    Route::post('/generate', [ExcelUploadSystemController::class, 'generateRandomUsers'])
        ->name('eus.generateExcelFile');
});
