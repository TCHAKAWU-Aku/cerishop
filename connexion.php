<?php
session_start();
require_once 'config/database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if ($utilisateur && password_verify($password, $utilisateur['mot_de_passe'])) {
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['user_nom'] = $utilisateur['nom'];
            header("Location: index.php");
            exit();
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - CeriShop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; background-color: #f4f4f9; }
        .form-container { background: white; padding: 30px; border-radius: 8px; max-width: 400px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #28a745; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #218838; }
        .msg { text-align: center; color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="text-align: center;">Connexion 🔑</h2>
        <?php if (!empty($message)): ?>
            <div class="msg"><?= $message ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label>Email :</label>
            <input type="email" name="email" required>
            
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
        <p style="text-align: center; margin-top: 15px;"><a href="inscription.php">Créer un compte</a> | <a href="index.php">Accueil</a></p>
    </div>
</body>
</html>