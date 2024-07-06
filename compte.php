<?php
session_start();
include 'config.php';

$email = ""; // Initialisation de la variable $email
$mdp = "";   // Initialisation de la variable $mdp

if (isset($_SESSION['nom'])) {
    if ($_SESSION['usertype'] == 'admin') {
        header("Location: administrateur.php");
    } else {
        header("Location: site.html");
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mdp = md5($_POST['mdp']); // Notez que l'utilisation de MD5 est obsolète pour le stockage sécurisé des mots de passe

    $sql = "SELECT * FROM users WHERE email='$email' AND mdp='$mdp'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $row['id'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['usertype'] = $row['usertype'];

        if ($row['usertype'] == 'admin') {
            header("Location: administrateur.php");
        } else {
            header("Location: site.html");
        }
    } else {
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="undefined" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="viewport" content="width device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Kaushan+Script&family=Reggae+One&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
</head>
<body>
    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>Be Healthy</h1>
                <p>Health is a relationship between you and your body</p>

            </section>

        </div>

        <div class="right">
            <form action="" method="POST" class="login-email">
                <section class="copy">
                    <h2>Se connecter à votre compte</h2>
                    <div class="login-container">
                        <p class="login-register-text">vous n'avez pas de compte?
                            <strong> <a href="register.php">créer un compte</a></strong>
                        </p>
                    </div>

                </section>
                <div class="input-container email">

                    <label for="email">Email</label>
                    <input name="email" type="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="input-container password">
                    <label for="password">Mot de passe</label>
                    <input name="mdp" type="password" value="<?php echo $mdp; ?>" required>
                    <i class="far fa-eye-slash"></i>
                </div>
                <div class="input-container cta">
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        Sign up for email updates.
                    </label>
                </div>
                <button name="submit" class="signup-btn" type="submit">
                    Se connecter
                </button>
            </form>
        </div>

    </div>

</body>
</html>
