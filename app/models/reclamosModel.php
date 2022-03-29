<?php
require_once "dbConnect.php";

class ReclamosModel
{
	static public function mdlRegistrarReclamo($datos)
	{
		$stmt = Conexion::conectar()->prepare("CALL RegistroReclamo(:fechaReclamo,:horaReclamo,:tipoDoc,:nDoc,:razonSocial,:nombres,:apellidoPat,:apellidoMat,:sexo,:email,:telefono,:departamento,:provincia,:distrito,:domicilio,:tipoDocR,:nDocR,:nombresR,:apellidoPatR,:apellidoMatR,:rsocialR,:emailRep,:domicilioR,:telefonoR,:regsRep,:tipoUsuario,:fechaOcurrencia,:derecho,:causaEspecifica,:detalleReclamo,:autogenerado,:autoCorreo)");

		$stmt->bindParam(":tipoDoc", $datos["tipoDoc"], PDO::PARAM_INT);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_INT);
		$stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_INT);
		$stmt->bindParam(":provincia", $datos["provincia"], PDO::PARAM_INT);
		$stmt->bindParam(":distrito", $datos["distrito"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoDocR", $datos["tipoDocR"], PDO::PARAM_INT);
		$stmt->bindParam(":regsRep", $datos["regsRep"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoUsuario", $datos["tipoUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":derecho", $datos["derecho"], PDO::PARAM_INT);
		$stmt->bindParam(":causaEspecifica", $datos["causaEspecifica"], PDO::PARAM_INT);
		$stmt->bindParam(":autoCorreo", $datos["autoCorreo"], PDO::PARAM_INT);

		$stmt->bindParam(":fechaReclamo", $datos["fechaReclamo"], PDO::PARAM_STR);
		$stmt->bindParam(":horaReclamo", $datos["horaReclamo"], PDO::PARAM_STR);
		$stmt->bindParam(":nDoc", $datos["nDoc"], PDO::PARAM_STR);
		$stmt->bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoPat", $datos["apellidoPat"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoMat", $datos["apellidoMat"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":nDocR", $datos["nDocR"], PDO::PARAM_STR);
		$stmt->bindParam(":nombresR", $datos["nombresR"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoPatR", $datos["apellidoPatR"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoMatR", $datos["apellidoMatR"], PDO::PARAM_STR);
		$stmt->bindParam(":rsocialR", $datos["rsocialR"], PDO::PARAM_STR);
		$stmt->bindParam(":emailRep", $datos["emailRep"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilioR", $datos["domicilioR"], PDO::PARAM_STR);
		$stmt->bindParam(":telefonoR", $datos["telefonoR"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaOcurrencia", $datos["fechaOcurrencia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalleReclamo", $datos["detalleReclamo"], PDO::PARAM_STR);
		$stmt->bindParam(":autogenerado", $datos["autogenerado"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlDevolverCorrelativo($codigo)
	{
		$stmt = Conexion::conectar()->prepare("CALL CorrelativoReclamo(:codigo)");
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlListarParametros($tipo)
	{
		$stmt = Conexion::conectar()->prepare("CALL Listar_Parametros(:tipo)");
		$stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlCargarHojaReclamo($codigo)
	{
		$stmt = Conexion::conectar()->prepare("CALL CargarHojaReclamo(:codigo)");
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt = null;
	}
}
