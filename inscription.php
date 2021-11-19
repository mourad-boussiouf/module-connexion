<?php

// connexion au serveur local phpmyadmin

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";


$conn = mysqli_connect($servername, $username, $password, $dbname);


//si le bouton "envoyer" est cliqué
if(isset($_POST['Envoyer'])) {

$login = mysqli_real_escape_string($conn,htmlspecialchars($_POST['login'])); 
$password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));


 
    

    $sql_u = "SELECT * FROM utilisateurs WHERE login='$login'";

    $res_u = mysqli_query($conn, $sql_u);


    

    if(mysqli_num_rows($res_u) > 0) {

    echo "Nom d'utilisateur déjâ utilisé !"; }

    else {

    

    //les champs ne sont pas vides et les mots de passes sont identiques
    if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['passwordconfirm']) &&
    !empty($_POST['prenom']) && !empty($_POST['nom']) && $_POST['password'] == $_POST['passwordconfirm']) {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];

     
    $query = "INSERT INTO utilisateurs (prenom,nom,login,password) VALUES ('$login', '$password' , '$prenom', '$nom' )";
    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Inscription bien enrengistrée,"."<br>"."vous allez être rediriger vers la page de connexion";
     header ("refresh:2;url=connexion.php");
    }

    else {
     echo "Inscription non prise en compte";
    } 
     
    }

    else {
    echo "Tous les champs doivent être remplis"."<br>".
    "et les mots de passe doivent correspondrent";

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
    <title>Inscription</title>
</head>
<header>

<?php
include ('header.php');
?>

</header>

</header>
<body>

<form method="POST" action = "#">

<p>
    <input type = "text" name = "login" id = "login" placeholder = "Nom d'utilisateur"  /> <br> 
    <input type = "password" name = "password" id = "password" placeholder = 'Mot de passe'  /><br>
    <input type = "password" name = "passwordconfirm" id = "passwordconfirm" placeholder ='Confirmer le mot de passe' /><br>
    <input type = "text" name = "prenom" id = "prenom" placeholder = "Prénom" /><br>
    <input type = "text" name = "nom" id = "nom" placeholder = "Nom" /><br>

</p>

<p>
    <input type = "submit" value = 'Envoyer' name = 'Envoyer'/>

</p>

</form>


<p> Déjâ inscrit ? <a href="connexion.php">Connexion</a>
    </p>

<footer>

<?php
include ('footer.php');
?>

</footer>

</body>


</html>


