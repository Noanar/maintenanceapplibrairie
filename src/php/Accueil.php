<?php
include 'database.php';
session_start();
$query1 = $pdo->prepare("SELECT * FROM livres lIMIT 14");
$query2 = $pdo->prepare("SELECT * FROM films  LIMIT 14");
$query3 = $pdo->prepare("SELECT * FROM films WHERE annee_sortie = YEAR(CURDATE()) LIMIT 1");
$query3->execute();
$film_annee = $query3->fetch(PDO::FETCH_ASSOC);
$query1->execute();
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
    <div class="contenair">
        <div class="text-section">
        <?php
            echo'<h1 class="titre-principal">'.$film_annee['titre'].'<span class="highlight">'.' '.$film_annee['annee_sortie'].'</span></h1>';
            echo '<p class="description-produit">' . $film_annee['description'] . '</p>';
            echo '<a href="film.php?film_id='.$film_annee['film_id'].'" class="btn-cta">Lire maintenant</a>';
        echo '</div>';
        echo '<img src="'.$film_annee['image_url'].'" alt="'.$film_annee['titre'].'" class="image-produit">';
        ?>
    </div>
    <div>
    <h2 class="section-title">Livres populaires</h2>
    <div class="boutique">
        <?php while ($livre = $query1->fetch()) {
            echo '<div class="carte-produit">';
            echo '<a href="livre.php?livre_id='.$livre['livre_id'].'">';
            echo '<img src="'.$livre['image_url'].'" alt="'.$livre['titre'].'">';
            echo '</a>';
            echo '<h2>' . $livre['titre'] . '</h2>';
            echo '<p>Pages: ' . $livre['Nb_pages'] . '</p>'; ?>
            <div class="icones-actions">
                <i class="fa-solid fa-heart"></i>
                <form action="site_principal.php" method="POST" style="display:inline;">
                    <input type="hidden" name="livre_id" value="<?php echo $livre['livre_id']; ?>">
                    <input type="hidden" name="id_client" value="<?php echo $_SESSION['id_client'] ?? ''; ?>">
                    <button type="submit" name="ajouter_liste" style="background:none; border:none; padding:0;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>
    <h2 class="section-title">Films récents</h2>
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
