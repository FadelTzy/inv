<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Bankuser;
class BankuserController extends Controller
{
    public function rekening($id)
    {
        if (request()->ajax()) {
            return Datatables::of(Bankuser::where('id_user',$id)->get())
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
    }
}
