<?php
include_once('header.php');
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}



$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (empty($_POST['brand'])) {
        $errors['brand'] = 'Le champ marque ne peut pas être vide.';
    }

    if (empty($_POST['model'])) {
        $errors['model'] = 'Le champ model ne peut pas être vide.';
    }
    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'Le champ nombre de chevaux ne peut pas être vide.';
    }
    if (empty($_POST['image'])) {
        $errors['image'] = 'Le champ image ne peut pas être vide.';
    }

    if (empty($errors)) {
        require('connectDB.php');
        $pdo = connectDB();

        $request = $pdo->prepare("INSERT INTO car (model, brand, horsePower, image)
            VALUES (:model, :brand, :horsePower, :image);");
        var_dump($_POST);
        $request->execute([
            ":model" => $_POST['model'],
            ":brand" => $_POST['brand'],
            ":horsePower" => $_POST['horsePower'],
            ":image" => $_POST['image'],
        ]);

        header("location: admin.php");
    }

}
?>

<?php

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container text-center">
    <h2 class="mb-4">Ajouter une Voiture</h2>
    <form action="add.php" method="POST">


        <div class="mb-3">
            <label for="brand" class="form-label">Marque</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="Ex: Toyota">
            <?php if (isset($errors['brand'])): ?>
                <p class="text-danger"><?= $errors['brand'] ?></p>
                <?php
            endif;
            // var_dump($errors['brand']);
            ?>
        </div>



        <div class="mb-3">
            <label for="model" class="form-label">Modèle</label>
            <input type="text" class="form-control" name="model" id="model" placeholder="Ex: Corolla">
            <?php if (isset($errors['model'])): ?>
                <p class="text-danger"><?= $errors['model'] ?></p>
                <?php
            endif;
            // var_dump($errors['model']);
            ?>
        </div>
        <div class="mb-3">
            <label for="horsePower" class="form-label">Nombre de chevaux</label>
            <input type="text" class="form-control" name="horsePower" id="horsePower" placeholder="Ex: 150">
            <?php if (isset($errors['horsePower'])): ?>
                <p class="text-danger"><?= $errors['horsePower'] ?></p>
                <?php
            endif;
            // var_dump($errors['horsePower']);
            ?>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image du véhicule</label>
            <input type="text" class="form-control" name="image" id="image" placeholder="">
            <?php if (isset($errors['image'])): ?>
                <p class="text-danger"><?= $errors['image'] ?></p>
                <?php
            endif;
            // var_dump($errors['image']);
            ?>
        </div>
        <div class="mb-2">

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
<?php
include_once('footer.php');
?>