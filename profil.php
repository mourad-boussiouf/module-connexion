
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



<div class="topnav">
  <a href="#home" class="active"> <?php  if (isset($_SESSION['login'])) {
      echo 'Connecté en tant que '.$_SESSION['login']; } ?> </a>

  <div id="menuprofil">
    <a href="#news">Modifier mon profil</a>
    <a  href = "connexion.php?logout='1'" >Déconnexion</a>
  </div>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<script>
function myFunction() {
  var x = document.getElementById("menuprofil");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
<p>
    



</p>
</body>
</html>