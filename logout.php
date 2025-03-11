<?php
session_start();

//1ere façon de detruire session
// session_destroy();

//2eme façon

if (isset($_SESSION["username"])) {
    unset($_SESSION["username"]);
}

header("location: index.php")
    ?>