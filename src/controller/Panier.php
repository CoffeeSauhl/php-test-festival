<?php

class Panier {

    private $title;
    private $model;
    private $concertList;
    private $prixTotal;

    public function __construct() {
        $this->title = 'Panier';
        $this->model = new Model;
        $this->concertList = $this->model->getAllConcerts();
        $this->prixTotal = 0;
    }

    public function manage() {
        if (isset($_SESSION['cart'])) {
            for ($i=0; $i<count($_SESSION['cart']); $i++ ) {
                $concert = $this->model->getConcertById($_SESSION['cart'][$i]['concertId']);
                $this->prixTotal += ($_SESSION['cart'][$i]['nb'] * $concert['concert_prix']);
            }
        }

        if (isset($_GET['action']) && $_GET['action'] === 'valider') {
            $this->model->updateConcerts($_SESSION['cart']);
        }

        include (__DIR__ . './../view/view_panier.php');
    }
}


?>