<?php

define('SERVIDOR', 'localhost'); // Servidor de la base de datos
define('USUARIO', 'root'); // Usuario de la base de datos
define('PASSWORD', ''); // Contraseña de la base de datos 
define('DB', 'schoolmanagement'); // Nombre de la base de datos

define('APP_NAME', 'SCHOOL MANAGEMENT SYSTEM'); // Nombre de la aplicación
define('APP_URL', 'http://localhost:8080/sisGestionEscolar/'); // URL de la aplicación
define('KEY_API_MAPS', ''); // API KEY de Google Maps

// $servidor = "mysql:dbname=" . DB . ";host=" . SERVIDOR;
$servidor = "mysql:host=" . SERVIDOR . ";port=3307;dbname=" . DB;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    // echo "conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error no se pudo conectar a la base de datos " . $e->getMessage();
    exit;
}

date_default_timezone_set("America/Lima");
// echo $fechaHora = date('Y-m-d H:i:s'); // Fecha y hora actual

$fecha_actual = date('Y-m-d'); // Fecha actual
$dia_actual = date('d'); // Día actual
$mes_actual = date('m'); // Mes actual
$anio_actual = date('Y'); // Año actual

$estado_de_registro = 1; // Estado de registro activo
$estado_inactivo = 0; // Estado de registro inactivo

// echo "el dia de hoy ".$dia_actual."en el mes de ".$mes_actual."del año ".$anio_actual;