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
                          <button type="button" class="btn btn-info btn-sm" onclick="verRol(<?= $id_rol ?>)"><i class="bi bi-eye"></i></button>
                          <button type="button" class="btn btn-success btn_sm" onclick="editarRol(<?= $id_rol ?>)"><i class="bi bi-pencil"></i></button>
                          <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion(<?= $id_rol ?>)"><i class="bi bi-trash"></i></button>

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


<!-- Agregar esto JUSTO ANTES del cierre del body -->
<!-- Modal -->
<div class="modal fade" id="verRolModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fs-5">Detalles del Rol</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="detalles-rol">
        <!-- Contenido dinámico -->
      </div>
    </div>
  </div>
</div>


<!-- Modal para editar rol -->
<div class="modal fade" id="editarRolModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditarRol">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title fs-5">Editar Rol</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editar_id_rol" name="id_rol">
          <div class="mb-3">
            <label for="editar_nombre_rol" class="form-label">Nombre del rol</label>
            <input type="text" class="form-control" id="editar_nombre_rol" name="nombre_rol" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Actualizar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Confirmar Eliminación -->
<div class="modal fade" id="modalEliminarRol" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <div class="mb-3">
          <div style="font-size: 40px;">❓</div>
          <h4 class="fw-bold">Eliminar registro</h4>
          <p>¿Desea eliminar este registro?</p>
        </div>
        <form id="formEliminarRol">
          <input type="hidden" name="id_rol" id="eliminar_id_rol">
          <button type="submit" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Scripts necesarios -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function verRol(id_rol) {
  $.ajax({
    url: 'show.php', // Asegúrate que esta ruta es correcta
    type: 'GET',
    data: {id_rol: id_rol},
    success: function(response) {
      $('#detalles-rol').html(response);
      new bootstrap.Modal(document.getElementById('verRolModal')).show();
    },
    error: function() {
      alert('Error al cargar los detalles');
    }
  });
}
</script>

<script>
function editarRol(id_rol) {
  $.ajax({
    url: 'get_rol.php',
    type: 'GET',
    data: { id_rol: id_rol },
    success: function(response) {
      let data = JSON.parse(response);
      $('#editar_id_rol').val(data.id_rol);
      $('#editar_nombre_rol').val(data.nombre_rol);
      new bootstrap.Modal(document.getElementById('editarRolModal')).show();
    },
    error: function() {
      alert('Error al cargar el rol');
    }
  });
}

// Manejar el submit del formulario
$('#formEditarRol').submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'update.php',
    type: 'POST',
    data: $(this).serialize(),
    success: function(response) {
      const modal = bootstrap.Modal.getInstance(document.getElementById('editarRolModal'));
      modal.hide();

      if (response === 'ok') {
        Swal.fire({
          icon: 'success',
          title: 'Actualizado',
          text: 'El rol se actualizó correctamente',
          confirmButtonColor: '#198754',
          timer: 2000,
          timerProgressBar: true,
          showConfirmButton: false
        }).then(() => {
          location.reload(); // recarga después de la confirmación visual
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo actualizar el rol',
          confirmButtonColor: '#dc3545'
        });
      }
    },
    error: function() {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Error en la conexión al servidor',
        confirmButtonColor: '#dc3545'
      });
    }
  });
});

</script>


<script>
function confirmarEliminacion(id_rol) {
  $('#eliminar_id_rol').val(id_rol);
  new bootstrap.Modal(document.getElementById('modalEliminarRol')).show();
}

$('#formEliminarRol').submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'delete.php',
    type: 'POST',
    data: $(this).serialize(),
    success: function(response) {
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalEliminarRol'));
      modal.hide();

      if (response === 'ok') {
        Swal.fire({
          icon: 'success',
          title: 'Eliminado',
          text: 'El rol se eliminó correctamente',
          confirmButtonColor: '#198754',
          timer: 2000,
          timerProgressBar: true,
          showConfirmButton: false
        }).then(() => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo eliminar el rol',
          confirmButtonColor: '#dc3545'
        });
      }
    },
    error: function() {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Error en la conexión al servidor',
        confirmButtonColor: '#dc3545'
      });
    }
  });
});

</script>

