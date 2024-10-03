<?php
class Commande {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getCommandes() {
        $stmt = $this->pdo->query("SELECT * FROM commandes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommande($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM commandes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterCommande($nom_client, $date_commande) {
        $query = "INSERT INTO commandes (nom_client, date_commande) VALUES (:nom_client, :date_commande)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->bindParam(':date_commande', $date_commande);
        $stmt->execute();
    }

    public function modifierCommande($id, $nom_client, $date_commande) {
        $query = "UPDATE commandes SET nom_client = :nom_client, date_commande = :date_commande WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->bindParam(':date_commande', $date_commande);
        $stmt->execute();
    }

    public function supprimerCommande($id) {
        $query = "DELETE FROM commandes WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
