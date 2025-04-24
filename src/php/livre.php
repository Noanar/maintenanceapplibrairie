<?php
include 'database.php';
session_start();

// Vérification de l'existence du paramètre GET
if (!isset($_GET['livre_id'])) {
    die("Identifiant de livre non fourni.");
}

$id_livre = $_GET['livre_id'];

// Récupération des infos du livre
$livreStmt = $pdo->prepare("SELECT * FROM livres WHERE livre_id = :id_livre");
$livreStmt->execute(['id_livre' => $id_livre]);
$livre = $livreStmt->fetch();

// Récupération de la note moyenne (j'ai supposé qu'il y a une table 'notes' liée aux films)
$noteStmt = $pdo->prepare("SELECT AVG(valeur) as note_livre FROM note_livre WHERE livre_id = :id_livre");
$noteStmt->execute(['id_livre' => $id_livre]);
$note = $noteStmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de navigation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Accueil.css">
    <style>
        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            display: flex;
            justify-content: flex-start;
            gap: 5px;
        }

        .rating input[type="radio"] {
            display: none;
        }

        .rating label {
            font-size: 25px;
            color: #ccc;
            cursor: pointer;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
        }

    </style>
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
                <li><a href="livres.php">Livres</a></li>
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
            <?php if ($livre): ?>
                <h1 class="titre-principal">
                    <?= htmlspecialchars($livre['titre']) ?>
                    <span class="highlight"><?= htmlspecialchars($livre['date_sortie']) ?></span>
                </h1>
                <p class="description-produit"><?= htmlspecialchars($livre['Nb_pages']) ?> pages</p>
                <?php if ($note && $note['note_livre']): ?>
                    <p class="description-produit">Note moyenne : <?= number_format($note['note_livre'], 1) ?>/5</p>
                <?php endif; ?>
                <a href="#" class="btn-cta">Lire maintenant</a>
            <?php else: ?>
                <p>Livre non trouvé.</p>
            <?php endif; ?>
        </div>
        <form action="noter_livre.php" method="post" class="note-form">
            <input type="hidden" name="livre_id" value="<?= $id_livre ?>">
            <div class="rating">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <input type="radio" id="star<?= $i ?>" name="note" value="<?= $i ?>">
                    <label for="star<?= $i ?>"><i class="fa-solid fa-star"></i></label>
                <?php endfor; ?>
            </div>
            <button type="submit">Noter</button>
        </form>
        <img src="<?php echo $livre['image_url']; ?>" alt="Appareil Photographique" class="image-produit">

    </div>
    
</body>
</html>
