<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PDF_CALKController extends Controller
{
    protected $pdf;

    public function __construct(\App\Models\PDF_CALK $fpdf)
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
            SELECT tanggal, '12' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_penjualan) AS a
            INNER JOIN akun AS b ON a.akun_id=b.id
            WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        $beban = DB::select("SELECT tanggal, akun_id, b.nama, SUM(jumlah) AS jumlah FROM transaksi_biaya AS a
                                INNER JOIN akun AS b ON a.akun_id=b.id
                                WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);



        foreach ($pemasukan as $pms) {
            $totPendapatan += $pms->jumlah;
        }

        foreach ($beban as $bbn) {
            $totBeban += $bbn->jumlah;
        }

        $totLabRug = $totPendapatan - $totBeban;

        $this->pdf->ln(1);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(110, 7, "a. Gambaran Umum Usaha", 0, 1, 'L');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(110, 5, "Usaha ini berdiri pada tahun 2004, dan bergerak dibidang usaha dagang menjual helm", 0, 1, 'L');
        $this->pdf->Cell(110, 5, "dengan berbagai jenis dan merk. Berstandar Nasional Indonesia (SNI)", 0, 1, 'L');
        $this->pdf->ln(2);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(110, 7, "b. Penyusunan Laporan Keuangan", 0, 1, 'L');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(110, 5, "Dasar-dasar dari penyusunan Laporan Keuangan pada usaha ini yaitu mengikuti aturan", 0, 1, 'L');
        $this->pdf->Cell(110, 5, "Standar Akuntasnsi Keuangan - Entitas Mikro Kecil dan Menengah (SAK-EMKM)", 0, 1, 'L');
        $this->pdf->ln(2);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(110, 7, "c. Informasi Laporan Keuangan", 0, 1, 'L');
        $this->pdf->SetFont('Arial', '', 10);

        // if ($totLabRug < 0) {
        //     $this->pdf->SetTextColor(255, 0, 0);
        // } else {
        //     $this->pdf->SetTextColor(0, 255, 0);
        // }

        $this->pdf->Cell(105, 7, "Laba Bersih Bulan Ini", 0, 0, 'L');
        $this->pdf->Cell(30, 7, 'Rp. ' . number_format($totLabRug), 0, 0, 'R');
        $this->pdf->ln(7);

        // $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->Output("Laba_Rugi.pdf", "I");
    }
}
