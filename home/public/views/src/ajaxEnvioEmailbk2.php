<?php
require_once "../../../app/controllers/reclamosController.php";
require_once "../../../app/models/reclamosModel.php";

require "./../../views/util/phpmailer/Exception.php";
require "./../../views/util/phpmailer/PHPMailer.php";
require "./../../views/util/phpmailer/SMTP.php";
require "./../../views/util/tcpdf/tcpdf.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ajaxEnvioCorreo
{
    public $codigoReclamo;
    public function ajaxEnviarCorreo()
    {
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
                                                            <p>' . $dataReclamos['detalleReclamo'] . '</p>
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
            // Maquetado de HTML Mensaje Oficina

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
                // $mailUser->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                $mailUser->isHTML(true);
                $mailUser->CharSet = "utf-8";
                $mailUser->Body = $bodyMailUser;

                // Correo Envío de Correo para Usuario

                // Correo Envío de Correo para Oficina Calidad
                $mailOffice->setFrom("libroreclamacioneshnseb@outlook.com", $parametrosLibro["detalleParametro"]);

                $mailOffice->addAddress($emailOffice);
                $mailOffice->Subject = $subjectOffice;
                // $mailOffice->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
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

            $bodyMailOffice = '<div style="margin:0;padding:0">
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
                                                        <h4>N° de Reclamo: ' . $corre2 . '</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0px 0px 0px;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h4>Fecha de Registro: ' . $fRegistro2 . '</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Representante del Usuario Afectado</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>' . $mTDocRep2 . ' :</b> ' . $nDocRep . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Nombres o Razón Social del Representante:</b> ' . $nomRep . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Correo Electrónico Representante:</b>
                                                            <a href="mailto:' . $emailRep . '">' . $emailRep . '</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Teléfono o Celular Representante:</b> ' . $telefRep . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:10px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Usuario Afectado</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>' . $mTDoc2 . ' :</b> ' . $nDocUsuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Nombres y Apellidos:</b> ' . $nyAusuario2 . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Correo Electrónico:</b>
                                                            <a href="mailto:' . $emailUsuario . '">' . $emailUsuario . '</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Teléfono o Celular:</b> ' . $telefUsuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Ubigeo:</b> ' . $mDep2 . '-' . $mProv2 . '-' . $mDist2 . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Domicilio:</b> ' . $DomUsuario . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Tipo de Usuario:</b> ' . $mTUs2 . '</td>
                                                    </tr>
                                                    <br><br>
                                                    <tr>
                                                        <td style="padding:15px 0 0px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <h3><u>Datos del Reclamo</u></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Fecha del Incidente:</b> ' . $cajaFecha . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Causa General:</b> ' . $mCG2 . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Causa Específica:</b> ' . $mCE2 . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <b>Detalle del Reclamo:</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:3px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                            <p>' . $detReclamo . '</p>
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
                // $mailUser->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                $mailUser->isHTML(true);
                $mailUser->CharSet = "utf-8";
                $mailUser->Body = $bodyMailUserR;
                // Correo Envío de Correo para Usuario

                // Correo Envío de Correo para Oficina Calidad
                $mailOffice->setFrom('libroreclamacioneshnseb@outlook.com', $parametrosLibro["detalleParametro"]);
                $mailOffice->addAddress($emailOffice);
                $mailOffice->Subject = $subjectOffice;
                // $mailOffice->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                // $mailOffice->isHTML(true);
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
        // Representante Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 1

        // CONDICIONALES DEPENDIENDO DE QUIEN PRESENTA EL RECLAMO
        // 
        // $cuerpoOficina = "<h1>".$dataReclamos["detalleReclamo"]."</h1>";
        // $destinoOficina = $parametros["correoParametro"];
        // $asuntoOficina = "Información de Registro de Reclamo en Salud Virtual-HNSEB";
        // $mailOficina1 = new PHPMailer(true);

        // try {
        //     $mailOficina1->SMTPDebug = 0;
        //     $mailOficina1->isSMTP();
        //     $mailOficina1->Host = 'smtp-mail.outlook.com';
        //     $mailOficina1->SMTPAuth = true;
        //     $mailOficina1->Username = 'libroreclamacioneshnseb@outlook.com';
        //     $mailOficina1->Password = 'Sistemas2021+-+@';
        //     $mailOficina1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //     $mailOficina1->Port = 587;

        //     // Recipientes
        //     $mailOficina1->setFrom("libroreclamacioneshnseb@outlook.com", $parametros["detalleParametro"]);
        //     $mailOficina1->addAddress($destinoOficina);
        //     $mailOficina1->Subject = $asuntoOficina;
        //     $mailOficina1->isHTML(true);
        //     $mailOficina1->CharSet = "utf-8";
        //     $mailOficina1->Body = $cuerpoOficina;
        //     $mailOficina1->send();
        // } catch (Exception $e) {
        //     echo "Hubo un error al enviar: {$mailOficina1->ErrorInfo}";
        // }

        // echo 1;
    }
}

$EnvioCorreo = new ajaxEnvioCorreo();
$EnvioCorreo->codigoReclamo = $_POST["codigoReclamo"];
$EnvioCorreo->ajaxEnviarCorreo();
