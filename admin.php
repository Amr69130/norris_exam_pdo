<?php

include_once('header.php');
require_once('connectDB.php');

require_once('functions.php');
verifySession();

$pdo = connectDB();
// var_dump($pdo);
selectAllCars();
$cars = selectAllCars();


?>
<div>
    <a href="add.php" class="btn btn-primary text-start m-3">Ajouter une voiture</a>
</div>


<div class="cars-container">
    <?php

    foreach ($cars as $car): ?>

        <div>
            <ul>

                <img src="images/<?php echo $car['image'] ?>" alt=" <?php echo $car["model"] ?>">
                <h2><?php echo $car['model'] ?></h2>
                <p><?php
                echo $car["brand"]
                    ?></p>
                <p> <?php
                echo $car["horsePower"]
                    ?>chevaux</p>
                <a href="update.php?id=<?= $car['id']; ?>" class="btn btn-info">Modifier</a>
                <a href="delete.php?id=<?= $car['id'];
                ?>" class="btn btn-warning">Supprimer</a>

                <?php


                ?>

            </ul>
        </div>
    <?php endforeach; ?>
</div>
<?php
include('footer.php')
    ?>