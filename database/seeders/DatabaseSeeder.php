<?php

namespace Database\Seeders;

use App\Models\Bankuser;
use App\Models\ktp;
use App\Models\saldoUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
     $this->createuser();
    
    }
    public function createuser()
    {
          $data = User::create([
            'nama' => fake()->name(),
            'username' => fake()->userName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'role' => 3,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => 1,
            'nomor' => '123123123',
            'is_active' => 1
        ]);
        ktp::create([
            'id_user' => $data->id,
            'nama' => $data->username,
            'nik' => fake()->randomNumber(7),
            'tempat_lahir' => 'makassar',
            'tanggal_lahir' => '04123',
            'jk' => 'perempuan',
            'alamat' => 'alaman',
            'rt' => '1',
            'rw' => '2',
            'kel_des' => 'maa',
            'kecamatan' => 'kecamatan',
            'agama' => 'agama',
            'pekerjaan' => 'pekerjaan',
            'status_kawin' => 'statuskawin',
            'warganegara' => 'indonesia',
            'rekening' =>'rekening',
            'bank' =>'bank',
            'kode_referal' => fake()->randomNumber(5) . $data->id,
            'status_referal' => 0,
            'status_bonus' => 1,

        ]);
        saldoUser::create([
            'id_user' => $data->id,
            'saldo_active' => 0,
            'saldo_tertahan' => 0,
            'total_wd' => 0,
        ]);
        Bankuser::create([
            'id_user' => $data->id,
            'nomor_rekening' => 123123123,
            'nama_rekening' => 'BCA',
            'atasnama' => $data->nama
        ]);
    }
}
