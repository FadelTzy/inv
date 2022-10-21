<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\pengajuanInvestasi;
use Akaunting\Money\Money;
use App\Models\Deposit;
use App\Models\User;
use App\Models\saldoAdmin;
use App\Models\saldoUser;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SaldoExport;
use App\Models\Historybunga;
use App\Models\ktp;
use App\Models\Pengaturan;
use App\Models\Realisasi;
use App\Models\Tarikbunga;
use Illuminate\Support\Carbon;
class SaldoUserController extends Controller
{
    // public function tes($id)
    // {
    //     $nowAdate = Date('Y-m-d H:i:s');
    //     $pe = pengajuanInvestasi::with('oRealisasi.oBunga')
    //         ->where('id_user', $id)
    //         ->where('status_investasi', 1)
    //         ->get();
    //     // return $pe;
    //     foreach ($pe as $key => $value) {

    //         // $latestt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->count();
    //         // $thl = $value->oRealisasi->lamapenarikanbunga * $latestt;

    //         $tb = Carbon::parse($value->oRealisasi->tanggal_berlaku);

    //         $dif = $tb->diffInDays($nowAdate);
    //         if ($dif > $value->oRealisasi->lamahari) {
    //             $dif = $value->oRealisasi->lamahari;
    //         }
    //         // return $dif;
    //         $difmasuk = $value->oRealisasi->oBunga->count();
    //         // echo 'Dif Masuk :' . $difmasuk . '<br>';
    //         $belumdibayarkan = $dif - $difmasuk;
    //         // echo 'belum bayar' . $belumdibayarkan . '<br>';
    //         $latest = Historybunga::where('id_realisasi', $value->oRealisasi->id)
    //             ->latest()
    //             ->first();
    //         // return $latest;
    //         if ($latest) {
    //             $harike = $latest->harike;
    //         } else {
    //             $harike = 0;
    //         }

    //         // echo 'latest : ' . $latest->created_at ?? $firstdate . '<br>';
    //         for ($i = 1; $i <= $belumdibayarkan; $i++) {
    //             $saldo = saldoUser::where('id_user', $id)->first();
    //             print_r($saldo);
    //             echo $harike . ' - ' . $i . 'kontol' . '<br>';

    //             $hb = Historybunga::create([
    //                 'id_realisasi' => $value->oRealisasi->id,
    //                 'id_user' => $value->id_user,
    //                 'id_pengajuan' => $value->id,
    //                 'harike' => $harike + $i,
    //                 'jumlah' => $value->rupiahbungaharian,
    //                 'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
    //                 'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
    //             ]);

    //             $saldo->saldo_tertahan = $saldo->saldo_tertahan + $hb->jumlah;
    //             $saldo->save();
    //             //simpan di saldo tertahan user
    //             echo $saldo->saldo_tertahan . '<br>';
    //             // echo ' ' . $createdat->addDays($i).'<br>';
               
    //                 if ($i % $value->oRealisasi->lamapenarikanbunga == 0) {
    //                     echo $i . ' ucok<br>';
    //                     echo $i . ' ucok<br>';
    //                     // echo 'Tarik :  ' .  $createdat->addDays($i) . '<br>';
    //                     echo 'total Dana : Ditarik :' . $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian . '<br>';
    //                     $latestt = Tarikbunga::where('id_realisasi', $value->oRealisasi->id)
    //                         ->latest()
    //                         ->first();

    //                     echo '/././.' . $latestt . '<br>';
    //                     $tb = Tarikbunga::create([
    //                         'id_realisasi' => $value->oRealisasi->id,
    //                         'id_user' => $value->id_user,
    //                         'id_pengajuan' => $value->id,
    //                         'penarikanke' => $latestt->penarikanke ?? 0 + $i,
    //                         'jumlah' => $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian,
    //                         'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
    //                         'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
    //                     ]);
    //                     $saldo->saldo_tertahan = $saldo->saldo_tertahan - $tb->jumlah;
    //                     $saldo->saldo_active = $saldo->saldo_active + $tb->jumlah;
    //                     $saldo->save();
    //                     // saldo simpan di saldo active
    //                 }
                
