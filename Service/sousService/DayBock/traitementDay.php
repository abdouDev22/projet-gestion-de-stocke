<?php
session_start();
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['id_utilisateur'])) {

}else{
  header("Location: ../../../index.php");
}

$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "stockage1";
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
if ($conn->connect_error) {
  die("La connexion à la base de données a échoué : " . $conn->connect_error);
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


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../asset/cash.css">
  <link rel="stylesheet" href="../../../asset/coment.css">
  <link rel="stylesheet" href="../../../asset/phpAC.css">
  <title>Document</title>
</head>
<body>
<?php
$id_commande=$_GET['id'];
 $query = "SELECT commandes.date_commande,client_fourniseur.nom AS Nom_client,commandes.id FROM commandes 
 JOIN client_fourniseur ON commandes.id_Client_Fourniseur = client_fourniseur.id WHERE commandes.id=$id_commande
";
$query1= "SELECT produits_commande.prix_total AS prix_total,produits.nom AS nom_produits,produits_commande.quantite AS quantite,produits.prix AS Prix_unitaire FROM produits_commande
 JOIN produits ON produits.id = produits_commande.id_produit WHERE produits_commande.id_commande=$id_commande
";
 $result = $conn->query($query);
 $result1 = $conn->query($query1);
 ?>
  <nav>
    <div class="logo">
      <strong>MATA</strong>
      <span>Company</span>
    </div>
    <ul>
      <li><a href="../../../logout.php">logout</a> </li>
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
        <a href="../profile/profile.php">
          <span class="icon"><span class="profile"><svg fill="#000000" width="800px" height="800px" viewBox="0 0 64 64"version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"xml:space="preserve" xmlns:serif="http://www.serif.com/"style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g transform="matrix(1,0,0,1,-1216,-192)"><rect id="Icons" x="0" y="0" width="1280" height="800" style="fill:none;" /><g id="Icons1" serif:id="Icons"><g id="Strike"></g><g id="H1"></g><g id="H2"> </g><g id="H3"></g><g id="list-ul"></g><g id="hamburger-1"></g><g id="hamburger-2"></g><g id="list-ol"></g><g id="list-task"></g><g id="trash"></g><g id="vertical-menu"></g><g id="horizontal-menu"></g><g id="sidebar-2"></g><g id="Pen"></g><g id="Pen1" serif:id="Pen"></g><g id="clock"></g><g id="external-link"></g><g id="hr"></g><g id="info"></g><g id="warning"></g><g id="plus-circle"></g><g id="minus-circle"></g><g id="vue"></g><g id="cog"> </g><g id="logo"></g><g id="radio-check"></g><g id="eye-slash"></g><g id="eye"></g><g id="toggle-off"></g><g id="shredder"></g><g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"></g><g id="react"></g><g id="check-selected"></g><g id="turn-off"></g><g id="code-block"></g><g id="user" transform="matrix(1.03318,0,0,1.03318,-20.8457,199.979)"><g transform="matrix(0.909091,0,0,0.909091,1182.28,-18.6364)"><path d="M50,46.5C42.8,46.5 37,40.7 37,33.5C37,26.3 42.8,20.5 50,20.5C57.2,20.5 63,26.3 63,33.5C63,40.7 57.2,46.5 50,46.5ZM50,24.5C45,24.5 41,28.5 41,33.5C41,38.5 45,42.5 50,42.5C55,42.5 59,38.5 59,33.5C59,28.5 55,24.5 50,24.5Z"style="fill-rule:nonzero;" /></g><g transform="matrix(1,0,0,1,1177.7,-20.5)"><path d="M34.036,58.5L34.036,67L30.4,67L30.4,58.5C30.4,51.318 39.218,45.773 50.4,45.773C61.582,45.773 70.4,51.318 70.4,58.5L70.4,67L66.764,67L66.764,58.5C66.764,53.591 59.309,49.409 50.4,49.409C41.491,49.409 34.036,53.591 34.036,58.5Z"style="fill-rule:nonzero;" /></g></g><g id="coffee-bean"></g><g transform="matrix(0.638317,0.368532,-0.368532,0.638317,785.021,-208.975)"><g id="coffee-beans"><g id="coffee-bean1" serif:id="coffee-bean"></g></g></g><g id="coffee-bean-filled"></g><g transform="matrix(0.638317,0.368532,-0.368532,0.638317,913.062,-208.975)"><g id="coffee-beans-filled"><g id="coffee-bean2" serif:id="coffee-bean"></g></g></g><g id="clipboard"></g><g transform="matrix(1,0,0,1,128.011,1.35415)"><g id="clipboard-paste"></g></g><g id="clipboard-copy"></g><g id="Layer1"></g></g></g></svg></span></span>
          <span class="text">Profile</span>
        </a>
      </li>
      <li class="list">
        <a href="../../index.php">
          <span class="icon"><svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/><path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/></svg></span>
          <span class="text">Modify</span>
        </a>
      </li>
      
      <li class="list">
        <a href="../../Analitics.php">
          <span class="icon"><svg width="800px" height="800px" viewBox="0 0 128 128" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">.st0{display:none;}.st1{display:inline;}.st2{fill:none;stroke:#0F005B;stroke-width:8;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style><g class="st0" id="Layer_1"/><g id="Layer_2"><path class="st2" d="M72.3,19.3c20.1,0,36.4,16.3,36.4,36.4H72.3V19.3z"/><path class="st2" d="M55.7,57.7V35.9c-20.1,0-36.4,16.3-36.4,36.4s16.3,36.4,36.4,36.4s36.4-16.3,36.4-36.4H55.7"/></g></svg></span>
          <span class="text">Analitics</span>
        </a>
      </li>
    </ul>
  </div>
  
  <div class="cont1 n">
    <ul class="ul list1" id="f"></ul>
    
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
    <form action="">
    <h1>D-commande</h1>
    <a href="Daybock.php" onclick="local()" class="lien-ret"><svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M16 12H8M8 12L11 9M8 12L11 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/></svg></a>
    
    <span class="Name">Name client</span>
    <span class="Name1"><input type="text" name="" value="<?php echo $row['Nom_client']; ?>" id=""></span>
    <span class="date">Date</span>
    <span class="date1"><input type="date" value="<?php echo $row['date_commande']; ?>"></span>
    <span class="num">NO :</span>
    <span class="num1"><input type="number" value="<?php echo $id_commande; ?>" readonly></span>
    <span class="total1">Prix TOTAL</span>
    <span class="total"><input class="tt" type="text" value="" readonly></span>
    <?php
        }
    } else {
        ?>
        <script>
            alert("Aucun client trouvé dans la base de données.");
        </script>
        <?php
    }
    ?>
      <table class="content-table">
        <thead>
        
          <tr>
            <th>Name produit</th>
            <th>Quatité</th>
            <th>Prix Unitaire</th>
            <th>Prix total</th>
          </tr>
          
        </thead>
        <tbody>
        <?php
      if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            ?>
          <tr>
            <td><input type="text" class="input" value="<?php echo $row['nom_produits']; ?>"></td>
            <td><input type="number" value="<?php echo $row['quantite']; ?>"></td>
            <td><input type="number" id="price" value="<?php echo $row['Prix_unitaire']; ?>"></td>
            <td><input type="number" value="<?php echo $row['prix_total']; ?>"  readonly></td>
          </tr>
          <?php
        }
    } else {
        ?>
        <script>
            alert("Aucun client trouvé dans la base de données.");
        </script>
        <?php
    }
    ?>
        </tbody>
      </table>
      
      
    </form>
    
    
    

  </div>


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
  const remiseInput = document.querySelector('#hf');
