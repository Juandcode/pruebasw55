<?php
require_once('../app/views/template/header.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mesas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
            <div class="card card-default">
                <form method="post" action="?controller=mesas&action=guardar">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Mesa</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Codigo Mesa</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Nombre">
                                </div>
                                <!-- /.form-group -->

                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Recinto</label>
                                    <input type="text" class="form-control" id="vice" name="vice" required placeholder="Vicepresidente">
                                </div>
                                <!-- /.form-group -->

                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Codigo QR</th>
                                    <th>Imagen</th>
                                    <th>Recinto</th>
                                    <th>Resultados</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $var1 = mesa::getMesas();
                                foreach ($var1 as $users1) {
                                ?>
                                    <tr>
                                        <td><?php echo $users1->codigo; ?></td>
                                        <td>
                                            <?php if ($users1->imagen != null) { ?>

                                                <a href=<?php echo $users1->imagen ?> target="_blank" type="button" class="btn btn-block bg-gradient-info">Imagen</a>
                                            <?php } ?>
                                        <td><?php echo Recinto::getNombreDistrito($users1->idRecinto); ?>
                                        </td>

                                        <td><?php  if(Votos::devolverDatos($users1->id)!=0){ ?>
                                            <form method="post" action="?controller=mesa&action=resultados">
                                            <button type="submit" value=<?php echo $users1->id ?>  name="id" class="btn btn-block bg-gradient-success">Resultados</button>
                                            </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>

</div>


<?php
require_once('../app/views/template/footer.php');
?>