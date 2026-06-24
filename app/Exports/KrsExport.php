<?php

namespace App\Exports;

use App\Models\Krs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KrsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $npm;

    public function __construct($npm = null)
    {
        $this->npm = $npm;
    }

    public function collection()
    {
        $query = Krs::with(['mahasiswa', 'mataKuliah']);

        if ($this->npm) {
            $query->where('npm', $this->npm);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NPM',
            'Nama Mahasiswa',
            'Kode Mata Kuliah',
            'Nama Mata Kuliah',
            'SKS',
        ];
    }

    public function map($krs): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $krs->npm,
            $krs->mahasiswa->nama ?? '-',
            $krs->kode_matakuliah,
            $krs->mataKuliah->nama_matakuliah ?? '-',
            $krs->mataKuliah->sks ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '16a34a']],
            ],
        ];
    }
}