let isEnterPressed = false;

remiseInput.addEventListener('keydown', (event) => {
  if (event.key === 'Enter') {
    isEnterPressed = true;
  }
});

remiseInput.addEventListener('keyup', (event) => {
  if (event.key === 'Enter' && isEnterPressed) {
    // Ton code à exécuter quand la touche "Entrée" est relâchée
    console.log('Touche Entrée relâchée!');
    rof(remiseInput.value)
    // Ajoute ici le code que tu veux exécuter
    isEnterPressed = false; // Réinitialise la variable
  }
});
  
  
  function rof(inpu){
    const remiset=document.querySelector('#hh input')
    const inputs = document.querySelectorAll('tr > td:last-child input');
  const t = document.querySelector(".tt");
  let somme = 0;
  let Neg = "";
  let out = inpu
  console.log(out)
  for (const input of inputs) {
    const n = parseInt(input.value);
    if(n ===0){
      continue
    }
   else if (n <= out) {
      input.style.backgroundColor = "#9e4b2f22";
      console.log(input)
      out -= n
    }else{
      input.style.backgroundColor = "#fff";
      somme += n;
    }
    
  }


    t.value = somme;
    remiset.value=out
    

  


}
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
    tr.innerHTML = `
    <td><input type="text" value="" class="input"></td>
    <td><input type="number" value="0" ></td>
    <td><input type="number" value="0" id="price"></td>
    <td><input type="number" value="0" readonly></td>
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
if(!input){
  console.log("yes");
}else{
  input.addEventListener("change",() =>{
  const table = document.querySelector('table.content-table');
  const tbody = table.querySelector('tbody');
  const trCount = tbody.querySelectorAll('tr').length;
  let value=  Number(input.value)
  addtr(value,trCount)
})
}

const button = document.querySelector('button');
if(!button){
  console.log("yes");
}else{
  button.addEventListener('click',() =>{
  const table = document.querySelector('table.content-table');
  const tbody = table.querySelector('tbody');
  const trCount = tbody.querySelectorAll('tr').length;
  let value=  Number(input.value)
  addtr(value,trCount)
})
}




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


document.addEventListener('DOMContentLoaded', function() {
  misetotal();
  totalprix(); 
});


const v= document.querySelector('.output1').addEventListener('click',() => {
  rof(remiseInput.value)
})

</script>

</body>
</html>