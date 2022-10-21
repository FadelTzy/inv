<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Redeemcode;
use App\Models\Userredeem;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Bank;
use Akaunting\Money\Money;
use App\Models\saldoUser;
use Illuminate\Support\Facades\Validator;
class RedeemcodeController extends Controller
{
    public function deleteredeem($id)
    {
        $data = Userredeem::where('id',$id)->first();
        if ($data) {
            $data->delete();
            return 'success';
            
        }
        return 'error';
    }
    public function rs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        
        $rd = Redeemcode::where('kode',$request->code)->first();
        if ($rd) {
            if ($rd->status == 1) {
                $check =  Userredeem::where('id_user',$request->id)->where('kode',$request->code)->first();
                if ($check) {
                    $status = ['status' => 'warning','message'=>'Kode Redeem Sudah Digunakan'];
                }else{
                  $ud =  Userredeem::create([
                        'id_user' => $request->id,
                        'id_redeem' => $rd->id,
                        'kode' => $request->code,
                        'nominal' => $rd->nominal,
                    ]);
                if ($ud) {
                   
                    $rd->peserta = $rd->peserta - 1;
                    if ($rd->peserta == 0) {
                        $rd->status = 2;
                    }
                    $rd->save();
                }
                    
                $saldo = saldoUser::where('id_user',$request->id)->first();
                $saldo->saldo_active = $saldo->saldo_active + $ud->nominal;
                $saldo->save();
                $status = ['status' => 'success','message'=>'Kode Redeem Berhasil Digunakan'];

                }
            }elseif($rd->status == 2){
                $status = ['status' => 'error','message'=>'Kode Redeem Habis'];
            }else{
                $status = ['status' => 'error','message'=>'Kode Redeem Tidak Berlaku'];
            }
        }else{
            $status = ['status' => 'error','message'=>'invalid Kode'];

        }
        return $status;
    }
    public function history($id)
    {
        $user = User::with('oKtp')->where('id',$id)->first();
        $bank = Bank::get();
        $d = Userredeem::where('id_user',$user->id)->first();
        if (request()->ajax()) {
            return Datatables::of(
                Userredeem::where('id_user',$user->id)
                    ->orderBy('created_at','DESC')->get()
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
                    
                        $btn = Money::IDR($data->nominal, true);
                    return $btn;
                })->addColumn('datadepo', function ($data) {
                   $btn = $data->nominal;
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = ' ' . $data->created_at->format('Y/m/d H:i:s');
                     return $btn;
                 })
                 ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.redeemuser',compact('user','bank'));
    }
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(
                Redeemcode::get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                        <li class='list-inline-item'>
                        <button type='button' data-toggle='modal' onclick='staffupd(" .
                                $dataj .
                                ")'   class='btn btn-success btn-xs mb-1'>Edit</button>
                        </li>
                            <li class='list-inline-item'>
                            <button type='button'  onclick='staffdel(" .
                                $data->id .
                                ")'   class='btn btn-danger btn-xs mb-1'>Hapus</button>
                            </li>
                     
                </ul>";
                    return $btn;
                })
                
                ->addColumn('tanggalnya', function ($data) {
                    
                    $btn = $data->start . ' s/d ' . $data->expayer;
                    return $btn;
                })
                
                ->addColumn('statusnya', function ($data) {
                    if ($data->expayer == Date("Y-m-d")) {
                        $btn = 'Masa Berlaku Habis';
                    }else{

                    
                    if ($data->status == 1) {
                        $btn = 'Aktif';
                    }elseif ($data->status == 2) {
                        $btn = 'Full';
                    }elseif ($data->status == 3) {
                        $btn = 'Non Aktif';
                    }
                }
                    return $btn;
                })
                
                ->addColumn('jenisnya', function ($data) {
                    
                    if ($data->jenis == 1) {
                        $btn = 'Public';
                    }else if ($data->jenis == 2) {
                        $btn = 'Private';
                    }
                    return $btn;
                })
                
                ->rawColumns(['aksi','tanggalnya','statusnya','jenisnya'])
                ->make(true);
        }
        return view('admin.data.redeem');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'max:255'],
            'investasi' => ['required', 'string', 'max:255'],
            'awal' => ['required', 'string', 'max:255'],
            'akhir' => ['required', 'string', 'max:255'],
            'penerima' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
   
        $data = Redeemcode::create([
            'judul' => $request->judul,
            'nominal' => $request->investasi,
            'start' => $request->awal,
            'expayer' => $request->akhir,
            'peserta' => $request->penerima,
            'kode' => $request->kode,
            'status' => 1,
            'jenis' => $request->sp

        ]);

        if ($data) {
        
            return 'success';
        }
    }
    public function destroy($id)
    {
        $data = Redeemcode::where('id',$id)->first();
       
        if ($data) {
            Userredeem::where('id_redeem',$data->id)->delete();
            $data->delete();
            return 'success'; 
        }
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'max:255'],
            'investasi' => ['required', 'string', 'max:255'],
            'awal' => ['required', 'string', 'max:255'],
            'akhir' => ['required', 'string', 'max:255'],
            'penerima' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
       
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = Redeemcode::where('id',$request->id)->first();
      $data->judul = $request->judul;
      $data->nominal = $request->investasi;
      $data->start = $request->awal;
      $data->expayer = $request->akhir;
      $data->peserta = $request->penerima;
      $data->kode = $request->kode;
      $data->jenis = $request->sp;           
      $data->save();

        if ($data) {
        
            return 'success';
        }
    }
}
