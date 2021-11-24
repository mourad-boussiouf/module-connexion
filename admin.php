<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";

$conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");


?>
<?php

session_start();

if($_SESSION['login'] != 'admin'){
    header('Location: index.php');

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<header>
<link rel="stylesheet" href="headerprofil.css">

<div class="menumoduleconnexion">

    <a href="index.php">Accueil</a>

</div>

<?php
include ('loggedbaradmin.php');
?>

</header>



<?php

//énumère tous les login présents dans la base de données

$sql= mysqli_query ($conn,"SELECT login FROM utilisateurs");
$res= mysqli_fetch_all($sql); 

foreach ($res as $v1) {
    foreach ($v1 as $v2) {
        echo "$v2"."<br>";
    }
}

if(isset($_POST['logintomodify'])){
    $loginmod=$_POST['logintomodify'];
    $sqlmod= mysqli_query ($conn,"SELECT * FROM utilisateurs WHERE login='$loginmod'");
    $resmod= mysqli_fetch_all($sqlmod); 
    $_MODIFY['success'] = "";


    if (empty($resmod)) {
        echo "Veillez entrer le nom d'utilisateur à modifier";
    }
     else {

                $_MODIFY['login'] = $resmod[0][1];
                $_MODIFY['nom'] = $resmod[0][3];
                $_MODIFY['id'] = $resmod[0][0];
                $_MODIFY['prenom'] = $resmod[0][2];
                $_MODIFY['password'] = $resmod[0][4];

            }
         
}
         else {
             echo "Veillez entrer le nom d'utilisateur à modifier";
         }

?>


<form method="POST" action = "#">
    
<p>
    <input type = "text" name = "logintomodify" id = "logintomodify" placeholder = "Nom d'utilisateur"  /> <br> 
</p>

<p>
    <input type = "submit" value = 'Modifier le profil de cet utilisateur' name = 'adminmodify'/>

</p>

<?php 


if (isset($_MODIFY['login'])) {
echo $_MODIFY['login']."<br>";
}

?>

<form method="POST" action = "profil.php">

<input type = "text" name = "login" id = "login" placeholder = <?php if (isset($_MODIFY['login'])) { echo $_MODIFY['login']; }?>  > <br> 
<input type = "submit" value = "Changer le nom d'utilisateur" name = "changelogin"/> <br>

<input type = "password" name = "password" id = "password" placeholder = 'Nouveau mot de passe'  /><br>
<input type = "password" name = "passwordconfirm" id = "passwordconfirm" placeholder ='Confirmer le mot de passe' /><br>
<input type = "submit" value = "Changer le mot de passe" name = "changepassword"/> <br>

<input type = "text" name = "prenom" id = "prenom" placeholder = <?php if (isset($_MODIFY['prenom'])) { echo $_MODIFY['prenom']; }?>><br>
<input type = "submit" value = "Changer le prénom" name = "changeprenom"/> <br>

<input type = "text" name = "nom" id = "nom" placeholder = <?php if (isset($_MODIFY['nom'])) { echo $_MODIFY['nom']; } ?> ><br>
<input type = "submit" value = "Changer le nom" name = "changenom"/>  <br> 

</form>









</body>
</html>