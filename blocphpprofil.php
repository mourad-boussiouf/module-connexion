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
        $password = $_POST['password'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];

    $query = "UPDATE utilisateurs WHERE login='$login' SET prenom='$prenom',nom='$nom',login='$login' "; 
    //si les conditions sont remplies, éxécute les insertions SQL à partir des données du formulaire
    $run = mysqli_query($conn, $query) or die(mysqli_error());

    if($run) {
     echo "Inscription bien enrengistrée,"."<br>"."vous allez être rediriger vers la page de connexion";
     header ("refresh:2;url=connexion.php");
    }

    else {
     echo "Inscription non prise en compte";
    } 
     
    

    else {
    echo "Tous les champs doivent être remplis"."<br>".
    "et les mots de passe doivent correspondrent";

}

}

}
?>