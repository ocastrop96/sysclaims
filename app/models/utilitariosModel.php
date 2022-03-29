<?php
require_once "dbConnect.php";
class ModeloUtilitarios
{
    static public function mdlListarTipoDoc($opcion)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTiposDoc(:opcion)");
        $stmt->bindParam(":opcion", $opcion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarTipoDocDetalles($opcion)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTiposDocDetalle(:opcion)");
        $stmt->bindParam(":opcion", $opcion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarTipoSexo()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTipoSexo()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarDepartamento()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarDepartamentos()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarProvinciasxDep($opcion)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarProvinciasxDep(:opcion)");
        $stmt->bindParam(":opcion", $opcion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarDistritosxProv($opcion)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarDistritosxProv(:opcion)");
        $stmt->bindParam(":opcion", $opcion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }


    static public function mdlListarCausasxDerecho($opcion)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarCausasxDerecho(:opcion)");
        $stmt->bindParam(":opcion", $opcion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarTiposUsuarios()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTiposUsuarios()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarDerechosSalud()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarDerechosForm()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
