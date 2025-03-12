<?php
include_once('header.php');
require_once('functions.php');
verifySession();

// Récupérer les données de la voiture en fonction de l'ID
require('connectDB.php');
$pdo = connectDB();




$car = selectCarByID($_GET['id']);

if ($car === false) {
    header('Location: admin.php');
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des champs texte
    if (empty($_POST['brand'])) {
        $errors['brand'] = 'Le champ marque ne peut pas être vide.';
    }

    if (empty($_POST['model'])) {
        $errors['model'] = 'Le champ modèle ne peut pas être vide.';
    }

    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'Le champ nombre de chevaux ne peut pas être vide.';
    }

    // Vérification de l'image
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        // Si l'image n'est pas modifiée
        $imageUrl = $car['image'];  // L'image actuelle de la voiture reste inchangée
    } else {
        // Si une nouvelle image est téléchargée
        if ($_FILES['image']['size'] > 5000000) { // Limite à 5MB
            $errors['image'] = 'Le fichier est trop lourd (5MB max).';
        } else {
            $file_info = pathinfo($_FILES['image']['name']);
            $extension = strtolower($file_info['extension']);
            $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];

            if (!in_array($extension, $allowed_extensions)) {
                $errors['image'] = 'Seuls les fichiers JPG, JPEG, GIF et PNG sont acceptés.';
            } else {
                // Générer un nouveau nom unique pour l'image
                $imageUrl = uniqid() . '.' . $extension;
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageUrl);
                unlink("images/" . $car["image"]);  // Supprimer l'ancienne image si elle est modifiée
            }
        }
    }

    // Si pas d'erreurs, mettre à jour la voiture dans la base de données
    if (empty($errors)) {
        updateCar($_GET['id'], $_POST, $imageUrl);


        header("Location: admin.php");
        exit();
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container text-center">
    <h2 class="mb-4">Modifier une Voiture</h2>
    <form action="update.php?id=<?= $car['id'] ?>" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="brand" class="form-label">Marque</label>
            <input type="text" class="form-control" name="brand" id="brand" value="<?= $car['brand'] ?>"
                placeholder="Ex: Toyota">
            <?php if (isset($errors['brand'])): ?>
                <p class="text-danger"><?= $errors['brand'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Modèle</label>
            <input type="text" class="form-control" name="model" id="model" value="<?= $car['model'] ?>"
                placeholder="Ex: Corolla">
            <?php if (isset($errors['model'])): ?>
                <p class="text-danger"><?= $errors['model'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="horsePower" class="form-label">Nombre de chevaux</label>
            <input type="text" class="form-control" name="horsePower" id="horsePower" value="<?= $car['horsePower'] ?>"
                placeholder="Ex: 150">
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

            <img src="images/<?= $car['image'] ?>" alt="<?= $car['model'] ?>" class="mt-3" width="150">
        </div>

        <div class="mb-2">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>

    </form>
</div>

<?php include_once('footer.php'); ?>