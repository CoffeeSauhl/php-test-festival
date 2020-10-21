<?php


class ErrorService
{

    public function __construct()
    {
    }

public function logError($errno, $errstr, $errfile, $errline) {

    //logger l'erreur a l'endroit spécifié
    //peut être un fichier par jour
    //Peut être une analyse à faire des niveaux
    //standard : https://www.php-fig.org/psr/psr-3/

    $log = "<h2>Custom error: " . $errno . $errstr . "</h2><br /> 
            <div>Error on line " . $errline . " in " . $errfile . " le ". date("d-m-Y H:i:s") . "</div>";


    $filename = __DIR__ . '/../../log/' . date("d-m-Y") .'.log';
    file_put_contents($filename, $log);
}

}