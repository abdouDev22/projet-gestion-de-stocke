<?php
session_start();
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['id_utilisateur'])) {

}else{
  header("Location: ../../../index.php");
}
$id_utilisateur=$_SESSION['id_utilisateur'];
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "stockage1";
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if ($conn->connect_error) {
  ?>
  <script>
      alert("La connexion à la base de données a échoué : <?php echo $conn->connect_error; ?>");
  </script>
  <?php
}else{
   
    
    
    
    
    if(isset($_POST["u_name"])!==""&&isset($_POST["u_pass"])!==""&&$_POST["u_pass"]==$_POST["u_pass_conf"] ){
        $u_name = $_POST["u_name"];
          $u_pass = $_POST["u_pass"];
          $sql = "UPDATE Utilisateurs SET username='$u_name', `password`='$u_pass' WHERE id=$id_utilisateur";
          $conn->query($sql);
          if ($conn->query($sql) === TRUE) {
            ?>
        <script>
            alert("Donne bien ajoute");
            window.location.href = "profile.php";
        </script>
        <?php
        }
        else {
            ?>
            <script>
                alert("Eureur");
                window.location.href = "profile.php";
            </script>
            <?php
        }
    }else if(isset($_POST["name_check"])=="name"&&isset($_POST["u_name"])!==""){
        $u_name = $_POST["u_name"];
        $sql = "UPDATE Utilisateurs SET username='$u_name' WHERE id=$id_utilisateur";
        $conn->query($sql);
        ?>
        <script>
            alert("Donne bien ajoute");
            window.location.href = "profile.php";
        </script>
        <?php
    }else if(isset($_POST["name_check"])=="pass"&&isset($_POST["u_pass"])!==""&&$_POST["u_pass"]==$_POST["u_pass_conf"]){
        $u_name = $_POST["u_pass"];
        $sql = "UPDATE Utilisateurs SET password='$u_name' WHERE id=$id_utilisateur";
        $conn->query($sql);
        ?>
        <script>
            alert("Donne bien ajoute");
            window.location.href = "profile.php";
        </script>
        <?php
    }else {
        ?>
        <script>
            alert("Eureur");
            window.location.href = "profile.php";
        </script>
        <?php
    }
}

?>