<?php

class Model {

    private $bdd;

    public function __construct() {

        $config = file_get_contents(__DIR__ . '/../config/' . ENV . '/database.json');
        $obj = json_decode($config);


        $host = 'localhost';
        $user = 'root';
        $pswrd = '';
        $dbName = 'festival';

        /**
        * always data connexion 
        * $host = 'mysql-coffeesauhl.alwaysdata.net';
        * $user = 'coffeesauhl';
        * $pswrd = '789guizmo456seb!';
        * $dbName = 'festival';
         */

        try {
            $this->bdd = new PDO ($obj->dsn, $obj->user, $obj->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//            $this->bdd = new PDO ("mysql:host=$host; dbname=$dbName; charset=utf8",
//                                    $user, $pswrd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {

            var_dump('Echec lors de la tentative de connexion : ' . $e->getMessage());
        }
    }

    public function mailIsUnique($mail) {
        try {
            $request = $this->bdd->prepare('SELECT * FROM users WHERE users_email = ?');
            $request->execute(array($mail));
            $verif = $request->fetch();
            if ($verif === false) {
                return true;
            } else {
                return false;
            } 
        } catch (Exception $e) {
            echo '<div>Erreur lors de la vérification du mail</div>';
        }
    }

    public function signUp($mail, $psw, $name) {

        try {
            $psw = password_hash($psw, PASSWORD_DEFAULT);
            $request = $this->bdd->prepare('INSERT INTO users (users_name, users_email, users_psw) VALUES (?, ?, ?)');
            $request->execute(array($name , $mail, $psw));
            $_SESSION['login'] = true;
            $_SESSION['email'] = $mail;

            $connec = $this->bdd->prepare('SELECT * FROM users WHERE users_email = ?');
            $connec->execute(array($mail));
            $connec = $request->fetch();
            
            $_SESSION['id'] = $connec['users_id'];
            if ($connec['users_admin'] == 1) {
                $_SESSION['admin'] = true;
            }

            return 'success sign up';
        } catch (Exception $e) {

            return 'Erreur lors de la création du compte';
        }
    }

    public function signIn($email, $psw) {
        try{
            $request = $this->bdd->prepare('SELECT * FROM users WHERE users_email = ?');
            $request->execute(array($email));
            $connec = $request->fetch();

            if (!$connec) {
                return "L'email est erroné";
            } elseif (password_verify($psw, $connec["users_psw"])) {
                $_SESSION['login'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $connec['users_id'];
                if ($connec['users_admin'] == 1) {
                    $_SESSION['admin'] = true;
                }
            } else {
                return "Le mot de passe est erroné";
            } 
        } catch (Exception $e) {

            return 'Erreur lors de la connexion';
        }
    }

    public function getAllScenes() {
        try{
            $request = $this->bdd->prepare('SELECT * FROM scenes');
            $request->execute();
            return $request->fetchAll();
        } catch (Exception $e) {

            echo 'Erreur lors de la connexion à la BDD';
        }
    }

    public function getConcertList($scene) {
        try {
            $request = $this->bdd->prepare('SELECT * FROM concerts 
                                            LEFT JOIN scenes ON concerts.id_scene = scenes.scene_id
                                            LEFT JOIN artistes ON concerts.id_artistes = artistes.artistes_id
                                            WHERE scene_id = ?');
            $request->execute(array($scene));
            return $request->fetchAll();

        }catch (Exception $e) {

            echo 'Erreur lors de la connexion à la BDD';
        }
    }

    public function convertDate($date) {
        $newDate = date("d/m/Y à H:i", strtotime($date));
        return($newDate);
    }

    public function addToCart($nb, $concertId) {
        $index = 0;
        if (isset($_SESSION['cart'])) {
            $index = count($_SESSION['cart']);
        }
        $_SESSION['cart'][$index]['concertId'] = $concertId;
        $_SESSION['cart'][$index]['nb'] = $nb;
    }

    public function getAllConcerts() {
        try {
            $request = $this->bdd->prepare('SELECT * FROM concerts
                                            LEFT JOIN scenes ON concerts.id_scene = scenes.scene_id
                                            LEFT JOIN artistes ON concerts.id_artistes = artistes.artistes_id ');
            $request->execute();
            return $request->fetchAll();
            
        } catch (Exception $e) {

            echo 'Erreur lors de la connexion à la BDD';
        }
    }

    public function updateConcerts($tickets) {
        try {
            for ($i=0; $i<count($tickets); $i++) {
                $request = $this->bdd->prepare('INSERT INTO billets (id_users, id_concert, billet_nb) VALUES (?, ?, ?)');
                $request->execute(array($_SESSION['id'], $tickets[$i]['concertId'], $tickets[$i]['nb']));


                $request = $this->bdd->prepare('UPDATE concerts SET concert_places = concert_places - ? WHERE concert_id = ? ');
                $request->execute(array($tickets[$i]['nb'], $tickets[$i]['concertId']));

                unset($_SESSION['cart']);
            }
        } catch (Exception $e) {

            echo 'Erreur lors de la connexion à la BDD';
        }
    }

    public function getTicketList($id) {
        try {
            $request = $this->bdd->prepare('SELECT * FROM billets
                                            LEFT JOIN users ON billets.id_users = users.users_id
                                            LEFT JOIN concerts ON billets.id_concert = concerts.concert_id
                                            LEFT JOIN artistes ON concerts.id_artistes = artistes.artistes_id
                                            LEFT JOIN scenes ON concerts.id_scene = scenes.scene_id
                                            WHERE users_id = ?');
            $request->execute(array($id));
            return $request->fetchAll();

        } catch (Exception $e) {

            echo 'Erreur lors de la récupération des données';
        }
    }

    public function getAllArtistes() {
        try {
            $request = $this->bdd->prepare('SELECT * FROM artistes');
            $request->execute();
            return $request->fetchAll();
            
        } catch (Exception $e) {

            echo 'Erreur lors de la récupération des données';
        }
    }

    public function addScene($location) {
        try {
            $request = $this->bdd->prepare('INSERT INTO scenes (scene_location) VALUES (?)');
            $request->execute(array($location));
            return 'success add scene';
        } catch (Exception $e) {
            return 'Erreur lors de l\'ajout d\'une scene';
        }
    }

    public function addArtiste($nom, $genre, $img) {
        try {
            $request = $this->bdd->prepare('INSERT INTO artistes (artistes_nom,
                                                                  artistes_genre,
                                                                  artistes_img) VALUES (?, ?, ?)');
            $request->execute(array($nom, $genre, $img));
            return 'success add artiste/groupe';
        } catch (Exception $e) {
            return 'Erreur lors de l\'ajout d\'un(e) artiste/groupe';
        }catch (Exception $e) {
            return 'Erreur lors de l\'ajout d\'un(e) artiste/groupe';
        }
    }

    public function addConcert($co_tab) {
        $datetime = $co_tab['co_date'] . ' ' . $co_tab['co_heure'] . ':00';
        var_dump($datetime);
        try {
            $request = $this->bdd->prepare('INSERT INTO concerts (id_artistes,
                                                                 id_scene,
                                                                 concert_horaire,
                                                                 concert_places,
                                                                 concert_prix) VALUES (?, ?, ?, ?, ?)');
            $request->execute(array($co_tab['co_artiste'],
                                    $co_tab['co_scene'], 
                                    $datetime, 
                                    $co_tab['co_places'], 
                                    $co_tab['co_prix']));
            return 'success add concert';

        } catch (Exception $e) {
            var_dump($e);
            return 'Erreur lors de l\'ajout d\'un concert';
        }
    }

    public function getConcertById($id) {
        try {
            $request = $this->bdd->prepare('SELECT * FROM concerts WHERE concert_id = ?');
            $request->execute(array($id));
            return $request->fetch();
        } catch (Exception $e) {
            var_dump($e);
            return 'Erreur lors de l\'accès à la BDD';
        }
    }

}


?>