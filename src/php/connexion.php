<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    require 'database.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $reqclient = $pdo->prepare("SELECT * FROM clients WHERE email_client = :email");
    $reqclient->execute(['email' => $email]);
    $client = $reqclient->fetch();
    $requtilisateur = $pdo->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = :email");
    $requtilisateur->execute(['email' => $email]);
    $utilisateur = $requtilisateur->fetch();
    if ($client && password_verify($password, $client['password_client'])) {
        $_SESSION['id_client'] = $client['id_client'];
        $_SESSION['nom_client'] = $client['nom_client'];
        $_SESSION['prenom_client'] = $client['prenom_client'];
        $_SESSION['email_client'] = $client['email_client'];
        $_SESSION['adresse_client'] = $client['adresse_client'];
        $_SESSION['sexe_client'] = $client['sexe_client'];
        header('Location: Accueil.php');
        exit;}
    else {
        $error = "Email ou mot de passe incorrect.";
    }

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de connexion</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="connexion.php" method="POST">
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="password"  name="password" required>
                    <label>Mot de passe</label>
                </div>
                <?php if (isset($error)): ?>
                    <p style="color: red;margin-top:20px"><?php echo $error; endif?></p>
                <div class="forgot-pass">
                    <a href="#">mots de passe oublié?</a>
                </div>
                <button type="submit" class="btn">connexion</button>
                <div class="signup-link">
                    <a href="inscription.php">s'inscrire</a>
                </div>
            </form>
        </div>
</body>
</html>
