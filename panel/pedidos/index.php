
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
          <a class="navbar-brand" href="../dashboard.php">Pedidos realizados</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>
              <a href="../productos/index.php" class="btn">Productos</a>
            </li>
            <li>
              <a href="../categorias/index.php" class="btn">Categorias</a>
            </li>
            <li class="active">
              <a href="index.php" class="btn">Pedidos</a>
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
                <fieldset>
                  <legend>Listado de pedidos</legend>
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Nombre del cliente</th>
                        <th>Dirección</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Pago</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require '../../vendor/autoload.php';
                        $tienda = new Kawschool\Tienda;
                        $info_producto = $tienda->detellesPedidos();

                        $cantidad = count($info_producto);
                        if($cantidad > 0){
                          $c = 0;
                          for($x =0; $x < $cantidad; $x++){
                            $c++;
                            $item = $info_producto[$x];
                      ?>

                      <tr>
                        <td><?php print $c?></td>
                        <td><?php print $item['fecha']?></td>
                        <td><?php print $item['nomCompleto']?></td>
                        <td><?php print $item['direccion']?></td>
                        <td><?php print $item['nombre']?></td>
                        <td><?php print $item['cantidad']?></td>
                        <td><?php print $item['total']?></td>
                        <td class="text-center">

                      <?php
                        }
                          }else{

                      ?>

                      <tr>
                      <td align="center" colspan="7">No hay registros</td>
                      </tr>

                      <?php 
                        }
                      ?>
                    </tbody>
                  </table>
                </fieldset>
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
