<?php

namespace App\Http\Controllers;

use FPDF;
use App\Models\Ranking;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $pdf;
    public function __construct()
    {
        $this->pdf = new FPDF;
    }
    public function header()
    {
        // $this->pdf->Image(public_path('/assets/logo.png'), 10, 6, 40);
        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Cell(45);
        $this->pdf->Cell(80, 6, 'LAPORAN PERANKINGAN', 0, 1, 'C');

        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->Cell(45);
        $this->pdf->Cell(80, 6, 'SPK SAW', 0, 1, 'C');
        $this->pdf->SetFont('Arial', 'B', 13);

        // Menambahkan garis header
        $this->pdf->SetLineWidth(1);
        $this->pdf->Line(10, 36, 200, 36);
        $this->pdf->SetLineWidth(0);
        $this->pdf->Line(10, 37, 200, 37);
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
    }
    public function laporan_ranking()
    {
        $rankings = Ranking::orderBy('nilai', 'desc')->get();
        $this->pdf->AddPage('P', 'A4');
        $this->header();
        $this->pdf->SetFont('Arial', '', '8');
        $this->pdf->SetFillColor(11, 48, 91);
        $this->pdf->SetTextColor(255);
        $this->pdf->SetDrawColor(0);
        $this->pdf->Cell(15, 7, "Ranking", 1, '0', 'C', true);
        $this->pdf->Cell(55 + 35, 7, "Nama", 1, '0', 'L', true);
        $this->pdf->Cell(29 + 12 + 27 + 15, 7, "Nilai", 1, '0', 'C', true);
        // $this->pdf->Cell(29, 7, "Harga", 1, '0', 'C', true);
        // $this->pdf->Cell(12, 7, "Diskon", 1, '0', 'C', true);
        // $this->pdf->Cell(27, 7, "Total", 1, '0', 'C', true);
        $this->pdf->Ln();
        //Membuat kolom isi tabel
        $this->pdf->SetFont('Arial', '', '8');
        $this->pdf->SetFillColor(255);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetDrawColor(0);
        foreach ($rankings as $index => $ranking) {
            $this->pdf->Cell(15, 7, $index + 1, 1, '0', 'C', true);
            $this->pdf->Cell(55 + 35, 7, $ranking->nama, 1, '0', 'L', true);
            $this->pdf->Cell(29 + 12 + 27 + 15, 7, $ranking->nilai, 1, '0', 'C', true);
            // $this->pdf->Cell(29, 7,, 1, '0', 'R', true);
            // $this->pdf->Cell(12, 7,  '%', 1, '0', 'R', true);
            // $this->pdf->Cell(27, 7,, 1, '0', 'R', true);
            $this->pdf->Ln();
        }
        $this->pdf->Output("Laporan Hasil Perankingan.pdf", 'I');
        exit;
    }
}
