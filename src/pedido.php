<?php

namespace Kawschool;

class Pedido{

    private $config;
    private $cn = null;

    public function __construct(){
        $this -> config=parse_ini_file(__DIR__.'/../config.ini');
        
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function registrar($_params){
        $sql = "INSERT INTO `ventas`(`id_carrito`, `fecha`, `total`) VALUES 
        (:id_carrito,:fecha,:total)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id_carrito" => $_params['id_carrito'],
            ":fecha" => $_params['fecha'],
            ":total" => $_params['total']
        );

        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

    public function registrarDetalles($_params){
        $sql = "INSERT INTO `detalles`(`id_venta`, `id_producto`, `cantidad`, `precio`) 
        VALUES (:id_venta,:id_producto,:cantidad,:precio)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id_venta" => $_params['id_venta'],
            ":id_producto" => $_params['id_producto'],
            ":cantidad" => $_params['cantidad'],
            ":precio" => $_params['precio'],
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

}