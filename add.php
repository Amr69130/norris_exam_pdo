<?php
include_once('header.php');
require_once('functions.php');
verifySession();


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('connectDB.php');
    $pdo = connectDB();


    if (empty($_POST['brand'])) {
        $errors['brand'] = 'Le champ marque ne peut pas être vide.';
    }

    if (empty($_POST['model'])) {
        $errors['model'] = 'Le champ modèle ne peut pas être vide.';
    }

    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'Le champ nombre de chevaux ne peut pas être vide.';
    }


    if (empty($_FILES['image']['name'])) {
        $errors['image'] = 'Le champ image ne peut pas être vide.';
    } else {
        if ($_FILES['image']['error'] !== 0) {
            $errors['image'] = 'Une erreur est survenue lors de l\'upload de l\'image.';
        } elseif ($_FILES['image']['size'] > 5000000) {
            $errors['image'] = 'Le fichier est trop lourd (5MB max).';
        } else {

            $file_info = pathinfo($_FILES['image']['name']);
            $extension = strtolower($file_info['extension']);
            $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];

            if (!in_array($extension, $allowed_extensions)) {
                $errors['image'] = 'Seuls les fichiers JPG, JPEG, GIF et PNG sont acceptés.';
            }
        }
    }


    if (empty($errors)) {

        $imageUrl = uniqid() . '.' . $extension;
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageUrl);



        insertCar($_POST, $imageUrl);

        header("Location: admin.php");
        // exit();
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container text-center">
    <h2 class="mb-4">Ajouter une Voiture</h2>
    <form action="add.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="brand" class="form-label">Marque</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="Ex: Toyota">
            <?php if (isset($errors['brand'])): ?>
                <p class="text-danger"><?= $errors['brand'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Modèle</label>
            <input type="text" class="form-control" name="model" id="model" placeholder="Ex: Corolla">
            <?php if (isset($errors['model'])): ?>
                <p class="text-danger"><?= $errors['model'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="horsePower" class="form-label">Nombre de chevaux</label>
            <input type="text" class="form-control" name="horsePower" id="horsePower" placeholder="Ex: 150">
            <?php if (isset($errors['horsePower'])): ?>
                <p class="text-danger"><?= $errors['horsePower'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image du véhicule</label>
            <input type="file" class="form-control" name="image" id="image">
            <?php if (isset($errors['image'])): ?>
                <p class="text-danger"><?= $errors['image'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-2">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>

<?php include_once('footer.php'); ?>