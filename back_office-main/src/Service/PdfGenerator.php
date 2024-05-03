<?php

namespace App\Service;

use TCPDF;
use App\Entity\Devis;

class PdfGenerator
{
    public function generatePdf(Devis $devis)
    {
        // Initialise TCPDF
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Devis');
        $pdf->SetHeaderData('', '', 'Devis', '');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Generate PDF content
        $html = '<h1>Devis</h1>';
        $html .= '<p>Date: ' . $devis->getDate()->format('Y-m-d') . '</p>';
        $html .= '<p>Montant: ' . $devis->getMontant() . '</p>';

        // Write HTML content to PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Return PDF as string
        return $pdf->Output('devis.pdf', 'S');
    }
}
