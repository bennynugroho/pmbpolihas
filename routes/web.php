<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BiayaController;
use App\Http\Controllers\Admin\JalurMasukController;
use App\Http\Controllers\Admin\KelasController;
use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\RekomendasiController;
use App\Http\Controllers\Admin\SeleksiController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PersyaratanController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\SumberInfoController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\PendaftaranController As AdminPendaftaranController;
use App\Http\Controllers\Admin\ChatBotController As AdminChatBotController;

// Beranda
use App\Http\Controllers\Beranda\BerandaController;
use App\Http\Controllers\Beranda\ChatBotController As BerandaChatBotController;
use App\Http\Controllers\Beranda\PendaftaranController As BerandaPendaftaranController;
use App\Http\Controllers\PrintController;

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

// Auth
Route::get('/kuliah-aja', [AuthController::class, 'login'])->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('auth.post.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('pesan', PesanController::class);
    Route::resource('rekomendasi', RekomendasiController::class);
    Route::resource('kurikulum', KurikulumController::class);
    Route::resource('kontak', KontakController::class);
    Route::resource('syarat', PersyaratanController::class);
    Route::resource('jalur', JalurMasukController::class);
    Route::resource('biaya', BiayaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('sumber_info', SumberInfoController::class);
    Route::resource('chat', AdminChatBotController::class);
    
    // Pendaftar
    Route::resource('pendaftar', AdminPendaftaranController::class);
    Route::get('/table-pendaftar', [AdminPendaftaranController::class, 'showPendaftarTable']);
    Route::get('/status-pendaftar', [AdminPendaftaranController::class, 'updateStatus']);

    // Tahun Akademik
    Route::resource('tahun_akd', TahunAkademikController::class);
    Route::get('/status-tahun', [TahunAkademikController::class, 'updateStatus']);

    // Prodi
    Route::resource('prodi', ProdiController::class);
    Route::get('/createSlug/{prodi}', [ProdiController::class, 'createSlug']);

    // Seleksi
    Route::resource('seleksi', SeleksiController::class);
    Route::get('/table-seleksi', [SeleksiController::class, 'showSeleksiTable']);
    Route::get('/export-seleksi', [SeleksiController::class, 'export_seleksi']);

    // pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index']);

    // Akun Admin
    Route::get('/edit-akun', [AdminController::class, 'showEditAkun'])->name('admin.edit.akun');
    Route::post('/update-akun', [AdminController::class, 'updateAkun'])->name('admin.update.akun');

    // Info Pendaftaran
    Route::get('/info-daftar', [AdminController::class, 'showEditInfo'])->name('admin.edit.info');
    Route::post('/update-daftar', [AdminController::class, 'updateInfoDaftar'])->name('admin.update.info');

    // Formulir Pendaftaran
    Route::get('/edit-formulit', [AdminController::class, 'showEditFormulir'])->name('admin.edit.formulir');
    Route::post('/update-formulir', [AdminController::class, 'updateFormulir'])->name('admin.update.formulir');
});

// Download formulir pendaftaran
Route::get('/cetak-formulir/{email}', [PrintController::class, 'printFormulir'])->name('download.formulir');

// Beranda
Route::get('/', [BerandaController::class, 'index']);
Route::get('/jalur-masuk', [BerandaController::class, 'jalur_masuk']);
Route::get('/pengumuman', [BerandaController::class, 'pengumuman']);
Route::get('/prodi', [BerandaController::class, 'prodi']);
Route::get('/prodi/{slug}', [BerandaController::class, 'kurikulum']);
Route::get('/hubungi', [BerandaController::class, 'contact']);
Route::post('/kirimpesan', [BerandaController::class, 'kirimPesan'])->name('kirim.pesan');
Route::get('/registration-success/{email}', [BerandaController::class, 'registration_success']);
Route::get('/answer-chat/{id}', [BerandaChatBotController::class, 'getAnswer']);

Route::resource('/pendaftaran', BerandaPendaftaranController::class);