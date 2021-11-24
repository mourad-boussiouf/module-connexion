
<?php
 
 // connexion au serveur local phpmyadmin

 $servername = "127.0.0.1";
 $username = "root";
 $password = "";
 $dbname ="moduleconnexion";
 
 
 $conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");



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


<?php

//si le bouton "envoyer" est cliqué
if(isset($_POST['changelogin'])) {

$login = mysqli_real_escape_string($conn,htmlspecialchars($_POST['login'])); 
$password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));


 
    

    $sql_u = "SELECT * FROM utilisateurs WHERE login='$login'";

    $res_u = mysqli_query($conn, $sql_u);


    

    if(mysqli_num_rows($res_u) > 0) {

    echo "Nom d'utilisateur déjâ utilisé !"; }

    else {

        $login = $_POST['login'];
        $id = $_SESSION['id'];

    $query = "UPDATE utilisateurs SET login='$login' WHERE id='$id' "; 
    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Nom d'utilisateur modifié avec succés";
     header ("refresh:2;profil.php");
    }

        else {
        echo "Modification non prise en compte";
        } 
        

        

    }

}


if(isset($_POST['changepassword'])) {


    $sql_pass = "SELECT * FROM utilisateurs WHERE password='$password'";

    $res_pass = mysqli_query($conn, $sql_pass);

    if($_POST['password'] != $_POST['passwordconfirm']) {

        echo "Les mots de passe ne correspondent pas !"; }

        else {
            $password = $_POST['password'];
            $id = $_SESSION['id'];
    
        $query = "UPDATE utilisateurs SET password='$password' WHERE id='$id' "; 
        //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
        $run = mysqli_query($conn, $query) or die(mysqli_error());
    
        if($run) {
         echo "Mot de passe modifié avec succés";
         header ("refresh:2;profil.php");
        }
    
        else {
         echo "Modification non prise en compte";
        } 
        
    }
    
}

if(isset($_POST['changeprenom'])) {


    $prenom = $_POST['prenom'];
    $id = $_SESSION['id'];


    $sql_prenom = "SELECT * FROM utilisateurs WHERE prenom='$prenom'";

    $res_prenom = mysqli_query($conn, $sql_prenom);



    $query = "UPDATE utilisateurs SET prenom='$prenom' WHERE id='$id' "; 
    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Prénom modifié avec succés";
     header ("refresh:2;profil.php");
    }

    else {
     echo "Modification non prise en compte";
    } 
    
}


if(isset($_POST['changenom'])) {

    $nom = $_POST['nom'];
    $id = $_SESSION['id'];


    $sql_nom = "SELECT * FROM utilisateurs WHERE nom='$nom'";

    $res_nom = mysqli_query($conn, $sql_nom);


    $query = "UPDATE utilisateurs SET nom='$nom' WHERE id='$id' "; 
    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Nom modifié avec succés";
     header ("refresh:2;profil.php");
    }

    else {
     echo "Modification non prise en compte";
    } 
    
}





?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>

<header>
<?php
if(isset($_SESSION['login'])){
    include ('headerlogged.php');
}


if(isset($_SESSION['login'])==false){
    include ('header.php');
}




if(isset($_SESSION['login'])){
   include ('loggedbar.php');
}
?>
</header>

<main>
<p>
<form method="POST" action = "profil.php">

<input type = "text" name = "login" id = "login" placeholder = <?php echo $_SESSION['login'];?>  /> <br> 
<input type = "submit" value = "Changer le nom d'utilisateur" name = "changelogin"/> <br>

<input type = "password" name = "password" id = "password" placeholder = 'Nouveau mot de passe'  /><br>
<input type = "password" name = "passwordconfirm" id = "passwordconfirm" placeholder ='Confirmer le mot de passe' /><br>
<input type = "submit" value = "Changer le mot de passe" name = "changepassword"/> <br>

<input type = "text" name = "prenom" id = "prenom" placeholder = <?php echo $_SESSION['prenom'];?> /><br>
<input type = "submit" value = "Changer le prénom" name = "changeprenom"/> <br>

<input type = "text" name = "nom" id = "nom" placeholder = <?php echo $_SESSION['nom'];?> /><br>
<input type = "submit" value = "Changer le nom" name = "changenom"/>  <br> 

</form>

</p>
</main>

<footer>
</footer>
</body>
</html>