<?php
/*=============================================
    CONTROLADOR PLANTILLA
=============================================*/
require_once "controladores/plantilla.controlador.php";
/*=============================================
    CONTROLADORES
=============================================*/
require_once "controladores/blog.controlador.php";
require_once "controladores/correo.controlador.php";
/*=============================================
    MODELOS
=============================================*/
require_once "modelos/blog.modelo.php";

require "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrTraerPlantilla();