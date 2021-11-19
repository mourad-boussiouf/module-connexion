
<?php
 
 // Débute une session

 session_start();
   

 // si l'utilisateur n'est pas connecté, redirection vers la page connexion 
 if (!isset($_SESSION['login'])) {
     $_SESSION['msg'] = "Vous devez être connecté";
     header('location: connexion.php');
 }
   
 // Le bouton déconnexion supprimme la session
 if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['login']);
    header("location: connexion.php");
}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="profil.css">
</head>
<body>

<?php
include ('headerprofil.php');
?>

<?php

if(isset($_SESSION['login'])){
   include ('loggedheader.php');
}

?>




<p>
    



</p>
</body>
</html>