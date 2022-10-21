<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inforasi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class InforasiController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            
            return Datatables::of(Inforasi::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <a type='button' href='" . url('informasi/edit/' . $data->id . '').  "'  class='btn btn-success btn-sm mb-1'>Edit</a>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-sm mb-1'>Hapus</button>
                    </li>";
             
                    $btn .= '</ul>';

                    return $btn;
                })->addColumn('datenya', function ($data) {
                    
                    $btn = $data->created_at->format("Y-m-d H:i:s");
                    return $btn;
                })->rawColumns(['aksi', 'datenya', 'asal_d', 'select', 'status_p', 'univ'])
                ->make(true);
        }
        return view('admin.informasi');
    }
    public function create()
    {
        return view('admin.create');
    }
    public function edit($id)
    {
        $data = Inforasi::where('id',$id)->first();
        return view('admin.edit',compact('data'));

    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // if (request()->file('gambar')) {

        //     $gmbr = request()->file('gambar');
        //     $nama_file = str_replace(' ', '_', time() . "_" . $gmbr->getClientOriginalName());
        //     $tujuan_upload = 'img/gambar';
        //     $gmbr->move($tujuan_upload, $nama_file);

        // }
        $user = Inforasi::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'slug' => Str::slug($request->judul),
            // 'view' => $request->meta,
            // 'gambar' => $nama_file ?? null,
        ]);
        if ($user) {
            return 'success';
        }
    }
    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // if (request()->file('gambar')) {

        //     $gmbr = request()->file('gambar');
        //     $nama_file = str_replace(' ', '_', time() . "_" . $gmbr->getClientOriginalName());
        //     $tujuan_upload = 'img/gambar';
        //     $gmbr->move($tujuan_upload, $nama_file);

        // }
        // return $request->all();
        $data = Inforasi::where('id',$request->id)->first();
        // return $data;
        $data->judul = $request->judul;
        $data->konten = $request->konten;
        $data->slug = Str::slug($request->judul);

        $data->save();
    
        if ($data) {
            return 'success';
        }
    }
}
