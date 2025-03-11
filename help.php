<?php

function connectDB(): PDO
{
    $host = 'localhost';
    $dbName = 'garage12';
    $user = 'root';
    $password = '';
    try {
        $pdo = new PDO(
            'mysql:host=' . $host . ';dbname=' . $dbName . ';charset=utf8',
            $user,
            $password
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;

    } catch (Exception $e) {
        echo ("Erreur de connexion a la base de données. connectDB()");
        die();
    }
}
//$pdo représente la connexion à la BDD
$pdo = connectDB();

// ------ VERSION 1 requete sans paramètre avec query
//Préparer la requete pour récuperer toutes les voitures
$requete = $pdo->query("SELECT * FROM car;");
//Executer et récuperer les résultats
$cars = $requete->fetchAll();

var_dump($cars);
//Select ALL
// Version requete préparée sans parametre
$requete2 = $pdo->prepare("SELECT * FROM car;");
$requete2->execute();
$cars2 = $requete2->fetchAll();

//var_dump($cars2);

//Select by ID
// Démo fetch()
// Recherche d'une voiture par son ID ( je recevrais un seil ou 0 resultat )
$requeteFetch = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
$requeteFetch->execute(
    [
        ":id" => 1
    ]
);
$car = $requeteFetch->fetch();
var_dump("SELECT * FROM car WHERE id = :id;");
// Cas ou $car n'existe pas, fetch() a renvoyé FALSE
if ($car == false) {
    //je redirige, j'affiche une erreur
    var_dump("Aucune voiture trouvée avec cet ID");
} else {
    var_dump($car);
}

// Ajout d'une voiture en BDD
//Exemple INSERT INTO avec PDO
$request = $pdo->prepare("INSERT INTO car (model, brand, horsePower, image)
VALUES (:model, :brand, :horsePower, :image);");
$request->execute([
    ":model" => "Voiture inserée à la main en PHP",
    ":brand" => "Batman",
    ":horsePower" => "500",
    ":image" => "carrera.jpg"
]);
// Update d'une voiture en BDD
//Exemple UPDATE avec PDO
$request2 = $pdo->prepare("UPDATE car SET model = :model, brand = :brand, horsePower = :horsePower, image = :image  WHERE id = :id;");
$request2->execute([
    ":model" => "Model S",
    ":brand" => "Tesla",
    ":horsePower" => "500",
    ":image" => "modelS.jpg",
    ":id" => 1
]);
//On ne peut pas vérifier si l'insert / l'update a fonctionné grace au fetch ou autre

// Suppression d'une voiture en BDD
//Exemple DELETE avec PDO
$requestDelete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
$requestDelete->execute(
    [
        ":id" => 14
    ]
);
