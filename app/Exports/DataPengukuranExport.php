<?php

namespace App\Exports;

use App\Models\Balita;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use App\Helpers\PerhitunganUmur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class DataPengukuranExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    protected $posyandu;
    protected $puskesmas;
    protected $user;
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun, $id_posyandu = null)
    {
        $this->user = Auth::user();
        $this->bulan = $bulan;
        $this->tahun = $tahun;

        $posyandu_id = $id_posyandu ?? $this->user->id_posyandu;

        $this->posyandu = Posyandu::find($posyandu_id);
        $this->puskesmas = $this->posyandu ? Puskesmas::find($this->posyandu->id_puskesmas) : null;
    }

    public function collection()
    {
        $bulan = $this->bulan;
        $tahun = $this->tahun;

        return Balita::where('id_posyandu', $this->posyandu->id)
            ->whereDate('tanggal_lahir', '<=', Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()) // lahir sebelum atau pada akhir bulan filter
            ->whereDoesntHave('datapengukuran', function ($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal_pengukuran', $bulan)
                    ->whereYear('tanggal_pengukuran', $tahun);
            })
            ->orderBy('nama_balita')
            ->get();
    }


    public function headings(): array
    {
        return [
            'NO',
            'NAMA BALITA',
            'USIA (bulan)',
            'TINGGI BADAN (cm)',
            'BERAT BADAN (kg)',
            'ASI EKSKLUSIF',
            'MPASI',
        ];
    }

    public function map($balita): array
    {
        static $index = 0;
        $index++;

        $usia_balita = PerhitunganUmur::hitungUmurBulanPenuh($balita->tanggal_lahir, $this->bulan, $this->tahun);
        $usia_str = $usia_balita . ' bulan';

        return [
            $index,
            $balita->nama_balita,
            $usia_str,
            '',
            '',
            '',
            '',
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Header Posyandu
                $sheet->setCellValue('A1', 'Posyandu');
                $sheet->setCellValue('C1', ': ' . $this->posyandu->nama_posyandu);
                $sheet->setCellValue('E1', 'Petugas');
                $sheet->setCellValue('F1', ': ' . $this->user->nama);

                $sheet->setCellValue('A2', 'Puskesmas');
                $sheet->setCellValue('C2', ': ' . $this->puskesmas->nama_puskesmas);
                $sheet->setCellValue('E2', 'Tanggal Pengukuran');
                $sheet->setCellValue('F2', ': ' . date('d-m-Y'));

                $sheet->getStyle('A1:G1')->getFont()->setBold(true);
                $sheet->getStyle('A2:G2')->getFont()->setBold(true);

                $headerStyle = $sheet->getStyle('A4:G4');
                $headerStyle->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('0000FF');
                $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $headerStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(15);

                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle('A4:A' . $lastRow)->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A4:G' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Highlight untuk kolom ASI dan MPASI berdasarkan usia
                for ($row = 5; $row <= $lastRow; $row++) {
                    $usiaText = $sheet->getCell('C' . $row)->getValue();
                    preg_match('/(\d+)\s+bulan/', $usiaText, $matches);
                    $bulan = isset($matches[1]) ? (int)$matches[1] : null;

                    if ($bulan !== null && $bulan >= 0 && $bulan <= 6) {
                        $sheet->getStyle('F' . $row)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('FFFF00');
                    }

                    if ($bulan !== null && $bulan >= 6 && $bulan <= 23) {
                        $sheet->getStyle('G' . $row)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('FFFF00');
                    }
                }

                // Petunjuk
                $hintStartRow = $lastRow + 2;
                $sheet->setCellValue("A$hintStartRow", 'Petunjuk:');
                $sheet->setCellValue("A" . ($hintStartRow + 1), '1. Kolom "ASI Eksklusif" (F) dan "MPASI" (G) perlu diisi jika berwarna kuning.');
                $sheet->setCellValue("A" . ($hintStartRow + 2), '2. ASI Eksklusif diisi untuk Balita usia 0-6 bulan, MPASI diisi untuk Balita usia 6-23 bulan.');
                $sheet->setCellValue("A" . ($hintStartRow + 3), '3. Nilai pengisian: ASI Eksklusif = 1 (Ya), 0 (Tidak); MPASI = 1 (Baik), 0 (Tidak Baik).');
                $sheet->setCellValue("A" . ($hintStartRow + 3), '3. Tanggal Pengukuran di sesuaikan dengan bulan dan tahun filter');
                $sheet->getStyle("A$hintStartRow:A" . ($hintStartRow + 4))->getFont()->setItalic(true);
            },
        ];
    }
}
