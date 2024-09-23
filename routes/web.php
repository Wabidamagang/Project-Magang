<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RequestController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {
  Route::prefix('admin')->group(function(){
  Route::get('/dashboard', [DashboardController::class, 'index']);
  
  Route::middleware(['peran:kaprodi'])->group(function () {
  //Kaprodi
  Route::get('/kaprodi', [KaprodiController::class, 'index']);
  Route::get('/kaprodi/create', [KaprodiController::class, 'create']);
  Route::post('/kaprodi/store', [KaprodiController::class, 'store']);
  Route::get('/kaprodi/edit/{id}', [KaprodiController::class, 'edit']);
  Route::post('/kaprodi/update/{id}', [KaprodiController::class, 'update']);
  Route::get('/kaprodi/show/{id}', [KaprodiController::class, 'show']);
  Route::get('/kaprodi/delete/{id}', [KaprodiController::class, 'destroy']);

  //Kelas
  Route::get('/kelas', [KelasController::class, 'index']);
  Route::get('/kelas/create', [KelasController::class, 'create']);
  Route::post('/kelas/store', [KelasController::class, 'store']);
  Route::get('/kelas/edit/{id}', [KelasController::class, 'edit']);
  Route::post('/kelas/update/{id}', [KelasController::class, 'update']);
  Route::get('/kelas/delete/{id}', [KelasController::class, 'destroy']);
  Route::get('/kelas/show/{id}', [KelasController::class, 'show'])->name('kelas.show');
  Route::post('/kelas/{kelas_id}/mahasiswa', [KelasController::class, 'addMahasiswaToKelas'])->name('kelas.add.mahasiswa');
  Route::get('/kelas/{id}/add-mahasiswa', [KelasController::class, 'addMahasiswa'])->name('kelas.addMahasiswa');
  Route::post('/kelas/{id}/store-mahasiswa', [KelasController::class, 'storeMahasiswa'])->name('kelas.storeMahasiswa');
  Route::post('/kelas/{kelas}/plot', [KelasController::class, 'plot'])->name('kelas.plot');
  Route::get('/kelas/{kelas}/plot', [KelasController::class, 'showPlotForm'])->name('kelas.plot.form');

  //Dosen
  Route::get('/dosen', [DosenController::class, 'index']);
  Route::get('/dosen/create', [DosenController::class, 'create']);
  Route::post('/dosen/store', [DosenController::class, 'store']);
  Route::get('/dosen/edit/{id}', [DosenController::class, 'edit']);
  Route::post('/dosen/update/{id}', [DosenController::class, 'update']);
  Route::get('/dosen/show/{id}', [DosenController::class, 'show']);
  Route::get('/dosen/delete/{id}', [DosenController::class, 'destroy']);

});

Route::middleware(['peran:dosen'])->group(function () {
  Route::post('request/store', [RequestController::class, 'store'])->name('request.store');
  Route::get('/request', [RequestController::class, 'index'])->name('request.index');
  Route::get('/request/approve/{id}', [RequestController::class, 'approve'])->name('request.approve');
  Route::get('/request/reject/{id}', [RequestController::class, 'reject'])->name('request.reject');

  //Mahasiswa
  Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
  Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']);
  Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
  Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit']);
  Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
  Route::get('/mahasiswa/show/{id}', [MahasiswaController::class, 'show']);
  Route::get('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy']);
});

Route::middleware(['peran:kaprodi-dosen-mahasiswa'])->group(function () {
  // View only route for Mahasiswa list
  Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
  Route::post('request/store', [RequestController::class, 'store'])->name('request.store');
  Route::get('/request', [RequestController::class, 'index'])->name('request.index');
  Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit']);
  Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
});
});
});

  //Check Dosen Wali
  Route::group(['middleware' => 'check.dosen.wali'], function() {
  Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
  Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']);
  Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
  Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit']);
  Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
  Route::get('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
