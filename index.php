<?php session_start();

require ('src/controller/Home.php');
require ('src/controller/Login.php');
require ('src/controller/Concerts.php');
require ('src/controller/Panier.php');
require ('src/controller/Profil.php');
require ('src/controller/Add.php');
require ('src/model/Model.php');


$contents = file_get_contents(__DIR__ . '/src/config/env.json');
$obj = json_decode($contents);
$obj->env;

define('ENV', $obj->env);
echo ENV;
//if (ENV == "dev") {
//
//} else {
//
//}

//$page = filter_input(INPUT_GET, "page");
//var_dump($_SERVER);
$page = $_SERVER['REDIRECT_URL'];
var_dump($page);

$root = "/festival/";

$route = array(
    $root => Home::class,
    $root . "login" => Login::class,
    $root . "concerts" => Concerts::class,
    $root . "panier" => Panier::class,
    $root . "profil/([a-z]{3,15})" => Profil::class,
    $root . "add" => Add::class
);

//show(...$match);

foreach ($route as $routeValue => $className) {
    if (preg_match("#^" . $routeValue . "$#", $page, $match)) {

        array_shift($match);
        $controller = new $className;
        $controller->manage(); //show(...match()); quand ID a passer...
    break;
    }
}

if (!isset($controller)) {
    $controller = new Home();
    $controller-> manage();
}

//public function show(...$id) {
//
//}

?>