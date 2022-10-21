<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Akaunting\Money\Money;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SaldoExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with('oDatasaldo','mDeposit','mWd')->where('role',3)->get();
    }
    public function map($invoice): array
    {
        return [
            $invoice->nama,
            'Investor',
            $invoice->is_active == 1 ? 'Terverifikasi' : 'Belum',
           Money($invoice->oDatasaldo->saldo_active ?? 0,'IDR',true) ,
           Money( $invoice->oDatasaldo->saldo_tertahan ?? 0,'IDR',true),
           Money( $invoice->mDeposit->sum('jumlah') ?? 0,'IDR',true),
           Money( $invoice->mWd->sum('jumlah') ?? 0,'IDR',true),







           
        ];
    }
    public function headings(): array
    {
        return ['Nama','Role', 'Status', 'Saldo Aktif' ,'Saldo Tertahan','Total Deposit','Total WD' ];
    }
}
