<?php

include ('header.php');


?>

<div class="container level">
    <a class="button level-item" href="?page=add&add=scene">+ Scene</a>
    <a class="button level-item" href="?page=add&add=artiste">+ Artiste</a>
    <a class="button level-item" href="?page=add&add=concert">+ Concert</a>
</div>

<?php if (isset($_GET['add']) && $_GET['add'] == 'scene') {?>
    <div class="container box">
        <form class="form" action="?page=add&add=scene" method="post">
            <div class="field">
                <label class="label" for="sc_location">Position de la scène : </label> <br />
                <input class="input" type="text" name="sc_location" />
            </div>
            <input class="button" type="submit">
        </form>
    </div>
<?php } elseif (isset($_GET['add']) && $_GET['add'] == 'artiste') {?>
    <div class="container box">
        <form action="?page=add&add=artiste" method="post">
            <div class="field">
                <label class="label" for="ar_nom">Nom de l'artiste/groupe : </label> <br />
                <input class="input" type="text" name="ar_nom" />
            </div>
            <div class="field">
                <label class="label" for="ar_genre">Genre : </label> <br />
                <input class="input" type="text" name="ar_genre" />
            </div>
            <div class="field">
                <label class="label" for="ar_img">Affiche : </label> <br />
                <input class="input" type="text" name="ar_img" />
            </div>
            <input class="button" type="submit">
        </form>
    </div>
<?php } elseif (isset($_GET['add']) && $_GET['add'] == 'concert') {?>
    <div class="container box">
        <form action="?page=add&add=concert" method="post">
            <div class="field">
                <label class="label" for="co_artiste">Artiste : </label> <br />
                <select name="co_artiste" id="co_artiste">
                <?php for ($i = 0; $i < count($this->artistesList); $i ++) {?>
                    <option value="<?= $this->artistesList[$i]['artistes_id'] ?>"><?= $this->artistesList[$i]['artistes_nom'] ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="field">
            <label class="label" for="co_scene">Scene : </label> <br />
                <select name="co_scene" id="co_scene">
                <?php for ($i = 0; $i < count($this->scenesList); $i ++) {?>
                    <option value="<?= $this->scenesList[$i]['scene_id'] ?>"><?= $this->scenesList[$i]['scene_location'] ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="field">
                <label class="label" for="co_date">Horaire du concert : </label> <br />
                <div class="columns">    
                    <input class="input column-is-left" type="date" name="co_date" />
                    <input class="input column-is-right" type="time" name="co_heure" />
                </div>
            </div>
            <div class="field">
                <label class="label" for="co_places">Places : </label> <br />
                <input class="input" type="number" name="co_places" />
            </div>
            <div class="field">
                <label class="label" for="co_prix">Prix : </label> <br />
                <input class="input" type="text" name="co_prix" />
            </div>
            <input class="button" type="submit">
        </form>
    </div>

<?php
}
include ('footer.php');

?>