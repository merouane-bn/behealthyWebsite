<?php
session_start();
include 'config.php';
$id = $_SESSION['id'];

// Fetch user data including the creation date
$sql_user = "SELECT * FROM users WHERE id = $id";
$res_user = $conn->query($sql_user);

if ($res_user == false) {
    echo "Requête incorrecte";
} else {
    $user = $res_user->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <style type="text/css">
        .wrapper {
            width: 0 auto;
            margin: 0 auto;
            background-color: transparent;
            color: white;
        }
    </style>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body style="background-color: #009688">
<header style="background-color: white; ">
    <p style="font-family: 'Open Sans', sans-serif; font-size: 3.4em;"><a href="site.html"><span style="color:#009688;">Be</span>Healthy</a></p>
</header>

<div class="container">
    <div class="wrapper">
        <h2 style="text-align: center; color: black;font-family: 'Open Sans', sans-serif; font-size: 2.4em;">Mon profil</h2>
        <div ><b></b></div>
        <form action="edit.php" method="POST">
            <b>
            <table class="table">
                <tr>
                    <td><label>Numéro :</label></td>
                    <td><input type="text" name="id" value="<?php echo $_SESSION['id']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>Prénom :</label></td>
                    <td><input type="text" name="prenom" value="<?php echo isset($user['prenom']) ? $user['prenom'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Nom :</label></td>
                    <td><input type="text" name="nom" value="<?php echo isset($user['nom']) ? $user['nom'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Email :</label></td>
                    <td><input type="text" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>Date création du compte :</label></td>
                    <td><input type="text" name="date_creation" value="<?php echo isset($user['date_creation']) ? $user['date_creation'] : ''; ?>" readonly></td>
                </tr>
            </table>
            <input type="submit" name="bt" value="Modifier" class="btn btn-warning">
            </b><br><br>
            <div >
                <h2 style="text-align: center; color: black;font-family: 'Open Sans', sans-serif; font-size: 2.4em;">Votre historique :</h2>
                <b></b>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Age</th>
                        <th>Taille</th>
                        <th>Poids</th>
                        <th>BMR</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_fit = "SELECT * FROM fit WHERE id_user = $id";
                    $res_fit = $conn->query($sql_fit);
                    if ($res_fit == false) {
                        echo "Requête incorrecte";
                    } else {
                        foreach ($res_fit as $ligne) {
                            $age = $ligne['age'];
                            $t = $ligne['taille'];
                            $p = $ligne['poids'];
                            $b = $ligne['bmr'];
                            $dat = $ligne['date']; // Utilisation de la colonne 'date' avec TIMESTAMP

                            // Formater la date au format Y-m-d\TH:i:s pour le champ input de type 'datetime-local'
                            $date_formatee = date('Y-m-d\TH:i:s', strtotime($dat));

                            echo "<form method='post' action='insertFit.php'>";
                            echo "<tr>";
                            echo "<td> <input name='age' value='$age' ></td>";
                            echo "<td> <input name='taille' value='$t' ></td>";
                            echo "<td> <input name='poids' value='$p' ></td>";
                            echo "<td> <input name='bmr' value='$b' ></td>";
                            echo "<td> <input name='date' type='datetime-local' value='$date_formatee' ></td>"; // Utilisation d'un champ de type 'datetime-local'
                            echo "</tr>";
                            echo "</form>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
</body>
</html>
<?php
}
?>
