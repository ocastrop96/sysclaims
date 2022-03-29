<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=db-paus-web",
			            "pausweb-admin",
			            "!Wu96Sl&uCVm^2cMwg@6");
		$link->exec("set names utf8");
		return $link;
	}
}