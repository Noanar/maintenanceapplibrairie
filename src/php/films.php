<?php
include 'database.php';
session_start();
$query2 = $pdo->prepare("SELECT * FROM films ");
$query2->execute();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de navigation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Accueil.css">
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
    <h2 class="section-title">Liste de films</h2>
    <div class="boutique">
        <?php while ($film = $query2->fetch()) {
            echo '<div class="carte-produit">';
            echo '<a href="film.php?film_id='.$film['film_id'].'">';
            echo '<img src="'.$film['image_url'].'" alt="'.$film['titre'].'">';
            echo '</a>';
            echo '<h2>' . $film['titre'] . '</h2>';
            echo '<p>' . $film['annee_sortie'] . ' • ' . $film['duree_minutes'] . ' min</p>'; ?>
            <div class="icones-actions">
                <i class="fa-solid fa-heart"></i>
                <form action="site_principal.php" method="POST" style="display:inline;">
                    <input type="hidden" name="film_id" value="<?php echo $film['film_id']; ?>">
                    <input type="hidden" name="id_client" value="<?php echo $_SESSION['id_client'] ?? ''; ?>">
                    <button type="submit" name="ajouter_liste" style="background:none; border:none; padding:0;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>