    //         }

    //         echo '<br><br>';
    //         $latestt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->count();
    //         $latesttt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->latest()->first();

    //         $thl = $value->oRealisasi->lamapenarikanbunga * $latestt;
    //         $kurangthl = $dif - $thl;
    //         $perulangan = floor( $kurangthl / $value->oRealisasi->lamapenarikanbunga);
    //         for ($i=1; $i <= $perulangan; $i++) { 
    //             Tarikbunga::create([
    //                 'id_realisasi' => $value->oRealisasi->id,
    //                 'id_user' => $value->id_user,
    //                 'id_pengajuan' => $value->id,
    //                 'penarikanke' => ($latesttt != null ? $latesttt->penarikanke : 0 )+ $i,
    //                 'jumlah' =>  $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian,
    //                 'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
    //                 'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
    //             ]);
    //         }

       
    //         $sisa = $belumdibayarkan % $value->oRealisasi->lamapenarikanbunga;
    //         $berapami = floor($belumdibayarkan / $value->oRealisasi->lamapenarikanbunga);
    //         echo $berapami . '<br>';
    //         echo $berapami * (int) $value->rupiahbungaharian * $value->penarikanbunga;
    //         if ($sisa) {
    //             echo 'Tersisa ' . $sisa . ' Hari untuk penarikan bunga <br>';
    //         }
    //         echo '----------------<br>';
    //         $berapami = Historybunga::where('id_realisasi', $value->oRealisasi->id)->count();
    //         if ($berapami == $value->oRealisasi->lamahari) {
    //             $saldo = saldoUser::where('id_user', $id)->first();
    //             $saldo->saldo_active = $saldo->saldo_active + $value->oRealisasi->investasi;
    //             $saldo->saldo_tertahan = $saldo->saldo_tertahan - $value->oRealisasi->investasi;
    //             $saldo->save();
    //             $real = Realisasi::where('id_pengajuan', $value->id)->first();
    //             $pen = pengajuanInvestasi::where('id', $value->id)->first();
    //             $pen->status_investasi = 3;
    //             $real->tanggalautowd = $nowAdate;
    //             $pen->save();
    //             $real->save();
    //         }
    //     }

