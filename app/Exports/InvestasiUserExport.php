<?php

namespace App\Exports;

use App\Models\pengajuanInvestasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Akaunting\Money\Money;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvestasiUserExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $id;

    public function __construct($id)
    {
        
        $this->id = $id;
    }
    public function collection()
    {
        return  pengajuanInvestasi::with('oRiwayat')
        ->where('id_user', $this->id)
        ->get();
    }
    public function map($invoice): array
    {
        return [
            Money::IDR($invoice->jumlah_investasi, true), 
            Money::IDR($invoice->oRiwayat->sum('jumlah_depo'), true), 
            $invoice->oTipe->periodik,
            $invoice->status_investasi == 1 ? 'Progress' : 'Selesai', 
            $invoice->created_at->format('Y/m/d')
        ];
    }
    public function headings(): array
    {
        return ['Jumlah Investasi', 'Deposit', 'Tipe Investasi', 'Status','Tanggal Pengajuan'];
    }
}
