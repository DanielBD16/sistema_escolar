<?php
$id_usuario = $_GET['id'];
session_start();
include('../../app/config.php');
include('../../admin/layout/parte1admin.php');
include('../../app/controllers/usuarios/datos_del_usuario.php');
include('../../app/controllers/roles/listado_de_roles.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Modificar Usuario: <?=$nombres;?></h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
    <form action="<?= APP_URL ?>/app/controllers/usuarios/update.php" method="POST" id="form-registrar-rol">
    <div class="row">
    <!-- Campo: Nombre del rol -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="rol" class="form-label">Nombre del rol</label>
            <input type="text" name="id_usuario" value="<?=$id_usuario;?>" hidden>
            <div class="d-flex align-items-center" style="gap: 8px;">
                <select name="rol_id" id="rol_id"
                        class="form-select"
                        style="max-width: 250px; font-size: 14px; color: #6c757d; height: 38px; padding-top: 6px; padding-bottom: 6px;
                               border-radius: 0.375rem; border: 1px solid #ced4da;">
                               
                               <?php 
foreach ($roles as $role) { 
    $nombre_rol_tabla = $role['nombre_rol'];
    $selected = ($nombre_rol == $nombre_rol_tabla) ? 'selected="selected"' : '';
?>
    <option value="<?= $role['id_rol']; ?>" <?= $selected ?>>
        <?= $role['nombre_rol']; ?>
    </option>
<?php } ?>

                </select>

                <a href="<?= APP_URL; ?>/admin/roles/create.php"
                   class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                   style="height: 38px; width: 38px; padding: 0; border-radius: 0.375rem;">
                    <i class="bi bi-file-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Campo: Nombres del usuario -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="nombre_usuario" class="form-label">Nombres del usuario</label>
            <input type="text" name="nombres" value="<?=$nombres;?>" id="nombres" class="form-control" placeholder="Ingrese nombre" required>
        </div>
    </div>

    <!-- Campo: Email -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="<?=$email;?>" id="email" class="form-control" placeholder="Ingrese email" required>
        </div>
    </div>

<!-- Campo: PASSWORD -->
<div class="col-md-4">
    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese Password">
    </div>
</div>

<!-- Campo: REPETIR PASSWORD -->
<div class="col-md-4">
    <div class="form-group">
        <label for="repetir_password" class="form-label">Repetir Password</label>
        <input type="password" name="repetir_password" id="repetir_password" class="form-control" placeholder="Repita Password" >
    </div>
</div>



</div>



<hr>

 <!-- Campo: REGISTRAR Y CANCELAR -->

<div class="row">
    <div class="col-md-4" style="margin-left: 4px;">
        <div class="form-group d-flex" style="gap: 10px;">
            <button type="submit" class="btn btn-success" id="btn-registrar-rol" name="btn-registrar-rol">
                Actualizar
            </button>

            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= APP_URL ?>/admin/usuarios/'">
                Volver
            </button>
        </div>
    </div>
</div>













<?php if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])): ?>
    <?php
        $icono = $_SESSION['icono'] === 'success' ? '✔️' : ($_SESSION['icono'] === 'error' ? '❌' : '⚠️');
        $color = $_SESSION['icono'] === 'success' ? '#28a745' : ($_SESSION['icono'] === 'error' ? '#dc3545' : '#ffc107');
        $mensaje = $_SESSION['mensaje'];
        unset($_SESSION['mensaje'], $_SESSION['icono']);
    ?>
    <div id="mensaje-flash" style="
        border: 1px solid <?= $color ?>;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        max-width: 400px;
        margin: 20px auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        opacity: 1;
        transition: opacity 0.2s ease;
    ">
        <div style="font-size: 40px; color: <?= $color ?>;"><?= $icono ?></div>
        <div style="font-size: 16px; font-weight: bold; color: #333;"><?= $mensaje ?></div>
    </div>

    <script>
        setTimeout(() => {
            const mensaje = document.getElementById('mensaje-flash');
            if (mensaje) {
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.remove(), 200);
            }
        }, 800); // ⚡️ DESAPARECE EN 0.8 SEGUNDOS
    </script>
<?php endif; ?>






















                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->







<?php
include('../../admin/layout/parte2admin.php');

include('../../layout/mensajes.php');

?>

