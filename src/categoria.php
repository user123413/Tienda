<?php

namespace Kawschool;

class Categoria{

    private $config;
    private $cn = null;

    public function __construct(){
        $this -> config=parse_ini_file(__DIR__.'/../config.ini');
        
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function mostrar(){
        $sql = "SELECT * FROM `categoria`";
        
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function registrarC($_params){
        $sql = "INSERT INTO `categoria`( `nomCategoria`) 
        VALUES (:nomCategoria)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nomCategoria" => $_params['nomCategoria'],
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function actualizarC($_params){
        $sql = "UPDATE `categoria` SET `nomCategoria`=:nomCategoria WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nomCategoria" => $_params['nomCategoria'],
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function mostrarCPorId($id){
        
        $sql = "SELECT * FROM `categoria` WHERE `id`=:id ";
        
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" =>  $id
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }

    public function eliminarC($id){
        $sql = "DELETE FROM `categoria` WHERE `id`=:id ";

        $resultado = $this->cn->prepare($sql);
        
        $_array = array(
            ":id" =>  $id
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }
}