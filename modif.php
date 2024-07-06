<?php 

include 'config.php';
session_start();



if ($_POST['bt']=="supprimer") {

	$i=$_POST['id'];
	$sql="delete from users where id=$i";
	try{
		$res=$conn->query($sql);
		//echo "<script>alert('suppression avec succès')</script>";
		header("Location:administrateur.php");
	}catch(Exception $e){
		echo "erreur";
	}
	 
}
/*if($_POST['bt']=="ajouter"){
	//$i=$_POST['id'];
	$n=$_POST['nom'];
	$p=$_POST['prenom'];
	$ad=$_POST['email'];
	$mdp=$_POST['mdp'];
	$d=$_POST['date'];
	$sql="insert into user(nom, prenom, email, date) values('$n','$p','$ad','$d')";
	$res=$conn->query($sql);
	header("Location:administrateur.php");





}
*/






?>
