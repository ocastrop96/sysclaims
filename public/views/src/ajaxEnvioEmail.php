<?php
require_once "../../../app/controllers/reclamosController.php";
require_once "../../../app/models/reclamosModel.php";

require "./../../views/util/phpmailer/Exception.php";
require "./../../views/util/phpmailer/PHPMailer.php";
require "./../../views/util/phpmailer/SMTP.php";
// require "./../../views/util/tcpdf/tcpdf.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ajaxEnvioCorreo
{
    public $codigoReclamo;
    public function ajaxEnviarCorreo()
    {
        // Llamado a Metodo que inclute TCPDF
        require_once "./../../views/util/tcpdf/headFichaReclamo.php";
        // Llamado a Metodo que inclute TCPDF

        $codeRec = $this->codigoReclamo;
        // Listar Parametros -->> AQUI CARGAMOS LOS PARAMETROS DE LA BASE DE DATOS CON RESPECTO AL CORREO DEL LIBRO DE RECLAMOS.
        $parametrosLibro = ControllerReclamo::ctrListarParametros(1);
        // Listar Parametros

        // Cargar datos a partir del código autogenerado -->> $codeRec
        $dataReclamos = ControllerReclamo::ctrCargarHojaReclamo($codeRec);
        // Cargar datos a partir del código autogenerado -->> $codeRec

        // CONDICIONALES DEPENDIENDO DE QUIEN PRESENTA EL RECLAMO

        // Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 2
        if ($dataReclamos['regsRep'] == 2) {
            $bodyMailUser = "";
            $emailUser = $dataReclamos['email'];
            $subjectUser =  $parametrosLibro['detalleParametro'];

            // Maquetado de HTML Mensaje Usuario
            date_default_timezone_set('America/Lima');

            $anioRecurrente = date('Y');
            $bodyMailUser .= '<div style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px 0 30px 0">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Libro Reclamaciones" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                            <b><h4>Registro de Reclamo Virtual: </h4></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3>N° Reclamo: ' . $dataReclamos['correlativo'] . '</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3>Estimado(a): ' . $dataReclamos['UsuarioAfectado'] . '</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:2px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            Su reclamo ha sido registrado con éxito. Nos estaremos comunicando con Ud. a través de los medios brindados.<br></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy; &nbsp;' . $anioRecurrente . '&nbsp; - &nbsp; Libro de Reclamaciones en Salud Virtual</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>';
            // Maquetado de HTML Mensaje Usuario


            $bodyMailOffice = "";
            $emailOffice = $parametrosLibro['correoParametro'];
            $subjectOffice = $parametrosLibro['detalleParametro2'];

            // Maquetado de HTML Mensaje Oficina
            $bodyMailOffice .= '<div style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px 0 30px 0">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Doctor Fast" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                            <b>
                                                                <h4><u>Reclamo Web Registrado : </u> </h4>
                                                            </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h4>N° de Reclamo: ' . $dataReclamos['correlativo'] . '</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h4>Fecha de Registro: ' . $dataReclamos['fechaReclamo'] . '</h4>           
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Usuario Afectado</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>' . $dataReclamos['docUsuario'] . ' :</b> ' . $dataReclamos['nDoc'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Nombres y Apellidos:</b> ' . $dataReclamos['UsuarioAfectado'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Correo Electrónico:</b>
                                                            <a href="mailto:' . $dataReclamos['email'] . '">' . $dataReclamos['email'] . '</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Teléfono o Celular:</b> ' . $dataReclamos['telefono'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Distrito:</b> ' . $dataReclamos['ubgDistrito'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Domicilio:</b> ' . $dataReclamos['domicilio'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Tipo de Usuario:</b> ' . $dataReclamos['descTipUsuario'] . '</td>
                                                    </tr>
                                                    <br><br>
                                                    <tr>
                                                        <td style="padding:15px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Datos del Reclamo</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Fecha del Incidente:</b> ' . $dataReclamos['fechaOcurrencia'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Derecho en Salud Afectado:</b> ' . $dataReclamos['descDerechoSal'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Causa Específica:</b> ' . $dataReclamos['descCausaEsp'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Detalle del Reclamo:</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <p style="text-align: justify;">' . $dataReclamos['detalleReclamo'] . '</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>¿Autoriza notificación del resultado del reclamo al e-mail consignado?</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <p>' . $dataReclamos['autorizaCorreo'] . '</p>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy; &nbsp;' . $anioRecurrente . ' &nbsp; - &nbsp; 
                                                                Libro Virtual de Reclamaciones</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>';
            // Maquetado de HTML Mensaje Oficina

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
            if ($dataReclamos['autorizaCorreo'] == "SI") {
                $rSi = "X";
                $rNo = "";
            } else {
                $rSi = "";
                $rNo = "X";
            }
            // Datos con X

            // Rotulo de Nombres o Razón Social
            if ($dataReclamos['tipoDoc'] == 7) {
                $labelBlock = '<tr>
                    <td style="text-align:left; width:162px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>NOMBRE O RAZÓN SOCIAL:</b></td>
                    <td style="text-align:left; width:507.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> ' . $dataReclamos["UsuarioAfectado"] . '</td>
                </tr>';
            } else {
                $labelBlock = '<tr>
                    <td style="text-align:left; width:149px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>NOMBRES Y APELLIDOS:</b></td>
                    <td style="text-align:left; width:520.7px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> ' . $dataReclamos["UsuarioAfectado"] . '</td>
                </tr>';
            }
            // Rotulo de Nombres o Razón Social


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
                    border-left:   1px solid  #000000;">$dataReclamos[diaRec]</td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$dataReclamos[mesRec]</td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;">$dataReclamos[anioRec]</td>

                    <td style="text-align:left; width:10px;background-color:white;"></td>
                    
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$dataReclamos[horaRec]</td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;">$dataReclamos[minRec]</td>
                    <td style="text-align:center; width:31.5px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;">$dataReclamos[PMAMRec]</td>

                    <td style="text-align:center; width:210px;background-color:white;"></td>
                    <td style="width:260px;background-color:white;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;"><p style="text-align: center;"><b>00007634 - N° </b>$dataReclamos[correlativo]</p></td>
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
                $labelBlock
                <tr>
                    <td style="text-align:left; width:71px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
                    <td style="text-align:left; width:598.65px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    ">$dataReclamos[domicilio]</td>
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
                    "> $dataReclamos[ubgDistrito]</td>
                    <td style="text-align:left; width:83.5px;background-color:white;
                    border-bottom: 1px solid #000000;
                    background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                    <td style="text-align:left; width:213.72px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $dataReclamos[telefono]</td>
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
                    "> $dataReclamos[email]</td>
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
                    "> $dataReclamos[docUsuario]: (X) &nbsp; N° $dataReclamos[nDoc]</td>
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
                    "> </td>
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
                    "> $dataReclamos[descTipUsuario]</td>
                    <td style="text-align:left; width:150px;background-color:white;
                    border-bottom: 1px solid #000000;
                    background-color: #E6E6E6;"> <b>FECHA DE OCURRENCIA:</b></td>
                    <td style="text-align:left; width:202.4px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    "> $dataReclamos[fechaOcurrencia]</td>
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
                    "> $dataReclamos[descDerechoSal]</td>
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
                    "> $dataReclamos[descCausaEsp]</td>
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
                    border-left:   1px solid  #000000;"><p style="text-align: justify;">$dataReclamos[detalleReclamo]</p></td>
                </tr>
                <tr>
                    <td style="width:370px;background-color:white;
                    border-left:   1px solid  #000000;"><p style="text-align: left;"><b>4. AUTORIZO NOTIFICACIÓN DEL RESULTADO DEL RECLAMO AL E-MAIL CONSIGNADO &nbsp; Si ($rSi)  No ($rNo)</b></p><br><p style="text-align: left;"><b>5. FIRMA DEL RECLAMANTE <br>(USUARIO / REPRESENTANTE O TERCERO LEGITIMADO)</b></p></td>
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

            $reclamoPDF = $pdf->Output('RECLAMO EN SALUD VIRTUAL.pdf', 'S');

            // Armado de Adjunto PDF - Ficha de Reclamo


            $mailUser = new PHPMailer(true);
            $mailOffice = new PHPMailer(true);

            try {
                $mailUser->SMTPDebug = 0;
                $mailUser->isSMTP();
                $mailUser->Host = 'smtp-mail.outlook.com';
                $mailUser->SMTPAuth = true;
                $mailUser->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailUser->Password = 'Sistemas2021+-+@';
                $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailUser->Port = 587;

                $mailOffice->SMTPDebug = 0;
                $mailOffice->isSMTP();
                $mailOffice->Host = 'smtp-mail.outlook.com';
                $mailOffice->SMTPAuth = true;
                $mailOffice->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailOffice->Password = 'Sistemas2021+-+@';
                $mailOffice->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailOffice->Port = 587;

                // Armado de correo
                // Correo Envío de Correo para Usuario
                $mailUser->setFrom("libroreclamacioneshnseb@outlook.com", $parametrosLibro['detalleParametro']);

                $mailUser->addAddress($emailUser);
                $mailUser->addReplyTo($emailOffice, $parametrosLibro['detalleParametro']);
                $mailUser->Subject = $subjectUser;
                $mailUser->addStringAttachment($reclamoPDF, $dataReclamos['correlativo'] . '.pdf');
                $mailUser->isHTML(true);
                $mailUser->CharSet = "utf-8";
                $mailUser->Body = $bodyMailUser;

                // Correo Envío de Correo para Usuario

                // Correo Envío de Correo para Oficina Calidad
                $mailOffice->setFrom("libroreclamacioneshnseb@outlook.com", $parametrosLibro["detalleParametro"]);

                $mailOffice->addAddress($emailOffice);
                $mailOffice->Subject = $subjectOffice;
                $mailOffice->addStringAttachment($reclamoPDF, $dataReclamos['correlativo'] . '.pdf');
                $mailOffice->isHTML(true);
                $mailOffice->CharSet = "utf-8";
                $mailOffice->Body = $bodyMailOffice;
                // Correo Envío de Correo para Oficina Calidad

                // Send Mails
                $mailUser->send();
                $mailOffice->send();
                // Send Mails

                // Armado de correo
            } catch (Exception $e) {
                echo "Hubo un error al enviar: {$mailUser->ErrorInfo}";
                // echo "Hubo un error al enviar: {$mailOffice->ErrorInfo}";
            }
        }
        // Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 2

        // Representante Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 1
        elseif ($dataReclamos["regsRep"] == 1) {
            date_default_timezone_set('America/Lima');

            $anioRecurrente = date('Y');

            $bodyMailUserR = "";
            $emailUserR = $dataReclamos["emailRep"];
            $subjectUserR =  $parametrosLibro["detalleParametro"];

            $bodyMailUserR .= '<div style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px 0 30px 0">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Libro Reclamaciones" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                            <b><h4>Registro de Reclamo Virtual: </h4></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <h3>N° Reclamo: ' . $dataReclamos['correlativo'] . '</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3>Estimado(a): ' . $dataReclamos['representUsuario'] . '</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:2px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            El reclamo en representación de ' . $dataReclamos['UsuarioAfectado'] . ' ha sido registrado con éxito. Nos estaremos comunicando con Ud. a través de los medios brindados.<br></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy; &nbsp;' . $anioRecurrente . ' &nbsp; - &nbsp; 
                                                            Libro Virtual de Reclamaciones</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>';

            $bodyMailOffice = "";
            $emailOffice = $parametrosLibro["correoParametro"];
            $subjectOffice = $parametrosLibro["detalleParametro2"];

            $bodyMailOffice .= '<div style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px 0 30px 0">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;border-collapse:collapse;max-width:600px;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#5d7a8a" style="color:#5d7a8a;font-size:28px;font-weight:bold;font-family:Arial,sans-serif;">
                                            <img src="https://portal.hnseb.gob.pe/wp-content/uploads/2021/01/banner-2021-reclamos.png" alt="Doctor Fast" width="200" height="190" style="display:block" class="CToWUd a6T" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding:20px 30px 40px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="color:#0d2e3b;font-family:Arial,sans-serif;font-size:24px">
                                                            <b>
                                                                <h4><u>Reclamo Web Registrado: </u></h4>
                                                            </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 5px 0;margin-top: 5px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <h4>N° de Reclamo: ' . $dataReclamos['correlativo'] . '</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h4>Fecha de Registro: ' . $dataReclamos['fechaReclamo'] . '</h4>   
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Representante del Usuario Afectado</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>' . $dataReclamos['docRepre'] . ' :</b> ' . $dataReclamos['nDocR'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Nombres o Razón Social del Representante:</b> ' . $dataReclamos['representUsuario'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Correo Electrónico Representante:</b>
                                                            <a href="mailto:' . $dataReclamos['emailRep'] . '">' . $dataReclamos['emailRep'] . '</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Teléfono o Celular Representante:</b> ' . $dataReclamos['telefonoR'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:10px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Usuario Afectado</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>' . $dataReclamos['docUsuario'] . ' :</b> ' . $dataReclamos['nDoc'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Nombres y Apellidos:</b> ' . $dataReclamos['UsuarioAfectado'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Correo Electrónico:</b>
                                                            <a href="mailto:' . $dataReclamos['email'] . '">' . $dataReclamos['email'] . '</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Teléfono o Celular:</b> ' . $dataReclamos['telefono'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Distrito:</b> ' . $dataReclamos['ubgDistrito'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Domicilio:</b> ' . $dataReclamos['domicilio'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Tipo de Usuario:</b> ' . $dataReclamos['descTipUsuario'] . '</td>
                                                    </tr>
                                                    <br><br>
                                                    <tr>
                                                        <td style="padding:15px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Datos del Reclamo</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Fecha del Incidente:</b> ' . $dataReclamos['fechaOcurrencia'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Derecho en Salud Afectado:</b> ' . $dataReclamos['descDerechoSal'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <b>Causa Específica:</b> ' . $dataReclamos['descCausaEsp'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Detalle del Reclamo:</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                        <p style="text-align: justify;">' . $dataReclamos['detalleReclamo'] . '</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>¿Autoriza notificación del resultado del reclamo al e-mail consignado?</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <p>' . $dataReclamos['autorizaCorreo'] . '</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#05171f" style="padding:30px 30px 30px 30px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="color:#ffffff;font-family:Arial,sans-serif;font-size:13px" width="75%"><b>Oficina de Gestión de la Calidad - HNSEB &copy; &nbsp;' . $anioRecurrente . ' &nbsp; - &nbsp; 
                                                            Libro Virtual de Reclamaciones</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>';

            // Armado de Adjunto PDF - Ficha de Reclamo
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
            if ($dataReclamos['autorizaCorreo'] == "SI") {
                $rSi = "X";
                $rNo = "";
            } else {
                $rSi = "";
                $rNo = "X";
            }
            // Datos con X

            // Rotulo de Nombres o Razón Social
            if ($dataReclamos['tipoDoc'] == 7) {
                $labelBlock = '<tr>
                <td style="text-align:left; width:162px;background-color:white;
                border-bottom: 1px solid #000000;
                border-left:   1px solid  #000000;
                background-color: #E6E6E6;"> <b>NOMBRE O RAZÓN SOCIAL:</b></td>
                <td style="text-align:left; width:507.7px;background-color:white;
                border-bottom: 1px solid #000000;
                border-left:   1px solid  #000000;
                border-right:   1px solid  #000000;
                "> ' . $dataReclamos["UsuarioAfectado"] . '</td>
            </tr>';
            } else {
                $labelBlock = '<tr>
                <td style="text-align:left; width:149px;background-color:white;
                border-bottom: 1px solid #000000;
                border-left:   1px solid  #000000;
                background-color: #E6E6E6;"> <b>NOMBRES Y APELLIDOS:</b></td>
                <td style="text-align:left; width:520.7px;background-color:white;
                border-bottom: 1px solid #000000;
                border-left:   1px solid  #000000;
                border-right:   1px solid  #000000;
                "> ' . $dataReclamos["UsuarioAfectado"] . '</td>
            </tr>';
            }
            // Rotulo de Nombres o Razón Social

            // Armado de Adjunto PDF - Ficha de Reclamo
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
                 border-left:   1px solid  #000000;">$dataReclamos[diaRec]</td>
                 <td style="text-align:center; width:30px;background-color:white;
                 border-right:  1px solid #000000;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;">$dataReclamos[mesRec]</td>
                 <td style="text-align:center; width:30px;background-color:white;
                 border-right:  1px solid #000000;
                 border-bottom: 1px solid #000000;">$dataReclamos[anioRec]</td>

                 <td style="text-align:left; width:10px;background-color:white;"></td>
                 
                 <td style="text-align:center; width:30px;background-color:white;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;">$dataReclamos[horaRec]</td>
                 <td style="text-align:center; width:30px;background-color:white;
                 border-right:  1px solid #000000;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;">$dataReclamos[minRec]</td>
                 <td style="text-align:center; width:31.5px;background-color:white;
                 border-right:  1px solid #000000;
                 border-bottom: 1px solid #000000;">$dataReclamos[PMAMRec]</td>

                 <td style="text-align:center; width:210px;background-color:white;"></td>
                 <td style="width:260px;background-color:white;
                 border-right:  1px solid #000000;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;"><p style="text-align: center;"><b>00007634 - N° </b>$dataReclamos[correlativo]</p></td>
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
             $labelBlock
             <tr>
                 <td style="text-align:left; width:71px;background-color:white;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;
                 background-color: #E6E6E6;"> <b>DOMICILIO:</b></td>
                 <td style="text-align:left; width:598.65px;background-color:white;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;
                 border-right:   1px solid  #000000;
                 ">$dataReclamos[domicilio]</td>
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
                 "> $dataReclamos[ubgDistrito]</td>
                 <td style="text-align:left; width:83.5px;background-color:white;
                 border-bottom: 1px solid #000000;
                 background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                 <td style="text-align:left; width:213.72px;background-color:white;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;
                 border-right:   1px solid  #000000;
                 "> $dataReclamos[telefono]</td>
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
                 "> $dataReclamos[email]</td>
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
                 "> $dataReclamos[docUsuario]: (X) &nbsp; N° $dataReclamos[nDoc]</td>
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
                 "> $dataReclamos[representUsuario]</td>
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
                 "> $dataReclamos[domicilioR]</td>
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
                 "> $dataReclamos[ubgDistrito]</td>
                 <td style="text-align:left; width:80px;background-color:white;
                 border-bottom: 1px solid #000000;
                 background-color: #E6E6E6;"> <b>TELEF./CEL.:</b></td>
                 <td style="text-align:left; width:217.3px;background-color:white;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;
                 border-right:   1px solid  #000000;
                 "> $dataReclamos[telefonoR]</td>
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
                 "> $dataReclamos[emailRep]</td>
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
                 "> $dataReclamos[docRepre] : N° $dataReclamos[nDocR]</td>
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
                 "> $dataReclamos[descTipUsuario]</td>
                 <td style="text-align:left; width:150px;background-color:white;
                 border-bottom: 1px solid #000000;
                 background-color: #E6E6E6;"> <b>FECHA DE OCURRENCIA:</b></td>
                 <td style="text-align:left; width:202.4px;background-color:white;
                 border-bottom: 1px solid #000000;
                 border-left:   1px solid  #000000;
                 border-right:   1px solid  #000000;
                 "> $dataReclamos[fechaOcurrencia]</td>
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
                 "> $dataReclamos[descDerechoSal]</td>
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
                 "> $dataReclamos[descCausaEsp]</td>
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
                 border-left:   1px solid  #000000;"><p style="text-align: justify;">$dataReclamos[detalleReclamo]</p></td>
             </tr>
             <tr>
                 <td style="width:370px;background-color:white;
                 border-left:   1px solid  #000000;"><p style="text-align: left;"><b>4. AUTORIZO NOTIFICACIÓN DEL RESULTADO DEL RECLAMO AL E-MAIL CONSIGNADO &nbsp; Si ($rSi)  No ($rNo)</b></p><br><p style="text-align: left;"><b>5. FIRMA DEL RECLAMANTE <br>(USUARIO / REPRESENTANTE O TERCERO LEGITIMADO)</b></p></td>
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
        // Armado de Adjunto PDF - Ficha de Reclamo


         $pdf->writeHTML($html, true, false, true, false, '');

         $reclamoPDF = $pdf->Output('RECLAMO EN SALUD VIRTUAL.pdf', 'S');

            $mailUser = new PHPMailer(true);
            $mailOffice = new PHPMailer(true);

            try {
                $mailUser->SMTPDebug = 0;
                $mailUser->isSMTP();
                $mailUser->Host = 'smtp-mail.outlook.com';
                $mailUser->SMTPAuth = true;
                $mailUser->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailUser->Password = 'Sistemas2021+-+@';
                $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailUser->Port = 587;

                $mailOffice->SMTPDebug = 0;
                $mailOffice->isSMTP();
                $mailOffice->Host = 'smtp-mail.outlook.com';
                $mailOffice->SMTPAuth = true;
                $mailOffice->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailOffice->Password = 'Sistemas2021+-+@';
                $mailOffice->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailOffice->Port = 587;

                // Armado de correo
                // Correo Envío de Correo para Usuario
                $mailUser->setFrom('libroreclamacioneshnseb@outlook.com', $parametrosLibro["detalleParametro"]);
                $mailUser->addAddress($emailUserR);
                $mailUser->addReplyTo($emailOffice, $parametrosLibro['detalleParametro']);

                $mailUser->Subject = $subjectUserR;
                $mailUser->addStringAttachment($reclamoPDF, $dataReclamos['correlativo'] . '.pdf');
                $mailUser->isHTML(true);
                $mailUser->CharSet = "utf-8";
                $mailUser->Body = $bodyMailUserR;
                // Correo Envío de Correo para Usuario

                // Correo Envío de Correo para Oficina Calidad
                $mailOffice->setFrom('libroreclamacioneshnseb@outlook.com', $parametrosLibro["detalleParametro"]);
                $mailOffice->addAddress($emailOffice);
                $mailOffice->Subject = $subjectOffice;
                $mailOffice->addStringAttachment($reclamoPDF, $dataReclamos['correlativo'] . '.pdf');
                $mailOffice->isHTML(true);
                $mailOffice->CharSet = "utf-8";
                $mailOffice->Body = $bodyMailOffice;
                // Correo Envío de Correo para Oficina Calidad

                // Send Mails
                $mailUser->send();
                $mailOffice->send();
                // Send Mails

                // Armado de correo
            } catch (Exception $e) {
                echo "Hubo un error al enviar: {$mailUser->ErrorInfo}";
                echo "Hubo un error al enviar: {$mailOffice->ErrorInfo}";
            }
        }
    }
}

$EnvioCorreo = new ajaxEnvioCorreo();
$EnvioCorreo->codigoReclamo = $_POST["codigoReclamo"];
$EnvioCorreo->ajaxEnviarCorreo();
