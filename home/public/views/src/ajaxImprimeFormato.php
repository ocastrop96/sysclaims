<?php
require_once "../../../app/controllers/reclamosController.php";
require_once "../../../app/models/reclamosModel.php";

class ajaxImprimeFormato
{
    public function ajaxImprimirFicha()
    {
        require_once "./../../views/util/tcpdf/headFichaReclamo.php";
        // Armado de Adjunto PDF - Ficha de Reclamo
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('OFICINA DE GESTIÓN DE LA CALIDAD-HNSEB');
        $pdf->SetTitle('RECLAMO VIRTUAL EN SALUD - HNSEB');

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(10, 23, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->SetFont('helvetica', '', 9);
        $pdf->AddPage();

        // Datos con X
        // if ($dataReclamos['autorizaCorreo'] == "SI") {
        //     $rSi = "X";
        //     $rNo = "";
        // } else {
        //     $rSi = "";
        //     $rNo = "X";
        // }

        // Datos con X

        // Cuerpo del PDF
        $html =
            <<<EOF
    <table cellpadding="2" cellspacing="1.2" class="block-1" style="text-align:center;">
    <tr>
        <td style="width:30px;background-color:white;
        border-top:    1px solid  #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: center;"><b>DIA</b></p></td>

        <td style="width:30px;background-color:white;
        border-top:    1px solid  #000000;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: center;"><b>MES</b></p></td>

        <td style="width:30px;background-color:white;
        border-top:    1px solid  #000000;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        background-color: #E6E6E6;"><p style="text-align: center;"><b>AÑO</b></p></td>

        <td style="text-align:left; width:10px;background-color:white;"></td>

        <td style="width:94px;background-color:white;
        border-right:   1px solid  #000000;
        border-top:    1px solid  #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: center;"><b>HORA</b></p></td>

        <td style="text-align:left; width:210px;background-color:white;"></td>
        <td style="width:260px;background-color:white;
        border-top:    1px solid  #000000;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: center;"><b>HOJA DE RECLAMACION EN SALUD VIRTUAL</b></p></td>
    </tr>
    <tr>
        <td style="text-align:center; width:30px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"></td>
        <td style="text-align:center; width:30px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"></td>
        <td style="text-align:center; width:30px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;"></td>

        <td style="text-align:left; width:10px;background-color:white;"></td>
        
        <td style="text-align:center; width:30px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"></td>
        <td style="text-align:center; width:30px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"></td>
        <td style="text-align:center; width:31.5px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;"></td>

        <td style="text-align:center; width:210px;background-color:white;"></td>
        <td style="width:260px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"><p style="text-align: center;"><b>00007634 - N° </b></p></td>
    </tr>
    </table>

    <table cellpadding="1" cellspacing="1" style="text-align:left;" border="0">
    <tr>
        <td style="text-align:center; width:667px;background-color:white;"></td>
    </tr>
    </table>

    <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="0">
    <tr>
        <td style="width:671px;background-color:white;
        border-top:    1px solid  #000000;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: left;"><b>1. IDENTICACIÓN DEL USUARIO O TERCERO LEGITIMADO (PACIENTE AFECTADO)</b></p></td>
    </tr>
    <tr>
        <td style="text-align:left; width:149px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>NOMBRES Y APELLIDOS:</b></td>
        <td style="text-align:left; width:520.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:162px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>NOMBRE O RAZÓN SOCIAL:</b></td>
        <td style="text-align:left; width:507.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:71px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
        <td style="text-align:left; width:598.65px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "></td>
    </tr>
    <tr>
        <td style="text-align:left; width:70px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DISTRITO:</b></td>
        <td style="text-align:left; width:300px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
        <td style="text-align:left; width:83.5px;background-color:white;
        border-bottom: 1px solid #000000;
        background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
        <td style="text-align:left; width:213.72px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:70px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>E-MAIL:</b></td>
        <td style="text-align:left; width:599.71px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:168px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DOCUMENTO DE IDENTIDAD:</b></td>
        <td style="text-align:left; width:501.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> : (X) &nbsp; N° </td>
    </tr>
    <tr>
        <td style="width:671px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: left;"><b>2. IDENTICACIÓN DE QUIEN PRESENTA EL RECLAMO (En caso de ser el usuario afectado no es necesario su llenado)</b></p></td>
    </tr>
    <tr>
        <td style="text-align:left; width:162px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>NOMBRE O RAZÓN SOCIAL:</b></td>
        <td style="text-align:left; width:507.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:71px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
        <td style="text-align:left; width:598.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:70px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DISTRITO:</b></td>
        <td style="text-align:left; width:300px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
        <td style="text-align:left; width:80px;background-color:white;
        border-bottom: 1px solid #000000;
        background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
        <td style="text-align:left; width:217.3px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:70px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>E-MAIL:</b></td>
        <td style="text-align:left; width:599.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:168px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DOCUMENTO DE IDENTIDAD:</b></td>
        <td style="text-align:left; width:501.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> DNI: () CE: () PASAPORTE: () &nbsp; N° </td>
    </tr>
    <tr>
        <td style="width:671px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: left;"><b>3. DATOS DEL RECLAMO</b></p></td>
    </tr>
    <tr>
        <td style="text-align:left; width:115px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>TIPO DE USUARIO:</b></td>
        <td style="text-align:left; width:200px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
        <td style="text-align:left; width:150px;background-color:white;
        border-bottom: 1px solid #000000;
        background-color: #E6E6E6;"> <b>FECHA DE OCURRENCIA:</b></td>
        <td style="text-align:left; width:202.4px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="text-align:left; width:195px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"> <b>DERECHO EN SALUD AFECTADO:</b></td>
        <td style="text-align:left; width:474.7px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> </td>
    </tr>
    <tr>
        <td style="width:671px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: left;"> <b>CAUSA ESPECIFICA DEL RECLAMO:</b></p></td>
    </tr>
    <tr>
        <td style="text-align:left; width:671px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        border-right:   1px solid  #000000;
        "> Encontrar IPRESS y/o unidades prestadoras de salud cerradas en horario de atención o no presencia del personal responsable de la
        atención</td>
    </tr>
    <tr>
        <td style="width:671px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;
        background-color: #E6E6E6;"><p style="text-align: left;"><b> DETALLE DEL RECLAMO</b></p></td>
    </tr>
    <tr>
        <td style="width:671px;height:345px;background-color:white;
        border-right:  1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"><p style="text-align: justify;"></p></td>
    </tr>
    <tr>
        <td style="width:370px;background-color:white;
        border-left:   1px solid  #000000;"><p style="text-align: left;"><b>4. AUTORIZO NOTIFICACIÓN DEL RESULTADO DEL RECLAMO AL E-MAIL CONSIGNADO &nbsp; Si (X)  No (X)</b></p><br><p style="text-align: left;"><b>5. FIRMA DEL RECLAMANTE <br>(USUARIO / REPRESENTANTE O TERCERO LEGITIMADO)</b></p></td>
        <td style="width:200px;background-color:white;
        border-bottom: 1px solid #000000;"></td>
        <td style="text-align:left; width:20px;background-color:white;"></td>
        <td style="text-align:left; width:50px;background-color:white;
        border-left:   1px solid  #000000;"></td>
        <td style="text-align:left; width:26.2px;background-color:white;
        border-right:   1px solid  #000000;"></td>
        

    </tr>
    <tr>
        <td style="text-align:left; width:350px;background-color:white;
        border-bottom: 1px solid #000000;
        border-left:   1px solid  #000000;"></td>
        <td style="width:230px;background-color:white;
        border-bottom: 1px solid #000000;"><p style="text-align: center;"><b>FIRMA</b></p></td>
        <td style="text-align:left; width:10px;background-color:white;
        border-bottom: 1px solid #000000;"></td>
        <td style="width:77.5px;background-color:white;
        border-top: 1px solid #000000;
        border-bottom: 1px solid #000000;
        border-right: 1px solid #000000;
        border-left: 1px solid #000000;"><p style="text-align: center;font-size: 6px;"><b>(HUELLA DIGITAL)</b></p></td>
    </tr>
    </table>
EOF;
        // Cuerpo del PDF

        $pdf->writeHTML($html, true, false, true, false, '');

        $reclamoPDF = $pdf->Output('RECLAMO EN SALUD VIRTUAL.pdf', 'I');
    }
}

$FormatoCorreo = new ajaxImprimeFormato();
$FormatoCorreo->ajaxImprimirFicha();
