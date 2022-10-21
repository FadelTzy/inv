<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\tipeInvest;
use Illuminate\Support\Facades\Validator;


class TipeInvestController extends Controller
{
    public function index()
    {
        
        if (request()->ajax()) {
            return Datatables::of(
                tipeInvest::get(),
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
                
                ->rawColumns(['aksi',])
                ->make(true);
        }
        return view('admin.data.tipe');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paket' => ['required', 'string', 'max:255'],
            'investasi' => ['required', 'string', 'max:255'],
            'bungaperhari' => ['required', 'string', 'max:255'],
            'hrbp' => ['required', 'string', 'max:255'],
            'gambar' => ['mimes:jpeg,png,jpg|max:2500', 'required'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        if (request()->file('gambar')) {
            $gmbr = request()->file('gambar');
            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'img/tipe';
            $gmbr->move($tujuan_upload, $nama_file);
        }
        $data = tipeInvest::create([
            'paket' => $request->paket,
            'investasi' => $request->investasi,
            'persenanhari' => $request->bungaperhari,
            'bungaperhari' => $request->hrbp,
            'lamapenarikanbunga' => $request->periodepenarikanbunga,
            'lamapenarikan' => $request->lamainvestasi,
            'total' => $request->investasi + ($request->hrbp * $request->lamainvestasi),
            'persenadmin' => $request->biayaadmin,
            'biayaadmin' => null,
            'biayawd' => $nama_file ?? null,
            'status' => $request->status,
            'limit' => $request->limit ?? null,
            'status_user' => $request->statususer,
            'limit_user' => $request->limituser ?? null
        ]);

        if ($data) {
        
            return 'success';
        }
    }
    public function destroy($id)
    {
        $data = tipeInvest::where('id',$id)->first();
        if ($data->biayawd != null) {
            $path = '/img/tipe/' . $data->biayawd;
            $bases = $_SERVER['DOCUMENT_ROOT'];
            if (file_exists($bases . '/' . $path)) {
                unlink($bases . '/' . $path);
                $data->biayawd = null;
            } else {
                return 'gagal hapus foto';
            }
        }
        if ($data) {
         
            $data->delete();
            return 'success'; 
        }
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paket' => ['required', 'string', 'max:255'],
            'investasi' => ['required', 'string', 'max:255'],
            'bungaperhari' => ['required', 'string', 'max:255'],
            'hrbp' => ['required', 'string', 'max:255'],
       
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = tipeInvest::where('id',$request->id)->first();
     $data->paket = $request->paket;
     $data->investasi = $request->investasi;
     $data->persenanhari = $request->bungaperhari;
     $data->bungaperhari = $request->hrbp;
     $data->lamapenarikanbunga = $request->periodepenarikanbunga;
     $data->lamapenarikan = $request->lamainvestasi;
     $data->total = $request->investasi + ($request->hrbp * $request->lamainvestasi);
     $data->persenadmin = $request->biayaadmin;
     $data->biayaadmin = $request->biayaadmin * 0.01 * $request->investasi;
     $data->status = $request->statusu;
     $data->limit = $request->limit ?? null;
     if (request()->file('gambar')) {
        $path = '/img/tipe/' . $data->biayawd;
        $bases =  $_SERVER['DOCUMENT_ROOT'];
        if ($data->biayawd != null) {
            if (file_exists($bases . '/' . $path)) {
                unlink($bases . '/' . $path);
                $data->biayawd = null;
            } else {
                return "gagal hapus foto";
            }
        }

        $gmbr = request()->file('gambar');
        $nama_file = str_replace(' ', '_', time() . "_" . $gmbr->getClientOriginalName());
        $tujuan_upload = 'img/tipe';
        $gmbr->move($tujuan_upload, $nama_file);

        $data->biayawd = $nama_file ?? null;
    }
            $data->save();

        if ($data) {
        
            return 'success';
        }
    }
}
