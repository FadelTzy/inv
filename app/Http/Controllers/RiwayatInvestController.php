<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\pengajuanInvestasi;
use Akaunting\Money\Money;
use App\Models\Historybunga;
use App\Models\User;
use App\Models\tipeInvest;
use App\Models\RiwayatInvest;
use App\Models\saldoUser;
use App\Models\Tarikbunga;
use Illuminate\Support\Facades\Validator;

class RiwayatInvestController extends Controller
{
    public function depo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => ['required', 'string', 'max:255'],
            'id_investasi' => ['required', 'string', 'max:255'],
            'deposit' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = RiwayatInvest::create([
            'id_user' => $request->id_user,
            'id_pengajuan' => $request->id_investasi,
            'jumlah_depo' => $request->deposit,
            'status' => $request->status ?? 2,
        ]);

        if ($data) {
            $inv = pengajuanInvestasi::where('id', $request->id_investasi)->first();
            $saldo = saldoUser::where('id_user',$request->id_user)->first();

            if ($data->status == 2) {
                $inv->total_depo = $inv->total_depo + 0;

            }else{

                $inv->total_depo = $inv->total_depo + $request->deposit;
                if ($inv->total_depo == $inv->jumlah_investasi) {
                    $inv->status = 2;
                } else {
                    $inv->status = 1;
                }
                $saldo->saldo_active = $saldo->saldo_active - $request->deposit;
                $saldo->saldo_tertahan = $saldo->saldo_tertahan + $request->deposit;
                $saldo->save();
            }
       
         
            $inv->save();
            return ['status' => 'success', 'data' => $saldo];
        }
    }
    public function riwayat($id)
    {
        if (request()->ajax()) {
            return Datatables::of(Historybunga::where('id_pengajuan', $id)->get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn = "<ul class='list-inline mb-0'>";

                    if ($data->status == 2) {
                        $btn .=
                            "<li class='list-inline-item'>
                            <button type='button' data-toggle='modal' onclick='verifDepo(" .
                            $data->id .
                            ")'   class='btn btn-success btn-sm mb-1'>Setujui</button>
                            </li>";
                    } else {
                        $btn .=
                            "<li class='list-inline-item'>
                                                    <button type='button' data-toggle='modal' onclick='verifDepo(" .
                            $data->id .
                            ")'   class='btn btn-danger btn-sm mb-1'>Tolak</button>
                                                    </li>";
                    }

                    $btn .=
                        "<li class='list-inline-item'>
                    <button type='button'  onclick='hapusDepo(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-sm mb-1'>Hapus</button>
                    </li>
                     
                </ul>";
                    return $btn;
                })

                ->addColumn('deponya', function ($data) {
                    $btn = Money::IDR($data->jumlah, true);
                    return $btn;
                })
                ->addColumn('createdatnya', function ($data) {
                    $btn = $data->created_at->format('Y/m/d H:i:s');
                    return $btn;
                })
                
                ->rawColumns(['aksi', 'createdatnya', 'deponya'])
                ->make(true);
        }
    }
    
    public function riwayatpenarikan($id)
    {
        if (request()->ajax()) {
            return Datatables::of(Tarikbunga::where('id_pengajuan', $id)->get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn = "<ul class='list-inline mb-0'>";

                    if ($data->status == 2) {
                        $btn .=
                            "<li class='list-inline-item'>
                            <button type='button' data-toggle='modal' onclick='verifDepo(" .
                            $data->id .
                            ")'   class='btn btn-success btn-sm mb-1'>Setujui</button>
                            </li>";
                    } else {
                        $btn .=
                            "<li class='list-inline-item'>
                                                    <button type='button' data-toggle='modal' onclick='verifDepo(" .
                            $data->id .
                            ")'   class='btn btn-danger btn-sm mb-1'>Tolak</button>
                                                    </li>";
                    }

                    $btn .=
                        "<li class='list-inline-item'>
                    <button type='button'  onclick='hapusDepo(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-sm mb-1'>Hapus</button>
                    </li>
                     
                </ul>";
                    return $btn;
                })

                ->addColumn('deponya', function ($data) {
                    $btn = Money::IDR($data->jumlah, true);
                    return $btn;
                })
                ->addColumn('createdatnya', function ($data) {
                    $btn = $data->created_at->format('Y/m/d H:i:s');
                    return $btn;
                })
                
                ->rawColumns(['aksi', 'createdatnya', 'deponya'])
                ->make(true);
        }
    }
    public function destroy($id)
    {
        $data = RiwayatInvest::where('id', $id)->first();
        if ($data) {
            $depo = pengajuanInvestasi::where('id', $data->id_pengajuan)->first();
            if ($data->status == 1) {
                $depo->total_depo = $depo->total_depo - $data->jumlah_depo;

                if ($depo->total == $depo->jumlah_investasi) {
                    $depo->status = 2;
                } else {
                    $depo->status = 1;
                }
            }else{

            }
          
            $depo->save();
            $data->delete();
            return 'success';
        }
    }
    public function verif($id)
    {
        $data = RiwayatInvest::where('id', $id)->first();
     
        if ($data) {
            $saldo = '';
            $depo = pengajuanInvestasi::where('id', $data->id_pengajuan)->first();
            if ($data->status == 1) {
                $depo->total_depo = $depo->total_depo - $data->jumlah_depo;
                $data->status = 2;
            }else{
                $data->status = 1;
                $depo->total_depo = $depo->total_depo + $data->jumlah_depo;
                $saldo = saldoUser::where('id_user',$depo->id_user)->first();
                $saldo->saldo_active = $saldo->saldo_active - $data->jumlah_depo;
                $saldo->saldo_tertahan = $saldo->saldo_tertahan + $data->jumlah_depo;
                $saldo->save();
            }
            if ($depo->total_depo == $depo->jumlah_investasi) {
                $depo->status = 2;
            } else {
                $depo->status = 1;
            }

            $depo->save();
            $data->save();
            return ['status' => 'success','data'=>$saldo];
        }
    }
}
