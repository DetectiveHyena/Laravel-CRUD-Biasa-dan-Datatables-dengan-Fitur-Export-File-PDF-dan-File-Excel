<?php

namespace App\Exports;

use App\Kpop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KpopsExport implements FromCollection, WithHeadings {
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return Kpop::all();
    }
    
    public function headings(): array
    {
        return [
            '#',
            'Nama Label',
            'CEO Sekarang',
            'Logo',
            'Didirikan Pada',
            'Instagram Akun',
        ];
    }
}
