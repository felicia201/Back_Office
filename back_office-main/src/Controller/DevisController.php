<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Repository\DevisRepository;
use App\Service\PdfGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TCPDF;

#[Route('/devis')]
class DevisController extends AbstractController
{
    private $pdfGenerator;

    public function __construct(PdfGenerator $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    #[Route('/', name: 'app_devis_index', methods: ['GET'])]
    public function index(DevisRepository $devisRepository): Response
    {
        return $this->render('devis/index.html.twig', [
            'devis' => $devisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $devi = new Devis();
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($devi);
            $entityManager->flush();

            return $this->redirectToRoute('app_devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis/new.html.twig', [
            'devi' => $devi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_show', methods: ['GET'])]
    public function show(Devis $devi): Response
    {
        return $this->render('devis/show.html.twig', [
            'devi' => $devi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Devis $devi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis/edit.html.twig', [
            'devi' => $devi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_delete', methods: ['POST'])]
    public function delete(Request $request, Devis $devi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($devi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_devis_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/download-pdf/{id}', name: 'download_pdf_devis', methods: ['GET'])]
    public function downloadPdf(Devis $devi): Response
    {
        // Générer le contenu HTML du PDF
        $html = $this->generatePdfHtml($devi);

        // Créer une instance de TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Définir le contenu du PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Devis');
        $pdf->SetSubject('Devis');
        $pdf->SetKeywords('Devis');

        // Ajouter une page
        $pdf->AddPage();

        // Écrire le contenu HTML dans le PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        
        ob_clean();

        // Télécharger le PDF
        $response = new Response($pdf->Output('devis.pdf', 'D'));
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }


// generation du pdf a partir du devis
private function generatePdfHtml(Devis $devi): string
{
    
    $dateString = $devi->getDateDevis()->format('Y-m-d'); 

   // pour obtenir le montant total
    $montant = $devi->getMontantTotal(); 

    // Générer le HTML du devis
    $html = '<h1>Devis</h1>';
    $html .= '<p>Reference: ' . $devi->getReference() . '</p>';
    $html .= '<p>Client Nom: ' . $devi->getClientNom() . '</p>';
    $html .= '<p>Client Adresse: ' . $devi->getClientAdresse() . '</p>';
    $html .= '<p>Client Email: ' . $devi->getClientEmail() . '</p>';
    $html .= '<p>Date Devis: ' . $dateString . '</p>';
    $html .= '<p>Montant Total: ' . $montant . '</p>';
    $html .= '<p>Description: ' . $devi->getDescription() . '</p>';
    $html .= '<p>Duree Validite: ' . $devi->getDureeValidite() . '</p>';
    $html .= '<p>Statut: ' . $devi->getStatut() . '</p>';
    $html .= '<p>Termes Conditions: ' . $devi->getTermesConditions() . '</p>';
    $html .= '<p>Informations Supplementaires: ' . $devi->getInformationsSupplementaires() . '</p>';

    return $html;
}


}
