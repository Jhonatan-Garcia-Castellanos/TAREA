<?php

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'usuario/mostrarPerfil';
$urlParams = explode('/', filter_var($url, FILTER_SANITIZE_URL));

$nombreControlador = !empty($urlParams[0]) ? ucfirst($urlParams[0]) . 'Controller' : 'UsuarioController';
$metodo = !empty($urlParams[1]) ? $urlParams[1] : 'mostrarPerfil';


$archivoControlador = __DIR__ . "/../app/controllers/{$nombreControlador}.php";

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    if (class_exists($nombreControlador)) {
        $controlador = new $nombreControlador();

        if (method_exists($controlador, $metodo)) {
            $parametros = array_slice($urlParams, 2);
            call_user_func_array([$controlador, $metodo], $parametros);
        } else {
            echo "Error 404: El método '{$metodo}' no existe.";
        }
    } else {
        echo "Error 404: La clase '{$nombreControlador}' no existe.";
    }
} else {
    echo "Error 404: El archivo '{$nombreControlador}.php' no fue encontrado.";
}