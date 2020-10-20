<?php

include ('header.php');


?>
<div class="container level">
    <?php for ($i = 0; $i < count($this->allScenes); $i++) { ?>
        <a class="button level-item" href="?page=concerts&scene=<?= $this->allScenes[$i]['scene_id'] ?>">
            Scène <?= $this->allScenes[$i]['scene_location'] ?>
        </a>
    <?php } ?>
</div> 
<?php
if (isset($_GET['scene']) && $_GET['scene'] != '') {
    for ($n = 0; $n < count($this->concertsByScene); $n++) {
        if ($this->concertsByScene[$n]['concert_places'] > 0) {
?>
    <div class="box container">
        <div><strong><?= $this->concertsByScene[$n]['artistes_nom'] ?></strong></div>
        <div>Le <?= $this->model->convertDate($this->concertsByScene[$n]['concert_horaire']) ?> </div>
        <div>Prix : <?= $this->concertsByScene[$n]['concert_prix'] ?>€</div>
        <div>Places restante : <?= $this->concertsByScene[$n]['concert_places'] ?></div>
        <form class="form" action="?page=concerts&scene=<?= $_GET['scene'] ?>" method="post">
            <input class="input" type="number" min="0" max="<?= $this->concertsByScene[$n]['concert_places'] ?>" name="nbTickets" placeholder="Nombre de tickets" />
            <input type="hidden" name="concert" value="<?= $this->concertsByScene[$n]['concert_id'] ?>" />
            <input class="button" type="submit" value="Ajouter">
        </form>
    </div>
        <?php } else { ?>
    <div class="box container">
            <div>
            Le concert de <?= $this->concertsByScene[$n]['artistes_nom'] ?> le <?= $this->model->convertDate($this->concertsByScene[$n]['concert_horaire']) ?>
            est complet. Nous vous invitons à profiter du rest du festival.
            </div>
    </div>

<?php } } }?>


<?php
var_dump($this->concertsByScene);
include ('footer.php');

?>