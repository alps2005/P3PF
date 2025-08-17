<?php

include_once("../configuraciones/conexionBD.php");
include_once("../utilidades/funciones.php");

class Autos {
    private $id;
    private $marca;
    private $modelo;
    private $color;
    private $precio;
    private $imagen;
    private $conexion;

    function __construct(){
        global $nomHost, $puerto, $usuario, $pss, $nomBD;
        $this -> conexion = new mysqli($nomHost, $usuario, $pss, $nomBD, $puerto);
    }

    function __destruct(){
        $this -> conexion -> close();
    }

    function asignarValores($id, $marca, $modelo, $color, $precio, $imagen){
        $this -> id = $id;
        $this -> marca = $marca;
        $this -> modelo = $modelo;
        $this -> color = $color;
        $this -> precio = $precio;
        $this -> imagen = $imagen;
    }

    function obtenerAutos(){
        $sentencia = "SELECT * FROM autos";
        $resultado = $this -> conexion -> query($sentencia);
        $arr = [];
        if ($resultado -> num_rows > 0 ){
            while ($fila = $resultado -> fetch_assoc()) {
                $arr[] = $fila;
            }
        }
        return $arr;
    }

    function obtenerAutoPorId(){
        $sentencia = "SELECT * FROM autos WHERE id = {$this->id}";
        $resultado = $this -> conexion -> query($sentencia);
        $arr = [];
        if ($resultado -> num_rows > 0 ){
            $arr = $resultado -> fetch_assoc();
        }
        return $arr;
    }
    
    function insertarAuto() {
        try {
            $sentencia = "INSERT INTO `autos`(`marca`, `modelo`, `color`, `precio`, `imagen`) VALUES ('{$this->marca}','{$this->modelo}','{$this->color}', '{$this->precio}', '{$this->imagen}')";
            $resultado = $this -> conexion -> query($sentencia);
            return $resultado;
        } catch (Exception $err) {
            generateLog($err -> getMessage());
            return false;
        }
    }

    function actualizarAuto() {
        try {
            $sentencia = "UPDATE autos SET marca='{$this->marca}', modelo='{$this->modelo}', color='{$this->color}', precio='{$this->precio}', imagen='{$this->imagen}'  WHERE id={$this->id}";
            $resultado = $this -> conexion -> query($sentencia);
            return $resultado;
        } catch (Exception $err) {
            generateLog($err -> getMessage());
            return false;
        }
    }

    function eliminarAuto(){
        try {
            $sentencia = "DELETE FROM autos WHERE id = '{$this->id}'";
            $resultado = $this -> conexion -> query($sentencia);
            return $resultado;
        } catch (Exception $err) {
            generateLog($err -> getMessage());
            return false;
        }
    }
}
?>