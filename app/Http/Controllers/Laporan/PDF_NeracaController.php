<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PDF_NeracaController extends Controller
{
    protected $pdf;

    public function __construct(\App\Models\PDF_Neraca $fpdf)
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

        $this->pdf->SetMargins(35, 20, 25);
        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->ln(10);
        $this->pdf->Cell(25, 7, 'Kode Akun', 1, 0, 'C');
        $this->pdf->Cell(50, 7, 'Nama Akun', 1, 0, 'C');
        $this->pdf->Cell(30, 7, 'Debit', 1, 0, 'C');
        $this->pdf->Cell(30, 7, 'Kredit', 1, 1, 'C');
        $this->pdf->ln(0);

        $laporan = DB::select("SELECT tanggal, b.kode, b.nama, SUM(a.debit) debit, SUM(a.kredit) kredit FROM (
            SELECT tanggal, '1' AS 'akun_id', SUM(grand_total) AS debit, 0 kredit FROM transaksi_penjualan
            UNION ALL
            SELECT tanggal, '11' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_penjualan

            UNION ALL

            SELECT tanggal, '1' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_pembelian
            UNION ALL
            SELECT tanggal, '12' AS 'akun_id', SUM(grand_total) AS debit, 0 kredit FROM transaksi_pembelian

            UNION ALL

            SELECT tanggal, '1' AS 'akun_id', SUM(jumlah) AS debit, 0 kredit FROM transaksi_kas
            UNION ALL
            SELECT tanggal, akun_id, 0 AS debit, SUM(jumlah) kredit FROM transaksi_kas

            UNION ALL

            SELECT tanggal, '1' AS 'akun_id', 0 AS debit, SUM(jumlah) kredit FROM transaksi_biaya
            UNION ALL
            SELECT tanggal, akun_id, SUM(jumlah) AS debit, 0 kredit FROM transaksi_biaya

            ) AS a INNER JOIN akun AS b ON a.akun_id=b.id WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);

        $totDebit = 0;
        $totKredit = 0;

        foreach ($laporan as $lap) {
            $totDebit += $lap->debit;
            $totKredit += $lap->kredit;
            $this->pdf->Cell(25, 7, $lap->kode, 1, 0, 'C');
            $this->pdf->Cell(50, 7, $lap->nama, 1, 0, 'C');
            $this->pdf->Cell(30, 7, number_format($lap->debit), 1, 0, 'R');
            $this->pdf->Cell(30, 7, number_format($lap->kredit), 1, 1, 'R');
            $this->pdf->ln(0);
        }
        $this->pdf->Cell(75, 7, 'TOTAL', 1, 0, 'C');
        $this->pdf->Cell(30, 7, number_format($totDebit), 1, 0, 'R');
        $this->pdf->Cell(30, 7, number_format($totKredit), 1, 1, 'R');

        $this->pdf->Output("Neraca_Saldo.pdf", "I");
    }
}
