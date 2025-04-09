<?php
include('../../app/config.php');
include('../../admin/layout/parte1admin.php');

include('../../app/controllers/roles/listado_de_roles.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <br>
  <div class="content">
    <div class="container">
      <div class="row">
        <h1>Listado de categorias</h1>
      </div>
      <br>
      <div class="row">

        <div class="col-md-6">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Roles registrados</h3>

              <div class="card-tools">
                <a href="create.php" class="btn btn-primary"><i class="bi bi-person-rolodex"></i> Crear nuevo rol</a>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-hover table-sm table-responsiv">
                <thead>
                  <tr>
                    <th>Nro</th>
                    <th>Nombre del rol</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador_rol = 0;
                  foreach ($roles as $role) {
                    $id_rol = $role['id_rol'];
                    $contador_rol = $contador_rol + 1; ?>
                    <tr>
                      <td><?= $contador_rol; ?></td>
                      <td><?= $role['nombre_rol'] ?></td>
                      <td style="text-align: center;">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></button>
                          <button type="button" class="btn btn-success btn_sm"><i class="bi bi-pencil"></i></button>
                          <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>
              </table>
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