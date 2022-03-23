<?php
// Controladores
require_once "./app/controller/PlantillaControlador.php";
require_once "./app/controller/UsuariosControlador.php";
require_once "./app/controller/DerechoSControlador.php";
require_once "./app/controller/CausasControlador.php";
require_once "./app/controller/ReclamosControlador.php";
require_once "./app/controller/ConsultasControlador.php";



// Modelos
require_once "./app/model/UsuariosModelo.php";
require_once "./app/model/DerechoSModelo.php";
require_once "./app/model/CausasModelo.php";
require_once "./app/model/ReclamosModelo.php";
require_once "./app/model/ConsultasModelo.php";


$template = new ControladorPlantilla();
$template->ctrPlantilla();
