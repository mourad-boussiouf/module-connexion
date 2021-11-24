<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";


$conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");

 session_start();

?>

<?php

if(isset($_SESSION['login'])){
    include ('headerlogged.php');
}
?>

<?php
if(!isset($_SESSION['login'])){
    include ('header.php');
}
?>

<?php

if(isset($_SESSION['login'])){
   include ('loggedbar.php');
}


?>

