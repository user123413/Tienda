<?php

  session_start();
  require 'funciones.php';

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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
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
          <a class="navbar-brand" href="index.php">Pagina Principal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>             
              <a href="contactenos.html" class="contactenos">Contactenos</a>
            </li>
            <li>
              <a href="carrito.php">CARRITO<span class="badge"><?php print cantidadProductos(); ?></span></a>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <section class="home" >
        <div class="content">
          <h3>Productos al <span>mejor</span> precio</h3>
          <p>Está a un solo clic de disfrutar de un<br> centro comercial digital con las mejores<br> ofertas 
          de Internet. <br><br>¿Qué espera para ser parte de la Comunidad?</p>
          <!--<a href="#" class="btn">mas detalles</a>-->
        </div>
      </section>
      <section class="features">
        <h1 class="heading">Productos de  <span>calidad</span> y al mejor precio</h1>
      </section>
    <div class="container" id="main">
      <div class="row">
        <?php
        require 'vendor/autoload.php';
        $tienda = new Kawschool\Tienda;
        $info_tienda = $tienda->mostrar();
        $cantidad = count($info_tienda);
        if($cantidad > 0){
          for($x = 0; $x < $cantidad; $x++){
            $item = $info_tienda[$x];
        ?>

        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1 class="text-center titulo-pelicula"><?php print $item['nombre'] ?></h1>
            </div>
            <div class="panel-body">

              <?php
                $foto = 'upload/'.$item['foto'];
                if(file_exists($foto)){
                ?>
                <img src="<?php print $foto; ?>" width="230" height="180">
                <?php }else{ ?>
                <img src="assets/imagenes/not-found.jpg" width="230" height="180">
                <?php } ?>

              </div>

              <div class="panel-heading">
                <h1 class="text-center titulo-pelicula">$ <?php print $item['precio'] ?></h1>
              </div>

                  <div class="panel-footer">
                    <a href="carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
                    <span class="glyphicon glyphicon-shopping-cart"></span>Comprar
                    </a>
                  </div>

          </div>
        </div>
        
      <?php }

        } else {?>

        <h4>No hay registros</h4>

      <?php } ?>

      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
