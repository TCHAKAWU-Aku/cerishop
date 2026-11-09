<?php
require_once 'config/database.php';
require_once 'models/Produit.php';

// Récupérer l'ID du produit dans l'URL (ex: produit-detail.php?id=1)
$id_produit = isset($_GET['id']) ? intval($_GET['id']) : 0;

$produitObj = new Produit($connexion);
// On récupère les infos du produit spécifique
$produit = $produitObj->getProduitById($id_produit);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du produit - CeriShop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .detail-container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .detail-container img { width: 100%; max-height: 300px; object-fit: cover; border-radius: 6px; margin-bottom: 15px; }
        h1 { color: #007bff; }
        .btn-panier { background: #ffc107; border: none; padding: 12px 20px; font-size: 16px; border-radius: 4px; cursor: pointer; font-weight: bold; color: #333; margin-top: 15px; width: 100%; transition: background 0.3s; }
        .btn-panier:hover { background: #e0a800; }
        .btn-retour { display: inline-block; margin-top: 20px; text-decoration: none; background: #6c757d; color: white; padding: 10px 15px; border-radius: 4px; }
        .btn-retour:hover { background: #5a6268; }
    </style>
</head>
<body>
    <div class="detail-container">
        <?php if ($produit): ?>
            <?php if (!empty($produit['image'])): ?>
                <img src="public/uploads/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>">
            <?php endif; ?>
            <h1><?= htmlspecialchars($produit['nom_produit']) ?></h1>
            <p><strong>Description : </strong><?= htmlspecialchars($produit['description']) ?></p>
            <p><strong>Prix : </strong><?= htmlspecialchars($produit['prix']) ?> €</p>
            <p><strong>Stock disponible : </strong><?= htmlspecialchars($produit['stock']) ?></p>

            <!-- Formulaire d'ajout au panier -->
            <form action="panier.php" method="POST">
                <input type="hidden" name="produit_id" value="<?= $produit['id'] ?>">
                <button type="submit" class="btn-panier">Ajouter au panier 🛒</button>
            </form>

        <?php else: ?>
            <p>Oups ! Ce produit n'existe pas ou a été supprimé.</p>
        <?php endif; ?>
        
        <br>
        <a href="index.php" class="btn-retour">← Retour à la boutique</a>
    </div>
</body>
</html>