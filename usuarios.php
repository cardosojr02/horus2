<?php include ('layout/parte1.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $URL; ?>">Home</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-11 mx-auto">
          <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">GESTIÓN DE USUARIOS</h3>
                <div class="card-tools">
                  <a href="usuarios.php?a=register" class="btn btn-tool btn-sm">
                    <i class="fa fa-user-plus"></i>
                    Registrar usuario
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive">
                <hr>
                
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>E-mail</th>
                    <th>Documento</th>
                    <th>Tipo de usuario</th>
                    <th>Token</th>
                    <th>Fecha de creacion</th>
                    <th>Fecha de actualizacion</th>
                    <th>Operaciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php include 'app/controllers/usuarios/controller_usuarios.php'; ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php include ('layout/parte2.php'); ?>