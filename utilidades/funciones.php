<?php

function generateLog($chain){
    $file = fopen("../log.txt", "a");
    fwrite($file, date("Y-m-d H:i:s") . " - " . $chain . "\n");
    fclose($file);
}

function saveImg(){
    if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] !== UPLOAD_ERR_OK) {
        return "";
    }
    
    $file = explode(".", $_FILES["imagen"]["name"]);
    $extension = $file[count($file)-1];
    $finalName = uniqid() . "." . $extension;
    $destination = "../publico/imagenes/";
    
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $destination . $finalName)) {
        return $finalName;
    } else {
        return "";
    }
}

?>