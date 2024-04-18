<?php
session_start();
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['id_utilisateur'])) {

}else{
  header("Location: ../../../../index.php");
}

$id_utilisateur=$_SESSION['id_utilisateur'];


?>
<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../../asset/cash.css">
  <link rel="stylesheet" href="../../../../asset/coment.css">
  <link rel="stylesheet" href="../../../../asset/phpAC.css">
  <title>Document</title>
</head>
<body>
<?php

if(isset($_GET['id'])){
  $_SESSION['Ater_cash']=$_GET['id']; 
}
$id_client = $_SESSION['Ater_cash'];
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "stockage1";
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$query = "SELECT * FROM client_fourniseur WHERE id = $id_client";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $nom_client = $row['nom'];
  $dateActuelle = date('Y-m-d');
  // Fermer la connexion à la base de données
} 
$query = "SELECT nom, prix FROM produits";

$result = $conn->query($query);
if ($result->num_rows > 0) {
  $products = array();
  while ($row = $result->fetch_assoc()) {
    $products[$row['nom']] = array('nom' => $row['nom'], 'prix' => $row['prix']);
  }

  // Convertir le tableau PHP en objet JSON
  $jsonProducts = json_encode($products); 

  // Retourner la chaîne JSON

} else {
  echo json_encode(array('error' => 'Aucun produit trouvé'));
}

$query3 = "SELECT MAX(id) AS max_id FROM commandes";
$result3 = $conn->query($query3);

if ($result3->num_rows > 0) {
  $row = $result3->fetch_assoc();
  $lastId = $row['max_id'];
  
  // Incrémenter pour le prochain ID
  $nextId = $lastId + 1;

}

