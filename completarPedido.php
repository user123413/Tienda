<?php

    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){  

        require 'funciones.php';
        require 'vendor/autoload.php';

        if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
           
            $cliente = new Kawschool\Cliente;
            
            $_params = array(        
        
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'email' => $_POST['email'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono']
            );
        
            $id_carrito = $cliente->registrar($_params);
        
            $pedido = new Kawschool\Pedido;
        
            $_params = array(
                'id_carrito'=>$id_carrito,
                'fecha' => date('Y-m-d H:i:s'),
                'total' => calcularTotal()
            );
        
            $id_venta = $pedido->registrar($_params);

            foreach($_SESSION['carrito'] as $indice => $value){
                $_params = array(
                    "id_venta" => $id_venta,
                    "id_producto" => $value['id'],
                    "cantidad" => $value['cantidad'],
                    "precio" => $value['precio']
                );

                $pedido->registrarDetalles($_params);
            }

            $_SESSION['carrito'] = array();

            header('Location: finish.php');

        }
    

    }


?>