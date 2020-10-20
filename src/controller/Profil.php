<?php

class Profil {

    private $title;
    private $model;
    private $ticketList;

    public function __construct() {
        $this->title = "Profil";
        $this->model = new Model;
        if (isset($_SESSION['id'])) {
            $this->ticketList = $this->model->getTicketList($_SESSION['id']);
        }
    }

    public function manage() {


        include (__DIR__ . './../view/view_profil.php');
    }
}
?>