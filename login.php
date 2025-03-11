<?php
require('connectDB.php');
$pdo = connectDB();
session_start();

if (isset($_SESSION["username"])) {
    header("location: admin.php");
}
;
// var_dump($_SESSION);
// $pass = password_hash("admin", PASSWORD_DEFAULT);
// var_dump($pass)
?>

<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    if (empty($_POST['username'])) {
        $errors['username'] = 'Le champ username ne peut pas être vide.';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Le champ password de chevaux ne peut pas être vide.';
    }




    if (empty($errors)) {
        $request = $pdo->prepare("SELECT * FROM User WHERE username = :username");
        $request->execute([
            ":username" => $_POST['username'],
        ]);

        $user = $request->fetch();
        //verif  si resultat
        // var_dump($user);
        if ($user === false) {
            echo ('USER OU MDP INEXISTANT !! ');
        } else {
            if (password_verify($_POST["password"], $user["password"]) === false) {

                echo ('USER OU MDP INEXISTANT !! ');
            } else {
                // echo ('ok connecté');


                $_SESSION["username"] = $user["username"];
                header('Location: admin.php');
            }
        }



    }

}
?>

<form method="POST" action="login.php">
    <label>Username</label>
    <input required type="text" name="username">
    <label>Password</label>
    <input required type="password" name="password">
    <button class="btn btn-outline-succes">Se connecter</button>
</form>