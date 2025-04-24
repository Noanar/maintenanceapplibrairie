<?php
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    require 'database.php';

    $nom = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmation = $_POST['confirm_password'];
    $sexe = $_POST['sexe'];

    $req = $pdo->prepare("SELECT * FROM clients WHERE email_client = :email");
    $req->execute(['email' => $email]);
    $user = $req->fetch();

    if ($user) {
        $error = "L'email est déjà utilisé.";
    } elseif ($password !== $confirmation) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO clients (nom_client,email_client, password_client) VALUES (:nom_client, :email_client, :password_client)");
        $stmt->execute([
            'nom_client' => $nom,
            'email_client' => $email,
            'password_client' => $hashed_password
        ]);

        header('Location: connexion.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-box">
        <h2>Inscription</h2>
        <form action="inscription.php" method="POST">
            <div class="input-box">
                <input type="text" name="username" required>
                <label>Nom d'utilisateur</label>
            </div>
            <div class="input-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <label>Mot de passe</label>
            </div>
            <div class="input-box">
                <input type="password"  name="confirm_password" required>
                <label>Confirmer le mot de passe</label>
            </div>
            <button type="submit" class="btn">S'inscrire</button>
            <div class="signup-link">
                <a href="connexion.php">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </div>
</body>
</html>
