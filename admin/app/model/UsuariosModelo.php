<?php
require_once "dbConnect.php";
class UsuariosModelo
{
    static public function mdlLoginUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL LoginUsuario(:cuenta)");
        $stmt->bindParam(":cuenta", $datos, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistroIntentos($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL RegistrarIntentos(:idUsuario)");
        $stmt->bindParam(":idUsuario", $datos, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarUsuarios($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            sc_usuario.idUsuario, 
            sc_usuario.dni, 
            sc_usuario.nombres, 
            sc_usuario.apellidos, 
            sc_usuario.cuenta, 
            sc_usuario.correo, 
            sc_usuario.clave, 
            sc_usuario.intentos, 
            date_format(sc_usuario.fechaAlta,'%d/%m/%Y') AS  fechaAlta,
            sc_usuario.idPerfil, 
            sc_perfil.descPerfil, 
            sc_usuario.idEstado, 
            sc_estusuario.descEstadoUs
        FROM
            sc_usuario
            INNER JOIN
            sc_perfil
            ON 
                sc_usuario.idPerfil = sc_perfil.idPerfil
            INNER JOIN
            sc_estusuario
            ON 
                sc_usuario.idEstado = sc_estusuario.idEstadoUs
        WHERE $item = :$item 
            ORDER BY sc_usuario.idPerfil ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL ListarUsuarios()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarPerfilesUsuarios($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            acpsy_perfiles.idPerfil, 
            acpsy_perfiles.detallePerfil
        FROM
            acpsy_perfiles WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_PERFILES_USUARIO()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL REGISTRAR_USUARIO(:idPerfil,:dniUsuario,:apellidosUsuario,:nombresUsuario,:cuentaUsuario,:correoUsuario,:claveUsuario)");
        $stmt->bindParam(":idPerfil", $datos["idPerfil"], PDO::PARAM_INT);
        $stmt->bindParam(":dniUsuario", $datos["dniUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidosUsuario", $datos["apellidosUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":nombresUsuario", $datos["nombresUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":cuentaUsuario", $datos["cuentaUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":correoUsuario", $datos["correoUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":claveUsuario", $datos["claveUsuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL EDITAR_USUARIO(:idUsuario,:idPerfil,:dniUsuario,:apellidosUsuario,:nombresUsuario,:cuentaUsuario,:correoUsuario,:claveUsuario)");
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
        $stmt->bindParam(":idPerfil", $datos["idPerfil"], PDO::PARAM_INT);
        $stmt->bindParam(":dniUsuario", $datos["dniUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidosUsuario", $datos["apellidosUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":nombresUsuario", $datos["nombresUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":cuentaUsuario", $datos["cuentaUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":correoUsuario", $datos["correoUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":claveUsuario", $datos["claveUsuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlActualizarUsuario($idUsuario, $idEstado)
    {
        $stmt = Conexion::conectar()->prepare("CALL HABILITAR_USUARIO(:idUsuario,:idEstado)");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":idEstado", $idEstado, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlDesbloquearUsuario($idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("CALL DESBLOQUEAR_USUARIO(:idUsuario)");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlValidarEstado($idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("CALL VERIFICA_ESTADO_LOG(:idUsuario)");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEliminarUsuario($dato)
    {
        $stmt = Conexion::conectar()->prepare("CALL ELIMINAR_USUARIO(:idUsuario)");
        $stmt->bindParam(":idUsuario", $dato, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
