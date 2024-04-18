<?php
session_start();
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['id_utilisateur'])) {

}else{
  header("Location: ../../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "stockage1";

$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

if(isset($_GET['id'])){
  $_SESSION['Ater_employe']=$_GET['id'];
}
// ID de l'unité que vous souhaitez afficher
$idUnite =$_SESSION['Ater_employe'];

$updateQuery = "UPDATE utilisateurs SET password='Admin' WHERE id = $idUnite";
if ($conn->query($updateQuery) === TRUE) {
    ?>
    <script>
        alert("information mise ajour le mot passe default est Admin");
        window.location.href ="employe.php";

    </script>
    <?php
  } else {
    ?>
    <script>
        alert("Eureur");
        window.location.href ="employe.php";
    </script>
    <?php
  }
?>
</body>
</html>