
    
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

<form method="POST" action = "index.php">

<p>
    <label for = "login"> Entrez le nom d'utilisateur : </label> 
    <input type = "text" name = "login" id = "login" /> <br>
    <label for = "password"> Entrez le mot de passe : </label> 
    <input type = "password" name = "password" id = "password" /><br>
    <label for = "password"> Veillez confirmez le mot de passe </label> 
    <input type = "password" name = "passwordconfirm" id = "passwordconfirm" /><br>
    <label for = "prenom"> Entrez le prenom : </label> 
    <input type = "text" name = "prenom" id = "prenom" /><br>
    <label for = "nom"> Entrez le nom : </label> 
    <input type = "text" name = "nom" id = "nom" /><br>

</p>

<p>
    <input type = "submit" value = Submit />

</p>

</form>

<p> Déjâ inscrit ? <a href="/connexion.php">Connexion</a>
    </p>

<footer>

<?php
include ('footer.php');
?>

</footer>

</body>


</html>


