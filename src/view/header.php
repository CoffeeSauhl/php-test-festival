

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src\public\css\style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    <meta name="google-site-verification" content="rFNj65ELNd3uvaaGCA2xWmy4VyTQQCHbjOJqcmE2sHs" />
    <title><?= $this->title ?></title>
</head>



<body>
    
    <header>
        <nav>
            <a class="button is-link" href=".">Home</a>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {?>
            <a class="button is-link" href="?page=add">Ajout Programmation</a>
        <?php } ?>


        <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {?>
            <a class="button is-link" href="/festival/concerts">Concerts</a>
            <a class="button is-link" href="/festival/profil/">Profil</a>
            <a class="button is-info" href="/festival/panier">
                <img src="src\public\img\shopping-cart.png" height="34px" width="34px"> 
                (<?php if (isset($_SESSION['cart'])) {echo count($_SESSION['cart']); } else {echo '0';} ?>) 
                
            </a>
            
            <a class="button is-danger" href="/festival/login?action=deco" rel="nofollow">Log Out</a>
        <?php } else {?>
            <a class="button is-primary" href="/festival/login" rel="nofollow">Sign in</a>
            <a class="button is-primary" href="/festival/login?action=signup" rel="nofollow">Sign up</a>
        <?php } ?>
            <a class="button is-warning" href="/festival/privacy">Privacy</a>
        </nav>
    </header>