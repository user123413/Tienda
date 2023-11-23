<?php
  require '../../vendor/autoload.php';

  if(isset($_GET['id']) && is_numeric($_GET['id'])){

    $id = $_GET['id'];

    $tienda = new Kawschool\Tienda;
    $resultado = $tienda->mostrarPorId($id);

    if(!$resultado)
    header('Location: index.php');

  } else {
    header('Location: index.php');
  }



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tienda Online</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../dashboard.php">Actualizar Productos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li class="active">
              <a href="index.php" class="btn">Productos</a>
            </li>
            <li>
              <a href="../categorias/index.php" class="btn">categorias</a>
            </li> 
            <li>
              <a href="../pedidos/index.php" class="btn">Pedidos</a>
            </li> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admim <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Salir</a></li>
                </ul>
            </li>

          </ul>

          
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
       <div class="row">
        <div class="col-md-12">

        <form class="form_registrar" method="POST" action="../acciones.php" enctype="multipart/form-data">

        <h1>Actualizar los datos del producto</h1>

              <input type="hidden" name="id" value="<?php print $resultado['id'] ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre del producto</label>
                            <input value="<?php print $resultado['nombre'] ?>" type="text" class="form-control" name="Producto" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="" cols="3" required><?php print $resultado['descripcion'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control"name="id_categoria" required>
                                <option value="">--seleccione--</option>
                                <?php
                                 require '../../vendor/autoload.php';
                                 $categoria = new Kawschool\Categoria;
                                 $info_categoria = $categoria->mostrar();
                                 $cantidad = count($info_categoria);

                                 for($x =0; $x < $cantidad; $x++){
                                  $item = $info_categoria[$x];
                               
                                ?>

                                  <option value="<?php print $item['id']?>"
                                  <?php print $resultado['id_categoria']== $item['id'] ?'selected':'' ?>
                                  ><?php print $item['nomCategoria']?></option>

                                <?php
                                 }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto">
                            <input type="hidden" name="foto_temp" value="<?php print $resultado['foto'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Precio</label>
                            <input value="<?php print $resultado['precio'] ?>" type="text" class="form-control" name="precio" placeholder="0.00" required>
                        </div>
                    </div>
                </div>


                <input type="submit" class="btn btn-primary" name="accion" value="Actualizar">
                <a href="index.php" class="btn btn-default">Cancelar</a>
            </form>
            

        </div>
       </div>
        

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

  </body>
</html>
