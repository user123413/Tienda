<?php

namespace Kawschool;

class Cliente{

    private $config;
    private $cn = null;

    public function __construct(){
        $this -> config=parse_ini_file(__DIR__.'/../config.ini');
        
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function registrar($_params){
        $sql = "INSERT INTO `carrito`( `nombre`, `apellidos`, `email`, `direccion`, `telefono`)
        VALUES (:nombre,:apellidos,:email,:direccion,:telefono)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":apellidos" => $_params['apellidos'],
            ":email" => $_params['email'],
            ":direccion" => $_params['direccion'],
            ":telefono" => $_params['telefono']
        );

        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

}