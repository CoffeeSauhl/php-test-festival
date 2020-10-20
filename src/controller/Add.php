<?php

class Add {

    private $title;
    private $model;
    private $scenesList;
    private $artistesList;
    private $messErr;

    public function __construct() {
        $this->title = 'Add Back Office';
        $this->model = new Model;
        $this->scenesList = $this->model->getAllScenes();
        $this->artistesList = $this->model->getAllArtistes();
    }

    public function manage() {

        if (isset($_GET['add']) && $_GET['add'] == 'scene') {
            if (isset($_POST['sc_location']) && $_POST['sc_location'] != "") {
                $this->messErr = $this->model->addScene($_POST['sc_location']);

            } else {
                $this->messErr = "Ne laissez pas le champ vide";
            }
        } elseif (isset($_GET['add']) && $_GET['add'] == 'artiste') {
            if (isset($_POST['ar_nom']) && isset($_POST['ar_genre']) && isset($_POST['ar_img']) &&
                $_POST['ar_nom'] != "" && $_POST['ar_genre'] != "" && $_POST['ar_img'] != "") {
                    $this->messErr = $this->model->addArtiste($_POST['ar_nom'], $_POST['ar_genre'], $_POST['ar_img']);
                } else {
                    $this->messErr = "Ne laissez pas de champ vide";
                }
        } elseif (isset($_GET['add']) && $_GET['add'] == 'concert') {
            if (isset($_POST['co_artiste']) && isset($_POST['co_scene']) && isset($_POST['co_date'])
                && isset($_POST['co_heure']) && isset($_POST['co_places']) && isset($_POST['co_prix'])) {
                    $this->messErr = $this->model->addConcert($_POST);
                    var_dump($this->messErr);
                }
        }
        include (__DIR__ . './../view/view_add.php');
    }
}


?>