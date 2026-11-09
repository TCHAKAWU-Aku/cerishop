<?php
require_once __DIR__ . '/../config/database.php';

class Produit {
    private $connexion;

    public function __construct($db) {
        $this->connexion = $db;
    }

    // Méthode pour récupérer tous les produits
    public function getAllProduits() {
        $query = "SELECT * FROM produits";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>