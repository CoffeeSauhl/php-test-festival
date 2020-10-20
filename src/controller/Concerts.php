<?php

class Concerts {

    private $title;
    private $allScenes;
    private $concertsByScene;
    private $model;

    public function __construct() {

        $this->title = "Concerts";
        $this->model = new Model;
        $this->allScenes = $this->model->getAllScenes();
    }

    public function manage() {

        if (isset($_GET['scene']) && $_GET['scene'] != '') {
            
            $this->concertsByScene = $this->model->getConcertList($_GET['scene']);
        }

        if (isset($_POST['nbTickets']) && isset($_POST['concert']) && $_POST['nbTickets'] != '' && $_POST['concert'] != '') {
            $this->model->addToCart($_POST['nbTickets'], $_POST['concert']);
        }


        include (__DIR__ . './../view/view_concerts.php');
    }
}

?>