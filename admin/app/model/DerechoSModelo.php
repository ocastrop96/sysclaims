<?php
require_once "dbConnect.php";
class DerechoSModelo
{
    static public function mdlListarDerechoS($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            sc_derecho.idDerecho, 
            sc_derecho.descDerechoSal, 
            sc_derecho.estadoItemDer, 
            sc_estadoitem.descEstadoItem
        FROM
            sc_derecho
            INNER JOIN
            sc_estadoitem
            ON 
                sc_derecho.estadoItemDer = sc_estadoitem.idEstadoItem WHERE $item = :$item ORDER BY estadoItemDer ASC, idDerecho ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL ListarDerechos()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
}
