<?php
include_once("../utilidades/funciones.php");
include_once("../modelos/autos.clase.php");

class AutoControlador {

    public $objAuto;

    function __construct(){
        $this -> objAuto = new Autos();
    }

    function obtenerAutos(){
        header("content-type:application/json");
        echo json_encode($this->objAuto->obtenerAutos());
    }

    function obtenerAutoPorId($id){
        $this -> objAuto -> asignarValores($id, "", "", "", "", "");
        header("content-type:application/json");
        echo json_encode($this->objAuto->obtenerAutoPorId());
    }

    function insertarAuto($marca, $modelo, $color, $precio, $imagen){
        $this -> objAuto -> asignarValores("", $marca, $modelo, $color, $precio, $imagen);
        $this -> objAuto -> insertarAuto();
        header("location:../vistas/lista_de_autos.php");
    }
    
    function actualizarAuto($id, $marca, $modelo, $color, $precio, $imagen){
        $this -> objAuto -> asignarValores($id, $marca, $modelo, $color, $precio, $imagen);
        $this -> objAuto -> actualizarAuto();
        header("location:../vistas/lista_de_autos.php");
    }

    function eliminarAuto($id){
        try {
            $this -> objAuto -> asignarValores($id, "", "", "", "", "");
            $resultado = $this -> objAuto -> eliminarAuto();
            if ($resultado) {
                echo "ok";
            } else {
                echo "error";
            }
        } catch (Exception $e) {
            echo "error: " . $e->getMessage();
        }
    }
}

$objAutoControlador = new AutoControlador();
switch ($_POST['opcion']) {
    case 'obtenerAutos':
        $objAutoControlador -> obtenerAutos();
        break;
    case 'obtenerAutoPorId':
        $objAutoControlador -> obtenerAutoPorId($_POST['id']);
        break;
    case 'insertarAuto':
        $img = saveImg();
        $objAutoControlador -> insertarAuto($_POST["marca"], $_POST["modelo"], $_POST["color"], $_POST["precio"], $img);
        break;
    case 'actualizarAuto':
        $img = saveImg();
        $objAutoControlador -> actualizarAuto($_POST["id"], $_POST["marca"], $_POST["modelo"], $_POST["color"], $_POST["precio"], $img);
        break;
    case 'eliminarAuto':
        $objAutoControlador -> eliminarAuto($_POST['id']);
        break;
    default:
        break;
}
?>