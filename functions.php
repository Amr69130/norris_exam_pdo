<?php
// selectAllCars();
// selectCarByID();
// insertCar();
// updateCar();
// deleteCar();

function deleteCar()
{

}
;

function verifySession()
{
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }
}
;

?>