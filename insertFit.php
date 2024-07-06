
<?php
session_start();
require_once "config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['age']) && isset($_POST['weight'])  &&  isset($_POST['height'])   &&   isset($_POST['bmr']) )
    {
        $i=$_SESSION['id'] ;
       
        
        $weight = $_POST['weight'] ;
        $height = $_POST['height'] ;
        $bmr    = $_POST['bmr'] ;
        $age    = $_POST['age'] ;
        
        $inserFitRequete = "insert into fit (id_user,age,taille,poids,bmr) values ($i,$age,$height,$weight,$bmr) ";

        if ($InsertResult = $conn->query($inserFitRequete))
        {
            echo "execution avec succes";
        }
        else
        {
            echo "execution Echoue";
        }

    }
}



