<?php
session_start();
require_once 'config/database.php';

// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier si un ID est passé en POST
if (isset($_POST['produit_id'])) {
    $id = intval($_POST['produit_id']);
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]++;
    } else {
        $_SESSION['panier'][$id] = 1;
    }
    header("Location: panier.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier - CeriShop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        .btn { background: #007bff; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mon Panier 🛒</h2>
        <?php if (!empty($_SESSION['panier'])): ?>
            <table>
                <tr>
                    <th>Produit (ID)</th>
                    <th>Quantité</th>
                </tr>
                <?php foreach ($_SESSION['panier'] as $id => $quantite): ?>
                    <tr>
                        <td>Produit #<?= $id ?></td>
                        <td><?= $quantite ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
        <br>
        <a href="index.php" class="btn">← Continuer mes achats</a>
    </div>
</body>
</html>