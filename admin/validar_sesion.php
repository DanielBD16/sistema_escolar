<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/config.php';

if (!isset($_SESSION['sesion_email'])) {
    $_SESSION['mensaje'] = "No tienes acceso a esta sección, inicia sesión primero";
    $_SESSION['tipo_mensaje'] = "error";
    header('Location: ' . APP_URL . 'login');
    exit;
}
