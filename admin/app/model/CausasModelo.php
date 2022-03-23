<?php
require_once "dbConnect.php";
class CausasModelo
{
    static public function mdlListarCausas($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            sc_causaespecifica.idCausaEsp, 
            sc_causaespecifica.descCausaEsp, 
            sc_causaespecifica.derechoId, 
            sc_derecho.descDerechoSal, 
            sc_causaespecifica.estadoItemCE, 
            sc_estadoitem.descEstadoItem
        FROM
            sc_causaespecifica
            INNER JOIN
            sc_derecho
            ON 
                sc_causaespecifica.derechoId = sc_derecho.idDerecho
            INNER JOIN
            sc_estadoitem
            ON 
                sc_causaespecifica.estadoItemCE = sc_estadoitem.idEstadoItem WHERE $item = :$item ORDER BY estadoItemCE ASC, idCausaEsp ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL ListarCausasEspecificas()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
}