?>

  <nav>
    <div class="logo">
      <strong>MATA</strong>
      <span>Company</span>
    </div>
    <ul>
      <li><a href="../../../../logout.php">logout</a> </li>
    </ul>
  </nav>
  <div class="sidebar">
    <span class="lock1"> 
      <svg width="64px" height="64px" viewBox="-8.16 -8.16 40.32 40.32" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-8.16" y="-8.16" width="40.32" height="40.32" rx="20.16" fill="#7ed0ec" strokewidth="0"/></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.43200000000000005"/><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" fill="#1C274C"/> <path d="M12 18C13.1046 18 14 17.1046 14 16C14 14.8954 13.1046 14 12 14C10.8954 14 10 14.8954 10 16C10 17.1046 10.8954 18 12 18Z" fill="#1C274C"/> <path d="M6.75 8C6.75 5.10051 9.10051 2.75 12 2.75C14.4453 2.75 16.5018 4.42242 17.0846 6.68694C17.1879 7.08808 17.5968 7.32957 17.9979 7.22633C18.3991 7.12308 18.6405 6.7142 18.5373 6.31306C17.788 3.4019 15.1463 1.25 12 1.25C8.27208 1.25 5.25 4.27208 5.25 8V10.0546C5.68651 10.022 6.18264 10.0089 6.75 10.0036V8Z" fill="#1C274C"/> </g></svg></span>
      <span class="lock2">
        <svg width="64px" height="64px" viewBox="-7.44 -7.44 38.88 38.88" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-7.44" y="-7.44" width="38.88" height="38.88" rx="19.44" fill="#7ed0ec" strokewidth="0"/></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" fill="#1C274C"/> <path d="M12 18C13.1046 18 14 17.1046 14 16C14 14.8954 13.1046 14 12 14C10.8954 14 10 14.8954 10 16C10 17.1046 10.8954 18 12 18Z" fill="#1C274C"/> <path d="M6.75 8C6.75 5.10051 9.10051 2.75 12 2.75C14.8995 2.75 17.25 5.10051 17.25 8V10.0036C17.8174 10.0089 18.3135 10.022 18.75 10.0546V8C18.75 4.27208 15.7279 1.25 12 1.25C8.27208 1.25 5.25 4.27208 5.25 8V10.0546C5.68651 10.022 6.18264 10.0089 6.75 10.0036V8Z" fill="#1C274C"/> </g></svg>
      </span>
    <ul>
      
      
      <li class="list">
        <a href="../../profile/profile.php">
          <span class="icon"><span class="profile"><svg fill="#000000" width="800px" height="800px" viewBox="0 0 64 64"version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"xml:space="preserve" xmlns:serif="http://www.serif.com/"style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g transform="matrix(1,0,0,1,-1216,-192)"><rect id="Icons" x="0" y="0" width="1280" height="800" style="fill:none;" /><g id="Icons1" serif:id="Icons"><g id="Strike"></g><g id="H1"></g><g id="H2"> </g><g id="H3"></g><g id="list-ul"></g><g id="hamburger-1"></g><g id="hamburger-2"></g><g id="list-ol"></g><g id="list-task"></g><g id="trash"></g><g id="vertical-menu"></g><g id="horizontal-menu"></g><g id="sidebar-2"></g><g id="Pen"></g><g id="Pen1" serif:id="Pen"></g><g id="clock"></g><g id="external-link"></g><g id="hr"></g><g id="info"></g><g id="warning"></g><g id="plus-circle"></g><g id="minus-circle"></g><g id="vue"></g><g id="cog"> </g><g id="logo"></g><g id="radio-check"></g><g id="eye-slash"></g><g id="eye"></g><g id="toggle-off"></g><g id="shredder"></g><g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"></g><g id="react"></g><g id="check-selected"></g><g id="turn-off"></g><g id="code-block"></g><g id="user" transform="matrix(1.03318,0,0,1.03318,-20.8457,199.979)"><g transform="matrix(0.909091,0,0,0.909091,1182.28,-18.6364)"><path d="M50,46.5C42.8,46.5 37,40.7 37,33.5C37,26.3 42.8,20.5 50,20.5C57.2,20.5 63,26.3 63,33.5C63,40.7 57.2,46.5 50,46.5ZM50,24.5C45,24.5 41,28.5 41,33.5C41,38.5 45,42.5 50,42.5C55,42.5 59,38.5 59,33.5C59,28.5 55,24.5 50,24.5Z"style="fill-rule:nonzero;" /></g><g transform="matrix(1,0,0,1,1177.7,-20.5)"><path d="M34.036,58.5L34.036,67L30.4,67L30.4,58.5C30.4,51.318 39.218,45.773 50.4,45.773C61.582,45.773 70.4,51.318 70.4,58.5L70.4,67L66.764,67L66.764,58.5C66.764,53.591 59.309,49.409 50.4,49.409C41.491,49.409 34.036,53.591 34.036,58.5Z"style="fill-rule:nonzero;" /></g></g><g id="coffee-bean"></g><g transform="matrix(0.638317,0.368532,-0.368532,0.638317,785.021,-208.975)"><g id="coffee-beans"><g id="coffee-bean1" serif:id="coffee-bean"></g></g></g><g id="coffee-bean-filled"></g><g transform="matrix(0.638317,0.368532,-0.368532,0.638317,913.062,-208.975)"><g id="coffee-beans-filled"><g id="coffee-bean2" serif:id="coffee-bean"></g></g></g><g id="clipboard"></g><g transform="matrix(1,0,0,1,128.011,1.35415)"><g id="clipboard-paste"></g></g><g id="clipboard-copy"></g><g id="Layer1"></g></g></g></svg></span></span></span>
          <span class="text">Profile</span>
        </a>
      </li>
      <li class="list">
        <a href="../../../index.php">
          <span class="icon"><svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/><path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/></svg></span>
          <span class="text">Modify</span>
        </a>
      </li>
      
      <li class="list">
        <a href="../../../Analitics.php">
          <span class="icon"><svg width="800px" height="800px" viewBox="0 0 128 128" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

            <style type="text/css">
              .st0{display:none;}
              .st1{display:inline;}
              .st2{fill:none;stroke:#0F005B;stroke-width:8;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
            </style>
            
            <g class="st0" id="Layer_1"/>
            
            <g id="Layer_2">
            
            <path class="st2" d="M72.3,19.3c20.1,0,36.4,16.3,36.4,36.4H72.3V19.3z"/>
            
            <path class="st2" d="M55.7,57.7V35.9c-20.1,0-36.4,16.3-36.4,36.4s16.3,36.4,36.4,36.4s36.4-16.3,36.4-36.4H55.7"/>
            
            </g>
            
            </svg></span>
          <span class="text">Analitics</span>
        </a>
      </li>
    </ul>
  </div>
  
  <div class="cont1 n">
    <ul class="ul list1" id="f"></ul>
    <span class="rest"><button>RESET</button></span>
    <span class="td"><input class="ss" type="number" ></span>
    <form action="achat.php" method="post">
    <h1>Achat</h1>
    <a href="../entreprice.php" onclick="local()" class="lien-ret"><svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M16 12H8M8 12L11 9M8 12L11 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/></svg></a>
    
    <span class="Name">Name client</span>
    <span class="Name1"><input type="text" name="nom_client" value="<?php echo $nom_client  ?>" id="" readonly></span>
    <span class="date">Date</span>
    <span class="date1"><input type="date" name="date_commande" value="<?php echo $dateActuelle  ?>"></span>
    <span class="num">NO :</span>
    <span class="num1"><input type="number" name="" value="<?php echo $nextId   ?>" readonly></span>
    
    
    <span class="total1">Prix TOTAL</span>
    <span class="total"><input class="tt" name="p" type="text" value="0" readonly></span>
    
      <table class="content-table">
        <thead>
          <tr>
            <th>Name produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Prix total</th>
          </tr>
          
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="nom_produit[]" class="input"></td>
            <td><input type="number" name="quantite[]" value="0"></td>
            <td><input type="number" name="prix_unitaire[]" value="0" id="price"></td>
            <td><input type="number" name="prix_total[]" value="0" readonly></td>
          </tr>
          
        </tbody>
      </table>
      
      <span class="vendre"><input type="submit" value="vendre"></span>
    </form>
    
    

  </div>


  <?php
// Vérifie la quantité commandée pour chaque produit



// Assure-toi de te connecter à ta base de données avant cette partie
// Utilise les valeurs appropriées pour le serveur, le nom d'utilisateur, le mot de passe et la base de données

$mysqli = new mysqli("localhost", "root", "", "stockage1");

// Vérifie la connexion
if ($mysqli->connect_error) {
    ?>
    <script>
        alert("Erreur de connexion à la base de données ");
    </script>
    <?php
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $validation_quantite = true;

  for ($i = 0; $i < count($_POST['nom_produit']); $i++) {

    $nom_produit = $_POST['nom_produit'][$i];
    $quantite = $_POST['quantite'][$i];
  
    // Récupère la quantité disponible du produit
    $result = $mysqli->query("SELECT quantite FROM produits WHERE nom = '$nom_produit'");
    $row = $result->fetch_assoc();
    $quantite_dispo = $row['quantite'];
  
    
  
  }

if($validation_quantite) {
    // Récupère les valeurs du formulaire
    $date_commande = $_POST["date_commande"];
    $nom_client = $_POST["nom_client"];
    $p_total=$_POST["p"];

    // Recherche l'ID du client
    $result_client = $mysqli->query("SELECT id FROM client_fourniseur WHERE nom = '$nom_client'");
    if ($result_client->num_rows > 0) {
        $row_client = $result_client->fetch_assoc();
        $id_client = $row_client["id"];
    } else {
        ?>
        <script>
            alert("Erreur : Client non trouvé.");
        </script>
        <?php
    }

    // Insertion dans la table Commandes
    $insert_commande = "INSERT INTO commandes (date_commande, id_utilisateur, id_Client_Fourniseur,quantite_totale_commande) 
                        VALUES ('$date_commande', $id_utilisateur, $id_client,$p_total)";

    if ($mysqli->query($insert_commande) === TRUE) {

        ?>
        <script>
            alert("Commande ajoutée avec succès.");
           
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Erreur lors de l'ajout de la commande :  <?php echo $mysqli->error; ?>");
        </script>
        <?php
    }

    // Récupère l'ID de la dernière commande ajoutée
    $last_command_id = $mysqli->insert_id;
    for ($i = 0; $i < count($_POST['nom_produit']); $i++) {

      $nom_produit = $_POST['nom_produit'][$i];
      $quantite = $_POST['quantite'][$i];
    
      // Récupère l'ID du produit
      $result = $mysqli->query("SELECT id FROM produits WHERE nom = '$nom_produit'"); 
      $row = $result->fetch_assoc();
      $id_produit = $row['id'];
    
      // Met à jour la quantité disponible
      $update_quantite = "UPDATE produits 
                          SET quantite = quantite + $quantite
                          WHERE id = $id_produit";
    
      $mysqli->query($update_quantite);
    
    }

    // Insère les détails de la commande dans la table produits_commande pour chaque produit
    for ($i = 0; $i < count($_POST['nom_produit']); $i++) {
        $nom_produit = $_POST['nom_produit'][$i];
        $quantite = $_POST['quantite'][$i];
        $prix_unitaire = $_POST['prix_unitaire'][$i];
        $prix_total = $_POST['prix_total'][$i];

        // Recherche l'ID du produit
        $result_produit = $mysqli->query("SELECT id FROM Produits WHERE nom = '$nom_produit'");
        if ($result_produit->num_rows > 0) {
            $row_produit = $result_produit->fetch_assoc();
            $id_produit = $row_produit["id"];

            // Insère le produit dans la table produits_commande avec l'ID de la commande correcte
            $insert_produits_commande = "INSERT INTO produits_commande (id_produit, id_commande, quantite, prix_unitaire, prix_total, Statut_transaction) 
                                         VALUES ($id_produit, $last_command_id, $quantite, $prix_unitaire, $prix_total, 'achat')";

            if ($mysqli->query($insert_produits_commande) !== TRUE) {
                ?>
                <script>
                    alert("Erreur lors de l'ajout des détails du produit dans la commande :");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Erreur : Produi <?php echo $nom_produit ?> non trouvé.");
            </script>
            <?php
        }
    }
    $mysqli->close();
    ?>
            <script>
                 window.location.href="../entreprice.php";      
            </script>
      <?php
  }
    // Ferme la connexion
    
   
      
}
?>




  
<script>



let sortedNames = <?php echo $jsonProducts; ?>;
  
  
// Définir l'objet sortedNames à l'extérieur de la fonction sg


// Fonction pour initialiser les événements et gérer les entrées
function sg() {
  let input1 = document.querySelectorAll('.input');
  for (const inputs of input1) {
    inputs.addEventListener("keyup", (e) => {
      removeElements();
      for (let key in sortedNames) {
        let i = sortedNames[key];
        if ( key.toLowerCase().startsWith(inputs.value.toLowerCase()) && inputs.value !== "") {
          // créer un élément li
          let listItem = document.createElement("li");
          // une classe commune
          listItem.classList.add("list-items1");
          listItem.style.cursor = "pointer";
          listItem.addEventListener("click", function () {
            displayNames(key, inputs);
          });
          // afficher la partie correspondante en gras
          let word = "<b>" + key.substr(0, inputs.value.length) + "</b>";
          word += key.substr(inputs.value.length);
          // afficher la valeur dans le tableau
          listItem.innerHTML = word;
          document.querySelector(".list1").appendChild(listItem);
        }
      
      }
    });
  }
}

// Fonction pour afficher le nom sélectionné dans l'input
function displayNames(value1, inputElement) {
  inputElement.value = value1;

  let parentElement = inputElement.parentNode;
  let parent=parentElement.parentNode;

  let priceElement = parent.querySelector('#price');
  

  // Trouver le produit correspondant dans l'objet JSON
  let selectedProduct = sortedNames[value1];
 

  if (selectedProduct) {
    priceElement.value = selectedProduct.prix;
  }

  removeElements();
}

// Fonction pour supprimer tous les éléments de la liste
function removeElements() {
  let items = document.querySelectorAll(".list-items1");
  items.forEach((item) => {
    item.remove();
  });
}

// Exécuter la fonction lors de la frappe
sg();
function copierPositionInput() {
  // Sélectionnez l'input sur lequel l'utilisateur écrit
  const inputEnCours = document.activeElement;

  // Vérifiez si l'élément en cours est bien un input
  if (inputEnCours.tagName === 'INPUT') {
    // Récupérez la position de l'input
    const positionInput = inputEnCours.getBoundingClientRect();

    // Sélectionnez l'élément du DOM auquel vous souhaitez donner la position
    const autreElement = document.querySelector('#f');

    // Appliquez la position à l'autre élément
    autreElement.style.position = 'absolute';
    autreElement.style.left = positionInput.left-75+ 'px';
    autreElement.style.top = positionInput.bottom-110 + 'px';
  }
  console.log(document.querySelector('.f'))
}

// Ajoutez un écouteur d'événement pour déclencher la fonction lorsque l'utilisateur écrit
document.addEventListener('input', copierPositionInput);

</script>
  <script>
    const s = document.querySelector('.lock1');
  s.classList.add('z');
  const s2 = document.querySelector('.lock2');
  const q = document.querySelector('.sidebar');
  s.addEventListener('click', () => {
  q.classList.add('hover');
  q.classList.add('blocked');
  s2.classList.add('z');
  });
  s2.addEventListener('click', () =>{
  q.classList.remove('blocked');
  s2.classList.remove('z');
  })
  </script>

  <script>
    const sidebar = document.querySelector('.sidebar');
 const listItems = document.querySelectorAll('.list');
 
 // Calculer la hauteur de la sidebar et la position des éléments de la liste
 const sidebarHeight = sidebar.offsetHeight;
 const listItemHeight = listItems[0].offsetHeight;
 const listHeight = listItems.length * listItemHeight;
 const padding = (sidebarHeight - listHeight + 1) / 8;
 
 // Ajouter une marge supérieure et inférieure aux éléments de la liste
 listItems.forEach((item) => {
  item.style.marginTop = padding + 'px';
  item.style.marginBottom = padding + 'px';
 });



</script>


<script>
function css(){
  const table = document.querySelector("table");
const trs = table.querySelectorAll("tr");

for (let i = 1; i < trs.length; i++) {
  const tr = trs[i];

  if (i % 2 === 0) {
    tr.style.backgroundColor = "#f3f3f3";
  }
}
}


function addtr(nb,dd){
console.log(nb+dd)
  if(nb>0){
   for(let i=0;i<nb;i++){
    if(nb>16||dd>16||nb+dd>16){
      break;
    }
    const tr = document.createElement("tr");
    tr.innerHTML =`
                <td><input type="text" name="nom_produit[]" class="input" value=""></td>
                <td><input type="number" name="quantite[]" value="0"></td>
                <td><input type="number" name="prix_unitaire[]" value="0" id="price"></td>
                <td><input type="number" name="prix_total[]" value="0" readonly></td>
            `;
  const table = document.querySelector("tbody");
  table.appendChild(tr);
  }
  css()
  misetotal()
  sg()
  }
  
}
const input = document.querySelector('.ss')
input.addEventListener("change",() =>{
  const table = document.querySelector('table.content-table');
  const tbody = table.querySelector('tbody');
  const trCount = tbody.querySelectorAll('tr').length;
  let value=  Number(input.value)
  addtr(value,trCount)
})
const button = document.querySelector('button')
button.addEventListener('click',() =>{
  const gg = document.querySelectorAll('tr')
  
  for(let i=2;i<gg.length;i++){
    const tbody = document.querySelector('tbody');
    if(gg[i].parentNode === tbody){
      tbody.removeChild(gg[i]);
    }
  }

})



function totalprix() {
  const inputs = document.querySelectorAll('tr > td:last-child input');
  const t = document.querySelector(".tt");
  let somme = 0;
  let Neg = "";

  for (const input of inputs) {
    const n = parseInt(input.value);
    if (n < 0) {
      input.style.backgroundColor = "#9e4b2f22";
      Neg = "Negatif";
      break;
    }
    input.style.backgroundColor = "#fff";
    somme += n;
  }

  if (isNaN(somme)) {
    t.value = 0;
    
  } else if (Neg === "Negatif") {
    t.value = Neg;
  } else {
    t.value = somme;

  }
}

// Mise à jour de la somme en temps réel

  function misetotal(){
    const table = document.querySelector('.content-table');

  const quantityInputs = [];
  const unitPriceInputs = [];
  const totalPriceInputs = [];

  const rows = table.querySelectorAll('tbody tr');
  for (let i = 0; i < rows.length; i++) {
    const row = rows[i];

    const quantityInput = row.querySelector('td:nth-child(2) input');
    const unitPriceInput = row.querySelector('td:nth-child(3) input');
    const totalPriceInput = row.querySelector('td:nth-child(4) input');

    quantityInputs.push(quantityInput);
    unitPriceInputs.push(unitPriceInput);
    totalPriceInputs.push(totalPriceInput);
  }

  for (let i = 0; i < quantityInputs.length; i++) {
    const quantityInput = quantityInputs[i];
    const unitPriceInput = unitPriceInputs[i];
    const totalPriceInput = totalPriceInputs[i];

    quantityInput.addEventListener('input', () => {
      const quantity = parseInt(quantityInput.value);
      const unitPrice = parseInt(unitPriceInput.value);
      const totalPrice = quantity * unitPrice;
      console.log(totalPrice)
      totalPriceInput.value = totalPrice;
      console.log(quantity)
      totalprix();
    });
    unitPriceInput.addEventListener('input', () => {
      const quantity = parseInt(quantityInput.value);
      const unitPrice = parseInt(unitPriceInput.value);
      const totalPrice = quantity * unitPrice;
      console.log(totalPrice)
      totalPriceInput.value = totalPrice;
      console.log(quantity)
      totalprix();
    });
    
  }
  }
misetotal()



</script>
<script>
  localStorage.setItem('nav-lien', 0);
  const ss=document.querySelector('#ww');
  function local(){
    localStorage.setItem('nav-lien', 2);
  }
  
</script>
</body>
</html>