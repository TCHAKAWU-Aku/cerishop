<?php
session_start();
require_once 'config/database.php';
require_once 'models/Produit.php';

$produit = new Produit($connexion);
$liste_produits = $produit->getAllProduits();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CeriShop - Accueil</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f9; }
        header { background: #333; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header a { color: white; text-decoration: none; margin-left: 15px; font-weight: bold; }
        header a:hover { color: #ffc107; }
        .main-container { padding: 30px; }
        h1 { color: #333; text-align: center; }
        .produits-container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-top: 20px; }
        .produit-card { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 220px; text-align: center; }
        .produit-card img { width: 100%; height: 150px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; }
        .produit-card h3 a { text-decoration: none; color: #007bff; }
        .produit-card h3 a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <header>
        <div><h2>CeriShop 🛍️</h2></div>
        <div>
            <a href="index.php">Accueil</a>
            <?php if (isset($_SESSION['user_nom'])): ?>
                <span>👋 Bonjour, <?= htmlspecialchars($_SESSION['user_nom']) ?></span>
                <a href="panier.php">Mon Panier 🛒</a>
                <a href="deconnexion.php" style="color: #ff6b6b;">Déconnexion</a>
            <?php else: ?>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
                <a href="panier.php">Mon Panier 🛒</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="main-container">
        <h1>Nos produits disponibles :</h1>

        <div class="produits-container">
            <?php if (!empty($liste_produits)): ?>
                <?php foreach ($liste_produits as $prod): ?>
                    <div class="produit-card">
                        <?php if (!empty($prod['image'])): ?>
                            <img src="public/uploads/<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['nom_produit']) ?>">
                        <?php endif; ?>
                        
                        <h3>
                            <a href="produit-detail.php?id=<?= $prod['id'] ?>">
                                <?= htmlspecialchars($prod['nom_produit']) ?>
                            </a>
                        </h3>
                        <p><?= htmlspecialchars($prod['description']) ?></p>
                        <p><strong>Prix : </strong> <?= htmlspecialchars($prod['prix']) ?> €</p>
                        <p>Stock : <?= htmlspecialchars($prod['stock']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; width: 100%;">Aucun produit disponible pour le moment dans la boutique.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>