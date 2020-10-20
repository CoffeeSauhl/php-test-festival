<?php
include ('header.php');
?>

<div class="divForm">
    <form class="form" action="?page=login" method="post">
    <div class="field">
        <label class="label" for="mail">E-mail : </label><br />
        <input class="input" type="text" name="mail" />
    </div>
    <div class="field">
        <label class="label" for="pws">Password : </label><br/>
        <input class="input" type="text" name="psw" />
    </div class="field">
<?php if(isset($_GET['action']) && $_GET['action'] == 'signup') { ?>
    <div class="field">
        <label class="label" for="nom">Prénom & Nom : </label><br />
        <input class="input" type="text" name="nom" />
    </div class="field">
<?php } ?>
    <input class="button" type="submit" />
    </form>
</div>


<?php
include ('footer.php');
?>