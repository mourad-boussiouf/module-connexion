<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";


$conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");









if(isset($_POST['login']) && isset($_POST['password'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $sql= mysqli_query ($conn,"SELECT * FROM utilisateurs WHERE login='$login' AND password='$password'");
    $res= mysqli_fetch_all($sql); 
    $_SESSION['success'] = "";



    
    if (empty($res)) {
        echo "<div class=topmessagebad> ⚠️Votre nom d'utilisateur et/ou votre mot de passe n'est pas reconnu⚠️</div>";
    }
     else {
         if($res[0][1] == $login){
            session_start();
            if ( $login == 'admin'){
                $_SESSION['login'] = $res[0][1];
                $_SESSION['nom'] = $res[0][3]; 
                $_SESSION['id'] = $res[0][0];
                $_SESSION['prenom'] = $res[0][2];
                $_SESSION['password'] = $res[0][4];
                header ("refresh:0.1;url=admin.php");
    
            }
            else {
                $_SESSION['login'] = $res[0][1];
                $_SESSION['nom'] = $res[0][3]; 
                $_SESSION['id'] = $res[0][0];
                $_SESSION['prenom'] = $res[0][2];
                $_SESSION['password'] = $res[0][4];

                header ("refresh:0.1;url=profil.php");

            }
         
     }
         else {
             echo "<div class=topmessagebad> ⚠️
             Votre nom d'utilisateur et/ou votre mot de passe n'est pas reconnu⚠️</div>";
         }
}
}


?>





<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
<div class = connection>
<form method="POST" action = "#">
<div class = connectionform>
<p>
    <input type = "text" name = "login" id = "login" placeholder = "Nom d'utilisateur"  /> <br> 
    <input type = "password" name = "password" id = "password" placeholder = 'Mot de passe'  /><br>
</p>
</div>
<div class = connectionsubmit>
<p>
    <input type = "submit" value = 'Connexion' name = 'Connexion'/>
</p>
</div>
<div class = registerinvite>
<p> Pas de compte ? <a href="inscription.php">Inscription</a>
    </p>
</div>
</div>

</form>
</main>
<footer>
<?php
include ('footer.php');
?>
</footer>
</body>


</html>