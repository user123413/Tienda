<?php

namespace Kawschool;

class Tienda{

    private $config;
    private $cn = null;

    public function __construct(){
        $this -> config=parse_ini_file(__DIR__.'/../config.ini');
        
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }
    public function registrar($_params){
        $sql = "INSERT INTO `productos`( `id_categoria`, `nombre`, `descripcion`, `precio`, `foto`) 
        VALUES (:id_categoria, :nombre, :descripcion, :precio, :foto)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id_categoria" => $_params['id_categoria'],
            ":nombre" => $_params['nombre'],
            ":descripcion" => $_params['descripcion'],
            ":precio" => $_params['precio'],
            ":foto" => $_params['foto'],
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function actualizar($_params){
        $sql = "UPDATE `productos` SET `id_categoria`=:id_categoria,`nombre`=:nombre,`descripcion`=:descripcion,`precio`=:precio,`foto`=:foto WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id_categoria" => $_params['id_categoria'],
            ":nombre" => $_params['nombre'],
            ":descripcion" => $_params['descripcion'],
            ":precio" => $_params['precio'],
            ":foto" => $_params['foto'],
            ":id" =>  $_params['id']
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function eliminar($id){
        $sql = "DELETE FROM `productos` WHERE `id`=:id ";

        $resultado = $this->cn->prepare($sql);
        
        $_array = array(
            ":id" =>  $id
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function mostrar(){
        $sql = "SELECT productos.id, productos.nombre, productos.descripcion, categoria.nomCategoria, productos.foto, productos.precio FROM productos 
        INNER JOIN categoria 
        ON productos.id_categoria = categoria.id ORDER BY productos.id DESC
        ";
        
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarPorId($id){
        
        $sql = "SELECT * FROM `productos` WHERE `id`=:id ";
        
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" =>  $id
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }

    public function mostrarProductos(){
        $sql = "SELECT ventas.id_carrito, ventas.fecha, detalles.id_producto, detalles.cantidad, productos.nombre FROM ventas INNER JOIN detalles ON ventas.id = detalles.id_venta INNER JOIN productos ON detalles.id_producto = productos.id
        ";
        
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function detellesPedidos(){
        $sql = "SELECT `productos`.`nombre`, `detalles`.`cantidad`, `ventas`.`fecha`, `ventas`.`total`, concat(`carrito`.`nombre`, ' ' ,`carrito`.`apellidos`) AS `nomCompleto`, `carrito`.`direccion` FROM `productos` INNER JOIN `detalles` ON `productos`.`id` = `detalles`.`id_producto` INNER JOIN `ventas` ON `ventas`.`id` = `detalles`.`id_venta` INNER JOIN `carrito` ON `carrito`.`id` = `ventas`.`id_carrito`";
        
        $resultado = $this->cn->prepare($sql     );

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    
}



