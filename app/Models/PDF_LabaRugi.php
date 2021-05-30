<?php

namespace App\Models;

use Codedge\Fpdf\Fpdf\Fpdf;

class PDF_LabaRugi extends Fpdf
{
    public function Header()
    {
        // $this->Image(storage_path() . '/logo.jpg',10,6,30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(185, 0, 'Laporan Laba Rugi', 0, 0, 'C');
        $this->ln(7);
        $this->Cell(185, 0, 'UD Sudiarsa Helm', 0, 0, 'C');
        $this->ln(7);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
