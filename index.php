<?php
include_once('header.php');
// require_once('connectDB.php');
require_once('functions.php');
require('connectDB.php');

$pdo = connectDB();
var_dump($pdo);

selectAllCars();
$cars = selectAllCars();


include_once('header.php'); ?>

<!-- <a href="login.php" class="btn btn-success">SE CONNECTER</a> -->


<div class="cars-container">
    <?php

    foreach ($cars as $car):

        ?>

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


                <?php


                ?>

            </ul>
        </div>
    <?php endforeach; ?>
</div>
<?php
include('footer.php')
    ?>