<?php
session_start();
// var_dump($_SESSION);
// $pdo = connectDB();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>LES VOITURES DE FIRMINY</title>
</head>

<body>

    <header>
        <?php
        //declaration en variable pour faciliter affichage des login/logout
        $btn_login = '<a href="login.php" class="btn btn-success">SE CONNECTER</a>';


        $btn_logout = '<a href="logout.php" class="btn btn-danger">SE DECONNECTER</a>';
        ?>
        <div class="text-end m-3">
            <?php
            if (isset($_SESSION["username"])) {
                $welcome = "<p class='fw-bold text-white' >Bienvenue " . ucwords(strtolower($_SESSION['username'])) . "</p>";
                echo $welcome . $btn_logout;
            } else {
                echo $btn_login;
            }
            ?>
        </div>
        <h1 class="text-center animated-gradient-text">LE GARAGE DE FIRMINY</h1>
    </header>