    //     // return $diff;
    // }
    public function gettes($iid)
    {
        $nowAdate = Date('Y-m-d H:i:s');
        $pe = pengajuanInvestasi::with('oRealisasi.oBunga')
            ->where('id_user', $iid)
            ->where('status_investasi', 1)
            ->get();
        // return $pe;
        foreach ($pe as $key => $value) {

            // $latestt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->count();
            // $thl = $value->oRealisasi->lamapenarikanbunga * $latestt;

            $tb = Carbon::parse($value->oRealisasi->tanggal_berlaku);

            $dif = $tb->diffInDays($nowAdate);
            if ($dif > $value->oRealisasi->lamahari) {
                $dif = $value->oRealisasi->lamahari;
            }
            // return $dif;
            $difmasuk = $value->oRealisasi->oBunga->count();
            // echo 'Dif Masuk :' . $difmasuk . '<br>';
            $belumdibayarkan = $dif - $difmasuk;
            // echo 'belum bayar' . $belumdibayarkan . '<br>';
            $latest = Historybunga::where('id_realisasi', $value->oRealisasi->id)
                ->latest()
                ->first();
            // return $latest;
            if ($latest) {
                $harike = $latest->harike;
            } else {
                $harike = 0;
            }

            // echo 'latest : ' . $latest->created_at ?? $firstdate . '<br>';
            for ($i = 1; $i <= $belumdibayarkan; $i++) {
                $saldo = saldoUser::where('id_user', $iid)->first();
                print_r($saldo);
                echo $harike . ' - ' . $i . 'kontol' . '<br>';

                $hb = Historybunga::create([
                    'id_realisasi' => $value->oRealisasi->id,
                    'id_user' => $value->id_user,
                    'id_pengajuan' => $value->id,
                    'harike' => $harike + $i,
                    'jumlah' => $value->rupiahbungaharian,
                    'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                    'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                ]);

                $saldo->saldo_tertahan = $saldo->saldo_tertahan + $hb->jumlah;
                $saldo->save();
                //simpan di saldo tertahan user
                echo $saldo->saldo_tertahan . '<br>';
                // echo ' ' . $createdat->addDays($i).'<br>';
               
                    if ($i % $value->oRealisasi->lamapenarikanbunga == 0) {
                        echo $i . ' ucok<br>';
                        echo $i . ' ucok<br>';
                        // echo 'Tarik :  ' .  $createdat->addDays($i) . '<br>';
                        echo 'total Dana : Ditarik :' . $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian . '<br>';
                        $latestt = Tarikbunga::where('id_realisasi', $value->oRealisasi->id)
                            ->latest()
                            ->first();

                        echo '/././.' . $latestt . '<br>';
                        $tb = Tarikbunga::create([
                            'id_realisasi' => $value->oRealisasi->id,
                            'id_user' => $value->id_user,
                            'id_pengajuan' => $value->id,
                            'penarikanke' => $latestt->penarikanke ?? 0 + $i,
                            'jumlah' => $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian,
                            'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                            'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                        ]);
                        $saldo->saldo_tertahan = $saldo->saldo_tertahan - $tb->jumlah;
                        $saldo->saldo_active = $saldo->saldo_active + $tb->jumlah;
                        $saldo->save();
                        // saldo simpan di saldo active
                    }
                
            }

            echo '<br><br>';
            $latestt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->count();
            $latesttt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->latest()->first();

            $thl = $value->oRealisasi->lamapenarikanbunga * $latestt;
            $kurangthl = $dif - $thl;
            $perulangan = floor( $kurangthl / $value->oRealisasi->lamapenarikanbunga);
            for ($i=1; $i <= $perulangan; $i++) { 
                Tarikbunga::create([
                    'id_realisasi' => $value->oRealisasi->id,
                    'id_user' => $value->id_user,
                    'id_pengajuan' => $value->id,
                    'penarikanke' => ($latesttt != null ? $latesttt->penarikanke : 0 )+ $i,
                    'jumlah' =>  $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian,
                    'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                    'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                ]);
            }

       
            $sisa = $belumdibayarkan % $value->oRealisasi->lamapenarikanbunga;
            $berapami = floor($belumdibayarkan / $value->oRealisasi->lamapenarikanbunga);
            echo $berapami . '<br>';
            echo $berapami * (int) $value->rupiahbungaharian * $value->penarikanbunga;
            if ($sisa) {
                echo 'Tersisa ' . $sisa . ' Hari untuk penarikan bunga <br>';
            }
            echo '----------------<br>';
            $berapami = Historybunga::where('id_realisasi', $value->oRealisasi->id)->count();
            if ($berapami == $value->oRealisasi->lamahari) {
                $saldo = saldoUser::where('id_user', $iid)->first();
                $saldo->saldo_active = $saldo->saldo_active + $value->oRealisasi->investasi;
                $saldo->saldo_tertahan = $saldo->saldo_tertahan - $value->oRealisasi->investasi;
                $saldo->save();
                $real = Realisasi::where('id_pengajuan', $value->id)->first();
                $pen = pengajuanInvestasi::where('id', $value->id)->first();
                $pen->status_investasi = 3;
                $real->tanggalautowd = $nowAdate;
                $pen->save();
                $real->save();
            }
        }

        // return $diff;
    }
    public function tes(Request $request)
    {
        $nowAdate = Date('Y-m-d H:i:s');
        $pe = pengajuanInvestasi::with('oRealisasi.oBunga')
            ->where('id_user', $request->id)
            ->where('status_investasi', 1)
            ->get();
        // return $pe;
        foreach ($pe as $key => $value) {

            // $latestt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->count();
            // $thl = $value->oRealisasi->lamapenarikanbunga * $latestt;

            $tb = Carbon::parse($value->oRealisasi->tanggal_berlaku);

            $dif = $tb->diffInDays($nowAdate);
            if ($dif > $value->oRealisasi->lamahari) {
                $dif = $value->oRealisasi->lamahari;
            }
            // return $dif;
            $difmasuk = $value->oRealisasi->oBunga->count();
            // echo 'Dif Masuk :' . $difmasuk . '<br>';
            $belumdibayarkan = $dif - $difmasuk;
            // echo 'belum bayar' . $belumdibayarkan . '<br>';
            $latest = Historybunga::where('id_realisasi', $value->oRealisasi->id)
                ->latest()
                ->first();
            // return $latest;
            if ($latest) {
                $harike = $latest->harike;
            } else {
                $harike = 0;
            }

            // echo 'latest : ' . $latest->created_at ?? $firstdate . '<br>';
            for ($i = 1; $i <= $belumdibayarkan; $i++) {
                $saldo = saldoUser::where('id_user', $request->id)->first();
                print_r($saldo);
                echo $harike . ' - ' . $i . 'kontol' . '<br>';

                $hb = Historybunga::create([
                    'id_realisasi' => $value->oRealisasi->id,
                    'id_user' => $value->id_user,
                    'id_pengajuan' => $value->id,
                    'harike' => $harike + $i,
                    'jumlah' => $value->rupiahbungaharian,
                    'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                    'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                ]);

                $saldo->saldo_tertahan = $saldo->saldo_tertahan + $hb->jumlah;
                $saldo->save();
                //simpan di saldo tertahan user
                echo $saldo->saldo_tertahan . '<br>';
                // echo ' ' . $createdat->addDays($i).'<br>';
               
                    if ($i % $value->oRealisasi->lamapenarikanbunga == 0) {
                        echo $i . ' ucok<br>';
                        echo $i . ' ucok<br>';
                        // echo 'Tarik :  ' .  $createdat->addDays($i) . '<br>';
                        echo 'total Dana : Ditarik :' . $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian . '<br>';
                        $latestt = Tarikbunga::where('id_realisasi', $value->oRealisasi->id)
                            ->latest()
                            ->first();

                        echo '/././.' . $latestt . '<br>';
                        $tb = Tarikbunga::create([
                            'id_realisasi' => $value->oRealisasi->id,
                            'id_user' => $value->id_user,
                            'id_pengajuan' => $value->id,
                            'penarikanke' => $latestt->penarikanke ?? 0 + $i,
                            'jumlah' => $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian,
                            'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                            'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                        ]);
                        $saldo->saldo_tertahan = $saldo->saldo_tertahan - $tb->jumlah;
                        $saldo->saldo_active = $saldo->saldo_active + $tb->jumlah;
                        $saldo->save();
                        // saldo simpan di saldo active
                    }
                
            }

            echo '<br><br>';
            $latestt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->count();
            $latesttt = Tarikbunga::where('id_realisasi',$value->oRealisasi->id)->latest()->first();

            $thl = $value->oRealisasi->lamapenarikanbunga * $latestt;
            $kurangthl = $dif - $thl;
            $perulangan = floor( $kurangthl / $value->oRealisasi->lamapenarikanbunga);
            for ($i=1; $i <= $perulangan; $i++) { 
                Tarikbunga::create([
                    'id_realisasi' => $value->oRealisasi->id,
                    'id_user' => $value->id_user,
                    'id_pengajuan' => $value->id,
                    'penarikanke' => ($latesttt != null ? $latesttt->penarikanke : 0 )+ $i,
                    'jumlah' =>  $value->oRealisasi->lamapenarikanbunga * $value->rupiahbungaharian,
                    'created_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                    'updated_at' => $latest != null ? $latest->created_at->addDays($i) : $value->oRealisasi->created_at->addDays($i),
                ]);
            }

       
            $sisa = $belumdibayarkan % $value->oRealisasi->lamapenarikanbunga;
            $berapami = floor($belumdibayarkan / $value->oRealisasi->lamapenarikanbunga);
            echo $berapami . '<br>';
            echo $berapami * (int) $value->rupiahbungaharian * $value->penarikanbunga;
            if ($sisa) {
                echo 'Tersisa ' . $sisa . ' Hari untuk penarikan bunga <br>';
            }
            echo '----------------<br>';
            $berapami = Historybunga::where('id_realisasi', $value->oRealisasi->id)->count();
            if ($berapami == $value->oRealisasi->lamahari) {
                $saldo = saldoUser::where('id_user', $request->id)->first();
                $saldo->saldo_active = $saldo->saldo_active + $value->oRealisasi->investasi;
                $saldo->saldo_tertahan = $saldo->saldo_tertahan - $value->oRealisasi->investasi;
                $saldo->save();
                $real = Realisasi::where('id_pengajuan', $value->id)->first();
                $pen = pengajuanInvestasi::where('id', $value->id)->first();
                $pen->status_investasi = 3;
                $real->tanggalautowd = $nowAdate;
                $pen->save();
                $real->save();
            }
        }

        // return $diff;
    }
    public function export()
    {
        return Excel::download(new SaldoExport(), 'SaldoUser.xlsx');
    }
    public function index()
    {
     
        if (request()->ajax()) {
            return Datatables::of(
                User::with('oDatasaldo', 'mDeposit', 'mWd')
                    ->where('role', 3)
                    ->get(), 
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "
                    <div class='dropdown d-inline mr-2'>
                    <button class='btn btn-primary dropdown-toggle' type='button'
                        id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true'
                        aria-expanded='false'>
                        Aksi
                    </button>
                    <div class='dropdown-menu'>
                 
                   
                    <a type='button' target='_blank' href='" .
                        url('data-saldo/riwayat-deposit/') .
                        '/' .
                        $data->id .
                        "'
                    class='dropdown-item' href='#'>Riwayat Deposit</a>
                        
                     
                         
                         <a type='button' target='_blank' href='" .
                        url('data-saldo/riwayat-wd/') .
                        '/' .
                        $data->id .
                        "'
                         class='dropdown-item' href='#'>Riwayat WD</a>
                         <a type='button' target='_blank' href='" .
                        url('data-saldo/bonus-referal/') .
                        '/' .
                        $data->id .
                        "'
                         class='dropdown-item' href='#'>Bonus Referal</a>
                         <a type='button' target='_blank' href='" .
                         url('data-saldo/redeem-code/') .
                         '/' .
                         $data->id .
                         "'
                          class='dropdown-item' href='#'>Redeem Bonus</a>
                         <a type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'  class='dropdown-item' href='#'>Reset</a>
                    </div>
                </div>
                    ";
                    if ($data->oDatasaldo == null) {
                        $btn = 'Belum Verifikasi';
                    }
                    return $btn;
                })
                ->addColumn('deponya', function ($data) {
                    if ($data->mDeposit) {
                        $btn = Money::IDR($data->mDeposit->sum('jumlah'), true);
                    } else {
                        $btn = Money::IDR(0, true);
                    }

                    return $btn;
                })
                ->addColumn('wdnya', function ($data) {
                    if ($data->mWd) {
                        $btn = Money::IDR($data->oDatasaldo->total_wd, true);
                    } else {
                        $btn = Money::IDR(0, true);
                    }

                    return $btn;
                })
                ->addColumn('saldonya', function ($data) {
                    $btn = Money::IDR($data->oDatasaldo->saldo_active ?? 0, true);

                    return $btn;
                })
                ->addColumn('saldotnya', function ($data) {
                    $btn = Money::IDR($data->oDatasaldo->saldo_tertahan ?? 0, true);

                    return $btn;
                })
                ->rawColumns(['aksi', 'deponya', 'wdnya'])
                ->make(true);
        }
        return view('admin.datasaldo');
    }
    public function storedepo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'depo' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],
            'file' => ['mimes:jpeg,png,jpg|max:2500', 'required'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        if (request()->file('file')) {
            $gmbr = request()->file('file');
            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'img/buktidepo';
            $gmbr->move($tujuan_upload, $nama_file);
        }
        $k1 = strtoupper(substr(Date('M'), 0, 2));
        $k2 = Date('Hy');
        $ktotal =
            Deposit::where('id_user', $request->id)
                ->where('jenis', 1)
                ->where('status_masuk', 1)
                ->count() + 1;
        $ktp = ktp::where('id_user', $request->id)->first();
        $k3 = strtoupper(substr($ktp->nama, 0, 1));
        $k4 = 'PD';
        $kodege = $k1 . $k2 . $k3 . $ktotal . $k4;
        $data = Deposit::create([
            'id_user' => $request->id,
            'jumlah' => $request->depo,
            'kode' => $kodege,
            'buktitransfer' => $nama_file,
            'id_penerima' => $request->rekpe,
            'status_masuk' => 0,
            'status' => 1,
            'tanggal_aju_depo' => Date('Y-m-d H:i:s'),
            'jenis' => 1,
            'id_rekening' => $request->rekeninguser
        ]);

        if ($data) {
            // $saldo = saldoUser::where('id_user',$request->id)->first();
            // $saldo->saldo_active = $saldo->saldo_active + $request->depo;
            // $saldo->save();
            return 'success';
        }
    }
    public function storewithdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wd' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // return 's';
        $set = Pengaturan::first();

        $k1 = strtoupper(substr(Date('M'), 0, 2));
        $k2 = Date('Hy');
        $ktotal =
            Deposit::where('id_user', $request->id)
                ->where('jenis', 2)
                ->where('status_masuk', 1)
                ->count() + 1;
        $ktp = ktp::where('id_user', $request->id)->first();
        $k3 = strtoupper(substr($ktp->nama, 0, 1));
        $k4 = 'PW';
        $kodege = $k1 . $k2 . $k3 . $ktotal . $k4;
        $data = Deposit::create([
            'id_user' => $request->id,
            'jumlah' => $request->wd,
            'kode' => $kodege,
            'status_masuk' => 0,
            'status' => 1,
            'tanggal_aju_depo' => Date('Y-m-d H:i:s'),
            'jenis' => 2,
            'biayaadmin' => ($set->persen * 0.01 * $request->wd) + $set->biayaadmin,
            'total' => $request->wd - ((10 * 0.01 * $request->wd) + 6500),
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function verifwithdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rekpe' => ['required', 'string', 'max:255'],
            'id_pengajuan' => ['required', 'string', 'max:255'],
            'file' => ['mimes:jpeg,png,jpg|max:2500', 'required'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $datap = Deposit::where('id', $request->id_pengajuan)->first();
        $set = Pengaturan::first();
        $datap->status = 2;
        $datap->status_masuk = 1;
        $datap->id_penerima = $request->rekpe;
        $datap->id_rekening = $request->srekeningpenerima;
        $datap->tanggal_verif = Date('Y-m-d H:i:s');
        if (request()->file('file')) {
            $path = '/img/buktiwd/' . $datap->buktitransfer;
            $bases = $_SERVER['DOCUMENT_ROOT'];
            if ($datap->buktitransfer != null) {
                if (file_exists($bases . '/' . $path)) {
                    unlink($bases . '/' . $path);
                    $datap->buktitransfer = null;
                } else {
                    return 'gagal hapus foto';
                }
            }
            $gmbr = request()->file('file');
            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'img/buktiwd';
            $gmbr->move($tujuan_upload, $nama_file);
            $datap->buktitransfer = $nama_file ?? null;
        }
        $datap->save();
        if ($datap) {
            $saldo = saldoUser::where('id_user', $datap->id_user)->first();
            $saldo->saldo_active = $saldo->saldo_active - $datap->jumlah;
            $saldo->total_wd = $saldo->total_wd + $datap->jumlah;
            $saldo->save();
            saldoAdmin::create([
                'id_transaksi' => $datap->id,
                'total' => $datap->total,
                'persenan' => $set->persen,
                'biayatf' => $set->biayaadmin
            ]);
            return ['status' => 'success', 'saldo' => $saldo->saldo_active];
        }
    }
    public function reset($id)
    {
        $data = saldoUser::where('id_user', $id)->first();
        if ($data) {
            $data->saldo_active = 0;
            $data->saldo_tertahan = 0;
            $depo = Deposit::where('id_user', $id)->delete();
            $wd = Withdraw::where('id_user', $id)->delete();
            $data->save();
            return 'success';
        }
    }
}
