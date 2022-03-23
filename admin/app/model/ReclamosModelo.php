<?php
require_once "dbConnect.php";
class ReclamosModelo
{
    static public function mdlListarReclamos($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            sc_reclamo.idReclamo, 
            sc_reclamo.correlativo, 
            date_format( sc_reclamo.fechaReclamo, '%d/%m/%Y' ) AS fechaReclamo, 
            sc_reclamo.tipoDoc, 
            sc_tipodocumento.descTipoDoc, 
            sc_reclamo.nDoc, 
            sc_reclamo.nombres, 
            sc_reclamo.apellidoPat, 
            sc_reclamo.apellidoMat, 
            sc_reclamo.sexo, 
            sc_sexo.descSexo, 
            sc_reclamo.email, 
            sc_reclamo.telefono, 
            sc_reclamo.departamento, 
            sc_departamento.descDepartamento, 
            sc_reclamo.provincia, 
            sc_provincia.descProvincia, 
            sc_reclamo.distrito, 
            sc_distrito.descDistrito, 
            sc_reclamo.domicilio, 
            sc_reclamo.tipoDocR, 
            sc_reclamo.nDocR, 
            tdoc2.descTipoDoc AS descTipoDocR, 
            sc_reclamo.nombresR, 
            sc_reclamo.emailRep, 
            sc_reclamo.domicilioR, 
            sc_reclamo.telefonoR, 
            sc_reclamo.tipoUsuario, 
            sc_tipousuario.descTipUsuario, 
            date_format( sc_reclamo.fechaOcurrencia, '%d/%m/%Y' ) AS fechaOcurrencia, 
            sc_reclamo.derecho, 
            sc_derecho.descDerechoSal, 
            sc_reclamo.causaEspecifica, 
            sc_causaespecifica.descCausaEsp, 
            sc_reclamo.detalleReclamo, 
            sc_reclamo.estadoRec, 
            sc_estadoreclamo.descEstadoRec, 
            sc_reclamo.etapaReclamo, 
            sc_etapasrec.descEtapa, 
            sc_reclamo.resulRec, 
            sc_resultadorec.descResultado, 
            sc_reclamo.autogenerado, 
            sc_reclamo.autoCorreo
        FROM
            sc_reclamo
            INNER JOIN
            sc_tipodocumento
            ON 
                sc_reclamo.tipoDoc = sc_tipodocumento.idTipoDoc
            INNER JOIN
            sc_sexo
            ON 
                sc_reclamo.sexo = sc_sexo.idSexo
            INNER JOIN
            sc_departamento
            ON 
                sc_reclamo.departamento = sc_departamento.idDepartamento
            INNER JOIN
            sc_provincia
            ON 
                sc_departamento.idDepartamento = sc_provincia.DepaId AND
                sc_reclamo.provincia = sc_provincia.idProvincia
            INNER JOIN
            sc_distrito
            ON 
                sc_reclamo.distrito = sc_distrito.idDistrito AND
                sc_provincia.idProvincia = sc_distrito.provId
            INNER JOIN
            sc_tipodocumento AS tdoc2
            ON 
                sc_reclamo.tipoDoc = tdoc2.idTipoDoc
            LEFT JOIN
            sc_tipousuario
            ON 
                sc_reclamo.tipoUsuario = sc_tipousuario.idTipUsuario
            INNER JOIN
            sc_derecho
            ON 
                sc_reclamo.derecho = sc_derecho.idDerecho
            INNER JOIN
            sc_causaespecifica
            ON 
                sc_derecho.idDerecho = sc_causaespecifica.derechoId AND
                sc_reclamo.causaEspecifica = sc_causaespecifica.idCausaEsp
            INNER JOIN
            sc_estadoreclamo
            ON 
                sc_reclamo.estadoRec = sc_estadoreclamo.idEstadoRec
            INNER JOIN
            sc_etapasrec
            ON 
                sc_reclamo.etapaReclamo = sc_etapasrec.idEtapa
            INNER JOIN
            sc_resultadorec
            ON 
                sc_reclamo.resulRec = sc_resultadorec.idResultado WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL ListarReclamos()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
}
