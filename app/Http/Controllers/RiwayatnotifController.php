<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use App\Models\Deposit;
use App\Models\pengajuanInvestasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\riwayatnotif;
use Illuminate\Support\Carbon;

class RiwayatnotifController extends Controller
{
    public function ps()
    {
        if (request()->ajax()) {
            return Datatables::of(
                pengajuanInvestasi::with('oUser', 'oTipe')
                    ->latest()
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                         
                            <li class='list-inline-item'>
                            <a href='" . url('saldo-user/') .'/' . $data->id_user . "'  class='btn btn-success btn-xs mb-1'>Investasi</a>
                            </li>
                </ul>";

                    return $btn;
                })
                ->addColumn('usernya', function ($data) {
                    $btn = $data->oUser->nama ?? '- ';
                    return $btn;
                })
                ->addColumn('tipenya', function ($data) {
                    $btn = $data->oTipe->paket . '<br> ' . 'Harga : ' . Money($data->oTipe->investasi, 'IDR', true);
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->created_at->format('d-m-Y H:i:s');
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    $btn = '';
                    if ($data->status_pengajuan == 1) {
                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-primary btn-xs mb-1'>Menunggu Pembayaran</span>
                </li>
                   
                     
                </ul>";
                    } elseif ($data->status_pengajuan == 2) {
                        # code...

                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-warning btn-xs mb-1'>Telah Dibeli</span>
                </li>
                   
                     
                </ul>";
                    } else {
                        # code...

                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-success btn-xs mb-1'>Telah Dibeli</span>
                </li>
                   
                     
                </ul>";
                    }

                    if ($data->status_investasi == 0) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-secondary btn-xs mb-1'>Proses Pembelian</span>
                        </li>
                        </ul>";
                    } elseif ($data->status_investasi == 1) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-warning btn-xs mb-1'>Investasi Berjalan</span>
                        </li>
                        </ul>";
                    } else {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-success btn-xs mb-1'>Investasi Selesai</span>
                        </li>
                        </ul>";
                    }
                    return $btn;
                })
                ->addColumn('belinya', function ($data) {
                    $btn = $data->created_at->diffForHumans();
                    $btn .= '<br>';
                    $now = Carbon::now();

                    $days_count = $data->created_at->diffInDays($now);
                    if ($days_count <= 1) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-danger btn-xs mb-1'>Baru</span>
                        </li>
                        </ul>";
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'statusnya', 'tipenya', 'belinya'])
                ->make(true);
        }
        return view('admin.notif.ps');
    }
 
    public function depo()
    {
        if (request()->ajax()) {
            return Datatables::of(
                Deposit::with('oUser')->where('jenis',1)
                    ->latest()
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <a href='" . url('data-saldo/riwayat-deposit/') .'/' . $data->id_user . "'  class='btn btn-success btn-xs mb-1'>Depo</a>
                        </li>
                </ul>";

                    return $btn;
                })
                ->addColumn('usernya', function ($data) {
                    $btn = $data->oUser->nama ?? '- ';
                    return $btn;
                })
                ->addColumn('depositnya', function ($data) {
                    $btn =  Money($data->jumlah, 'IDR', true);
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->created_at->format('d-m-Y H:i:s');
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    $btn = '';
                    if ($data->status == 1) {
                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-primary btn-xs mb-1'>Menunggu Pembayaran</span>
                </li>
                   
                     
                </ul>";
                    } elseif ($data->status == 2) {
                        # code...

                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-warning btn-xs mb-1'>Telah Di Depo</span>
                </li>
                </ul>";
                    } else {
                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-success btn-xs mb-1'>Ditolak</span>
                </li>
                   
                     
                </ul>";
                    }

                    if ($data->status_masuk == 0) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-secondary btn-xs mb-1'>Proses Pembelian</span>
                        </li>
                        </ul>";
                    
                    } else {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-success btn-xs mb-1'>Depo Selesai</span>
                        </li>
                        </ul>";
                    }
                    return $btn;
                })
                ->addColumn('belinya', function ($data) {
                    $btn = $data->created_at->diffForHumans();
                    $btn .= '<br>';
                    $now = Carbon::now();

                    $days_count = $data->created_at->diffInDays($now);
                    if ($days_count <= 1) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-danger btn-xs mb-1'>Baru</span>
                        </li>
                        </ul>";
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'statusnya', 'depositnya', 'belinya'])
                ->make(true);
        }
        return view('admin.notif.depo');
    }
    public function pw()
    {

      
        if (request()->ajax()) {
            return Datatables::of(
                Deposit::with('oUser')->where('jenis',2)
                    ->latest()
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                            <a href='" . url('data-saldo/riwayat-wd/') .'/' . $data->id_user . "'  class='btn btn-success btn-xs mb-1'>Withdraw</a>
                            </li>
                </ul>";

                    return $btn;
                })
                ->addColumn('usernya', function ($data) {
                    $btn = $data->oUser->nama ?? '- ';
                    return $btn;
                })
                ->addColumn('depositnya', function ($data) {
                    $btn =  Money($data->jumlah, 'IDR', true);
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->created_at->format('d-m-Y H:i:s');
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    $btn = '';
                    if ($data->status == 1) {
                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-primary btn-xs mb-1'>Menunggu Verifikasi</span>
                </li>
                   
                     
                </ul>";
                    } elseif ($data->status == 2) {
                        # code...

                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-warning btn-xs mb-1'>WD Diverifikasi</span>
                </li>
                </ul>";
                    } else {
                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-success btn-xs mb-1'>Ditolak</span>
                </li>
                   
                     
                </ul>";
                    }

                    if ($data->status_masuk == 0) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-secondary btn-xs mb-1'>Proses Pembelian</span>
                        </li>
                        </ul>";
                    
                    } else {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-success btn-xs mb-1'>WD Selesai</span>
                        </li>
                        </ul>";
                    }
                    return $btn;
                })
                ->addColumn('belinya', function ($data) {
                    $btn = $data->created_at->diffForHumans();
                    $btn .= '<br>';
                    $now = Carbon::now();

                    $days_count = $data->created_at->diffInDays($now);
                    if ($days_count <= 1) {
                        $btn .= "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <span type='button' class='badge badge-danger btn-xs mb-1'>Baru</span>
                        </li>
                        </ul>";
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'statusnya', 'depositnya', 'belinya'])
                ->make(true);
        }
        return view('admin.notif.pw');
    }
    public function notif()
    {
        if (request()->ajax()) {
            return Datatables::of(riwayatnotif::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    if ($data->jns_notif == 1) {
                        $btn =
                            "<ul class='list-inline mb-0'>
                            <li class='list-inline-item'>
                            <button type='button'  onclick='staffdel(" .
                            $data->id .
                            ")'   class='btn btn-danger btn-xs mb-1'>Hapus</button>
                            </li>
                </ul>";
                    }

                    return $btn;
                })
                ->addColumn('rolenya', function ($data) {
                    if ($data->jns_notif == 1) {
                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-primary btn-xs mb-1'>Registrasi User</span>
                </li>
                   
                     
                </ul>";
                    } elseif ($data->jns_notif == 2) {
                        # code...

                        $btn = "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <span type='button' class='badge badge-warning btn-xs mb-1'>Admin</span>
                </li>
                   
                     
                </ul>";
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'rolenya'])
                ->make(true);
        }
        return view('admin.riwayatnotif');
    }
    public function notifhapus($id)
    {
        riwayatnotif::where('id', $id)->delete();
        return 'success';
    }
}
