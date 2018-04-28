<?php
class PDF extends FPDF
{
  function setLinea($largo, $key, $data){
    $this->SetFont('Arial','B',12);
    $this->Cell($largo, 5, $key.": ");
    $this->SetFont('Arial','',12);
    $this->Cell(60, 5, $data);
    $this->Ln();
  }
}
?>
