<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="imge/svg+xml" href="store-svgrepo-com.svg">
  <link rel="stylesheet" href="asset/coment.css">
  <link rel="stylesheet" href="asset/login.css">
  <title>Document</title>
</head>
<body>
  <nav>
    <a href="index.php">
      <div class="logo">
        <strong>MATA</strong>
        <span>Company</span>
      </div>
    </a>
  </nav>
  <div class="cont">
    <div class="wrapperlog">
      <div class="form-wrapper sign-in">
        <form action="login.php" method="post">
          <h2>Connexion</h2>
          <div class="input-group">
            <input type="text" name="name" id="name" required>
            <label for="name">Nom</label>
          </div>
          <div class="input-group">
            <input type="password" name="pass" id="pass" required >
            <label for="pass">Mot de pass </label>
          </div>
          <button type="submit">Connexion</button>
          
        </form>
      </div>
    </div>
  </div>
  <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $serveur = "localhost";
  $utilisateur = "root";
  $motDePasse = "";
  $baseDeDonnees = "stockage1";
  
  $conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
  
  // Vérifier la connexion
  if ($conn->connect_error) {
      die("La connexion à la base de données a échoué : " . $conn->connect_error);
  }
  
  // Traitement du formulaire de connexion
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $pass = $_POST['pass'];
  
      // Requête SQL pour vérifier les informations de connexion
      $sql = "SELECT * FROM utilisateurs WHERE username = '$name' AND password = '$pass'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
  
      if ($result->num_rows > 0 && $row['id']) {
          // L'utilisateur est connecté avec succès
          ?>
                    <script>
                        alert("connexion reussie");
                    </script>
                    <?php
                    
  
  session_start();
  $_SESSION["id_utilisateur"]=$row['id'];
          header("Location: Service/");
      } else {
        ?>
        <script>
            alert("le mot de passe ou le nom de l'utilisateur est incorrecte: <?php echo $conn->error; ?>");
        </script>
        <?php
      }
  }
  
  // Fermer la connexion à la base de données
  $conn->close();
}
// Connexion à la base de données

?>

 

  <script>
    function transitionToIndex() {
      document.querySelector('.wrapperlog').style.opacity = 0;
      setTimeout(function() {
        window.location.href = 'index.html';
      }, 2000);
    }
    </script>
    
</body>
</html>