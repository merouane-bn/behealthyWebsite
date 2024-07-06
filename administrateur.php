<!DOCTYPE html>
<html>
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Affichage des données</title>
</head>
<body style="background-color:#009688">
    <header style="background-color:white">
    <p style="font-family: 'Open Sans', sans-serif; font-size: 3em;"><a href="site.html"><span style="color:#009688">Be</span>Healthy</a></p>
    </header>
    <div style="background-color:white">
    <h2 style="background-color:lightgreen; font-family: cursive;"> Supprimer un Utilisateur</h2>

    <?php
    include "config.php";
    $sql = "SELECT * FROM users";
    $res = $conn->query($sql);

    if (!$res) {
        echo "Erreur lors de la requête";
    } else {
    ?>
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th>nom</th>
                <th>prénom</th>
                <th>email</th>
                <th>date de création</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    <?php
        foreach ($res as $ligne) {
            $i = $ligne['id'];
            $n = $ligne['nom'];
            $p = $ligne['prenom'];
            $ad = $ligne['email'];
            $d = $ligne['date_creation']; // Utiliser le nom correct de la colonne

            echo "<form method='post' action='modif.php'>";
            echo "<tr>";
            echo "<input name='id' type='hidden'  value='$i'>";
            echo "<td> <input name='nom' value='$n' ></td>";
            echo "<td> <input name='prenom' value='$p' ></td>";
            echo "<td> <input name='email' value='$ad' ></td>";
            echo "<td> <input name='date_creation' type='text' value='$d' readonly></td>"; // Notez le changement ici
            echo "<td><input type='submit' value='supprimer' name='bt'> </td>";
            echo "</tr>";
            echo "</form>";
        }
    ?>
        </tbody>
    </table>
    <?php
    }
    ?>
    </div>
</body>
</html>
