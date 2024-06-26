<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/public/admin/index.php/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de Usuarios</h3>
                            <div class="card-tools">
                                <a href="/public/admin/index.php/users/create" class="btn btn-success">Nuevo Usuario</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($users) && is_array($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?php echo $user['id']; ?></td>
                                                <td><?php echo $user['username']; ?></td>
                                                <td><?php echo $user['email']; ?></td>
                                                <td><?php echo $user['role']; ?></td>
                                                <td>
                                                    <a href="/public/admin/index.php/users/edit/<?php echo $user['id']; ?>" class="btn btn-warning">Editar</a>
                                                    <button class="btn btn-danger" onclick="confirmDelete(<?php echo $user['id']; ?>)">Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No hay usuarios disponibles</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
                ¿Estás seguro de que deseas eliminar este usuario?
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
        deleteUrl = '/public/admin/index.php/users/delete/' + id;
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
            showNotification('Error', 'Hubo un problema al eliminar el usuario.', 'error');
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
