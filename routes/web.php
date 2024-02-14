<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Models\Transaksi;
use App\Models\Member;
use Carbon\Carbon;

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

//Login
Route::get('/', [AuthController::class, 'index']);
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/dashboard', function () {
    $today = Carbon::today();
    $totalTransaksi = Transaksi::count();
    $totalTransaksiHariIni = Transaksi::whereDate('tgl', $today)->count();
    $totalMember = Member::count();
    $totalPendapatan = Transaksi::all();
    $dataPendapatanHariIni = Transaksi::whereDate('tgl', $today)->get();

    return view('dashboard', [
        'title' => 'Dashboard',
        'totalTransaksi' => $totalTransaksi,
        'totalTransaksiHariIni' => $totalTransaksiHariIni,
        'totalMember' => $totalMember,
        'totalPendapatan' => $totalPendapatan,
        'dataPendapatanHariIni' => $dataPendapatanHariIni
    ]);
});


Route::group(['middleware' => ['auth', 'admin']], function(){
//CRUD Data Outlet
Route::get('/outlet', [OutletController::class, 'index']);
Route::post('/outlet/create', [OutletController::class, 'create']);
Route::post('/outlet/update/{id}', [OutletController::class, 'update']);
Route::get('/outlet/delete/{id}', [OutletController::class, 'delete']);
//CRUD Data Paket
Route::get('/paket', [PaketController::class, 'index']);
Route::post('/paket/create', [PaketController::class, 'create']);
Route::post('/paket/update/{id}', [PaketController::class, 'update']);
Route::get('/paket/delete/{id}', [PaketController::class, 'delete']);
//CRUD Data Member
Route::get('/member', [MemberController::class, 'index']);
Route::post('/member/create', [MemberController::class, 'create']);
Route::post('/member/update/{id}', [MemberController::class, 'update']);
Route::get('/member/delete/{id}', [MemberController::class, 'delete']);
//CRUD Data User
Route::get('/user', [UserController::class, 'index']);
Route::post('/user/create', [UserController::class, 'create']);
Route::post('/user/update/{id}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);
//CRUD Data Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/tambah', [TransaksiController::class, 'create']);
Route::post('/transaksi/store', [TransaksiController::class, 'store']);
Route::get('/transaksi/ubah/{id}', [TransaksiController::class, 'edit']);
Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update']);
Route::get('/transaksi/delete/{id}', [TransaksiController::class, 'delete']);
Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail']);
Route::post('/transaksi/status', [TransaksiController::class, 'status']);
Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar']);
Route::get('/transaksi/struk/{kode_invoice}', [TransaksiController::class, 'struk']);

});

Route::group(['middleware' => ['auth', 'kasir']], function(){
//CRUD Data Member
Route::get('/member', [MemberController::class, 'index']);
Route::post('/member/create', [MemberController::class, 'create']);
Route::post('/member/update/{id}', [MemberController::class, 'update']);
Route::get('/member/delete/{id}', [MemberController::class, 'delete']);
//CRUD Data Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/tambah', [TransaksiController::class, 'create']);
Route::post('/transaksi/store', [TransaksiController::class, 'store']);
Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail']);
Route::post('/transaksi/status', [TransaksiController::class, 'status']);
Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar']);
Route::get('/transaksi/struk', [TransaksiController::class, 'struk'])->name('transaksi.struk');
});

Route::get('/profile', [UserController::class, 'profile']);
Route::post('/profile/update/{id}', [UserController::class, 'pupdate']);
Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan']);
