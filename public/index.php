<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\BarberoController;
use Controllers\ServicioController;
use MVC\Router;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;

$router = new Router();

//Login
$router->get('/', [LoginController::class, 'login']);
$router->post("/", [LoginController::class,"login"]);
$router->get("/logout", [LoginController::class,"logout"]);

//Recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post("/olvide", [LoginController::class,"olvide"]);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post("/recuperar", [LoginController::class,"recuperar"]);

//Crear cuentas
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post("/crear-cuenta", [LoginController::class,"crear"]);
$router->get('/mensaje-creado', [LoginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

//AREA PRIVADA
$router->get('/cita', [CitaController::class,'index']);

//API CITAS
$router->get('/api/servicios', [APIController::class,"servicios"]);
$router->get('/api/barberos', [APIController::class,"barberos"]);
$router->post("/api/citas",[APIController::class,"guardarCita"]);
$router->post("/api/eliminarCita",[APIController::class,"eliminarCita"]);

//ADMIN
$router->get('/admin', [AdminController::class,'index']);

//CRUD servicios
$router->get('/servicios', [ServicioController::class,'index']);
$router->get('/servicios/crear', [ServicioController::class,'crear']);
$router->post('/servicios/crear', [ServicioController::class,'crear']);
$router->get('/servicios/actualizar', [ServicioController::class,'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class,'actualizar']);
$router->get('/servicios/eliminar', [ServicioController::class,'eliminar']);
$router->post('/servicios/eliminar', [ServicioController::class,'eliminar']);

//CRUD barberos
$router->get('/barberos', [BarberoController::class,'index']);
$router->get('/barberos/crear', [BarberoController::class,'crear']);
$router->post('/barberos/crear', [BarberoController::class,'crear']);
$router->get('/barberos/actualizar', [BarberoController::class,'actualizar']);
$router->post('/barberos/actualizar', [BarberoController::class,'actualizar']);
$router->get('/barberos/eliminar', [BarberoController::class,'eliminar']);
$router->post('/barberos/eliminar', [BarberoController::class,'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();