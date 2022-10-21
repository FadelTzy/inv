<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\pengajuanInvestasi;
use Akaunting\Money\Money;
use App\Models\RiwayatInvest;
use App\Models\saldoUser;
use App\Models\User;
use App\Models\tipeInvest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvestasiUserExport;
use App\Models\ktp;
use App\Models\Bank;
use App\Models\Historybunga;
use App\Models\Realisasi;
use Illuminate\Support\Carbon;

class PengajuanInvestasiController extends Controller
{
    public function exportt($id)
    {
        return Excel::download(new InvestasiUserExport($id), 'dataPengajuan.xlsx');
    }
    public function storewd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_investasi' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = pengajuanInvestasi::where('id', $request->id_investasi)->first();

        $data->total_wd = $request->jml_wd;
        $data->total_bonus = $request->jml_bonus;
        $data->tanggal_penarikan = date('Y/m/d');
        $data->status_wd = 2;
        $data->status_investasi = 2;
        $data->save();

        if ($data) {
            $saldo = saldoUser::where('id_user', $data->id_user)->first();
            $saldo->saldo_tertahan = $saldo->saldo_tertahan - $data->total_wd;
            $saldo->saldo_active = $saldo->saldo_active + ($data->total_wd + $data->total_bonus);
            $saldo->save();
            return 'success';
        }
    }
    public function wd($id)
    {
        $tipe = tipeInvest::get();
        $user = User::with('oKtp')
            ->where('id', $id)
            ->first();
        if (request()->ajax()) {
            return Datatables::of(
                pengajuanInvestasi::with('oRiwayat', 'oTipe')
                    ->where('id_user', $id)
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $sisa = $data->jumlah_investasi - $data->oRiwayat->sum('jumlah_depo');
                    $dataj = json_encode($data);
                    $btn = "<ul class='list-inline mb-0'>";
                    if ($data->status_investasi == 2) {
                        $btn .=
                            "<li class='list-inline-item'>
                            <button type='button' disabled='enabled' data-toggle='modal' onclick='depo(" .
                            $dataj .
                            ',' .
                            json_encode($sisa) .
                            ")'   class='btn-sm btn btn-success btn-xs mb-1'>Withdraw</button>
                            </li>";
                    } else {
                        $btn .=
                            "<li class='list-inline-item'>
                            <button type='button'  data-toggle='modal' onclick='depo(" .
                            $dataj .
                            ',' .
                            json_encode($sisa) .
                            ")'   class='btn-sm btn btn-success btn-xs mb-1'>Withdraw</button>
                            </li>";
                    }

                    $btn .=
                        "<li class='list-inline-item'>
                        <button type='button' data-toggle='modal' onclick='depo(" .
                        $dataj .
                        ',' .
                        json_encode($sisa) .
                        ")'   class='btn-sm btn btn-primary btn-xs mb-1'>Detail</button>
                        </li>
                  
                   
                </ul>";
                    return $btn;
                })
                ->addColumn('investnya', function ($data) {
                    $btn = Money::IDR($data->jumlah_investasi, true);
                    return $btn;
                })
                ->addColumn('datainves', function ($data) {
                    $btn = $data->total_wd;
                    return $btn;
                })
                ->addColumn('databonus', function ($data) {
                    $btn = $data->total_bonus;
                    return $btn;
                })
                ->addColumn('deponya', function ($data) {
                    $btn = Money::IDR($data->oRiwayat->sum('jumlah_depo'), true);
                    return $btn;
                })
                ->addColumn('datadepo', function ($data) {
                    $btn = $data->oRiwayat->sum('jumlah_depo');
                    return $btn;
                })
                ->addColumn('estimasinya', function ($data) {
                    $btn = $data->jumlah_investasi * $data->oTipe->persenan * 0.01 + $data->jumlah_investasi;
                    $btn = Money::IDR($btn, true);
                    return $btn;
                })
                ->addColumn('tipenya', function ($data) {
                    $btn = $data->oTipe->periodik;
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status_wd == 1) {
                        $btn = '<span class="badge badge-primary"> Belum WD </span>';
                    } else {
                        $btn = '<span class="badge badge-success"> WD </span>';
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'databonus', 'estimasinya', 'statusnya', 'datainves', 'datadepo', 'tipenya', 'investnya', 'deponya'])
                ->make(true);
        }
        return view('admin.wd', compact('tipe', 'user'));
    }
    public function pengajuan($id)
    {
        // return Date("Y m d H:i:s");
        $tipe = tipeInvest::get();
        $bp = Bank::get();
        $user = User::with('oKtp', 'oDatasaldo')
            ->where('id', $id)
            ->first();
        if (request()->ajax()) {
            return Datatables::of(
                pengajuanInvestasi::with('oRiwayat', 'oPenerima', 'oRealisasi')
                    ->where('id_user', $id)
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $sisa = $data->investasi - $data->oRiwayat->sum('jumlah_depo');
                    $dataj = json_encode($data);
                    $btn = "<ul class='list-inline mb-0'>";
                    if ($data->status_investasi == 0) {
                        $btn .=
                            "<li class='list-inline-item'>
                            <button type='button'  onclick='tagihan(" .
                            $dataj .
                            ")'   class='btn-sm btn btn-success btn-xs mb-1'>Tagihan</button>
                            </li>";
                    }

                    $btn .=
                        "
             
         
               
                    <li class='list-inline-item'>
                    <div class='dropdown d-inline mr-2'>
                    <button class='btn btn-sm btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      Aksi
                    </button>
                    <div class='dropdown-menu'>
                    <a class='dropdown-item'  href='#' onclick='editInvestasi(" .
                    $dataj .
                    ")' >Edit</a>
                      <a class='dropdown-item' href='#' onclick='riwayat(" .
                      $dataj .
                      ")'  >Riwayat Bunga Harian</a>
                      <a class='dropdown-item' href='#' onclick='riwayatpenarikan(" .
                      $dataj .
                      ")'  >Penarikan Bunga </a>
                      <a class='dropdown-item' onclick='deleteInvestasi(" .
                        $data->id .
                        ")'   href='#'>Hapus</a>
                    </div>
                  </div>
                  </li>
                </ul>";
                    return $btn;
                })
                ->addColumn('investnya', function ($data) {
                    $btn = Money::IDR($data->investasi, true);
                    return $btn;
                })
                ->addColumn('datainves', function ($data) {
                    $btn = $data->investasi;
                    return $btn;
                })
                ->addColumn('deponya', function ($data) {
                    $btn = Money::IDR($data->oRiwayat->sum('jumlah_depo') ?? 0, true);
                    return $btn;
                })
                ->addColumn('datadepo', function ($data) {
                    $btn = $data->oRiwayat->sum('jumlah_depo');
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    if ($data->status_pengajuan == 1) {
                        $btn = ' Tanggal Pengajuan :  ' . $data->created_at->format('d/m/Y, H:i:s');
                    } elseif ($data->status_pengajuan == 2) {
                        $btn = ' Tanggal Pengajuan :  ' . $data->created_at->format('d/m/Y, H:i:s');
                    } elseif ($data->status_pengajuan == 3) {
                        $btn = ' Tanggal Berlaku :  ' . $data->oRealisasi->tanggal_berlaku . ' / ' . $data->oRealisasi->tanggal_akhir;
                    } elseif ($data->status_pengajuan == 4) {
                        $btn = '<span class="badge badge-danger"> Tanggal Pengajuan : Ditolak </span>';
                    } else {
                        $btn = '<span class="badge badge-danger"> Tanggal Pengajuan : Dibatalkan </span>';
                    }
                    return $btn;
                })
                ->addColumn('namanya', function ($data) {
                    $btn = $data->nama;
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status_investasi == 0) {
                        $btn = '<div class="badge badge-warning mb-1"> Status Investasi : Pengajuan </div>';
                    } elseif ($data->status_investasi == 1) {
                        $btn = '<div class="badge badge-primary mb-1"> Status Investasi : Berjalan </div>';
                    } else {
                        $btn = '<div class="badge badge-success mb-1"> Status Investasi : Selesai </div>';
                    }
                    $btn .= '<br>';
                    if ($data->status_pengajuan == 1) {
                        $btn .= '<div class="badge badge-warning"> Status Pengajuan : Menunggu Pembayaran </div>';
                    } elseif ($data->status_pengajuan == 2) {
                        $dataj = json_encode($data);
                        $btn .= "<div onclick='butkitf(" . $dataj . ")' class='badge badge-primary'> Status Pengajuan : Menunggu Verifikasi </div>";
                    } elseif ($data->status_pengajuan == 3) {
                        $btn .= '<div class="badge badge-success"> Status Pengajuan : Disetujui </div>';
                    } elseif ($data->status_pengajuan == 4) {
                        $btn .= '<div class="badge badge-danger"> Status Pengajuan : Ditolak </div>';
                    } else {
                        $btn .= '<div class="badge badge-danger"> Status Pengajuan : Dibatalkan </div>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'statusnya', 'datainves', 'datadepo', 'namanya', 'investnya', 'tanggalnya', 'deponya'])
                ->make(true);
        }
        return view('admin.pengajuan', compact('tipe', 'user', 'bp'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $k1 = strtoupper(substr(Date('M'), 0, 2));
        $k2 = Date('Hy');
        $ktotal = pengajuanInvestasi::where('id_user', $request->id)->count() + 1;
        $ktp = ktp::where('id_user', $request->id)->first();
        $k3 = strtoupper(substr($ktp->nama, 0, 1));
        $k4 = 'PI';
        $kodege = $k1 . $k2 . $k3 . $ktotal . $k4;
        $tipe = tipeInvest::where('id', $request->tipe)->first();
        if ($tipe->limit == 0) {
            return ['status'=>'limit'];
        }
        if ($tipe->status == 1) {
            $tipe->limit = $tipe->limit - 1;
            $tipe->save();
        }
        if ($request->jenis == 1) {
            $today = Date('Y-m-d H:i:s');
            $tipe = tipeInvest::where('id',$request->tipe)->first();
            if ($tipe->status_user == 1) {
              $tp =  pengajuanInvestasi::where('tipe_investasi',$request->tipe)->count();
                if ($tipe->limit_user <= $tp) {
                    return ['status'=>'galat'];

                }
            }
            $data = pengajuanInvestasi::create([
                'id_user' => $request->id,
                'tipe_investasi' => $request->tipe,
                'kode' => $kodege,
                'nama' => $tipe->paket,
                'investasi' => $tipe->investasi,
                'bungaharian' => $tipe->persenanhari,
                'rupiahbungaharian' => $tipe->bungaperhari,
                'penarikanbunga' => $tipe->lamapenarikanbunga,
                'penarikaninvestasi' => $tipe->lamapenarikan,
                'total_bonus' => $tipe->lamapenarikan * $tipe->bungaperhari,
                'biayawd' => $tipe->biayawd,
                'biayaadmin' => 0,
                'status_pengajuan' => 3,
                'status_investasi' => 1,
            ]);
            $saldoUser = saldoUser::where('id_user',$request->id)->first();
            $saldoUser->saldo_active = $saldoUser->saldo_active - ($tipe->investasi);
            $saldoUser->saldo_tertahan = $saldoUser->saldo_tertahan + $tipe->investasi;
            $nextday = Carbon::createFromFormat('Y-m-d H:i:s', $today)
            ->addDays($data->penarikaninvestasi)->toDateTimeString();

            $realisasi = Realisasi::create([
                'id_pengajuan' => $data->id,
                'id_user' => $data->id_user,
                'tanggal_berlaku' => $today,
                'tanggal_akhir' => $nextday,
                'lamahari' => $data->penarikaninvestasi, //lamamodal ditarik
                'harike' => 0, // hari ke ??
                'lamapenarikanbunga' => $data->penarikanbunga, //lama bunga ditarik / per apa
                'penarikanbungake' => 0, //bunga ditarik kebrapa kali ??
                'totalpenarikanbunga' => 0, //ini bertambah kalau bunga ke dompet --> pada saat pengecekan harian
                'investasi' => $data->investasi,
                'persenbunga' => $data->bungaharian,
            ]);
            
            $saldoUser->save();
        }else{
            $data = pengajuanInvestasi::create([
                'id_user' => $request->id,
                'tipe_investasi' => $request->tipe,
                'kode' => $kodege,
                'nama' => $tipe->paket,
                'investasi' => $tipe->investasi,
                'bungaharian' => $tipe->persenanhari,
                'rupiahbungaharian' => $tipe->bungaperhari,
                'penarikanbunga' => $tipe->lamapenarikanbunga,
                'penarikaninvestasi' => $tipe->lamapenarikan,
                'total_bonus' => $tipe->lamapenarikan * $tipe->bungaperhari,
                'biayawd' => $tipe->biayawd,
                'biayaadmin' => 0,
                'status_pengajuan' => 1,
                'status_investasi' => 0,
            ]);
        }

        if ($data) {
            return ['status'=>'success'];
        }
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => ['required', 'string', 'max:255'],
            'investasi' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = pengajuanInvestasi::where('id', $request->id)->first();
        $data->jumlah_investasi = $request->investasi;
        $data->tipe_investasi = $request->tipe;
        $data->save();

        if ($data) {
            return 'success';
        }
    }
    public function destroy($id)
    {
        $data = pengajuanInvestasi::where('id', $id)->first();
        if ($data) {
            if ($data->status_investasi == 1) {
                RiwayatInvest::where('id_pengajuan', $id)->delete();
                $saldo = saldoUser::where('id_user', $data->id_user)->first();
                $saldo->saldo_tertahan = $saldo->saldo_tertahan - $data->total_depo;
                $saldo->saldo_active = $saldo->saldo_active + $data->total_depo;
                $saldo->save();
                $data->total_depo = 0;
                $data->save();
                return 'success';
            } else {
                return 'warning';
            }
        }
    }
    public function delete($id)
    {
        $data = pengajuanInvestasi::where('id', $id)->first();
        if ($data) {
            RiwayatInvest::where('id_pengajuan', $id)->delete();
            $data->delete();
            return 'success';
        }
    }
    public function tagihan(Request $request)
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

        $data = pengajuanInvestasi::where('id', $request->id_pengajuan)->first();

        if (request()->file('file')) {
            $path = '/img/bukti/' . $data->buktitransfer;
            $bases = $_SERVER['DOCUMENT_ROOT'];
            if ($data->buktitransfer != null) {
                if (file_exists($bases . '/' . $path)) {
                    unlink($bases . '/' . $path);
                    $data->logo = null;
                } else {
                    return 'gagal hapus foto';
                }
            }

            $gmbr = request()->file('file');
            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'img/bukti';

            $gmbr->move($tujuan_upload, $nama_file);

            $data->buktitransfer = $nama_file ?? null;
        }
        $data->updated_at = date('Y-m-d G:i:s');

        $data->id_penerima = $request->rekpe;
        $data->status_pengajuan = 2;
        $data->save();
        if ($data) {
            return 'success';
        }
    }
    public function verifikasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $data = pengajuanInvestasi::where('id', $request->id)
            ->where('kode', $request->kode)
            ->first();
        $today = Date('Y-m-d H:i:s');
        $nextday = Carbon::createFromFormat('Y-m-d H:i:s', $today)
            ->addDays($data->penarikaninvestasi)
            ->toDateTimeString();

        $data->status_pengajuan = 3;
        $data->status_investasi = 1;
        $data->save();
        $realisasi = Realisasi::create([
            'id_pengajuan' => $request->id,
            'id_user' => $data->id_user,
            'tanggal_berlaku' => $today,
            'tanggal_akhir' => $nextday,
            'lamahari' => $data->penarikaninvestasi, //lamamodal ditarik
            'harike' => 0, // hari ke ??
            'lamapenarikanbunga' => $data->penarikanbunga, //lama bunga ditarik / per apa
            'penarikanbungake' => 0, //bunga ditarik kebrapa kali ??
            'totalpenarikanbunga' => 0, //ini bertambah kalau bunga ke dompet --> pada saat pengecekan harian
            'investasi' => $data->investasi,
            'persenbunga' => $data->bungaharian,
        ]);
        // return $realisasi->persenbunga * 0.01 * $realisasi->investasi;
        $history = Historybunga::create([
            'id_pengajuan' => $request->id,
            'id_user' => $data->id_user,
            'id_realisasi' => $realisasi->id,
            'harike' => 1,
            'jumlah' => $realisasi->persenbunga * 0.01 * $realisasi->investasi,
        ]);
        if ($history) {
            $realisasi->harike = 1;
            $realisasi->bungatertunda = $history->jumlah;
            $realisasi->save();
        }

        if ($data) {
            return 'success';
        }
    }
}
