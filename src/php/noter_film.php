<?php
include 'database.php';
session_start();

if ($_SESSION['id_client']== null) {
    header('Location: connexion.php');
    exit;
}
else if (isset($_POST['note'], $_POST['film_id'], $_SESSION['id_client'])) {
    $note = (int)$_POST['note'];
    $film_id = (int)$_POST['film_id'];
    $client_id = $_SESSION['id_client'];
    $verif = $pdo->prepare("SELECT * FROM note_film WHERE client_id = ? AND film_id = ?");
    $verif->execute([$client_id, $film_id]);
    if ($verif->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE note_film SET valeur = ? WHERE client_id = ? AND film_id = ?");
        $update->execute([$note, $client_id, $film_id]);
    } else {
        $insert = $pdo->prepare("INSERT INTO note_film (client_id, film_id, valeur) VALUES (?, ?, ?)");
        $insert->execute([$client_id, $film_id, $note]);
    }
    header("Location: film.php?film_id=$film_id");
    exit();
} else {
    echo "Erreur : données manquantes.";
}
?>