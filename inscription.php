<?php

// connexion au serveur local phpmyadmin

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";


$conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");



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

     
    $query = "INSERT INTO utilisateurs (login,password,prenom,nom) VALUES ('$login', '$password' , '$prenom', '$nom' )";
    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "<div class=topmessagegood>Inscription bien enrengistrée,"."vous allez être rediriger vers la page de connexion</div>";
     header ("refresh:3;url=connexion.php");
    }

    else {
     echo "Inscription non prise en compte";
    } 
     
    }

    else {
    echo "<div class=topmessagebad> ⚠️ Tous les champs doivent être remplis
    et les mots de passe doivent correspondre ⚠️</div>"    ; 
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
    <title>Inscription</title>
</head>
<header>

<?php
include ('header.php');
?>

</header>

</header>
<body>
<main>
<div class = register>
<div class = registerform>
<form method="POST" action = "#">
<p>
    <input type = "text" name = "login" id = "login" placeholder = "Nom d'utilisateur"  /> <br> 
    <input type = "password" name = "password" id = "password" placeholder = 'Mot de passe'  /><br>
    <input type = "password" name = "passwordconfirm" id = "passwordconfirm" placeholder ='Confirmer le mot de passe' /><br>
    <input type = "text" name = "prenom" id = "prenom" placeholder = "Prénom" /><br>
    <input type = "text" name = "nom" id = "nom" placeholder = "Nom" /><br>
</p>
</div>
<div class = registersubmit>
<p>
    <input type = "submit" value = "S'inscrire" name = 'Envoyer'/>
</p>
</form>
</div>
<div class = alreadyregister>
<p> Déjâ inscrit ? <a href="connexion.php">Connexion</a>
    </p>
</div>
</div>
</main>
<footer>

<?php
include ('footer.php');
?>

</footer>

</body>


</html>


