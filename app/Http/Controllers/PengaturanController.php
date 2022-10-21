<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Validator;
class PengaturanController extends Controller
{
    public function index()
    {
        $data = Pengaturan::first();
        return view('admin.pengaturan',compact('data'));
    }
    public function storesaldo(Request $request)
    {
        $data = Pengaturan::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'minimal' => ['string', 'max:255'],
            'biayaadmin' =>  ['string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;;
        }
        $data->minimal = $request->minimal;
        $data->biayaadmin = $request->biayaadmin;
        $data->level1 = $request->level1;
        $data->level2 = $request->level2;
        $data->level3 = $request->level3;
        $data->persen = $request->persen;

        $data->save();
        return 'success';
    }
    public function storekontak(Request $request)
    {
        $data = Pengaturan::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'group' => ['string', 'max:255'],
            'alamat' =>  ['string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;;
        }
        $data->groupwa = $request->group;
        $data->alamat = $request->alamat;
        $data->wa = $request->wa;
        $data->email = $request->email;
        $data->nomor = $request->nomor;
        $data->persenan = $request->telegram;

        $data->save();
        return 'success';
    }
    public function storeinformasi(Request $request)
    {
        $data = Pengaturan::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'investor' => ['string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;;
        }
        $data->investor = $request->investor;
        $data->bonusperhari = $request->bonus;
    

        $data->save();
        return 'success';
    }
}
