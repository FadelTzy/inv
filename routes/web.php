<?php

use App\Http\Controllers\API\CAIUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\RiwayatnotifController;
use App\Http\Controllers\TipeInvestController;
use App\Http\Controllers\PengajuanInvestasiController;
use App\Http\Controllers\RiwayatInvestController;
use App\Http\Controllers\SaldoUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RedeemcodeController;
use App\Http\Controllers\BankuserController;
use App\Http\Controllers\InforasiController;
use App\Http\Controllers\PengaturanController;

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

// Route::get('/', 'Controller@index')->name('admin.dash');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('apiregister', [CAIUser::class, 'store']);
Route::post('apilogintesting', [CAIUser::class, 'login']);
Route::post('apideposit', [CAIUser::class, 'deposit']);
Route::get('apigetbanks', [CAIUser::class, 'getbanks']);
Route::get('apigettipeinvest', [CAIUser::class, 'gettipeinvests']);
Route::get('token', [CAIUser::class, 'token']);
Route::get('apigetuser/{id}', [CAIUser::class, 'getuser']);
Route::get('apigetriwayatdepo/{id}', [CAIUser::class, 'getriwayatdepo']);
Route::post('apiupdaterekening', [CAIUser::class, 'updaterekening']);
Route::post('apiwithdraw', [CAIUser::class, 'withdraw']);
Route::post('apiinvestasi', [CAIUser::class, 'investasi']);
Route::get('apigetinvestasi/{id}', [CAIUser::class, 'getinvestasi']);
Route::post('apipostbank', [CAIUser::class, 'postbankuser']);
Route::get('apigetbankuser/{id}', [CAIUser::class, 'getbankuser']);
Route::get('apigethistorybunga/{id}', [CAIUser::class, 'gethistorybunga']);
Route::post('apipostredeemcode', [CAIUser::class, 'postredeemcode']);
Route::get('apigetafiliasi/{id}', [CAIUser::class, 'afiliasi']);
Route::post('apipostuser', [CAIUser::class, 'postuser']);

Route::post('/tes', [SaldoUserController::class, 'tes']);
Route::get('/gettes/{id}', [SaldoUserController::class, 'gettes']);

// Route::get('/dashboard', [CAIUser::class, 'dashboard']);

