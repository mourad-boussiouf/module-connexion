<?php

$conn= mysqli_connect("localhost","root","","moduleconnexion");


if(isset($_POST['login']) && isset($_POST['password'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $sql=mysqli_query ($conn,"SELECT * FROM utilisateurs WHERE login='$login' AND password='$password'");
    $res= mysqli_fetch_all($sql); 
    $_SESSION['success'] = "";

    
    if (empty($res)) {
        echo "Votre nom d'utilisateur et/ou votre mot de passe n'est pas reconnu";
    }
     else {
         if($res[0][4] == $password){
            session_start();
            if ( $password == 'admin'){
                $_SESSION['login'] = $login;
                header ("refresh:1;url=admin.php");
    
            }
            else {
                $_SESSION['login'] = $login;
                header ("refresh:1;url=profil.php");

            }
         
     }
         else {
             echo "Votre nom d'utilisateur et/ou votre mot de passe n'est pas reconnu";
         }
}
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<form method="POST" action = "#">
    
<p>
    <input type = "text" name = "login" id = "login" placeholder = "Nom d'utilisateur"  /> <br> 
    <input type = "password" name = "password" id = "password" placeholder = 'Mot de passe'  /><br>
</p>

<p>
    <input type = "submit" value = 'Connexion' name = 'Connexion'/>

</p>


</form>

</body>


</html>