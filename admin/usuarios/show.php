<?php
$id_usuario = $_GET['id'];
include('../../app/config.php');
include('../../admin/layout/parte1admin.php');

// PASA EL ID POR SESSION
$_SESSION['id_usuario'] = $id_usuario;
 
include('../../app/controllers/usuarios/datos_del_usuario.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Usuario: <?= htmlspecialchars($nombres); ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos registrados</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Campo: Nombre del rol -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rol_id" class="form-label">Nombre del rol</label>
                                        <p><?=$nombre_rol?></p>
                                    </div>
                                </div>

                                <!-- Campo: Nombres del usuario -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombres" class="form-label">Nombres del usuario</label>
                                        <input type="text" name="nombres" id="nombres" class="form-control" 
                                               value="<?= htmlspecialchars($nombres); ?>" placeholder="Ingrese nombre" required>
                                    </div>
                                </div>

                                <!-- Campo: Email -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" 
                                               value="<?= htmlspecialchars($email); ?>" placeholder="Ingrese email" required>
                                    </div>
                                </div>

                                <!-- Campo: Password -->
                                

                                <!-- Campo: Repetir Password -->
                                
                            </div>

                            <hr>

                            <!-- Botón Volver -->
                            <div class="row">
                                <div class="col-md-4" style="margin-left: 4px;">
                                    <div class="form-group d-flex" style="gap: 10px;">
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= APP_URL ?>/admin/usuarios/'">
                                            Volver
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])) {
                                $icono = '';
                                $color = '';
                                
                                if ($_SESSION['icono'] === 'success') {
                                    $icono = '✔';
                                    $color = '#28a745';
                                } elseif ($_SESSION['icono'] === 'error') {
                                    $icono = '❌';
                                    $color = '#dc3545';
                                } else {
                                    $icono = '⚠';
                                    $color = '#ffc107';
                                }

                                echo "
                                <div style='
                                    border: 1px solid $color;
                                    background-color: #f9f9f9;
                                    padding: 20px;
                                    border-radius: 8px;
                                    text-align: center;
                                    max-width: 400px;
                                    margin: 20px auto;
                                    box-shadow: 0 0 10px rgba(0,0,0,0.1);'>

                                    <div style='font-size: 40px; color: $color;'>$icono</div>
                                    <div style='font-size: 16px; font-weight: bold; color: #333;'>{$_SESSION['mensaje']}</div>
                                </div>";
                                
                                unset($_SESSION['mensaje'], $_SESSION['icono']);
                            }
                            ?>
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