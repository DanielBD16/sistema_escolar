<?php
// session_start();
require_once __DIR__ . '/../validar_sesion.php';

// Validar si existe sesión
if (!isset($_SESSION['sesion_email'])) {
    $_SESSION['mensaje'] = "No tienes acceso a esta sección, inicia sesión primero";
    $_SESSION['tipo_mensaje'] = "error";
    header('Location: ' . APP_URL . 'login');
    exit;
}

$email_sesion = $_SESSION['sesion_email'];

try {
    // Obtener los datos del usuario logueado
    $query = $pdo->prepare("SELECT id_usuario, nombres, rol_id AS cargo, email FROM usuarios WHERE email = :email AND estado = 1 LIMIT 1");
    $query->execute(['email' => $email_sesion]);

    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    $nombre_usuario = $usuario['nombres'];
    $cargo_usuario = $usuario['cargo'];
    $id_usuario = $usuario['id_usuario'];
    $email_usuario = $usuario['email'];

    if (!$usuario) {
        // Usuario no encontrado o inactivo
        session_destroy();
        header('Location: ' . APP_URL . 'login');
        exit;
    }

    $nombre_usuario = $usuario['nombres'];
} catch (PDOException $e) {
    die("Error al obtener usuario: " . $e->getMessage());
}



?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= APP_URL; ?>/admin" class="nav-link"><?= APP_NAME; ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">



                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= APP_URL ?>/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <h5 class="brand-text font-weight-light">GESTIÓN ESCOLAR</h5>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= APP_URL ?>/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= htmlspecialchars($nombre_usuario) ?></a>
                        <!-- <div class="info text-muted small">
                            Cargo: <?= htmlspecialchars($cargo_usuario) ?><br>
                            ID: <?= $id_usuario ?><br>
                            Email: <?= htmlspecialchars($email_usuario) ?>
                        </div> -->
                    </div>

                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bookmark-star"></i></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/roles" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de roles</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link active">
<<<<<<< HEAD
                                <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i></i></i>
=======
                                <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i></i>
>>>>>>> 4df50ca6bfb824f68fdec04d4791721720ea69c4
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/usuarios" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                        <li class="nav-item">
                            <a href="<?=APP_URL;?>/login/logout.php" class="nav-link" style="background-color:rgb(217, 24, 37);color:white;">
                                <i class="nav-icon fas"><i class="bi bi-door-open"></i></i>
                                <p>
                                    Cerrar sesión
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>