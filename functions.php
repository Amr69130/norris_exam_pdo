<?php
// selectAllCars();
// selectCarByID();
// insertCar();
// updateCar();
// deleteCar();

function deleteCar()
{

    $pdo = connectDB();
    $requestDelete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    $requestDelete->execute(
        [
            ":id" => $car['id']
        ]
    );
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