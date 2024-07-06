<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['nom'])) {
    header("Location: compte.php");
}

if (isset($_POST['submit'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp = md5($_POST['mdp']);
	$cmdp = md5($_POST['cmdp']);
    
	if ($mdp == $cmdp) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (nom, prenom, email, mdp )
					VALUES ('$nom', '$prenom', '$email', '$mdp' )";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$nom = "";
				$prenom = "";
				$email = "";
				$_POST['mdp'] = "";
				$_POST['cmdp'] = "";
               
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}

	} else {
		echo "<script>alert('Password Not Matched.')</script>";
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
    <title>S'inscrire</title>
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
					<form action="" method="POST">
            <form>
					  <section class="copy">
                    <h2>Créez votre compte</h2>
                    <div class="login-container">
                        <p class="login-register-text">Already have an account? <a href="compte.php">
                                <strong>Log in</strong>
                            </a>
                        </p>

                    </div>

                </section>

                
                <div class="input-container prenom">
                  <label for="prenom">Prenom</label>
                  <input name="prenom" type="text" value="<?php echo $prenom; ?>" required>
              </div>
              <div class="input-container nom">

                <label for="fname">Nom</label>
                <input name="nom" type="text" value="<?php echo $nom; ?>" required>
            </div>
                <div class="input-container email">
                    <label for="email">Email</label>
                    <input name="email" type="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="input-container password">
                    <label for="password">Mot de passe</label>
                    <input  name="mdp" type="password" value="<?php echo $mdp; ?>" required>
                    <i class="far fa-eye-slash"></i>
                </div>
								<div class="input-container password">
                    <label for="password">Confirmer mot de passe</label>
                    <input  name="cmdp"  type="password" value="<?php echo $cmdp; ?>" required>
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
                    Sign up
                </button>
							</form>

            </form>

        </div>

    </div>

</body>
</html>
