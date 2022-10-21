<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Bank;
class BankController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(Bank::get())
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

                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.data.penerima');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'norek' => ['required', 'string', 'max:255'],
            'namabank' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = Bank::create([
            'nama' => $request->nama,
            'rekening' => $request->norek,
            'bank' => $request->namabank,
            'nohape' => $request->nohape,
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function destroy($id)
    {
        $data = Bank::where('id', $id)->first();

        if ($data) {
            $data->delete();
            return 'success';
        }
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'norek' => ['required', 'string', 'max:255'],
            'namabank' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = Bank::where('id', $request->id)->first();
        $data->nama = $request->nama;
        $data->rekening = $request->norek;
        $data->bank = $request->namabank;
        $data->nohape = $request->nohape;
        $data->save();

        if ($data) {
            return 'success';
        }
    }
}