Route::group(['middleware' => ['auth','notif']], function () {
    Route::get('/admin', [Controller::class, 'index'])->name('admin');
    Route::get('/data-investor', [Controller::class, 'investor'])->name('investor.index');
    Route::get('/data-investor/export', [Controller::class, 'export'])->name('investor.export');
    Route::post('/data-investor/referal', [Controller::class, 'referal'])->name('investor.referal');
    Route::get('/data-investor/rekening/{id}', [BankuserController::class, 'rekening']);

    Route::post('/data-investor', [Controller::class, 'investorstore'])->name('investor.store');
    Route::post('/data-investorktp', [Controller::class, 'investorktpstore'])->name('investorktp.store');

    Route::post('/data-investor/update', [Controller::class, 'investorupdate'])->name('investor.update');
    Route::delete('/data-investor/{id}', [Controller::class, 'investorhapus'])->name('investor.destroy');
    Route::post('/data-investor/{id}/aktif', [Controller::class, 'investoraktif']);

    Route::get('/data-admin', [Controller::class, 'admin'])->name('admin.index');
    Route::post('/data-admin', [Controller::class, 'adminstore'])->name('admin.store');
    Route::post('/data-admin/update', [Controller::class, 'adminupdate'])->name('admin.update');
    Route::delete('/data-admin/{id}', [Controller::class, 'adminhapus'])->name('admin.destroy');

    Route::get('/data-notif', [NotifController::class, 'notif'])->name('notif.index');
    Route::post('/data-notif', [NotifController::class, 'notifstore'])->name('notif.store');
    Route::post('/data-notif/update', [NotifController::class, 'notifupdate'])->name('notif.update');
    Route::delete('/data-notif/{id}', [NotifController::class, 'notifhapus'])->name('notif.destroy');

    //saldo-admin
    Route::get('/saldo-admin', [DepositController::class, 'saldoadmin'])->name('saldoadmin.index');


    //riwayatnotif
    Route::get('/riwayat-notif', [RiwayatnotifController::class, 'notif'])->name('riwayatnotif.index');
    Route::delete('/riwayat-notif/{id}', [RiwayatnotifController::class, 'notifhapus'])->name('riwayatnotif.destroy');

    //notif
    Route::get('/notif/ps', [RiwayatnotifController::class, 'ps'])->name('notif.ps');

    Route::get('/notif/pw', [RiwayatnotifController::class, 'pw'])->name('notif.pw');
    Route::get('/notif/depo', [RiwayatnotifController::class, 'depo'])->name('notif.depo');
    

    //saldo-user
    Route::get('/saldo-user', [DepositController::class, 'saldo'])->name('saldo.index');
    //pengajuan

    Route::get('/saldo-user/{id}', [PengajuanInvestasiController::class, 'pengajuan'])->name('pengajuan.index');
    Route::get('/saldo-user/{id}/export', [PengajuanInvestasiController::class, 'exportt'])->name('pengajuan.export');

    Route::post('/saldo-user/pengajuan-investasi', [PengajuanInvestasiController::class, 'store'])->name('pengajuan.store');
    Route::post('/saldo-user/pengajuan-investasi/edit', [PengajuanInvestasiController::class, 'edit'])->name('pengajuan.edit');
    Route::delete('/saldo-user/pengajuan-investasi/{id}', [PengajuanInvestasiController::class, 'destroy'])->name('pengajuan.destroy');
    Route::delete('/saldo-user/pengajuan-investasi/delete/{id}', [PengajuanInvestasiController::class, 'delete'])->name('pengajuan.delete');

    //websetting
    Route::get('/informasi', [InforasiController::class, 'index'])->name('informasi.admin');
    Route::get('/informasi/create', [InforasiController::class, 'create'])->name('informasi.create');
    Route::get('/informasi/edit/{id}', [InforasiController::class, 'edit'])->name('informasi.edit');

    Route::post('/informasi', [InforasiController::class, 'post'])->name('storei.info');
    Route::post('/informasi/update', [InforasiController::class, 'update'])->name('storei.update');

    //websetting
    Route::post('/pengaturan/informasi', [PengaturanController::class, 'storeinformasi'])->name('store.info');
    Route::post('/pengaturansaldo', [PengaturanController::class, 'storesaldo'])->name('pengaturan.saldo');
    Route::post('/pengaturan/kontak', [PengaturanController::class, 'storekontak'])->name('pengaturan.kontak');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('setitng.admin');
    //tagihan
    Route::post('/saldo-user/tagihan', [PengajuanInvestasiController::class, 'tagihan'])->name('pengajuan.tagihan');
    Route::post('/saldo-user/verifikasi', [PengajuanInvestasiController::class, 'verifikasi'])->name('pengajuan.verifikasi');

    //wd
    Route::get('/saldo-user/{id}/wd', [PengajuanInvestasiController::class, 'wd'])->name('wd.index');
    Route::post('/saldo-user/wd', [PengajuanInvestasiController::class, 'storewd'])->name('wd.storewd');

    //depo
    Route::post('/deposit', [RiwayatInvestController::class, 'depo'])->name('depo.store');
    Route::get('/riwayat-depo/{id}', [RiwayatInvestController::class, 'riwayat'])->name('depo.riwayat');
    Route::get('/riwayat-penarikan/{id}', [RiwayatInvestController::class, 'riwayatpenarikan']);

    Route::delete('/riwayat-depo/{id}', [RiwayatInvestController::class, 'destroy'])->name('depo.destroy');
    Route::post('/riwayat-depo/verif/{id}', [RiwayatInvestController::class, 'verif'])->name('depo.verif');

    //saldouser
    Route::get('/data-saldo', [SaldoUserController::class, 'index'])->name('saldouser.index');
    Route::get('/data-saldo/export', [SaldoUserController::class, 'export'])->name('saldouser.export');

    Route::post('/data-saldo/deposit', [SaldoUserController::class, 'storedepo'])->name('saldouser.store');
    Route::post('/data-saldo/withdraw', [SaldoUserController::class, 'storewithdraw'])->name('withdrawuser.store');
    Route::post('/data-saldo/withdraw/verif', [SaldoUserController::class, 'verifwithdraw'])->name('withdrawuser.verif');

    Route::delete('/data-saldo/reset/{id}', [SaldoUserController::class, 'reset']);
    //bonus referal
    Route::get('/data-saldo/bonus-referal/{id}', [DepositController::class, 'referal']);
    Route::get('/afiliasi', [DepositController::class, 'afiliasi'])->name('afiliasi');
    //redeem
    Route::get('/data-saldo/redeem-code/{id}', [RedeemcodeController::class, 'history']);
    Route::post('/data-saldo/redeem-code', [RedeemcodeController::class, 'rs'])->name('redeemcode.store');
    Route::delete('/data-saldo/redeem-code/{id}', [RedeemcodeController::class, 'deleteredeem']);

    //depouser
    Route::get('/data-saldo/riwayat-deposit/{id}', [DepositController::class, 'riwayat']);
    Route::post('/data-saldo/depo-saldo', [DepositController::class, 'depo']);

    Route::delete('/data-saldo/riwayat-deposit/{id}', [DepositController::class, 'delete']);
    //wduser
    Route::get('/data-saldo/riwayat-wd/{id}', [DepositController::class, 'riwayatwd']);
    Route::delete('/data-saldo/riwayat-wd/{id}', [DepositController::class, 'deletewd']);

    //tagihan
    //data-master
    //jenisinver
    Route::prefix('data-master')->group(function () {
        Route::get('/jenis-investasi', [TipeInvestController::class, 'index'])->name('jenisinvest.index');
        Route::post('/jenis-investasi', [TipeInvestController::class, 'store'])->name('jenisinvest.store');
        Route::post('/jenis-investasi/update', [TipeInvestController::class, 'edit'])->name('jenisinvest.update');
        Route::delete('/jenis-investasi/{id}', [TipeInvestController::class, 'destroy'])->name('jenisinvest.destroy');

        //bank
        Route::get('/penerima', [BankController::class, 'index'])->name('penerima.index');
        Route::post('/penerima', [BankController::class, 'store'])->name('penerima.store');
        Route::post('/penerima/update', [BankController::class, 'edit'])->name('penerima.update');
        Route::delete('/penerima/{id}', [BankController::class, 'destroy'])->name('penerima.destroy');

        //redeem
        Route::get('/redeem-code', [RedeemcodeController::class, 'index'])->name('redeem.index');
        Route::post('/redeem-code', [RedeemcodeController::class, 'store'])->name('redeem.store');
        Route::post('/redeem-code/update', [RedeemcodeController::class, 'edit'])->name('redeem.update');
        Route::delete('/redeem-code/{id}', [RedeemcodeController::class, 'destroy'])->name('redeem.destroy');
    });

    Route::get('/profil', [Controller::class, 'profil']);
    Route::post('/profil', [Controller::class, 'storeprofil']);
});
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/registrasi', function () {
    return view('registrasi');
})->name('registrasi');

require __DIR__ . '/auth.php';
