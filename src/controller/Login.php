<?php


class Login {

    private $title;
    private $messErr;
    private $model;


    public function __construct() {

        $this->title = 'Login';
        $this->model = new Model;
    }

    public function manage() {

        if (isset($_POST['mail']) && isset($_POST['psw'])) {
            if (isset($_POST['nom'])) {
                if ($_POST['mail'] != '' && $_POST['psw'] != '' && $_POST['nom'] != '') {
                    if ($this->model->mailIsUnique($_POST['mail'])) {
                        $this->messErr = $this->model->signUp($_POST['mail'], $_POST['psw'], $_POST['nom']);
                        
                    } else {
                        $this->messErr = "Cet e-mail est déjà utilisé sur notre site";
                    }
                } else {
                    $this->messErr = "Merci de remplir tous les champs";
                }
            } elseif ($_POST['mail'] != "" && $_POST['psw'] != "" ) {
                $this->messErr = $this->model->signIn($_POST['mail'], $_POST['psw']);

            } else {
                $this->messErr = 'Tous les champs ne sont pas renseignés';
            }
        }

        if (isset($_GET['action']) && $_GET['action'] == 'deco') {
            $_SESSION['login'] = false;
            $_SESSION['email'] = "";
            $_SESSION['id'] = NULL;
            $_SESSION['admin'] = false;
            session_destroy();
        }


        include (__DIR__ . './../view/view_login.php');
    }
}

?>