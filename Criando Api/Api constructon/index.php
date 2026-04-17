<?php

// impots
//require_once "security/controllerAuth.php";
require_once "database/connect.php";
require_once "Facade.php";



$clientRequest = json_decode(file_get_contents("php://input"), true);


$bundle = $clientRequest;

new Facade($bundle);


    //$clientResponse = [
    //    "codigo" => '1',
    //    "mensagem" => "Logado com sucesso!",
    //    "user_img" => "https://file.cbsys.digital/media/images/profile/db7fbdb7f82cab930a650e7445608d2b.png",
    //    "user_name" => "LUIZ FONSECA",
    //    "user_token" => "db7fbdb7f82cab930a650e7445608d2b"
    //];
    