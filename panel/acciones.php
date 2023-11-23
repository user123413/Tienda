<?php
require "../vendor/autoload.php";

$tienda = new Kawschool\Tienda;

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    if($_POST['accion']==='Registrar'){

        if(empty($_POST['Producto']))
            exit('Ingrese en nombre del producto');
        
        if(empty($_POST['descripcion']))
            exit('Ingrese la descripción');
        
        if(empty($_POST['id_categoria']))
            exit('Seleccione una categoria');
        
        if(!is_numeric($_POST['id_categoria']))
            exit('Seleccione una categoria valida');

        $_params = array(
            'id_categoria'=>$_POST['id_categoria'],
            'nombre'=>$_POST['Producto'],
            'descripcion'=>$_POST['descripcion'],
            'precio'=>$_POST['precio'],
            'foto'=>subirFoto()
        );

        $rpt = $tienda->registrar($_params);

        if($rpt)
            header('Location: productos/index.php');
        else
            print 'Error al registrar un producto';          
            
    }

    if($_POST['accion']==='Actualizar'){

        if(empty($_POST['Producto']))
            exit('Ingrese en nombre del producto');
        
        if(empty($_POST['descripcion']))
            exit('Ingrese la descripción');
        
        if(empty($_POST['id_categoria']))
            exit('Seleccione una categoria');
        
        if(!is_numeric($_POST['id_categoria']))
            exit('Seleccione una categoria valida');

        $_params = array(
            'id_categoria'=>$_POST['id_categoria'],
            'nombre'=>$_POST['Producto'],
            'descripcion'=>$_POST['descripcion'],
            'precio'=>$_POST['precio'],
            'id'=>$_POST['id']
        );

        if(!empty($_POST['foto_temp']))
        $_params['foto'] = $_POST['foto_temp'];

        if(!empty($_FILES['foto']['name']))
        $_params['foto'] = subirFoto();
        
        $rpt = $tienda->actualizar($_params);

        if($rpt)
            header('Location: productos/index.php');
        else
            print 'Error al actualizar un producto';

    }

}

if($_SERVER['REQUEST_METHOD'] ==='GET'){

    $id = $_GET['id'];

    $rpt = $tienda->eliminar($id);

    if($rpt)
        header('Location: productos/index.php');
    else
        print 'Error al eliminar';  
}

function subirFoto(){
    $carpeta = __DIR__.'/../upload/';

    $archivo = $carpeta.$_FILES['foto']['name'];

    move_uploaded_file($_FILES['foto']['tmp_name'],$archivo);

    return $_FILES['foto']['name'];
}