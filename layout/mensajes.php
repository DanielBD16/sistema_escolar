<?php
// session_start();

if (isset($_SESSION['mensaje'])): ?>
    <script>
        Swal.fire({
            icon: '<?= $_SESSION['tipo_mensaje'] ?? 'info' ?>',
            title: '<?= $_SESSION['tipo_mensaje'] === 'success' ? 'Éxito' : 'Oops...' ?>',
            text: '<?= $_SESSION['mensaje'] ?>',
            // confirmButtonText: 'Cerrar',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    <?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo_mensaje']);
    ?>
<?php endif; ?>