<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PDF_PersediaanController extends Controller
{
    protected $pdf;

    public function __construct(\App\Models\PDF_Persediaan $fpdf)
    {
        $this->pdf = $fpdf;
    }

    public function cetak($dari, $hingga)
    {
        \Carbon\Carbon::setLocale('id');
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 10);
        // $this->pdf->Cell(85);
        $this->pdf->Cell(185, 0, \Carbon\Carbon::parse($hingga)->isoFormat('D MMMM Y'), 0, 0, 'C');

        $this->pdf->SetMargins(20, 20, 25);
        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->ln(10);
        $this->pdf->Cell(25, 7, 'Kode Barang', 1, 0, 'C');
        $this->pdf->Cell(50, 7, 'Nama Barang', 1, 0, 'C');
        $this->pdf->Cell(30, 7, 'Masuk', 1, 0, 'C');
        $this->pdf->Cell(30, 7, 'Keluar', 1, 0, 'C');
        $this->pdf->Cell(30, 7, 'Stock', 1, 1, 'C');
        $this->pdf->ln(0);

        $barang = Barang::all();

        $totStock = 0;

        foreach ($barang as $brg) {
            $masuk = getMasuk($dari, $hingga, $brg->id);
            $keluar = getKeluar($dari, $hingga, $brg->id);
            $totStock += $masuk - $keluar;
            $this->pdf->Cell(25, 7, $brg->kode, 1, 0, 'C');
            $this->pdf->Cell(50, 7, $brg->nama, 1, 0, 'C');
            $this->pdf->Cell(30, 7, $masuk, 1, 0, 'C');
            $this->pdf->Cell(30, 7, $keluar, 1, 0, 'C');
            $this->pdf->Cell(30, 7, $masuk - $keluar, 1, 1, 'C');
        }
        $this->pdf->Cell(135, 7, 'Total Persediaan', 1, 0, 'C');
        $this->pdf->Cell(30, 7, number_format($totStock), 1, 0, 'C');

        $this->pdf->Output("Persediaan.pdf", "I");
    }
}
