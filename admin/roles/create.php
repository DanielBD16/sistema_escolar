<?php
include('../../app/config.php');
include('../../admin/layout/parte1admin.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Creacion de un nuevo Rol</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= APP_URL ?>/app/controllers/roles/create.php" method="POST" id="form-registrar-rol">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" placeholder="Nombre del rol" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" id="btn-registrar-rol" name="btn-registrar-rol">
                                                Registrar
                                            </button>
                                            <!-- <button class="btn btn-secondary" id="btn-registrar-rol" name="btn-registrar-rol">
                                                Cancelar
                                            </button> -->

                                            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= APP_URL ?>/admin/roles/'">
                                                Cancelar
                                            </button>

                                        </div>
                                    </div>
                                </div>
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