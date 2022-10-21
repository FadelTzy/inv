<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Deposit;
use App\Models\saldoUser;
use App\Models\Bank;
use App\Models\tipeInvest;
use App\Http\Resources\UserResource;
use App\Models\ktp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Realisasi;
use App\Models\pengajuanInvestasi;
use App\Models\Bankuser;
use App\Models\Historybunga;
use App\Models\Userredeem;
use App\Models\Redeemcode;
use App\Models\notif;
use App\Models\Referal;
use App\Models\riwayatnotif;

class CAIUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'password' => 'min:6|required_with:passwordc|same:passwordc',
            'passwordc' => 'min:6',
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // return ;
        $data = User::create([
            'nama' => $request->nama,
            'role' => 3,
            'username' => str_replace(' ', '', $request->nama),
            'status' => 1,
            'nomor' => $request->nomor,
            'password' => Hash::make($request->password),
            'email' => $request->nomor,
        ]);

        if ($data) {
            $checkrefer = ktp::where('kode_referal', $request->kode)->first();
            ktp::create([
                'id_user' => $data->id,
                'nama' => $data->nama,
                'status_bonus' => 1,
                'kode_referal' => fake()->randomNumber(5) . $data->id,
                'status_bonus' => 1,
                'status_referal' => $checkrefer != null ? 1 : 0,
                'kode_referal_orang' => $checkrefer != null ? $request->kode : null,
            ]);
            $user = saldoUser::create([
                'id_user' => $data->id,
                'saldo_active' => '0',
                'saldo_tertahan' => '0',
                'total_wd' => '0',
            ]);

            notif::create([
                'id_item' => $data->id,
                'jns_notif' => 1,
                'pesan' => 'Registrasi User Investor',
                'status' => 1,
            ]);

            riwayatnotif::create([
                'id_item' => $data->id,
                'jns_notif' => 1,
                'pesan' => 'Registrasi User Investor',
                'status' => 1,
            ]);
            return 'success';
        }
    }
    public function afiliasi($id)
    {
        $data = Referal::where('id_penerima', $id)
            ->with('akunKedua.akunKetiga')
            ->first();

        if ($data) {
            return response()->json(new UserResource(true, 'Success', $data));
        } else {
            return response()->json(new UserResource(false, 'Fail', 'Tidak ada data'));
        }
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|string|max:255',
        //     'password' => 'required'
        // ]);

        $cekemail = User::where('email', $request->email)->get();

        if (count($cekemail) != 0) {
            return response()->json(new UserResource(false, 'Gagal Foto', 'Data Email Telah Terdaftar'));
        }

        // if ($validator->fails()) {
        //     return response()->json(new UserResource(false, 'Gagal Registrasi', 'Data tidak Lengkap'));
        // }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $filename = time() . '_' . $file->getClientOriginalName();

            // File extension
            $extension = $file->getClientOriginalExtension();

            // File upload location
            $location = 'file/ktp';

            // Upload file
            $file->move($location, $filename);

            // File path
            $filepath = url('file/ktp' . $filename);

            $user = User::create([
                'nama' => $request->nama,
                'nomor' => $request->nomor,
                'email' => $request->email,
                'username' => $request->username,
                'role' => 3,
                'is_active' => 0,
                'status' => 0,
                'kode' => 0,
                'password' => Hash::make($request->password),
            ]);

            $time = time();
            $kode_referal = substr($time, strlen($time) - 3) . '0' . $user->id;

            $ktps = ktp::create([
                'id_user' => $user->id,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'kel_des' => $request->kel_des,
                'kecamatan' => $request->kecamatan,
                'provinsi' => $request->provinsi,
                'kabupaten_kota' => $request->kabupaten_kota,
                'agama' => $request->agama,
                'goldar' => $request->goldar,
                'pekerjaan' => $request->pekerjaan,
                'nik' => $request->nik,
                'foto' => $filepath,
                'status_kawin' => $request->status_kawin,
                'warganegara' => $request->warganegara,
                'kode_referal' => $kode_referal,
            ]);

            $user = saldoUser::create([
                'id_user' => $user->id,
                'saldo_active' => '0',
                'saldo_tertahan' => '0',
                'total_wd' => '0',
            ]);

            return response()->json(new UserResource(true, 'Berhasil Registrasi', $user, $ktps));
        } else {
            if ($request->email == '') {
                $user = User::create([
                    'nama' => $request->nama,
                    'nomor' => $request->nomor,
                    'email' => $request->nomor,
                    'username' => $request->username,
                    'role' => 3,
                    'is_active' => 0,
                    'status' => 0,
                    'kode' => 0,
                    'password' => Hash::make($request->password),
                ]);

                $time = time();
                $kode_referal = substr($time, strlen($time) - 3) . '0' . $user->id;

                $ktps = ktp::create([
                    'id_user' => $user->id,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jk' => $request->jk,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kel_des' => $request->kel_des,
                    'kecamatan' => $request->kecamatan,
                    'provinsi' => $request->provinsi,
                    'kabupaten_kota' => $request->kabupaten_kota,
                    'agama' => $request->agama,
                    'goldar' => $request->goldar,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    // 'foto' => $filepath,
                    'status_kawin' => $request->status_kawin,
                    'warganegara' => $request->warganegara,
                    'kode_referal' => $kode_referal,
                ]);

                $user = saldoUser::create([
                    'id_user' => $user->id,
                    'saldo_active' => '0',
                    'saldo_tertahan' => '0',
                    'total_wd' => '0',
                ]);

                return response()->json(new UserResource(true, 'Berhasil Registrasi', $user, $ktps));
            } else {
                $user = User::create([
                    'nama' => $request->nama,
                    'nomor' => $request->nomor,
                    'email' => $request->email,
                    'username' => $request->username,
                    'role' => 3,
                    'is_active' => 0,
                    'status' => 0,
                    'kode' => 0,
                    'password' => Hash::make($request->password),
                ]);

                $time = time();
                $kode_referal = substr($time, strlen($time) - 3) . '0' . $user->id;

                $ktps = ktp::create([
                    'id_user' => $user->id,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jk' => $request->jk,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kel_des' => $request->kel_des,
                    'kecamatan' => $request->kecamatan,
                    'provinsi' => $request->provinsi,
                    'kabupaten_kota' => $request->kabupaten_kota,
                    'agama' => $request->agama,
                    'goldar' => $request->goldar,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    // 'foto' => $filepath,
                    'status_kawin' => $request->status_kawin,
                    'warganegara' => $request->warganegara,
                    'kode_referal' => $kode_referal,
                ]);

                $user = saldoUser::create([
                    'id_user' => $user->id,
                    'saldo_active' => '0',
                    'saldo_tertahan' => '0',
                    'total_wd' => '0',
                ]);

                return response()->json(new UserResource(true, 'Berhasil Registrasi', $user, $ktps));
            }
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::where('email', $request->email)
            ->get()
            ->first();

        // dd(Hash::make($request->password));

        // $nuser = count($user);

        if ($user && password_verify($request->password, $user->password)) {
            return response()->json(new UserResource(true, 'Berhasil Login', $user));
        } else {
            return response()->json(new UserResource(false, 'Email atau Password salah', 'email atau password salah'));
        }
    }

    public function getuser($id)
    {
        $users = DB::table('users')
            ->join('saldo_users', 'saldo_users.id_user', '=', 'users.id')
            ->join('ktps', 'ktps.id_user', '=', 'users.id')
            ->where('users.id', $id)
            ->get()
            ->first();

        return response()->json(new UserResource(true, 'Berhasil', $users));
    }

    public function getbanks()
    {
        $banks = Bank::all();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function gettipeinvests()
    {
        $banks = tipeInvest::all();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function getriwayatdepo($id)
    {
        $banks = Deposit::where('id_user', $id)->get();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function deposit(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $a = mt_rand(100000, 999999);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $filename = time() . '_' . $file->getClientOriginalName();

            // File extension
            $extension = $file->getClientOriginalExtension();

            // File upload location
            $location = 'public/img/buktidepo';

            // Upload file
            $file->move($location, $filename);

            // File path
            $filepath = url('public/img/buktidepo/' . $filename);

            $deposit = Deposit::create([
                'id_user' => $request->id_user,
                'jumlah' => $request->jumlah,
                'kode' => $a,
                'buktitransfer' => $filepath,
                'id_penerima' => $request->id_penerima,
                'status_masuk' => 0,
                'status' => 1,
                'tanggal_aju_depo' => $date,
                'jenis' => 1,
            ]);

            return response()->json(new UserResource(true, 'Berhasil Registrasi', $deposit));
        } else {
            return response()->json(new UserResource(false, 'Gagal Foto', 'Tidak ada Foto'));
        }
    }

    public function updaterekening(Request $request)
    {
        $idktp = ktp::where('id_user', $request->id_user)
            ->get()
            ->first();
        $ktps = ktp::find($idktp->id);
        $ktps->bank = $request->input('bank');
        $ktps->rekening = $request->input('rekening');
        $ktps->update();

        return response()->json(new UserResource(true, 'Berhasil Registrasi', $ktps));
    }

    public function investasi(Request $request)
    {
        $saldouser = saldoUser::where('id_user', $request->id)
            ->get()
            ->first();
        $validator = Validator::make($request->all(), [
            'tipe' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $k1 = strtoupper(substr(Date('M'), 0, 2));
        $k2 = Date('Hy');
        $ktotal = pengajuanInvestasi::where('id_user', $request->id)->count() + 1;
        $ktp = ktp::where('id_user', $request->id)->first();
        $k3 = strtoupper(substr($ktp->nama, 0, 1));
        $k4 = 'PI';
        $kodege = $k1 . $k2 . $k3 . $ktotal . $k4;
        $tipe = tipeInvest::where('id', $request->tipe)->first();

        $today = Date('Y-m-d H:i:s');

        if ($saldouser->saldo_active < $tipe->investasi) {
            return response()->json(new UserResource(true, 'Gagal Invest', 'Saldo Tidak Mencukupi'));
        }
        $data = pengajuanInvestasi::create([
            'id_user' => $request->id,
            'tipe_investasi' => $request->tipe,
            'kode' => $kodege,
            'nama' => $tipe->paket,
            'investasi' => $tipe->investasi,
            'bungaharian' => $tipe->persenanhari,
            'rupiahbungaharian' => $tipe->bungaperhari,
            'penarikanbunga' => $tipe->lamapenarikanbunga,
            'penarikaninvestasi' => $tipe->lamapenarikan,
            'total_bonus' => $tipe->lamapenarikan * $tipe->bungaperhari,
            'biayawd' => $tipe->biayawd,
            'biayaadmin' => $request->biayaadmin,
            'status_pengajuan' => 3,
            'status_investasi' => 1,
        ]);
        $saldoUser = saldoUser::where('id_user', $request->id)->first();
        $saldoUser->saldo_active = $saldoUser->saldo_active - ($tipe->investasi + $request->biayaadmin);
        $saldoUser->saldo_tertahan = $saldoUser->saldo_tertahan + $tipe->investasi;
        $nextday = Carbon::createFromFormat('Y-m-d H:i:s', $today)
            ->addDays($data->penarikaninvestasi)
            ->toDateTimeString();

        $realisasi = Realisasi::create([
            'id_pengajuan' => $data->id,
            'id_user' => $data->id_user,
            'tanggal_berlaku' => $today,
            'tanggal_akhir' => $nextday,
            'lamahari' => $data->penarikaninvestasi, //lamamodal ditarik
            'harike' => 0, // hari ke ??
            'lamapenarikanbunga' => $data->penarikanbunga, //lama bunga ditarik / per apa
            'penarikanbungake' => 0, //bunga ditarik kebrapa kali ??
            'totalpenarikanbunga' => 0, //ini bertambah kalau bunga ke dompet --> pada saat pengecekan harian
            'investasi' => $data->investasi,
            'persenbunga' => $data->bungaharian,
        ]);
        // return $realisasi->persenbunga * 0.01 * $realisasi->investasi;
        // $history = Historybunga::create([
        //     'id_pengajuan' => $data->id,
        //     'id_user' => $data->id_user,
        //     'id_realisasi' => $realisasi->id,
        //     'harike' => 1,
        //     'jumlah' => $realisasi->persenbunga * 0.01 * $realisasi->investasi,
        // ]);
        // if ($history) {
        //     $realisasi->harike = 1;
        //     $realisasi->bungatertunda = $history->jumlah;
        //     $realisasi->save();
        // }
        // $saldoUser->saldo_tertahan = $saldoUser->saldo_tertahan + $history->jumlah;
        $saldoUser->save();

        return response()->json(new UserResource(true, 'Berhasil Invest', $realisasi));
    }

    public function withdraw(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $a = mt_rand(100000, 999999);

        // $deposit = Deposit::create([
        //     'id_user' => $request->id_user,
        //     'jumlah' => $request->jumlah,
        //     'kode' => $a,
        //     'id_penerima' => $request->id_penerima,
        //     'status_masuk' => 0,
        //     'status' => 1,
        //     'tanggal_aju_depo' => $date,
        //     'jenis' => 2,
        // ]);
        $k1 = strtoupper(substr(Date('M'), 0, 2));
        $k2 = Date('Hy');
        $ktotal =
            Deposit::where('id_user', $request->id_user)
                ->where('jenis', 2)
                ->where('status_masuk', 1)
                ->count() + 1;
        $ktp = ktp::where('id_user', $request->id_user)->first();
        $k3 = strtoupper(substr($ktp->nama, 0, 1));
        $k4 = 'PW';
        $kodege = $k1 . $k2 . $k3 . $ktotal . $k4;
        $saldouser = saldoUser::where('id_user', $request->id_user)
            ->get()
            ->first();

        if ($saldouser->saldo_active < $request->jumlah) {
            return response()->json(new UserResource(true, 'Gagal Withdraw', 'Saldo Tidak Mencukupi'));
        }
        $data = Deposit::create([
            'id_user' => $request->id_user,
            'jumlah' => $request->jumlah,
            'kode' => $kodege,
            'status_masuk' => 0,
            'status' => 1,
            'tanggal_aju_depo' => Date('Y-m-d H:i:s'),
            'jenis' => 2,
        ]);

        return response()->json(new UserResource(true, 'Berhasil Withdraw', $data));
    }

    public function getinvestasi($id)
    {
        $banks = pengajuanInvestasi::where('id_user', $id)->get();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function postbankuser(Request $request)
    {
        $data = Bankuser::create([
            'id_user' => $request->id,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_rekening' => $request->nama_rekening,
            'atasnama' => $request->atasnama,
        ]);
        return response()->json(new UserResource(true, 'Berhasil', 'Menambahkan Bank'));
    }

    public function getbankuser($id)
    {
        $banks = Bankuser::where('id_user', $id)->get();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function gethistorybunga($id)
    {
        $banks = Historybunga::where('id_pengajuan', $id)->get();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function getredeemuser($id)
    {
        $banks = Userredeem::where('id_user', $id)->get();
        return response()->json(new UserResource(true, 'Berhasil', $banks));
    }

    public function postredeemcode(Request $request)
    {
        $rd = Redeemcode::where('kode', $request->code)->first();
        if ($rd) {
            if ($rd->status == 1) {
                $check = Userredeem::where('id_user', $request->id)
                    ->where('kode', $request->code)
                    ->first();
                if ($check) {
                    return response()->json(new UserResource(true, 'Peringatan', 'Kode Redeem Sudah Digunakan'));
                } else {
                    $ud = Userredeem::create([
                        'id_user' => $request->id,
                        'id_redeem' => $rd->id,
                        'kode' => $request->code,
                        'nominal' => $rd->nominal,
                    ]);

                    $saldo = saldoUser::where('id_user', $request->id)->first();
                    $saldo->saldo_active = $saldo->saldo_active + $ud->nominal;
                    $saldo->save();
                    return response()->json(new UserResource(true, 'Berhasil', 'Kode Redeem Berhasil Digunakan'));
                }
            } elseif ($rd->status == 2) {
                return response()->json(new UserResource(true, 'Gagal', 'Kode Redeem Habis'));
            } else {
                return response()->json(new UserResource(true, 'Gagal', 'Kode Redeem Tidak Berlaku'));
            }
        } else {
            return response()->json(new UserResource(true, 'Gagal', 'Kode Invalid'));
        }
    }
}
