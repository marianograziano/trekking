<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/sidebar.php'; ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar Sendero</h1>
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
                        <div class="card-body">
                            <form action="/public/admin/index.php/senderos/update/<?php echo $sendero['id']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $sendero['nombre']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $sendero['descripcion']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_provincia">Provincia</label>
                                    <select class="form-control" id="id_provincia" name="id_provincia" required>
                                        <!-- Options will be populated from the database -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_localidad">Localidad</label>
                                    <select class="form-control" id="id_localidad" name="id_localidad" required>
                                        <!-- Options will be populated from the database -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gpx_file">Archivo GPX</label>
                                    <input type="file" class="form-control" id="gpx_file" name="gpx_file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include __DIR__ . '/../partials/footer.php'; ?>
