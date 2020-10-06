<?php
require_once('../app/views/template/header.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Partidos Politicos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
            <div class="card card-default">
                <form method="post" action="?controller=jurado&action=guardar">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Partido</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre Partido</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required
                                           placeholder="Nombre">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Presidente</label>
                                    <input type="text" class="form-control" id="presi" name="presi" required
                                           placeholder="Presidente">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vicepresidente</label>
                                    <input type="text" class="form-control" id="vice" name="vice" required
                                           placeholder="Vicepresidente">
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
                                <th>Nombre</th>
                                <th>Presidente</th>
                                <th>Vicepresidente</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $var1 = Partido::getPartidos();
                            foreach ($var1 as $users1) {
                                ?>
                                <tr>
                                    <td><?php echo $users1->nombre; ?></td>
                                    <td><?php echo $users1->presidente; ?>
                                    <td><?php echo $users1->vicepresidente; ?>
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


