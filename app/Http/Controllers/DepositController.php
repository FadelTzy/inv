<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use App\Models\Bank;
use App\Models\Bankuser;
use App\Models\Deposit;
use App\Models\ktp;
use App\Models\Pengaturan;
use App\Models\Referal;
use App\Models\saldoAdmin;
use App\Models\saldoUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
// use App\Models\Withdraw;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function saldoadmin()
    {
        if (request()->ajax()) {
            $data = saldoAdmin::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <button  class='btn btn-sm btn-secondary lihatpertama'> <i class='fa fa-arrow-down'> </i> </button>
                        </li>
                <li class='list-inline-item'>
                <a type='button' target='_blank' href='" .
                        url('saldo-user') .
                        '/' .
                        $data->id .
                        "'   class='btn btn-success btn-xs mb-1'>Invest</a>
                </li>
                </ul>";
                    return $btn;
                })
                ->rawColumns(['aksi', 'investnya', 'deponya', 'jumlahnya'])
                ->make(true);
        }
        return view('admin.saldoadmin');
    }
    public function afiliasi()
    {
        $data = User::with('akunPertama.akunKedua.akunKetiga', 'bonusReferal')
            ->where('role', 3)
            ->get();
        $set = Pengaturan::select('id','level1','level2','level3')->first();
        
        // return $data;
        if (request()->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <button  class='btn btn-sm btn-secondary lihatpertama'> <i class='fa fa-arrow-down'> </i> </button>
                        </li>
                <li class='list-inline-item'>
                <a type='button' target='_blank' href='" .
                        url('saldo-user') .
                        '/' .
                        $data->id .
                        "'   class='btn btn-success btn-xs mb-1'>Invest</a>
                </li>
                </ul>";
                    return $btn;
                })
                ->addColumn('deponya', function ($data) {
                    $btn = '';

                    return $btn;
                })
                ->addColumn('bonusnya', function ($data) {
                    $btn = 0;
                    // return $data->bonusReferal;
                    foreach ($data->bonusReferal as $key => $value) {
                        $btn += $value->harga;
                    }

                    return Money($btn, 'IDR', true);
                })
                ->addColumn('jumlahnya', function ($data) {
                    $btn = '';

                    if ($data->akunPertama->count() != 0) {
                        $btn = "<div class='badge badge-primary'>" . $data->akunPertama->count() . '</div>';
                        $kedua = 0;
                        $ketiga = 0;

                        foreach ($data->akunPertama as $value) {
                            $kedua += $value->akunKedua->count();
                            foreach ($value->akunKedua as $key => $third) {
                                $ketiga += $third->akunKetiga->count();
                            }
                        }
                        $btn .= "<div class='badge badge-warning'>" . $kedua . '</div>';
                        $btn .= "<div class='badge badge-info'>" . $ketiga . '</div>';

                        // if ($data->akunPertama->akun_kedua->count() != 0) {
                        //     $btn .= "<div class='badge badge-warning'>" . $data->akunPertama->akunKedua->count() . "</div>";
                        // }else{
                        //     $btn .= "<div class='badge badge-warning'>" ."0" . "</div>";
                        //     $btn .= "<div class='badge badge-info'>" ."0" . "</div>";
                        // }
                    } else {
                        $btn .= "<div class='badge badge-primary'>" . '0' . '</div>';
                        $btn .= "<div class='badge badge-warning'>" . '0' . '</div>';
                        $btn .= "<div class='badge badge-info'>" . '0' . '</div>';
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'investnya', 'deponya', 'jumlahnya'])
                ->make(true);
        }
        return view('admin.afiliasi',compact('set'));
    }
    public function depo(Request $request)
    {
         
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $data = Deposit::where('id', $request->id)
            ->where('kode', $request->kode)
            ->first();

        $ktp = ktp::where('id_user', $data->id_user)->first();
        if ($ktp->status_referal == 1 && $ktp->status_bonus == 1) {
            // return $ktp;
            $set= Pengaturan::first();
            $first = ktp::with('oFirst')
                ->where('kode_referal', $ktp->kode_referal_orang)
                ->first();
            // return $first;
            if ($first) {
                $ref = Referal::firstOrCreate(
                    [
                        'id_user' => $ktp->id_user,
                        'urut' => 1,
                    ],
                    [
                        'id_penerima' => $first->id_user,
                        'nama_penerima' => $first->nama,
                        'nama_user' => $ktp->nama,
                        'kode_referal' => $first->kode_referal,
                        'harga' => $set->level1 * 0.01 * $data->jumlah,
                        'status' => 1,
                    ],
                );
                $saldo = saldoUser::where('id_user', $first->id_user)->first();
                $saldo->saldo_active = $saldo->saldo_active + $ref->harga;
                $saldo->save();

                if ($first->oFirst) {
                    $seconds = ktp::with('oFirst')
                        ->where('kode_referal', $first->oFirst->kode_referal)
                        ->first();
                    if ($seconds) {
                        $ref = Referal::firstOrCreate(
                            [
                                'id_user' => $ktp->id_user,
                                'urut' => 2,
                            ],
                            [
                                'id_penerima' => $seconds->id_user,
                                'nama_penerima' => $seconds->nama,
                                'nama_user' => $ktp->nama,
                                'kode_referal' => $seconds->kode_referal,
                                'harga' => $set->level2 * 0.01 * $data->jumlah,
                                'status' => 1,
                            ],
                        );
                        $saldo = saldoUser::where('id_user', $seconds->id_user)->first();
                        $saldo->saldo_active = $saldo->saldo_active + $ref->harga;
                        $saldo->save();
                    }
                    if ($seconds->oFirst) {
                        $third = ktp::with('oFirst')
                            ->where('kode_referal', $seconds->oFirst->kode_referal)
                            ->first();
                        if ($third) {
                            $ref = Referal::firstOrCreate(
                                [
                                    'id_user' => $ktp->id_user,
                                    'urut' => 3,
                                ],
                                [
                                    'id_penerima' => $third->id_user,
                                    'nama_penerima' => $third->nama,
                                    'nama_user' => $ktp->nama,
                                    'kode_referal' => $third->kode_referal,
                                    'harga' => $set->level3 * 0.01 * $data->jumlah,
                                    'status' => 1,
                                ],
                            );
                            $saldo = saldoUser::where('id_user', $third->id_user)->first();
                            $saldo->saldo_active = $saldo->saldo_active + $ref->harga;
                            $saldo->save();
                        }
                    }
                }
            }
            $ktp->status_bonus = 2;
            $ktp->save();
        }

        $saldoU = saldoUser::where('id_user', $data->id_user)->first();
        if ($saldoU) {
            $data->status_masuk = 1;
            $data->status = 2;
            $data->tanggal_verif = Date('Y-m-d H:s:i');
            $saldoU->saldo_active = $saldoU->saldo_active + $data->jumlah;
            $saldoU->save();
        }
        $data->save();

        if ($data) {
            // $saldo = saldoUser::where('id_user',$request->id)->first();
            // $saldo->saldo_active = $saldo->saldo_active + $request->depo;
            // $saldo->save();
            return 'success';
        }
    }
    public function saldo()
    {
        if (request()->ajax()) {
            return Datatables::of(
                User::with('oTotalInvest', 'oSaldo')
                    ->where('role', 3)
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <a type='button' target='_blank' href='" .
                        url('saldo-user') .
                        '/' .
                        $data->id .
                        "'   class='btn btn-success btn-xs mb-1'>Invest</a>
                </li>
                </ul>";
                    return $btn;
                })
                ->addColumn('deponya', function ($data) {
                    if ($data->oTotalInvest) {
                        $btn = Money::IDR($data->oTotalInvest->sum('investasi'), true);
                    } else {
                        $btn = Money::IDR(0, true);
                    }

                    return $btn;
                })
                ->addColumn('investnya', function ($data) {
                    if ($data->oTotalInvest) {
                        $btn = Money::IDR($data->oTotalInvest->sum('total_bonus') + $data->oTotalInvest->sum('investasi'), true);
                    } else {
                        $btn = Money::IDR(0, true);
                    }

                    return $btn;
                })
                ->addColumn('latestnya', function ($data) {
                    if (count($data->oSaldo) != 0) {
                        if ($data->oSaldo[0]->status_investasi == 0) {
                            $st = 'Mengajukan';
                        } elseif ($data->oSaldo[0]->status_investasi == 1) {
                            $st = 'Berjalan';
                        } else {
                            $st = 'Selesai';
                        }
                        return Money($data->oSaldo[0]->investasi, 'IDR', 'false') . "<span class='badge badge-primary'>" . $st . '</span>';
                    } else {
                        return 'Belum Berinvestasi';
                    }
                    //    return $data->oSaldo;
                })
                ->rawColumns(['aksi', 'investnya', 'deponya', 'latestnya'])
                ->make(true);
        }
        return view('admin.saldo');
    }
    public function delete($id)
    {
        $data = Deposit::where('id', $id)->first();
        if ($data) {
            if ($data->status == 2) {
                # code...
                $datasaldo = saldoUser::where('id_user', $data->id_user)->first();
                $datasaldo->saldo_active = $datasaldo->saldo_active - $data->jumlah;
                $datasaldo->save();
            }
            $data->delete();
            return 'success';
        }
    }
    public function referal($id)
    {
        $user = User::with('oKtp')
            ->where('id', $id)
            ->first();
        $bank = Bank::get();
        if (request()->ajax()) {
            return Datatables::of(
                Referal::where('id_penerima', $user->id)
                    ->where('status', 1)
                    ->orderBy('created_at', 'DESC')
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
           
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-xs mb-1'>Hapus</button>
                    </li>
                     
                </ul>";
                    return $btn;
                })
                ->addColumn('jumlahnya', function ($data) {
                    $btn = Money::IDR($data->harga, true);
                    return $btn;
                })
                ->addColumn('urutnya', function ($data) {
                    if ($data->urut == 1) {
                        $btn = 'Referal Pertama';
                    } elseif ($data->urut == 2) {
                        $btn = 'Referal Kedua';
                    } else {
                        $btn = 'Referal Ketiga';
                    }
                    return $btn;
                })

                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 1) {
                        $dataj = json_encode($data);
                        $btn = "<span onclick='buktitf(" . $dataj . ")'  class='badge badge-warning'> Menunggu Verifikasi </span>";
                    }
                    if ($data->status == 2) {
                        $btn = '<span class="badge badge-success"> Diterima </span>';
                    }
                    if ($data->status == 3) {
                        $btn = '<span class="badge badge-danger"> Ditolak </span>';
                    }
                    return $btn;
                })
                ->addColumn('datadepo', function ($data) {
                    $btn = $data->harga;
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    if ($data->status == 1) {
                        $btn = 'Tanggal Pengajuan : ' . $data->created_at->format('Y/m/d H:i:s');
                    } elseif ($data->status == 2) {
                        $btn = 'Tanggal Pembayaran : ' . $data->updated_at->format('Y/m/d H:i:s');
                    } elseif ($data->status == 3) {
                        $btn = 'Tanggal Pembayaran : ' . $data->updated_at->format('Y/m/d H:i:s');
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'tanggalnya', 'urutnya', 'jumlahnya', 'statusnya', 'deponya', 'wdnya'])
                ->make(true);
        }
        return view('admin.bonusreferal', compact('user', 'bank'));
    }
    public function riwayat($id)
    {
        $user = User::with('oKtp')
            ->where('id', $id)
            ->first();
        $bank = Bank::get();
        $userbank = Bankuser::where('id_user', $id)->get();
        if (request()->ajax()) {
            return Datatables::of(
                Deposit::with('oPenerima', 'oRekening')
                    ->where('id_user', $id)
                    ->where('jenis', 1)
                    ->orderBy('created_at', 'DESC')
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
           
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-xs mb-1'>Hapus</button>
                    </li>
                     
                </ul>";
                    return $btn;
                })
                ->addColumn('jumlahnya', function ($data) {
                    $btn = Money::IDR($data->jumlah, true);
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 1) {
                        $dataj = json_encode($data);
                        $btn = "<span onclick='buktitf(" . $dataj . ")'  class='badge badge-warning'> Menunggu Verifikasi </span>";
                    }
                    if ($data->status == 2) {
                        $dataj = json_encode($data);

                        $btn = '<span class="badge badge-success"> Diterima </span>';
                        $btn .= "<span onclick='buktitf(" . $dataj . ")'  class='badge badge-warning'> Bukti Pembayaran </span>";
                    }
                    if ($data->status == 3) {
                        $btn = '<span class="badge badge-danger"> Ditolak </span>';
                    }
                    return $btn;
                })
                ->addColumn('datadepo', function ($data) {
                    $btn = $data->jumlah;
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    if ($data->status == 1) {
                        $btn = 'Tanggal Pengajuan : ' . $data->created_at->format('Y/m/d H:i:s');
                    } elseif ($data->status == 2) {
                        $btn = 'Tanggal Pembayaran : ' . $data->updated_at->format('Y/m/d H:i:s');
                    } elseif ($data->status == 3) {
                        $btn = 'Tanggal Pembayaran : ' . $data->updated_at->format('Y/m/d H:i:s');
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'tanggalnya', 'jumlahnya', 'statusnya', 'deponya', 'wdnya'])
                ->make(true);
        }
        return view('admin.riwayatdepo', compact('user', 'bank', 'userbank'));
    }
    public function riwayatwd($id)
    {
        // return 's';
        $bank = Bank::get();
        $user = User::with('oDatasaldo', 'oKtp')
            ->where('id', $id)
            ->first();
        $set = Pengaturan::first();
        
        $userbank = Bankuser::where('id_user', $id)->get();
        // return $user;
        if (request()->ajax()) {
            return Datatables::of(
                Deposit::where('id_user', $id)
                    ->where('jenis', 2)
                    ->orderBy('created_at', 'DESC')
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
           
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-xs mb-1'>Hapus</button>
                    </li>
                     
                </ul>";
                    return $btn;
                })
                ->addColumn('jumlahnya', function ($data) {
                    $btn = Money::IDR($data->jumlah, true);

                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 1) {
                        $dataj = json_encode($data);
                        $btn = "<span onclick='buktitf(" . $dataj . ")'  class='badge badge-warning'> Menunggu Verifikasi </span>";
                    }
                    if ($data->status == 2) {
                        $btn = '<span class="badge badge-success"> Diterima </span>';
                    }
                    if ($data->status == 3) {
                        $btn = '<span class="badge badge-danger"> Ditolak </span>';
                    }
                    return $btn;
                })
                ->addColumn('datadepo', function ($data) {
                    $btn = $data->jumlah;
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    if ($data->status == 1) {
                        $btn = 'Tanggal Pengajuan : ' . $data->created_at->format('Y/m/d H:i:s');
                    } elseif ($data->status == 2) {
                        $btn = 'Tanggal Pembayaran : ' . $data->updated_at->format('Y/m/d H:i:s');
                    } elseif ($data->status == 3) {
                        $btn = 'Tanggal Pembayaran : ' . $data->updated_at->format('Y/m/d H:i:s');
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'tanggalnya', 'jumlahnya', 'statusnya', 'deponya', 'wdnya'])
                ->make(true);
        }
        return view('admin.riwayatwd', compact('user', 'bank', 'userbank','set'));
    }
}
