<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');

class Tableau extends FPDF
{
    
   
    // En-tête
    function Header()
    {
        // Logo ou en-tête
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Pdf du  Devis',0,1,'C');
        $this->Ln(10);
    }

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    // Tableau amélioré
    function details($header, $resultats,$val)
    {
        // Couleurs, epaisseur du trait et police grasse
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0);
        $this->SetDrawColor(46,46,46);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',8);
        // En-tete
        $w = array(10, 60, 10, 20, 60, 30); // Ajustement des tailles des colonnes
        for($i=0; $i<count($header); $i++) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Donnees
            foreach ($resultats as $detail) {
                $this->Cell($w[0], 6, $detail->num_sous_travaux, 'LR', 0);
                $this->Cell($w[1], 6, $detail->sous_travaux, 'LR', 0);
                $this->Cell($w[2], 6, $detail->unite, 'LR', 0, 'R');
                $this->Cell($w[3], 6, $detail->quantite, 'LR', 0, 'R');
                $this->Cell($w[4], 6,  number_format($detail->prix_unit, 2, ',', ' '), 'LR', 0, 'R');
                $this->Cell($w[5], 6, number_format($detail->total, 2, ',', ' '), 'LR', 0, 'R');
                $this->Ln();
            }
        //
        $this->Cell($w[0], 6, '', 'LR', 0);
        $this->Cell($w[1], 6, '', 'LR', 0);
        $this->Cell($w[2], 6, '', 'LR', 0, 'R');
        $this->Cell($w[3], 6, '', 'LR', 0, 'R');
        $this->Cell($w[4], 6,'Total Devis', '1', 0, 'R');
        $this->Cell($w[5], 6, number_format($val->total, 2, ',', ' '), 'LR', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, '', 'LR', 0);
        $this->Cell($w[1], 6, '', 'LR', 0);
        $this->Cell($w[2], 6, '', 'LR', 0, 'R');
        $this->Cell($w[3], 6, '', 'LR', 0, 'R');
        $this->Cell($w[4], 6,'Finition', '1', 0, 'R');
        $this->Cell($w[5], 6, number_format($val->finit, 2, ',', ' '), 'LR', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, '', 'LR', 0);
        $this->Cell($w[1], 6, '', 'LR', 0);
        $this->Cell($w[2], 6, '', 'LR', 0, 'R');
        $this->Cell($w[3], 6, '', 'LR', 0, 'R');
        $this->Cell($w[4], 6,'Somme Total Devis', '1', 0, 'R');
        $this->Cell($w[5], 6, number_format($val->som, 2, ',', ' '), 'LR', 0, 'R');    
        $this->Ln();
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(5);
    }

    
}

// Instanciation de la classe dérivée
// $pdf = new PDF();
// $pdf->table();
// $a = '#id';
// $b = 'Personne';
// $c = "genre";
// // Affichage du PDF
// $pdf->Output();
?>
