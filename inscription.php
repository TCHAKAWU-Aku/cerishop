<?php
require_once 'config/database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!empty($nom) && !empty($email) && !empty($_POST['password'])) {
        // Insertion dans la table utilisateurs (adapter les noms de colonnes selon ta base)
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        
        try {
            $stmt->execute([$nom, $email, $password]);
            $message = "Inscription réussie ! <a href='connexion.php'>Connectez-vous ici</a>";
        } catch (PDOException $e) {
            $message = "Erreur : Cet email est déjà utilisé ou un problème est survenu.";
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
    <title>Inscription - CeriShop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; background-color: #f4f4f9; }
        .form-container { background: white; padding: 30px; border-radius: 8px; max-width: 400px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #007bff; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
        .msg { text-align: center; color: green; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="text-align: center;">Créer un compte 📝</h2>
        <?php if (!empty($message)): ?>
            <div class="msg"><?= $message ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" required>
            
            <label>Email :</label>
            <input type="email" name="email" required>
            
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
            
            <button type="submit">S'inscrire</button>
        </form>
        <p style="text-align: center; margin-top: 15px;"><a href="index.php">← Retour à l'accueil</a></p>
    </div>
</body>
</html>