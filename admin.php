<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname ="moduleconnexion";

$conn= mysqli_connect("127.0.0.1","root","","moduleconnexion");


?>
<?php
//cache les erreurs liés à la variable MODIFY qui est parfois non définie dans le processus

error_reporting(0);
ini_set('display_errors', 0); 

session_start();

if($_SESSION['login'] != 'admin'){
    header('Location: index.php');

}

?>


<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
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
<main>

<div class = thatareuser> 
<p> Voici la liste des utilisateurs présent sur le site :  </p>
</div>
<?php


//énumère tous les login présents dans la base de données (double boucle requise car l'array est multidimensionnel)

$sql= mysqli_query ($conn,"SELECT login FROM utilisateurs");
$res= mysqli_fetch_all($sql); 

foreach ($res as $v1) {
    foreach ($v1 as $v2) {
        echo "<div class = listuser>"."• "."$v2"."<br>"."</div>";
    }
}

if(isset($_GET['logintomodify'])){
    $loginmod=$_GET['logintomodify'];
    $sqlmod= mysqli_query ($conn,"SELECT * FROM utilisateurs WHERE login='$loginmod'");
    $resmod= mysqli_fetch_all($sqlmod); 
    $_MODIFY['success'] = "";

//crée des variables MODIFY qui sont les  anciennes données de l'utilisateur selectionné

                $_MODIFY['login'] = $resmod[0][1];
                $_MODIFY['nom'] = $resmod[0][3];
                $_MODIFY['id'] = $resmod[0][0];
                $_MODIFY['prenom'] = $resmod[0][2];
                $_MODIFY['password'] = $resmod[0][4];

            }
         

         else {
             echo "<div class = enterlogin>Entrez le nom d'utilisateur du compte à modifier :</div>";
         }





if(isset($_POST['changelogin'])) {

    $loginadmin = mysqli_real_escape_string($conn,htmlspecialchars($_POST['loginadmin'])); 

    
        $sql_u = "SELECT * FROM utilisateurs WHERE login='$loginadmin'";
        $res_u = mysqli_query($conn, $sql_u);
    
    
        
    
        if(mysqli_num_rows($res_u) > 0) {
    
        echo "Nom d'utilisateur déjâ utilisé !"; }
    
        else {
    
            $loginadmin = $_POST['loginadmin'];
            $id = $_MODIFY['id'];
    
        $query = "UPDATE utilisateurs SET login='$loginadmin' WHERE id='$id' "; 
        //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        if($run) {
         echo "Nom d'utilisateur modifié avec succés";
        //  header ("refresh:2;admin.php");
        }
    
            else { 
            echo "Modification non prise en compte";
            } 
            
    
            
    
        }
    
    }


    
?>    


<div class = logintomodify>
<form method="GET" action = "#">
    
<p>
    <input type = "text" name = "logintomodify" id = "logintomodify" value = "<?php if (isset($_MODIFY['login'])) { echo $_MODIFY['login']; }?>" placeholder = "Nom d'utilisateur"  /> <br> 
</p>

<p>
    <input type = "submit" value = 'Modifier le profil de cet utilisateur' name = 'adminmodify'/>

</p>
</form>
</div>
<div class = selecteduser>
<?php 

//affiche l'id et le login de l'utiliseur selectionné pour se repérer

if (isset($_MODIFY['login'])) {
echo "Nom d'utilisateur selectionné : ".$_MODIFY['login']."<br>";
echo "Numero ID de l'utilisateur sélectionné : ".$_MODIFY['id'];
}

//changement du nom de l'utilisateur selectionné

if(isset($_POST['changenom'])) {

    $onom = $_MODIFY['nom'];
    $nnom = $_POST['nom'];
    


    $sql_nom = "SELECT * FROM utilisateurs WHERE nom='$onom'";

    $res_nom = mysqli_query($conn, $sql_nom);

    $id=$_POST['changenom'];
    $query = "UPDATE utilisateurs SET nom='$nnom' WHERE id='$id'";

    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Nom modifié avec succés";

    }

    else {
     echo "Modification non prise en compte";
    } 
    
}

