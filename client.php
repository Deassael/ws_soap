<?php
include("funciones.inc.php");
try{
    $opciones = array(
        'location'=>'http://localhost/ws_soap/server.php',
        'uri'=>'urn:departamento',
        'trace' => true
    );

    $client = new SoapClient(null,$opciones);
    if(isset($_GET["idz"])){
        $idz = intval($_GET["idz"]);
        if($idz > 0){
            $respuestas = $client->obtenerDepartamentosPorZona($idz);
        }
    }else{
        $respuestas = $client->obtenerDepartamentos();
    }

    $arreglo = array();

    foreach($respuestas as $respuesta){
        $arreglo[]["departamento"] = array(
            "id" => $respuesta["id"],
            "nombre" => $respuesta["departamento"]
        );
    }
    $arr_headers = getAllheaders();
    if($arr_headers["Accept"] == "Application/xml"){
        $documento = creaxml("departamento",$arreglo);
        header("Content-type: Application/xml");
        echo($documento);
    }elseif($arr_headers["Accept"] == "Application/json"){
        header("Content-type: Application/json");
        echo(json_encode($respuesta));
    }else{
        echo("ESPECIFIQUE EL FORMATO DE DATOS QUE USTED ESPERA");
    }
}catch(Exception $e){
    echo('Error:' .$e->getMessage());
}
?>