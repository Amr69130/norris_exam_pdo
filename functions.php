<?php



function selectAllCars()
{
    $pdo = connectDB();
    $requete = $pdo->prepare("SELECT * FROM car;");
    $requete->execute();
    $cars = $requete->fetchAll();
    return $cars;
}
;
function selectCarByID($carId)
{
    $pdo = connectDB();
    $requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
    $requete->execute([
        'id' => $carId
    ]);
    return $requete->fetch();
    ;
}
;
function insertCar($car, $imageUrl)
{

    $pdo = connectDB();
    $request = $pdo->prepare("INSERT INTO car (model, brand, horsePower, image) 
    VALUES (:model, :brand, :horsePower, :image)");
    $request->execute([
        ":model" => $car['model'],
        ":brand" => $car['brand'],
        ":horsePower" => $car['horsePower'],
        ":image" => $imageUrl,
    ]);
}
;
function updateCar($id, $car, $imageUrl)
{
    $pdo = connectDB();
    $request = $pdo->prepare("UPDATE car SET model = :model, brand = :brand, horsePower = :horsePower, image = :image WHERE id = :id;");
    $request->execute([
        ":model" => $car['model'],
        ":brand" => $car['brand'],
        ":horsePower" => $car['horsePower'],
        ":image" => $imageUrl,
        ":id" => $id
    ]);
}
;


function deleteCar($id)
{
    $pdo = connectDB();
    $requestDelete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    $requestDelete->execute(
        [
            ":id" => $id
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