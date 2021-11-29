<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";


$conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");

 session_start();

?>



<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<header>
<?php
if(isset($_SESSION['login'])){
    include ('headerlogged.php');
}

if(!isset($_SESSION['login'])){
    include ('header.php');
}

if(isset($_SESSION['login'])){
   include ('loggedbar.php');
}
?>
</header>
<main>
<?php
if(!isset($_SESSION['login'])){
   
echo "<h1>Ton daron fait t'il de la drill ? <br>Connecte toi pour le savoir !<h1>";
}
?>
<div class = andrea>
<?php
if(isset($_SESSION['login'])){
echo "<img src='image/andreadrill.png' class = andreadrill alt='andreaquifaitdladrill'>";
?>
</div>
<div class = sentencesindex>
<?php
echo "<div class = darondrill>Bonjour ".$_SESSION['login'].
" les analyses sont formelles,<br>ton daron il fait de la drill gros !</div>";
}
?>
</div>



</main>

<footer>
<?php
include ('footer.php');
?>
</footer>
</body>
</html>

