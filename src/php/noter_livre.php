<?php
include 'database.php';
session_start();

if ($_SESSION['id_client']== null) {
    header('Location: connexion.php');
    exit;
}
else if (isset($_POST['note'], $_POST['livre_id'], $_SESSION['id_client'])) {
    $note = (int)$_POST['note'];
    $livre_id = (int)$_POST['livre_id'];
    $client_id = $_SESSION['id_client'];
    $verif = $pdo->prepare("SELECT * FROM note_livre WHERE client_id = ? AND livre_id = ?");
    $verif->execute([$client_id, $livre_id]);
    if ($verif->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE note_livre SET valeur = ? WHERE client_id = ? AND livre_id = ?");
        $update->execute([$note, $client_id, $livre_id]);
    } else {
        $insert = $pdo->prepare("INSERT INTO note_livre (client_id, livre_id, valeur) VALUES (?, ?, ?)");
        $insert->execute([$client_id, $livre_id, $note]);
    }
    header("Location: livre.php?livre_id=$livre_id");
    exit();
} else {
    echo "Erreur : données manquantes.";
}
?>