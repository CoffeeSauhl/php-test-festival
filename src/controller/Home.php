<?php


class Home {

    private $title;


    public function __construct() {

        $this->title = 'Home';
    }

    public function manage () {




        include (__DIR__ . './../view/view_home.php');
    }
}

?>