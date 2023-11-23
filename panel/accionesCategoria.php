<?php
require "../vendor/autoload.php";

$tienda = new Kawschool\Categoria;

if($_SERVER['REQUEST_METHOD'] ==='POST'){

if($_POST['acciones']==='Registrar'){

    if(empty($_POST['Categoria']))
        exit('Ingrese la categoria');

    $_params = array(
        'nomCategoria'=>$_POST['Categoria']
    );

    $rpt = $tienda->registrarC($_params);

    if($rpt)
        header('Location: categorias/index.php');
    else
        print 'Error al registrar la categoria';          
        
}

if($_POST['acciones']==='Actualizar'){

    if(empty($_POST['Categoria']))
        exit('Ingrese la categoria');

    $_params = array(
        'nomCategoria'=>$_POST['Categoria']
    );
    
    $rpt = $tienda->actualizarC($_params);

    if($rpt)
        header('Location: categorias/index.php');
    else
        print 'Error al actualizar la categoria';

}

}

if($_SERVER['REQUEST_METHOD'] ==='GET'){

$id = $_GET['id'];

$rpt = $tienda->eliminarC($id);

if($rpt)
    header('Location: categorias/index.php');
else
    print 'Error al eliminar';  
}