<?php
include('../../app/config.php');
include('../../admin/layout/parte1admin.php');
include('../../app/controllers/usuarios/listado_de_usuarios.php');
?>

<!-- DataTables CSS y JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<style>
  .titulo-principal {
    font-size: 1.8rem;
    font-weight: bold;
  }

  .encabezado-card {
    border-top: 6px solid #0d6efd; /* azul Bootstrap más grueso */
    background-color: #f8f9fa;
    padding: 1rem 1.5rem;
    border-radius: 0.5rem 0.5rem 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    font-size: 1.1rem;
  }

  .linea-divisoria {
    height: 2px;
    background-color: #dee2e6;
    margin: 0;
  }

  /* Quitar el borde azul exterior */
  .card-sin-borde {
    border: none;
    box-shadow: none;
  }
</style>
<style>
  /* Forzar bordes de cuadrícula en la tabla */
  table.table-bordered th,
  table.table-bordered td {
    border: 1px solid #dee2e6 !important;
  }
</style>

<div class="content-wrapper">
  <br>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <h3 class="mb-3 titulo-principal">Listado de usuarios</h3>

          <!-- Contenedor de tabla -->
          <div class="card card-sin-borde">
            <!-- Encabezado con estilo -->
            <div class="encabezado-card">
              <span>Usuarios registrados</span>
              <a href="create.php" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus"></i> Crear nuevo usuario
              </a>
            </div>

            <!-- Línea divisoria horizontal -->
            <div class="linea-divisoria"></div>

            <!-- Cuerpo de tabla -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="tabla_usuarios" class="table table-bordered table-hover table-sm text-nowrap">
                  <thead class="table-light">
                    <tr>
                      <th>Nro</th>
                      <th>Nombres del usuario</th>
                      <th>Rol id</th>
                      <th>Email</th>
                      <th>Fecha de creación</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $contador_usuario = 0;
                    if (isset($usuarios) && is_array($usuarios) && count($usuarios) > 0) {
                      foreach ($usuarios as $usuario) {
                        $contador_usuario++;
                        $id = $usuario['id_usuario'] ?? null;
                        $nombre_usuario = $usuario['nombre_usuario'] ?? 'No definido';
                        $rol_id = $usuario['rol_id'] ?? 'N/A';
                        $email = $usuario['email'] ?? 'N/A';
                        $fecha_creacion = $usuario['fecha_creacion'] ?? 'N/A';
                        $estado = $usuario['estado'] ?? 'N/A';
                        ?>
                        <tr>
                          <td><?= $contador_usuario; ?></td>
                          <td><?= htmlspecialchars($usuario['nombres']); ?></td>
                          <td><?= htmlspecialchars($rol_id); ?></td>
                          <td><?= htmlspecialchars($email); ?></td>
                          <td><?= htmlspecialchars($fecha_creacion); ?></td>
                          <td><?= htmlspecialchars($estado); ?></td>

                        


                          <td class="text-center">
  <div class="d-flex justify-content-center" style="gap: 10px;">
    <a href="show.php?id=<?= $id; ?>" class="btn btn-info btn-sm" title="Ver">
      <i class="bi bi-eye"></i>
    </a>
    <a href="edit.php?id=<?= $id; ?>" class="btn btn-success btn-sm" title="Editar">
      <i class="bi bi-pencil"></i>
    </a>
    <button type="button" class="btn btn-danger btn-sm btnEliminarUsuario"
        data-id="<?= $id; ?>" title="Eliminar">
  <i class="bi bi-trash"></i>
</button>

  </div>
</td>





<script>
 $(document).ready(function() {
  $('.btnEliminarUsuario').click(function() {
    const userId = $(this).data('id');
    $('#eliminar_id_usuario').val(userId);
    
    // Mostrar modal de confirmación
    $('#modalEliminarUsuario').modal('show');
  });

  $('#formEliminarUsuario').submit(function(e) {
    e.preventDefault();
    
    $.ajax({
      url: '../../app/controllers/usuarios/delete.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        $('#modalEliminarUsuario').modal('hide');
        
      
       
        if (response.trim() === 'ok') {
          // ALERTA SIN TIMER, CON BOTÓN ACEPTAR
          Swal.fire({
            icon: 'success',
            title: '¡Eliminado!',
            text: 'El usuario fue eliminado correctamente',
            showConfirmButton: true,      // Muestra el botón
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false,     // No cierra al clicar fuera
            allowEscapeKey: false         // No cierra con ESC
            // **ATENCIÓN: NO HAY timer aquí**
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else {
          // Si viene cualquier otro texto, lo mostramos como error
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.trim()
          });
        }
      },
      error: function(xhr, status, error) {
        console.error('Error AJAX:', status, error);
        Swal.fire({
          icon: 'error',
          title: 'Error de conexión',
          text: 'No se pudo conectar con el servidor'
        });
      }
    });
  });
});

</script>




                     

                        </tr>
                        <?php
                      }
                    } else {
                      echo '<tr><td colspan="7" class="text-center">No hay información</td></tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div> <!-- /.col-md-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<script>
  $(document).ready(function () {
    $('#tabla_usuarios').DataTable({
      language: {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "search": "Buscador:",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    });
  });
</script>

<?php
include('../../admin/layout/parte2admin.php');
include('../../layout/mensajes.php');
?>



<!-- Modal ver usuario -->
<div class="modal fade" id="verUsuarioModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fs-5">Detalles del Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="detalles-usuario">
        <!-- Contenido dinámico -->
      </div>
    </div>
  </div>
</div>

<!-- Modal editar usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditarUsuario">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title fs-5">Editar Usuario</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editar_id_usuario" name="id_usuario">
          <div class="mb-3">
            <label for="editar_nombre_usuario" class="form-label">Nombre del usuario</label>
            <input type="text" class="form-control" id="editar_nombre_usuario" name="nombre_usuario" required>
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

<!-- Modal para Confirmación de Eliminación -->
<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalEliminarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <div class="mb-3">
          <div style="font-size: 40px;">❓</div>
          <h4 class="fw-bold">Eliminar registro</h4>
          <p>¿Desea eliminar este registro?</p>
        </div>
        <form id="formEliminarUsuario">
          <input type="hidden" name="id_usuario" id="eliminar_id_usuario">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function verUsuario(id_usuario) {
  $.ajax({
    url: 'show.php',
    type: 'GET',
    data: {id_usuario: id_usuario},
    success: function(response) {
      $('#detalles-usuario').html(response);
      new bootstrap.Modal(document.getElementById('verUsuarioModal')).show();
    },
    error: function() {
      alert('Error al cargar los detalles');
    }
  });
}

function editarUsuario(id_usuario) {
  $.ajax({
    url: 'get_usuario.php',
    type: 'GET',
    data: { id_usuario: id_usuario },
    success: function(response) {
      let data = JSON.parse(response);
      $('#editar_id_usuario').val(data.id_usuario);
      $('#editar_nombre_usuario').val(data.nombre_usuario);
      new bootstrap.Modal(document.getElementById('editarUsuarioModal')).show();
    },
    error: function() {
      alert('Error al cargar el usuario');
    }
  });
}

$('#formEliminarUsuario').submit(async function(e) {
    e.preventDefault();
    
    const $form = $(this);
    const $btn = $form.find('button[type="submit"]');
    const originalText = $btn.html();
    
    // Mostrar estado de carga
    $btn.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm"></span> Procesando...
    `);
    
    try {
        const response = await $.ajax({
            url: '../../app/controllers/usuarios/delete.php',
            type: 'POST',
            data: $form.serialize(),
            dataType: 'text',
            timeout: 5000 // 5 segundos máximo
        }).then(res => res.trim());
        
        if (response === 'ok') {
            await Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'El usuario fue eliminado correctamente',
                timer: 2000,
                showConfirmButton: false
            });
            location.reload();
        } else {
            throw new Error(response || 'Error desconocido');
        }
    } catch (error) {
        let errorMsg = 'Error en el servidor';
        
        if (error.statusText === 'timeout') {
            errorMsg = 'El servidor no respondió a tiempo';
        } else if (error.responseText) {
            errorMsg = error.responseText;
        } else if (error.message) {
            errorMsg = error.message;
        }
        
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMsg,
            confirmButtonColor: '#dc3545'
        });
        
        console.error('Error completo:', error);
    } finally {
        $btn.prop('disabled', false).html(originalText);
    }
});
</script>