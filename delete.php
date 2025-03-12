<?php

include_once('header.php');
require_once('functions.php');
verifySession();
//verif presence ID url
// var_dump($_GET['id']);


require('connectDB.php');

//Recup en bdd des données grâce à leur ID

$pdo = connectDB();
$requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
$requete->execute([
    'id' => $_GET['id']
]);

$car = $requete->fetch();
//verif  si resultat
// var_dump($car);
if ($car === false) {

    header('location: admin.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    // $requestDelete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    // $requestDelete->execute(
    //     [
    //         ":id" => $car['id']
    //     ]
    // );
    deleteCar();
    header('location: admin.php');
}

?>


<div class="cars-container">
    <p class="text-danger fw-bold">ATTENTION <?= ucwords(strtolower($_SESSION['username'])) ?>, êtes vous certain de
        vouloir supprimer le
        véhicule :
        <?= $car['brand'] . " " . $car['model'] ?> ?
    </p>
    <img src="images/<?php echo $car['image']; ?>" style="width: 200px; height: 200px;" alt="Car Image">






    <form method="POST" action="delete.php?id=<?= $_GET['id'] ?>">
        <button class="btn btn-danger">SUPPRIMER</button>
        <button class="btn btn-secondary" formaction="admin.php">ANNULER</button>
    </form>
</div>



<?php
include('footer.php');
?>