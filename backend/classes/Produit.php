<?php

class Produit
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getProduits()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM produits");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getProduit($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterProduit($nom, $description, $prix, $quantite)
    {
        $query = "INSERT INTO produits (nom, description, prix, quantite) VALUES (:nom, :description, :prix, :quantite)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->execute();
    }

    public function modifierProduit($id, $nom, $description, $prix, $quantite)
    {
        $query = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, quantite = :quantite WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->execute();
    }

    public function supprimerProduit($id)
    {
        $query = "DELETE FROM produits WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
