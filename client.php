<?php
include("funciones.inc.php");
try{
    $opciones = array(
        'location'=>'http://localhost/ws_soap/server.php',
        'uri'=>'urn:departamento',
        'trace' => true
    );

    $cliente new SoapClient(null,$opciones);
    if(isset($_GET["idz"])){
        $idz = intval($_GET["idz"]);
        if($idz > 0){
            $respuestas = $client->obtenerDepartamentosPorZona($idz);
        }
    }else{
        $respuestas = $client->obtenerDepartamentos();
    }

    $arreglo = array();

    foreach($respuestas as $respuestas){
        $arreglo[]["departamento"] = array(
            "id" => $respuesta["id"],
            "nombre" => $respuesta["departamento"]
        );
    }
    $arr_head = getAllheaders();
    if($arr_head["Accept"] == "application/xml"){
        $documento = creaxml("departamento",$arreglo);
        echo($documento);
    }esleif($arr_head["Accept"] == "application/json"){
        header()
    }
}catch()

?>