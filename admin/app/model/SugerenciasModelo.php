<?php
require_once "dbConnect.php";
class SugerenciasModelo
{
    static public function mdlListarSugerencias($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            sc_sugerencia.idSugerencia, 
            sc_sugerencia.correlativoSug,
            date_format(sc_sugerencia.fechaSugerencia,'%d/%m/%Y') as fechaSugerencia,
            time_format(sc_sugerencia.horaSugerencia,'%H:%i %p') as horaSugerencia, 
            sc_sugerencia.tDoc, 
            sc_tipodocumento.descTipoDoc, 
            sc_sugerencia.nDoc, 
            sc_sugerencia.nombresAp, 
            sc_sugerencia.edad, 
            sc_sugerencia.sexoSug, 
            sc_sexo.descSexo, 
            sc_sugerencia.telefono, 
            sc_sugerencia.distrito, 
            sc_distrito.descDistrito, 
            sc_sugerencia.email, 
            sc_sugerencia.detalleSugerencia, 
            sc_sugerencia.autogenerado, 
            sc_sugerencia.estadoDoc, 
            sc_estadodoc.descEstadoDoc
        FROM
            sc_sugerencia
            INNER JOIN
            sc_tipodocumento
            ON 
                sc_sugerencia.tDoc = sc_tipodocumento.idTipoDoc
            INNER JOIN
            sc_sexo
            ON 
                sc_sugerencia.sexoSug = sc_sexo.idSexo
            INNER JOIN
            sc_distrito
            ON 
                sc_sugerencia.distrito = sc_distrito.idDistrito
            INNER JOIN
            sc_estadodoc
            ON 
                sc_sugerencia.estadoDoc = sc_estadodoc.idEstadoDoc WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL ListarSugerencias()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
}