//changement du prénom de l'utilisateur selectionné

 if(isset($_POST['changeprenom'])) {

    $oprenom = $_MODIFY['prenom'];
    $nprenom = $_POST['prenom'];
    


    $sql_pnom = "SELECT * FROM utilisateurs WHERE nom='$oprenom'";

    $res_pnom = mysqli_query($conn, $sql_pnom);

    $id=$_POST['changeprenom'];
    $query = "UPDATE utilisateurs SET prenom='$nprenom' WHERE id='$id'";

    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Prénom modifié avec succés";
    
    }

    else {
     echo "Modification non prise en compte";
    } 
    
} 

//changement du login de l'utilisateur selectionné

if(isset($_POST['changeloginadmin'])) {

    $ologin = $_MODIFY['loginadmin'];
    $nlogin = $_POST['loginadmin'];
    


    $sql_login = "SELECT * FROM utilisateurs WHERE login='$ologin'";

    $res_login = mysqli_query($conn, $sql_login);

    $id=$_POST['changeloginadmin'];
    $query = "UPDATE utilisateurs SET login='$nlogin' WHERE id='$id'";

    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Nom d'utilisateur modifié avec succés";
     //actualise la page pour mettre à jour la liste d'utilisateurs
     header ("refresh:2;url=admin.php");
    }

    else {
     echo "Modification non prise en compte";
    } 
    
} 



//changement du mot de passe de l'utilisateur selectionné


if(isset($_POST['changepassword']) && $_POST['password'] != $_POST['passwordconfirm']) {
    echo 'Les mots de passe ne sont pas identiques';
}

if(isset($_POST['changepassword']) && $_POST['password'] == $_POST['passwordconfirm']) {

    $opassword = $_MODIFY['password'];
    $npassword = $_POST['password'];
    

    $sql_password = "SELECT * FROM utilisateurs WHERE password='$opassword'";

    $res_password = mysqli_query($conn, $sql_password);

    $id=$_POST['changepassword'];
    $query = "UPDATE utilisateurs SET password='$npassword' WHERE id='$id'";

    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    

    if($run) {
     echo "mot de passe modifié avec succés";
     //actualise la page pour mettre à jour la liste d'utilisateurs
     header ("refresh:2;url=admin.php");
    }

    else {
     echo "Modification non prise en compte";
    } 
    
} 






if(isset($_MODIFY)){
?>
</div>
<div class = modifyform>
<!-- Le formulaire est pré rempli avec les anciennes informations -->
<form method="POST" action = "admin.php">

<input type = "text" name = "loginadmin" id = "loginadmin" placeholder = <?php if (isset($_MODIFY['login'])) { echo $_MODIFY['login']; }?>  > <br> 
<button type = "submit" value = "<?=$_MODIFY['id']?>" name = "changeloginadmin">Changer le nom d'utilisateur</button>  <br> 

<input type = "password" name = "password" id = "password" placeholder = 'Nouveau mot de passe'  /><br>
<input type = "password" name = "passwordconfirm" id = "passwordconfirm" placeholder ='Confirmer le mot de passe' /><br>
<button type = "submit" value = "<?=$_MODIFY['id']?>" name = "changepassword">Changer le mot de passe</button>  <br> 

<input type = "text" name = "prenom" id = "prenom" placeholder = <?php if (isset($_MODIFY['prenom'])) { echo $_MODIFY['prenom']; }?>><br>
<button type = "submit" value = "<?=$_MODIFY['id']?>" name = "changeprenom">Changer le prénom</button>  <br> 

<input type = "text" name = "nom" id = "nom" placeholder = <?php if (isset($_MODIFY['nom'])) { echo $_MODIFY['nom']; } ?> ><br>
<button type = "submit" value = "<?=$_MODIFY['id']?>" name = "changenom">Changer le nom</button>  <br> 

</form>
</div>
<?php }?>



<div class="clear"></div>
=

</main>
<div id="footer">
<footer>
<?php
include ('footer.php');
?>
</footer>
</div>
</body>
</html>