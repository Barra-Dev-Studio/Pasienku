<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Models\Registration;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\ServerBag;

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

Route::get('/', [HomeController::class, 'welcome']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('setting_page');
        Route::post('/saveUser', [SettingController::class, 'saveUser'])->name('save_user');
        Route::post('/savePassword', [SettingController::class, 'savePassword'])->name('save_password');
        Route::post('/savePhotoProfile', [SettingController::class, 'savePhotoProfile'])->name('save_photo_profile');
    });

    Route::prefix('item')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('item_page');
        Route::get('/list', [ItemController::class, 'list'])->name('item_list');
        Route::post('store', [ItemController::class, 'store'])->name('item_store');
        Route::post('update', [ItemController::class, 'update'])->name('item_update');
        Route::delete('delete', [ItemController::class, 'delete'])->name('item_delete');
        Route::post('/itemSelect', [ItemController::class, 'itemSelect'])->name('item_list_select');
        Route::post('/itemDetail', [ItemController::class, 'itemDetail'])->name('item_detail');
        Route::get('{id}/detail', [ItemController::class, 'show'])->name('item_show');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('stock_page');
        Route::get('/list', [StockController::class, 'list'])->name('stock_list');
        Route::post('store', [StockController::class, 'store'])->name('stock_store');
        Route::post('update', [StockController::class, 'update'])->name('stock_update');
        Route::delete('delete', [StockController::class, 'delete'])->name('stock_delete');
    });

    Route::prefix('registration')->group(function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('registration_page');
        Route::get('/list', [RegistrationController::class, 'indexlist'])->name('registration_list');
        Route::post('/listData', [RegistrationController::class, 'list'])->name('registration_list_data');
        Route::post('registerNewPatient', [RegistrationController::class, 'registerNewPatient'])->name('register_new_patient');
        Route::post('registerOldPatient', [RegistrationController::class, 'registerOldPatient'])->name('register_old_patient');
        Route::post('/history', [RegistrationController::class, 'history'])->name('register_history');
        Route::get('{id}/detail', [RegistrationController::class, 'show'])->name('registration_show');
    });

    Route::prefix('diagnosis')->group(function () {
        Route::post('updateOrCreate', [DiagnosisController::class, 'updateOrCreate'])->name('diagnosis_store');
    });

    Route::prefix('patient')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('patient_page');
        Route::get('/{id}/detail', [PatientController::class, 'show'])->name('patient_show');
        Route::post('list', [PatientController::class, 'list'])->name('patient_data_list');
        Route::post('update', [PatientController::class, 'update'])->name('patient_update');
        Route::post('getListPatients', [PatientController::class, 'getListPatients'])->name('patient_list');
        Route::post('getPatient', [PatientController::class, 'getPatient'])->name('patient_get');
    });

    Route::prefix('prescription')->group(function () {
        Route::post('/store', [PrescriptionController::class, 'store'])->name('prescription_store');
    });

    Route::prefix('billing')->group(function () {
        Route::post('updateMultiple', [BillingController::class, 'updateMultiple'])->name('update_multiple_billing');
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin_user_page');
            Route::post('detail', [UserController::class, 'detail'])->name('admin_user_detail');
            Route::post('list', [UserController::class, 'list'])->name('admin_user_list');
            Route::post('update', [UserController::class, 'update'])->name('admin_user_update');
            Route::delete('delete', [UserController::class, 'delete'])->name('admin_user_delete');
        });
    });
});
