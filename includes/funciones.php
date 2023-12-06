<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Valida si hay una sesion iniciada para redirigir al panel de citas o admin
function isAuth(): void{
    if(!isset($_SESSION["login"])){
        header("Location: /");
    }
}

//Valida si no hay una sesion iniciada para redirigir al login
function isAdmin(): void {
    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1){
        header("Location: /cita");
    }
}

//Valida si hay una sesion iniciada para redirigir a los paneles
function isLogged(): void{
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
        if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
            header('Location: /admin');
        }else{
            header('Location: /cita');
        }
    }
}