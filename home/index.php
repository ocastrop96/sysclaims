<?php

// Llamada a controladores
require_once "./app/controllers/templateController.php";
require_once "./app/controllers/reclamosController.php";
require_once "./app/controllers/utilitariosController.php";
// Llamada a modelos
require_once "./app/models/reclamosModel.php";
require_once "./app/models/utilitariosModel.php";
// Envío de Correos
// require_once "./public/views/util/envioCorreo.php";



$template =  new ControladorPlantilla();
$template->ctrPlantilla();
