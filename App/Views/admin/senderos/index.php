<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/sidebar.php'; ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Senderos</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de Senderos</h3>
                            <div class="card-tools">
                                <a href="/public/admin/index.php/senderos/create" class="btn btn-success">Nuevo Sendero</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Provincia</th>
                                        <th>Localidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($senderos) && is_array($senderos)): ?>
                                        <?php foreach ($senderos as $sendero): ?>
                                            <tr>
                                                <td><?php echo $sendero['id']; ?></td>
                                                <td><?php echo $sendero['nombre']; ?></td>
                                                <td><?php echo $sendero['descripcion']; ?></td>
                                                <td><?php echo $sendero['provincia']; ?></td>
                                                <td><?php echo $sendero['localidad']; ?></td>
                                                <td>
                                                    <a href="/public/admin/index.php/senderos/edit/<?php echo $sendero['id']; ?>" class="btn btn-warning">Editar</a>
                                                    <button class="btn btn-danger" onclick="confirmDelete(<?php echo $sendero['id']; ?>)">Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No hay senderos disponibles</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este sendero?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<!-- Toast de Notificación -->
<div class="toast" id="notificationToast" style="position: absolute; top: 20px; right: 20px;" data-delay="3000">
    <div class="toast-header">
        <strong class="mr-auto" id="notificationToastTitle"></strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body" id="notificationToastBody"></div>
</div>

<script>
    let deleteUrl = '';

    function confirmDelete(id) {
        deleteUrl = '/public/admin/index.php/senderos/delete/' + id;
        $('#confirmDeleteModal').modal('show');
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        fetch(deleteUrl, {
            method: 'POST',
        }).then(response => {
            $('#confirmDeleteModal').modal('hide');
            location.reload();
        }).catch(error => {
            $('#confirmDeleteModal').modal('hide');
            showNotification('Error', 'Hubo un problema al eliminar el sendero.', 'error');
        });
    });

    function showNotification(title, message, type) {
        console.log('Showing notification:', { title, message, type });

        const toast = document.getElementById('notificationToast');
        document.getElementById('notificationToastTitle').innerText = title;
        document.getElementById('notificationToastBody').innerText = message;

        toast.classList.remove('bg-success', 'bg-danger', 'text-white');

        if (type === 'success') {
            toast.classList.add('bg-success', 'text-white');
        } else {
            toast.classList.add('bg-danger', 'text-white');
        }

        $(toast).toast('show');
    }

    <?php if (isset($_SESSION['toast'])): ?>
        console.log('Session toast exists:', <?php echo json_encode($_SESSION['toast']); ?>);
        document.addEventListener('DOMContentLoaded', function() {
            const toastData = <?php echo json_encode($_SESSION['toast']); ?>;
            console.log('Toast data:', toastData);
            showNotification(toastData.type === 'success' ? 'Éxito' : 'Error', toastData.message, toastData.type);
            <?php unset($_SESSION['toast']); ?>
        });
    <?php else: ?>
        console.log('No toast data in session');
    <?php endif; ?>
</script>
