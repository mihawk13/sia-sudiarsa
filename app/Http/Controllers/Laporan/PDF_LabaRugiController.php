<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PDF_LabaRugiController extends Controller
{
    protected $pdf;

    public function __construct(\App\Models\PDF_LabaRugi $fpdf)
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

        $this->pdf->SetMargins(35, 44, 35);

        $this->pdf->ln(10);
        $this->pdf->SetFont('Arial', '', 10);

        $totPendapatan = 0;
        $totBeban = 0;

        $pemasukan = DB::select("SELECT tanggal, b.kode, b.nama, SUM(a.kredit) jumlah FROM (
            SELECT tanggal, '11' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_penjualan) AS a
            INNER JOIN akun AS b ON a.akun_id=b.id
            WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        $beban = DB::select("SELECT tanggal, akun_id, b.nama, SUM(jumlah) AS jumlah FROM transaksi_biaya AS a
                                INNER JOIN akun AS b ON a.akun_id=b.id
                                WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);

        $no = 1;

        $this->pdf->Cell(25, 7, 'Pendapatan Usaha', 0, 0, 'L');
        $this->pdf->ln(7);

        foreach ($pemasukan as $pms) {
            $totPendapatan += $pms->jumlah;
            $this->pdf->Cell(10, 7, $no++ . '.', 0, 0, 'L');
            $this->pdf->Cell(60, 7, $pms->nama, 0, 0, 'L');
            $this->pdf->Cell(30, 7, 'Rp. ' . number_format($pms->jumlah), 0, 0, 'R');
            $this->pdf->ln(7);
        }

        $this->pdf->Cell(110, 7, 'Jumlah Pendapatan', 0, 0, 'L');
        $this->pdf->Cell(30, 7, 'Rp. ' . number_format($totPendapatan), 0, 0, 'R');
        $this->pdf->ln(20);

        $this->pdf->Cell(25, 7, 'Beban Usaha', 0, 0, 'L');
        $this->pdf->ln(7);

        $no = 1;
        foreach ($beban as $bbn) {
            $totBeban += $bbn->jumlah;
            $this->pdf->Cell(10, 7, $no++ . '.', 0, 0, 'L');
            $this->pdf->Cell(60, 7, $bbn->nama, 0, 0, 'L');
            $this->pdf->Cell(30, 7, 'Rp. ' . number_format($bbn->jumlah), 0, 0, 'R');
            $this->pdf->ln(7);
        }

        $this->pdf->Cell(110, 7, 'Jumlah Beban', 0, 0, 'L');
        $this->pdf->Cell(30, 7, '(Rp. ' . number_format($totBeban) . ')', 0, 0, 'R');
        $this->pdf->ln(15);

        $totLabRug = $totPendapatan - $totBeban;
        $ketLabRug = ($totLabRug < 0) ? 'Total Kerugian' : 'Laba Bersih';

        $this->pdf->ln(1);
        $this->pdf->SetFont('Arial', 'B', 10);

        if ($totLabRug < 0) {
            $this->pdf->SetTextColor(255, 0, 0);
        } else {
            $this->pdf->SetTextColor(0, 255, 0);
        }

        $this->pdf->Cell(110, 7, $ketLabRug, 0, 0, 'L');
        $this->pdf->Cell(30, 7, 'Rp. ' . number_format($totLabRug), 0, 0, 'R');
        $this->pdf->ln(7);

        $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->Output("Laba_Rugi.pdf", "I");
    }
}
