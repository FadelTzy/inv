<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\notif;

class NotifController extends Controller
{
    public function notif()
    {
        if (request()->ajax()) {
            return Datatables::of(notif::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    if ($data->jns_notif == 1) {
                        $btn =
                            "<ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <a type='button' target='_blank' href='" .
                            url('data-investor') .
                            '/' .
                            "'   class='btn btn-success btn-xs mb-1'>Lihat</a>

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
        return view('admin.notif');
    }
}
