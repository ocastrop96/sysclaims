<?php
require_once "dbConnect.php";
class ConsultasModelo
{
    static public function mdlListarConsultas($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            sc_consulta.idConsulta, 
            sc_consulta.correlativoCon, 
            date_format(sc_consulta.fechaCon,'%d/%m/%Y') as fechaCon,
            time_format(sc_consulta.horaCon,'%H:%i %p') as horaCon, 
            sc_consulta.tDoc, 
            sc_tipodocumento.descTipoDoc,
            sc_consulta.nDoc, 
            sc_consulta.nombresAp, 
            sc_consulta.edad, 
            sc_consulta.sexoCon, 
            sc_sexo.descSexo, 
            sc_consulta.telefono, 
            sc_consulta.distrito, 
            sc_distrito.descDistrito, 
            sc_consulta.email, 
            sc_consulta.detalleConsulta, 
            sc_consulta.autogenerado, 
            sc_consulta.estadoDoc, 
            sc_estadodoc.idEstadoDoc, 
            sc_estadodoc.descEstadoDoc
        FROM
            sc_consulta
            INNER JOIN
            sc_tipodocumento
            ON 
                sc_consulta.tDoc = sc_tipodocumento.idTipoDoc
            INNER JOIN
            sc_sexo
            ON 
                sc_consulta.sexoCon = sc_sexo.idSexo
            INNER JOIN
            sc_distrito
            ON 
                sc_consulta.distrito = sc_distrito.idDistrito
            INNER JOIN
            sc_estadodoc
            ON 
                sc_consulta.estadoDoc = sc_estadodoc.idEstadoDoc WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL ListarConsultas()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
}
