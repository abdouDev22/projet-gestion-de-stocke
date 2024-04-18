<?php
// Assure-toi de te connecter à ta base de données avant cette partie
// Utilise les valeurs appropriées pour le serveur, le nom d'utilisateur, le mot de passe et la base de données
$id_utilisateur = 10;
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

    // Récupère les valeurs du formulaire
    $date_commande = $_POST["date_commande"];
    $nom_client = $_POST["nom_client"];

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
    $insert_commande = "INSERT INTO commandes (date_commande, id_utilisateur, id_Client_Fourniseur) 
                        VALUES ('$date_commande', $id_utilisateur, $id_client)";

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
                                         VALUES ($id_produit, $last_command_id, $quantite, $prix_unitaire, $prix_total, 'Achat')";

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

    // Ferme la connexion
    $mysqli->close();
}
?>
<form action="sug.php" method="post">
    <!-- Le reste de ton formulaire -->
</form>
