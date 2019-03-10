<?php 


// Determina o Tipo de Protocolo:
$protocolo      = isset($_SERVER["HTTPS"]) ? 'https' : 'http'; // Pode ser 'http' ou 'https'	

// Caminho Padrão do Servidor
$default_path    = $protocolo . "://" . $_SERVER['SERVER_NAME'] . "/prova_unilavras/";

$default_app    = $default_path ."sistema/";
$default_admin  = $default_path ."admin/";

// Pasta ADMIN (Painel)
$assets_admin = $default_admin . "assets/";


// Pasta APP (Site)
$assets_app         = $default_app . "assets/";
    $assets_app_images  = $assets_app . "images/";
    $assets_app_css     = $assets_app . "css/";
    $assets_app_js      = $assets_app . "js/";
    $assets_app_libs    = $assets_app . "libs/";

// Array app
$app = array(
    'default'=>$default_app,
    "root" => $default_path,
    "assets" => $assets_app,
    "css" => $assets_app_css,
    "js" => $assets_app_js,
    'libs' => $assets_app_libs
);

// Array painel
$admin = array(
    "root" => $default_path,
    "assets" => $assets_admin,
    "libs" => $assets_app_libs
);