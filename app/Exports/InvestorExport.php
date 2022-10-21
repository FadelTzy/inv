<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvestorExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return User::with('oKtp')->where('role',3)->get();
    }
    public function map($invoice): array
    {
        return [
            $invoice->nama,
            'Investor',
            $invoice->is_active == 1 ? 'Terverifikasi' : 'Belum',
            $invoice->username,
            $invoice->nomor,
            $invoice->nik,
            $invoice->tempat_lahir,
            $invoice->tanggal_lahir,
            $invoice->jk,
            $invoice->alamat,
            $invoice->rt . ' / '. $invoice->rw,
            $invoice->kel_desa,
            $invoice->kecamatan,
            $invoice->provinsi,
            $invoice->kabupaten_kota,
            $invoice->agama,
            $invoice->goldar,
            $invoice->pekerjaan,
            $invoice->status_kawin,
            $invoice->warganegara,





           
        ];
    }
    public function headings(): array
    {
        return ['Nama','Role', 'Status', 'Username', 'Nomor','NIK','Tempat Lahir','Tanggal Lahir','Jenis Kelamin','Alamat','RT/RW','Kel/Desa','Kecamatan','Provinsi','Kabupaten/Kota','Agama','Golongan Darah','Pekerjaan','Status Kawin','Warga Negara' ];
    }
}
