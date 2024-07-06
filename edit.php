<?php 
session_start();
include 'config.php';

if(isset($_POST['bt'])){
	$i=$_SESSION['id'];
	$n=$_POST['nom'];
	$p=$_POST['prenom'];
	$ad=$_POST['email'];
	$sql="update users set prenom='$p' , nom='$n' ,  email='$ad' where id=$i";
	try{
	$res=$conn->query($sql);
	header("Location: profil.php");
        }catch(Exception $e){
        	echo "<script>alert('erreur')";
        }

}

?>
