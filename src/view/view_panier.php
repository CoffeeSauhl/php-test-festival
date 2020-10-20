<?php

include ('header.php');


?>

<h1 class="title">Mon Panier</h1>

<?php if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][0]) ||
          !isset($_SESSION['cart'][0]['concertId']) || !isset($_SESSION['cart'][0]['nb'])) { ?>
          <div>Il n'y a rien dans votre panier</div>
<?php } else { 
        for ($i = 0; $i < count($_SESSION['cart']); $i++ ) {
            for ($n = 0; $n < count($this->concertList); $n++) {
                if ($_SESSION['cart'][$i]['concertId'] === $this->concertList[$n]['concert_id']) {?>
                    <div class="box container">
                        <div><?= $this->concertList[$n]['artistes_nom'] ?></div>
                        <div><?= $this->concertList[$n]['concert_horaire'] ?></div>
                        <div>Scène : <?= $this->concertList[$n]['scene_location'] ?></div>
                        <div>Nombre de tickets : <?= $_SESSION['cart'][$i]['nb'] ?></div>
                        <div>Total : <?= $_SESSION['cart'][$i]['nb'] * $this->concertList[$n]['concert_prix'] ?>€</div>
                    </div>
                <?php } } }  ?>
<div>
<a class="button" href="?page=panier&action=valider">Confirmer mes achats</a>
 Total des achats : <?= $this->prixTotal ?> €
</div>

<?php
}
include ('footer.php');

?>