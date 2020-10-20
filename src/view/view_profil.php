<?php

include ('header.php');

if ($this->ticketList == false) {
?>
<div>Aucun ticket n'est enregistré.</div>
<?php } else { 
            for ($i = 0; $i < count($this->ticketList); $i++) {?>
                <div class="box">
                    <div><?= $this->ticketList[$i]['artistes_nom'] ?></div>
                    <div>Le <?= $this->model->convertDate($this->ticketList[$i]['concert_horaire']) ?></div>
                    <div>Scène <?= $this->ticketList[$i]['scene_location'] ?></div>
                    <div><?= $this->ticketList[$i]['billet_nb'] ?> tickets - <?= $this->ticketList[$i]['billet_nb'] * $this->ticketList[$i]['concert_prix'] ?>€</div>
                </div>
<?php } } ?>

<?php

include ('footer.php');

?>