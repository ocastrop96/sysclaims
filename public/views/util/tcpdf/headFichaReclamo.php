<?php
require "tcpdf.php";
class MYPDF extends TCPDF
{
     //Page header
     public function Header()
     {
         // Logo HNSEB
         $image_file = K_PATH_IMAGES . 'logo-hnseb2.png';
         $this->Image($image_file, 10, 10, 82, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
         // Logo HNSEB

         // Set font
         $this->SetFont('helvetica', '', 8);
         // Información del HNSEB
         $html = '<p>Av. Túpac Amaru N° 8000, Comas<br>Teléfono Central (51-1) 558-0186</p>';
         $this->writeHTMLCell(0, 0, 105, 12, $html, 0, 1, 0, true, 'L', true);
         // Información del HNSEB

         // Title
         // $this->Cell(0, 15, 'Av. Tupac Amaru N°8000 - Comas', 0, false, 'L', 0, '', 0, false, 'T', 'M');
         // Logo SUSALUD
         $image_file2 = K_PATH_IMAGES . 'susalud.png';
         $this->Image($image_file2, 160, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
         // Logo SUSALUD
     }

     // Page footer
     public function Footer()
     {
         // Position at 15 mm from bottom
         $this->SetY(-15);
         // Set font
         $this->SetFont('helvetica', '', 6.5);
         // Page number
         // $this->Cell(0, 10, 'Av. Túpac Amaru N° 8000, Comas<br>Teléfono Central (51-1) 558-0186', 0, false, 'C', 0, '', 0, false, 'T', 'M');
         $html = '<p style="text-align: justify;">Las IAFAS,IPRESS o UGIPRESS deben atender el reclamo en un plazo de 30 días hábiles.<br><strong>Estimado usuario</strong>: Usted puede presentar su queja ante SUSALUD ante hechos o actos que vulneren o pudieran vulnerar el derecho a la salud o cuando no le hayan brindado un servicio, prestación o coberturas solicitada o recibidas de las IAFAS o IPRESS, o que dependan de las UGIPRESS pública, privada o mixtas. También ante la negativa de atención de su reclamo, irregularidad en su tramitación o disconformidad con el resultado del mismo o hacer uso de los mecanismos alternativos de solución de controversias ante el Centro de Conciliación y Arbitraje - CECONAR de SUSALUD</p>';
         $this->writeHTMLCell(0, 0, 10, 276, $html, 0, 1, 0, true, 'L', true);
     }
}
