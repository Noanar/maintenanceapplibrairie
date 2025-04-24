<?php
session_start();
if (!isset($_SESSION['id_client'])) {
    header('Location: connexion.php');
    exit;
}
include 'database.php';
$films = $pdo->prepare("SELECT * FROM note_film INNER JOIN films ON note_film.film_id = films.film_id WHERE client_id = :id_client");
$films->execute(['id_client' => $_SESSION['id_client']]);
$livres = $pdo->prepare("SELECT * FROM note_livre INNER JOIN livres ON note_livre.livre_id = livres.livre_id WHERE client_id = :id_client");
$livres->execute(['id_client' => $_SESSION['id_client']]);
if (isset($_POST['supprimer_panier'])) {
    $id_produit = $_POST['id_produit'];
    $id_client = $_POST['id_client'];
    $quantite = $_POST['quantite'];
    $query = $pdo->prepare("CALL supprimer_produit_panier(:id_client, :id_produit)");
    $query->bindParam(':id_client', $id_client);
    $query->bindParam(':id_produit', $id_produit);
    try {
        $query->execute();
        header("Location: panier.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/panier.css">
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="Accueil.php"><img src="../img/logo1.png" alt="logo" class="logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="Accueil.php">Accueil</a></li>
                <li><a href="films.php">Films</a></li>
                <li><a href="livres.php">livres</a></li>
            </ul>
            <div class="search-cart">
                <div class="cart-icon">
                    <a href="panier.php"><i class="fa-solid fa-heart" style="color: #012807;"></i>                    </i>
                    <span class="cart-count">1</span></a>
                </div>
                <?php if (isset($_SESSION['id_client'])) { ?>
                    <div class="user-icon">
                        <a href="deconnexion.php"><i class="fa-solid fa-right-from-bracket" style="color: #012807; margin-left: 30px;"></i></a>
                    </div>
                <?php } else { ?>
                <div>
                    <a href="connexion.php"><i class="fa-solid fa-user" style="color: #012807; margin-left: 30px;"></i></a>
                </div>
                <?php } ?>
            </div>
        </nav>
    </header>
    <h2 style="margin-left: 70px; margin-top: 30px;">Mes Films Likés</h2>
<div class="panier-section">
    <div class="panier-details">
        <?php
        if($films->rowCount() == 0) {
            echo "<p>Aucun film liké.</p>";
        } else {
            while ($film = $films->fetch()) {
                echo '<div class="panier-item">';
                echo '<img src="' . $film['image_url'] . '" alt="Image du film">';
                echo '<div>';
                echo '<h3>' . $film['titre'] . '</h3>';
                echo '<p>Note : ' . $film['valeur'] . '/5</p>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<h2 style="margin-left: 70px; margin-top: 30px;">Mes Livres Likés</h2>
<div class="panier-section">
    <div class="panier-details">
        <?php
        if($livres->rowCount() == 0) {
            echo "<p>Aucun livre liké.</p>";
        } else {
            while ($livre = $livres->fetch()) {
                echo '<div class="panier-item">';
                echo '<img src="' . $livre['image_url'] . '" alt="Image du livre">';
                echo '<div>';
                echo '<h3>' . $livre['titre'] . '</h3>';
                echo '<p>Note : ' . $livre['valeur'] . '/5</p>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

</body>
</html>
